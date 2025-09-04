<?php

namespace App\Http\Controllers\User;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\RequestPaymentAccount; 
use App\Models\GeneralSetting; 
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\RequestPayment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\FileTypeValidate;
use Image;
use DB;
use Carbon\Carbon;
class RequestAccountController extends Controller
{ 
 
    public function __construct()
    {
        // $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }
 

    public function index(Request $request)
    {
        $pageTitle       = 'Request Payment Account';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.vendor.request_account.index', compact('pageTitle', 'user'));
    }

    public function create(Request $request)
    {
        $pageTitle = 'Requet New Account';
        $accounts = RequestPaymentAccount::latest()->whereStatus(1)->get();
        return view($this->activeTemplate . 'user.vendor.request_account.create', compact('pageTitle','accounts'));
    }
    
    public function createRequest(Request $request)
    {    
            $user = auth()->user();
            $account = RequestPaymentAccount::whereId($request->account)->whereStatus(1)->firstOrFail();
            $commission = ($request->amount / 100) * $account->fee; // Correct Calculation
            $worth = $request->amount - $commission;
            $get = $worth * $account->rate;
            $code = getTrx();
            $order               = new RequestPayment();
            $order->user_id      = $user->id;
            $order->account_id   =  $account->id;
            $order->amount       =  $request->amount;
            $order->rate         = $account->rate; 
            $order->fee          = $commission; 
            $order->pay          = $get;  
            $order->details      = $account->details; 
            $order->status       = 0; 
            $order->trx          = $code;
            $order->save();
            $notify[] = ['success', 'Please complete payment'];
            return to_route('user.requestaccount.confirm',encrypt($code))->withNotify($notify);       
    }

    public function cancel($id)
    {
        $pageTitle = 'Cancel Payment';
        $user = auth()->user();
        $account = RequestPayment::latest()->whereUserId($user->id)->whereStatus(0)->whereTrx(decrypt($id))->with('account')->firstOrFail();
        $account->status = 3;
        $account->save();
        $notify[] = ['success', 'Payment Canceled'];
        return back()->withNotify($notify);
}

    public function confirm($id)
    {
        $pageTitle = 'Confirm Payment';
        $user = auth()->user();
        $account = RequestPayment::latest()->whereUserId($user->id)->whereStatus(0)->whereTrx(decrypt($id))->with('account')->firstOrFail();
        return view($this->activeTemplate . 'user.vendor.request_account.confirm', compact('pageTitle','account'));
    }


    public function confirmPost(Request $request, $id)
    {
        $request->validate([
            'proof'     => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $user = auth()->user();
        $account = RequestPayment::latest()->whereUserId($user->id)->whereStatus(0)->whereTrx(decrypt($id))->with('account')->firstOrFail();
        $path = imagePath()['proof']['path'].'/'.$user->username;
        if ($request->hasFile('proof')) {
             
            try {
                    
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
               $proof = $account->trx.'.png';
               $image = Image::make($request->proof)->save($path . '/'.$proof);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload your front kyc id image'];
                return back()->withNotify($notify)->withInput();
            }
        } 
        $account->proof = $proof;
        $account->status = 2;
        $account->save();
        $notify[] = ['success', 'Payment is pending'];
        return to_route('user.requestaccount.history')->withNotify($notify);     
    }
    public function history()
    {
        $user = auth()->user();
        $pageTitle = 'Payment Log';
        $log = RequestPayment::latest()->whereUserId($user->id)->with('account')->paginate(10);
        return view($this->activeTemplate . 'user.vendor.request_account.history', compact('pageTitle','log'));
    }

     
}
