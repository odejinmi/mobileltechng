<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use App\Lib\GoogleAuthenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{


    public function downlines(){


        $pageTitle = 'Downline Log';
        $user      = auth()->user();
        $ref = User::where('ref_by', $user->id)->latest()->paginate(getPaginate());
        $transactions = Transaction::where('user_id', $user->id)->whereTrxType('+')->whereRemark('Referral')->latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate.'user.ref', compact('transactions','pageTitle', 'user', 'ref', 'emptyMessage'));
    }


    public function profile()
    {
        $general            = gs();
        $pageTitle = "Account Setting";
        $countries  = json_decode(file_get_contents(resource_path('mobileapp/partials/country.json')));
        $user      = auth()->user();
        $ga        = new GoogleAuthenticator();
        $user      = auth()->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->site_name, $secret);
        return view($this->activeTemplate . 'user.profile_setting', compact('countries','secret','qrCodeUrl','ga','pageTitle', 'user'));
    }



    public function profileChange(){
        $pageTitle = 'Update Account';
        $user      = auth()->user(); 
        $countries  = json_decode(file_get_contents(resource_path('mobileapp/partials/country.json')));

        return view($this->activeTemplate.'user.profile', compact('pageTitle', 'user','countries'));
    }

    public function submitProfile(Request $request)
    {

        $request->validate([
            'firstname' => 'sometimes|string',
            'lastname'  => 'sometimes|string',
            'image'     => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ], [
            'firstname.required' => 'First name field is required',
            'lastname.required'  => 'Last name field is required',
        ]);

        $user = auth()->user();

        if ($request->hasFile('image')) {
            try {
                $old         = $user->image;
                $user->image = fileUploader($request->image, getFilePath('userProfile'), getFileSize('userProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }
        if($request->firstname ||$request->lastname   )
        {

            $user->firstname = $request->firstname;
            $user->lastname  = $request->lastname;
            $user->gender  = $request->gender;
            $user->dob  = $request->dob;
            $message = 'Profile Updated';
        }
        if(!empty($request->address))
        {
            $user->address   = [
                'address' => $request->address,
                'state'   => $request->state,
                'zip'     => $request->zip,
                'city'    => $request->city,
                'country'    => $request->country,
            ];
            $message = 'Billing Address Updated';
        }
            if(!empty($request->notification))
            {
                $user->sn = $request->sn ? 1 : 0;
                $user->en = $request->en ? 1 : 0;
                $message = 'Notification Status Updated';
            }



        $user->save();
        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }


    public function changePassword(){


        $pageTitle = 'Account Password';
        $user      = auth()->user(); 
        return view($this->activeTemplate.'user.password', compact('pageTitle', 'user'));
    }


    public function submitPassword(Request $request)
    {

        $passwordValidation = Password::min(6);
        $general            = gs();

        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', $passwordValidation],
        ]);

        $user = auth()->user();

        if (Hash::check($request->current_password, $user->password)) {
            $password       = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password updated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }


    public function TrxPassword(){
        $pageTitle = 'Transaction PIN';
        $user      = auth()->user(); 
        return view($this->activeTemplate.'user.trxpassword', compact('pageTitle', 'user'));
    }


    public function submitTrxPassword(Request $request)
    {

        $passwordValidation = Password::min(6);
        $general            = gs();

        $this->validate($request, [
            'password' => 'required',
            'pin' => 'required|min:4|max:6',
        ]);
        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $password       = Hash::make($request->pin);
            $user->trx_password = $password;
            $user->save();
            $notify[] = ['success', 'Transaction Pin Updated Successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The account password is invalid!'];
            return back()->withNotify($notify);
        }
    }

    public function TerminalPassword(){
        $pageTitle = 'Terminal PIN';
        $user      = auth()->user(); 
        if($user->vendor < 1)
        {
            $notify[] = ['error', 'This is not a vendor account'];
            return back()->withNotify($notify);
        }
        return view($this->activeTemplate.'user.terminalpassword', compact('pageTitle', 'user'));
    }


    public function submitTerminalPassword(Request $request)
    {

        $passwordValidation = Password::min(6);
        $general            = gs();

        $this->validate($request, [
            'password' => 'required',
            'pin' => 'required|min:4|max:4',
        ]);
        $user = auth()->user();
        if($user->vendor < 1)
        {
            $notify[] = ['error', 'This is not a vendor account'];
            return back()->withNotify($notify);
        }
        if (Hash::check($request->password, $user->password)) {
            $password       = Hash::make($request->pin);
            $user->terminal_pin = $password;
            $user->save();
            $notify[] = ['success', 'Terminal Pin Updated Successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The account password is invalid!'];
            return back()->withNotify($notify);
        }
    }
    public function deactivate(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);
        $user = auth()->user();
        if (Hash::check($request->password, $user->password)) {
            $user->status     = 0;
            $user->ban_reason = 'Self Action';
            $user->save();
            $notify[] = ['success', 'Account Deactivated Successfully'];
            return redirect()->route('user.login')->withNotify($notify);
        } else {
            $notify[] = ['error', 'The account password is invalid!'];
            return back()->withNotify($notify);
        }
    }
}
