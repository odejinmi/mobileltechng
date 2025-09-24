<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function showLoginForm()
    {
        $pageTitle = "Login";
        return view($this->activeTemplate . 'user.auth.login', compact('pageTitle'));
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        $request->session()->regenerateToken();

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);
    }

    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {

        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout()
    {
        $this->guard()->logout();

        request()->session()->invalidate();

        $notify[] = ['success', 'You have been logged out.'];
        return to_route('user.login')->withNotify($notify);
    }





    public function authenticated(Request $request, $user)
    {
        $user->tv = $user->ts == 1 ? 0 : 1;
        $user->save();
        $ip = getRealIP();
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->city =  $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',', $info['long']);
            $userLogin->latitude =  @implode(',', $info['lat']);
            $userLogin->city =  @implode(',', $info['city']);
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();

        return to_route('user.home');
    }

    // Add Google OAuth methods
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        // Debug: Log all request parameters
        \Log::info('Google Callback Request:', [
            'all_params' => $request->all(),
            'code' => $request->get('code'),
            'state' => $request->get('state'),
            'error' => $request->get('error'),
            'url' => $request->fullUrl()
        ]);

        // Handle user denial or errors
        if ($request->has('error')) {
            $notify[] = ['error', 'Google authentication was cancelled: ' . $request->get('error')];
            return redirect()->route('user.login')->withNotify($notify);
        }

        // Check if code exists
        if (!$request->has('code') || empty($request->get('code'))) {
            \Log::error('No authorization code received from Google');
            $notify[] = ['error', 'Authorization code not received from Google.'];
            return redirect()->route('user.login')->withNotify($notify);
        }
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if user already exists with this Google ID
            $existingUser = User::where('google_id', $googleUser->id)->first();

            if ($existingUser) {
                // Use the same authentication flow as normal login
                Auth::login($existingUser, true);

                // Call the same authenticated method to maintain consistency
                return $this->authenticated(request(), $existingUser);
            }

            // Check if user exists with same email
            $existingEmailUser = User::where('email', $googleUser->email)->first();

            if ($existingEmailUser) {
                // Update existing user with Google ID and avatar
                $existingEmailUser->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);

                Auth::login($existingEmailUser, true);

                // Call the same authenticated method
                return $this->authenticated(request(), $existingEmailUser);
            }

            // Create new user with proper defaults
            $user = new User();

            $newUser = User::create([
                'firstname' => $this->extractFirstName($googleUser->name),
                'lastname' => $this->extractLastName($googleUser->name),
                'username' => $this->generateUsername($googleUser->email),
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => Hash::make(uniqid()), // Random password
                'email_verified_at' => now(), // Auto-verify Google users
                'status' => 1, // Active status
                'ev' => 1, // Email verified
                'sv' => 1, // SMS verified (if applicable)
                'ts' => 0, // Two-factor security
                'tv' => 1, // Two-factor verified
                'theme' => 'default', // Default theme
            ]);

            Auth::login($newUser, true);

            // Call the same authenticated method
            return $this->authenticated(request(), $newUser);

        } catch (Exception $e) {
            $notify[] = ['error', 'Something went wrong with Google authentication.'];
            return redirect()->route('user.login')->withNotify($notify);
        }
    }

    // Helper methods for Google user creation
    private function extractFirstName($fullName)
    {
        $nameParts = explode(' ', $fullName);
        return $nameParts[0] ?? '';
    }

    private function extractLastName($fullName)
    {
        $nameParts = explode(' ', $fullName);
        array_shift($nameParts); // Remove first name
        return implode(' ', $nameParts) ?: '';
    }

    private function generateUsername($email)
    {
        $baseUsername = explode('@', $email)[0];
        $username = $baseUsername;
        $counter = 1;

        // Ensure username is unique
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }
}
