<?php

namespace App\Http\Controllers\User;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\GeneralSetting; 
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class QrController extends Controller
{ 
 
    public function __construct()
    {
        // $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }

    public function index($id)
    { 
        $pageTitle = 'QR Payment';
        $user = User::whereUsername(decrypt($id))->whereStatus(1)->firstOrFail(); 
        return view($this->activeTemplate . 'qr', compact('pageTitle', 'user'));
    }

    public function receivepayment(Request $request, $id)
    {

       $gateway =  json_decode($request->methodId);
       //return $gate['id'];
        $request->validate([ 
            'user' => 'required',
            'amount'    => 'required',
            'pin'    => 'required', 
        ]);

        $merchant = User::whereUsername(decrypt($id))->whereStatus(1)->firstOrFail(); 
 
        $payer = User::where('username',$request->user)->orWhere('email',$request->user)->whereStatus(1)->first(); 
        if(!$payer)
        {
            $notify[] = ['error', 'There is no active user with this account'];
            return back()->withNotify($notify)->withInput();
        }
        if (Hash::check($request->pin, $payer->trx_password)) {

            if($payer->balance < $request->amount)
            {
                $notify[] = ['error', 'You do not have enough balance to complete this payment'];
                return back()->withNotify($notify)->withInput();
            }

            $code1 = getTrx();
            $code2 = getTrx();
            //Create Debit Transaction
            $payer->balance -= $request->amount;
            $payer->save(); 
            $transaction               = new Transaction();
            $transaction->user_id      = $payer->id;
            $transaction->amount       = $request->amount;
            $transaction->post_balance = $payer->balance;
            $transaction->trx_type     = '-';
            $transaction->val_1        = $merchant->id;
            $transaction->details      = 'Account debited for QR payment to '.$merchant->username;
            $transaction->trx          = $code1;
            $transaction->remark       = 'QR Payment';
            $transaction->save(); 

            //Create Credit Transaction
            $merchant->balance += $request->amount;
            $merchant->save(); 
            $transaction               = new Transaction();
            $transaction->user_id      = $merchant->id;
            $transaction->amount       = $request->amount;
            $transaction->post_balance = $merchant->balance;
            $transaction->trx_type     = '+';
            $transaction->val_1        = $payer->id;
            $transaction->details      = 'Account credited for QR payment from '.$payer->username;
            $transaction->trx          = $code2;
            $transaction->remark       = 'QR Payment';
            $transaction->save(); 

            // Send Mail
            notify($merchant, 'QR_PAYMENT', [
                'merchant' => $merchant->username,
                'payer' => $payer->username,
                'type' => 'received',
                'trx' => $code1,
                'amount' => showAmount($request->amount),
            ]);

            // Send Mail
            notify($payer, 'QR_PAYMENT', [
                'merchant' => $merchant->username,
                'payer' => $payer->username,
                'type' => 'made',
                'trx' => $code2,
                'amount' => showAmount($request->amount),
            ]);

            $notify[] = ['success', 'QR Payment Successful!'];
            return back()->withNotify($notify);

        } else {
            $notify[] = ['error', 'Invalid Transaction Pin!'];
            return back()->withNotify($notify);
        }
         
    }

     
}
