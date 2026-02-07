<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Order;
use App\Models\GeneralSetting;
 use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Transaction;
use App\Services\BonusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class BettingController extends Controller
{


    public function __construct()
    {
        $this->middleware('betting.status');
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }


    public function fund_wallet(Request $request)
    {
        $encryption = hash_hmac('SHA512', 'Welcome to Tutorialspoint', 'any_secretkey');
        //return $encryption;
        $pageTitle = 'Sport Betting';
        $networks =  '';
        $networks = json_decode(file_get_contents(resource_path('mobileapp/partials/betting.json')), true);
        return view($this->activeTemplate . 'user.bills.betting.betting_buy', compact('pageTitle','networks'));
    }

    public function verify_merchant(Request $request){

        $mode = env('MODE');
        $publickey = env('OPAYPUBLICKEY');
        $merchantid = env('OPAYMERCHANTID');
        $curl = curl_init();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $company = $input['company'];
        $customer = $input['customer'];

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://cashierapi.opayweb.com/api/v3/bills/validate',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "serviceType": "betting",
            "provider": "'.$company.'",
            "customerId": "'.$customer.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'MerchantId: '.$merchantid,
            'Content-Type: application/json',
            'Authorization: Bearer '.$publickey.''
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $resp = curl_exec($curl);
        $reply = json_decode($resp, true);

    curl_close($curl);
    //$rep = json_encode($reply);
    if(!isset($reply['data']['customerId']))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @json_encode($reply['message']),'content'=> 'INVALID'],200);

    }
    else
    {
        return response()->json(['ok'=>true,'status'=>'success','message'=> 'Valid Customer Number','content'=> @$reply['data']['firstName'].' '.@$reply['data']['lastName']],200);

    }

	}



    public function fund_wallet_post()
    {

        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $password = $input['password'];
        $amount = $input['amount'];
        $customername = $input['customerName'];
        $customerId = $input['customerId'];
        $wallet = @$input['wallet'];
        $companyId = @$input['companyId'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
            BonusService::refundaccount(
                $user,
                $amount,
                $wallet
            );
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


        $total = env('BETTINGCHARGE')+$amount;
        $payment = $total;
        $code = getTrx();
        if($wallet == 'main')
        {
            $balance = $user->balance;
        }
        else
        {
            $balance = $user->ref_balance;
        }

        $parseamount = $amount*100;
        $url = 'https://cashierapi.opayweb.com/api/v3/bills/bulk-bills';
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
        "bulkData": [
            {
              "amount": "'.$parseamount.'",
              "country": "NG",
              "currency": "NGN",
              "customerId": "'.$customerId.'",
              "provider": "'.$companyId.'",
              "reference": "'.$code.'"
            }
        ]',
      CURLOPT_HTTPHEADER => array(
    'Authorization: Basic '.env('OPAYPUBLICKEY'),
    'MerchantId: '.env('OPAYMERCHANTID'),
    'Content-Type: application/json',
      ),
    ));

    $resp = curl_exec($curl);
    $response = $resp;
    $reply = json_decode($resp, true);
    curl_close($curl);
    if(!isset($reply['code'] ))
    {
        BonusService::refundaccount(
            $user,
            $amount,
            $wallet
        );
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @json_encode($reply).'We cant processs this request at the moment'],400);
    }

    if(!isset($reply['bulkData'][0]['reference']))
    {
        BonusService::refundaccount(
            $user,
            $amount,
            $wallet
        );
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @json_encode($reply).'We cant processs this request at the moment'],400);

    }

        if($reply['bulkData'][0]['reference'])
        {

                $user->balance -= $payment;
                $balance_after = $user->balance;

            $bonusAmount = BonusService::processBonus(
                $user->id,
                'betting',
                $amount,
                @$reply['bulkData'][0]['reference']
            );

            if ($bonusAmount) {
                // You can add a notification or log here
                \Log::info("Bonus of {$bonusAmount} awarded for airtime purchase");
            }

            //return $reply;


            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'betting';
            $order->val_1   = $customerName;
            $order->val_2   = $customerId;
            $order->product_id   = @$customerId;
            $order->product_name = @$customerName;
            $order->product_logo = @$reply['bulkData'][0]['provider'];
            $order->details      = @json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['bulkData'][0]['amount'];
            $order->currency     = @$reply['bulkData'][0]['currency'];
            $order->status       = 'success';
            $order->payment      = @$payment;
            $order->trx          = @$code;
            $order->source       = $wallet;
            $order->balance_before  = $balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = @$reply['bulkData'][0]['reference'];
            $order->save();


            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = env('BETTINGCHARGE');
            $transaction->trx_type     = '-';
            $transaction->details      = 'Fund betting wallet via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'betting';
            $transaction->save();

            notify($user,'BETTING_BUY', [
                'provider'        => @$customerId,
                'amount'          => @showAmount($payment),
                'product'         => @$plan,
                'beneficiary'     => @$customerName,
                'rate'            => @showAmount($payment),
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);

            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successfull','orderid'=> $trx],200);
        }
        else
        {
            BonusService::refundaccount(
                $user,
                $amount,
                $wallet
            );
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($response). 'API ERROR'],400);
        }
        //return json_decode($resp,true);
    }

    public function history(Request $request)
    {
        $pageTitle       = 'Betting Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('betting')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.betting.betting_log', compact('pageTitle', 'log'));
    }



}
