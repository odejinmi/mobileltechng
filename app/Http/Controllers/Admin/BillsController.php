<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\AirtimeCash; 
use App\Models\Order; 
use App\Models\GeneralSetting; 
 use App\Models\AdminNotification;
use App\Models\User;
use App\Models\VirtualCard;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class BillsController extends Controller
{

 
    public function __construct()
    {

    }

    public function airtime2cashFees(Request $request, $id = null)
    {
        $pageTitle       = 'Airtime 2 Cash Settings';
        $log = AirtimeCash::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.bills.airtime2cash.settings', compact('pageTitle', 'log'));
    }


    public function airtime2cashFeesAdd(Request $request)
    {
        $fee = new AirtimeCash();
        $fee->network = $request->network;
        $fee->min = $request->min;
        $fee->max = $request->max;
        $fee->fee = $request->fee;
        $fee->save();
        $notify[] = ['success', 'Airtime Swap Fee Added Successfully'];
        return back()->withNotify($notify);
    }

    public function airtime2cashFeesUpdate(Request $request)
    {
        $fee = AirtimeCash::whereId($request->id)->firstOrFail();
        $fee->min = $request->min;
        $fee->max = $request->max;
        $fee->fee = $request->fee;
        $fee->status = $request->status ? 1 : 0;
        $fee->save();
        $notify[] = ['success', 'Airtime Swap Fee Updated Successfully'];
        return back()->withNotify($notify);
    }


    public function airtime2cash(Request $request, $id = null)
    {
        $pageTitle       = 'Airtime 2 Cash Log';
        $log = Order::whereType('airtime2cash')->searchable(['trx'])->with('user')->orderBy('id', 'desc')->paginate(getPaginate());
        if($id != null)
        {
            $log = Order::whereType('airtime2cash')->searchable(['trx'])->whereStatus($id)->with('user')->orderBy('id', 'desc')->paginate(getPaginate());
        }
        return view('admin.bills.airtime2cash.airtime_cash_log', compact('pageTitle', 'log'));
    }

    public function airtime2cash_approve($id)
    {
        $pageTitle       = 'Airtime 2 Cash Log';
        $order = Order::whereType('airtime2cash')->whereTrx($id)->whereStatus(0)->with('user')->firstOrFail();
        $user = User::whereId($order->user_id)->firstOrFail();
        $order->status = 1;
        $order->save();
        $user->balance += $order->payment;
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $order->user_id;
        $transaction->amount       = $order->payment;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = $order->val_1;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Convert airtime For Cash';
        $transaction->trx          = $order->trx;
        $transaction->remark       = 'airtime2cash';
        $transaction->save();
         //Start Send Mail
         $general = GeneralSetting::first();
         $user = [
                'username' => $user->username,
                'email'    => $user->email,
                'fullname' => $user->fullname,
            ];
            notify($user, 'DEFAULT', [
                'subject' => 'Airtime To Cash Approved',
                'message' => 'You airtime to cash request valued at '.showAmount($order->price).$general->cur_text.' with transaction number '.$order->trx.'. has been approved. Please login to user dashboard to confirm payment.',
            ], ['email'], "bc",false);
        // End Send Email
        $notify[] = ['success', 'Airtime Swap Approved Successfully'];
        return back()->withNotify($notify);
    }

    public function airtime2cash_decline($id)
    {
        $pageTitle       = 'Airtime 2 Cash Log';
        $order = Order::whereType('airtime2cash')->whereTrx($id)->whereStatus(0)->with('user')->firstOrFail();
        $user = User::whereId($order->user_id)->firstOrFail();
        $order->status = 2;
        $order->save();
 
        //Start Send Mail
        $general = GeneralSetting::first();
        $user = [
               'username' => $user->username,
               'email'    => $user->email,
               'fullname' => $user->fullname,
           ];
           notify($user, 'DEFAULT', [
               'subject' => 'Airtime To Cash Declined',
               'message' => 'You airtime to cash request with transaction number '.$order->trx.'. has been declined.',
            ], ['email'], "bc",false);
       // End Send Email
        $notify[] = ['success', 'Airtime Swap Declined Successfully'];
        return back()->withNotify($notify);
    }

 
    public function insurance(Request $request, $id = null)
    {
        $pageTitle       = 'Insurance Log';
        $log = Order::whereType('insurance')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        if($id != null)
        {
          $user      = User::findOrFail($id);
          $pageTitle       = $user->username.' Insurance Log';
          $log = Order::whereType('insurance')->whereUserId($id)->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        }
        return view('admin.bills.insurance.insurance_log', compact('pageTitle', 'log'));
    }
    
    public function airtime(Request $request, $id = null)
    {
        $pageTitle       = 'Airtime';
        $log = Order::whereType('airtime')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        if($id != null)
        {
          $user      = User::findOrFail($id);
          $pageTitle       = $user->username.' Airtime Log';
          $log = Order::whereType('airtime')->whereUserId($id)->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        }
        return view('admin.bills.airtime.airtime_log', compact('pageTitle', 'log'));
    }

    public function internet(Request $request, $id = null)
    {
        $pageTitle       = 'Internet';
        $log = Order::where('type','internet')->orWhere('type','smedata')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate()); 
        if($id != null)
        {
          $user      = User::findOrFail($id);
          $pageTitle       = $user->username.' Internet Log';
          $log = Order::whereType('internet')->whereUserId($id)->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        }
        return view('admin.bills.internet.internet_log', compact('pageTitle', 'log'));
    }
    public function cabletv(Request $request, $id = null)
    {
        $pageTitle       = 'Cable TV Log';
        $log = Order::whereType('cabletv')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        if($id != null)
        {
          $user      = User::findOrFail($id);
          $pageTitle       = $user->username.' Cable TV Log';
          $log = Order::whereType('cabletv')->whereUserId($id)->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        }
        return view('admin.bills.cabletv.cabletv_log', compact('pageTitle', 'log'));
    }
    public function utility(Request $request, $id = null)
    {
        $pageTitle       = 'Utility Log';
        $log = Order::whereType('utility')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        if($id != null)
        {
          $user      = User::findOrFail($id);
          $pageTitle       = $user->username.' Utility Log';
          $log = Order::whereType('utility')->whereUserId($id)->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        }
        return view('admin.bills.utility.utility_log', compact('pageTitle', 'log'));
    }

    public function virtualcard(Request $request)
    {
        $pageTitle       = 'Card History';
        $user = auth()->user();
        $log = VirtualCard::searchable(['pan'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.bills.virtualcard.history', compact('pageTitle', 'log'));
    }

    public function virtualcardDetails($id)
    {
        $pageTitle       = 'Details';
        $card = VirtualCard::whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/secure-data/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS =>'',
        
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', $reply['message']];
            return back()->withNotify($notify);
        }

        return view('admin.bills.virtualcard.details', compact('pageTitle', 'card','reply'));
    }

    public function virtualcardDeactivate($id)
    {
        $pageTitle       = 'Details';
        $card = VirtualCard::whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/freeze/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'',
        
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);

    }

    public function virtualcardActivate($id)
    {
        $pageTitle       = 'Details';
        $card = VirtualCard::whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/unfreeze/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'',
        
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);

    }

    public function virtualcardBlock($id)
    {
        $pageTitle       = 'Details';
        $card = VirtualCard::whereCardId($id)->orderBy('id', 'desc')->firstOrFail();

        $url = 'https://api.blochq.io/v1/cards/block/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'
        {
          "account_id": "'.env('VIRTUALCARD_ACCOUNTID').'",
          "reason": "lost"
        }
        ',
        
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);

    }


    public function password(Request $request, $id)
    {
        $this->validate($request, [
            'old_pin' => 'required',
            'new_pin' => 'required',
        ]);

        $card = VirtualCard::whereCardId($id)->orderBy('id', 'desc')->firstOrFail();
 
        $url = 'https://api.blochq.io/v1/cards/change-pin/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS =>'
        {
            "old_pin": "'.$request->old_pin.'",
            "new_pin": "'.$request->new_pin.'"
          }
        ',
        
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $card->status = $reply['data']['status'];
        $card->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);
     

    }

    public function fundbalance(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);
        $general = gs();

         
        $card = VirtualCard::whereCardId($id)->orderBy('id', 'desc')->firstOrFail();
        $amount = $request->amount;
         
        $url = 'https://api.blochq.io/v1/cards/fund/'.$id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>'
        {
            "amount": '.intval($amount).',
            "from_account_id": "'.env('VIRTUALCARD_ACCOUNTID').'",
            "currency": "'.$card->currency.'"
        }',
        
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.env('VIRTUALCARDSK'),
        'Content-Type: application/json',
        'accept: application/json',
             ),
        ));
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);
        curl_close($curl);
        if(!isset($reply['data']['id']) && !isset($reply['data']['pan']))
        {
            $notify[] = ['error', @$reply['message']];
            return back()->withNotify($notify);
        }

        $user->balance -= $fee;
        $user->save();
        $notify[] = ['success', $reply['message']];
        return back()->withNotify($notify);
        

    }

  
    
    
}
