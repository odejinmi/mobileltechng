<?php

namespace App\Http\Controllers\User\Auth;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('registration.status')->except('registrationNotAllowed');
        $this->activeTemplate = activeTemplate();
    }

    public function showRegistrationForm($ref = null)
    {
        $pageTitle  = "Register";

        return view($this->activeTemplate . 'user.auth.register', compact('pageTitle'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $general = gs();
        $passwordValidation = Password::min(6);

        $validate = Validator::make($data, [
            'email' => 'required|string|email|unique:users',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            'nin' => 'required',
            'password' => ['required', 'confirmed', $passwordValidation],
            'username' => 'required|unique:users|min:4',
        ]);
        return $validate;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $request->session()->regenerateToken();

//        if (preg_match("/[^a-z0-9_]/",
//            trim($request->username)
//        )) {
//            $notify[] = ['info', 'Username can contain only small letters, numbers and underscore.'];
//            $notify[] = ['error', 'No special character, space or capital letters in username.'];
//            return back()->withNotify($notify)->withInput($request->all());
//        }


        $exist = User::where('mobile', $request->mobile_code . $request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'The mobile number already exists'];
            return back()->withNotify($notify)->withInput();
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $general = gs();
        //User Create
        $user = new User();
        $user->email = strtolower(trim($data['email']));
        $user->password = Hash::make($data['password']);
        $user->username = trim($data['username']);
        $user->firstname = trim($data['firstname']);
        $user->lastname = trim($data['lastname']);
        $user->profile_complete = 1;
        $user->country_code = '234';
        $user->mobile = $data['mobile'];
        $user->nin = $data['nin'];
        $user->address = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => isset($data['country']) ? $data['country'] : null,
            'city' => ''
        ];
        if($general->welcome_bonus == 1)
        {
          $user->balance = $general->welcome_bonus_amount;
        }

        $referUser = null;

        $user->ref_by = $referUser ? $referUser->id : 0;
        $user->ev = $general->ev ? Status::NO : Status::YES;
        $user->sv = $general->sv ? Status::NO : Status::YES;
        $user->ts = 0;
        $user->tv = 1;
        $user->save();
        if($general->reg_commission == 1)
        {
            levelCommision($user->id);
        }

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = urlPath('admin.users.detail', $user->id);
        $adminNotification->save();

        //Login Log Create
        $ip = getRealIP();
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
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

        $userAgent          = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip = $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os      = @$userAgent['os_platform'];
        $userLogin->save();


        return $user;
    }

    public function checkUser(Request $request)
    {
        $exist['data'] = false;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = User::where('email', $request->email)->exists();
            $exist['type'] = 'email';
        }
        if ($request->mobile) {
            $exist['data'] = User::where('mobile', $request->mobile)->exists();
            $exist['type'] = 'mobile';
        }
        if ($request->username) {
            $exist['data'] = User::where('username', $request->username)->exists();
            $exist['type'] = 'username';
        }
        return response($exist);
    }

    public function registered()
    {
        return to_route('user.home');
    }
}
