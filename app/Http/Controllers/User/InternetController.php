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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class InternetController extends Controller
{

 
    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->middleware('internet.status');
        $this->activeTemplate = activeTemplate();
    }

    public function getCountries()
    {
        if(env('MODE') == "TEST")
        {
            $baseurl = "https://topups-sandbox.reloadly.com/countries";
        }
        else
        {
            $baseurl = "https://topups.reloadly.com/countries";
        }
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => $baseurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/com.reloadly.topups-v1+json",
            "Authorization: Bearer ".getToken('topups')
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        // echo "cURL Error #:" . $err;
        return [];
        }
        $reply = json_decode($response,true);
        return $reply;
    }
    public function internet_operators(Request $request)
    {

        $token = getToken('topups');
        if(env('MODE') == "TEST")
        {
            $url = "https://topups-sandbox.reloadly.com";
        }
        else
        {
            $url = "https://topups.reloadly.com";
        }


       // $json = file_get_contents('php://input');
       // $input = json_decode($json, true); 

        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => $url."/operators/countries/".$request->isocode,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/com.reloadly.topups-v1+json",
            "Authorization: Bearer ".$token
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json(['status'=>'false','message'=>'','content'=>$reply],400);
        } else {
            $resp = json_decode($response,true);
            $val = [];
            $reply = array(
            'code' => '00',
            'response' => $resp,
             );
                 
             return response()->json(['status'=>'true','message'=>'Network Fetched','content'=>$reply],200);
        }
 
    }
    

    public function operatorsdetails($id)
    {

        $token = getToken('topups');
        if(env('MODE') == "TEST")
        {
            $url = "https://topups-sandbox.reloadly.com";
        }
        else
        {
            $url = "https://topups.reloadly.com";
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => $url."/operators/$id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/com.reloadly.topups-v1+json",
            "Authorization: Bearer ".$token
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $resp = json_decode($response,true);
        return $resp;
    }

    public function operatorsInternetdetails(Request $request)
    {

        $token = getToken('topups');
        if(env('MODE') == "TEST")
        {
            $url = "https://topups-sandbox.reloadly.com";
        }
        else
        {
            $url = "https://topups.reloadly.com";
        }

         

            $json = file_get_contents('php://input');
            $input = json_decode($json, true); 
            $id = @$input['operatorId'];
        

        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => $url."/operators/$id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/com.reloadly.topups-v1+json",
            "Authorization: Bearer ".$token
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl); 
        $f = json_decode($response) ;
        $ff = json_decode(json_encode($f->fixedAmountsDescriptions), true);
        return $ff ;
    }


    public function internet(Request $request)
    {
        $pageTitle       = 'Internet Subscription';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('internet')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.internet.index', compact('pageTitle', 'log'));
    }

    public function buy_internet(Request $request)
    {
        $pageTitle = 'Buy Internet';
        $countries = $this->getCountries();
        return view($this->activeTemplate . 'user.bills.internet.internet_buy', compact('pageTitle','countries'));
    }
    public function buy_internet_post()
    {
        if(env('MODE') == "TEST")
        {
            $url = "https://topups-sandbox.reloadly.com/topups";
        }
        else
        {
            $url = "https://topups.reloadly.com/topups";
        }
        $token = getToken('topups');
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $password = $input['password'];
        $arr = explode("|", $input['amount'], 2); 

        $amount =  $arr[0];
        $plan = $arr[1];
        $phone = $input['phone'];
        $wallet = @$input['wallet'];
        $operatorId = @$input['operator'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }

        // return $this->operatorsdetails($operatorId);

        $operator = $this->operatorsdetails($operatorId);
        $operatorId = @$operator['operatorId'];
        $operatorName = $operator['name'];
        $operatorLogo = @$operator['logoUrls'][0];
        $operatorCurrency = @$operator['destinationCurrencyCode'];
        $countryCode = @$operator['country']['isoName'];
        $min = $operator['minAmount'];
        $max = $operator['maxAmount'];
        $rate = $operator['fx']['rate'];
        
        if($amount < $min &&  $min > 0)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Minimum amount you can purchase is '.getAmount($min)],400);
        }
        if($amount > $max  &&  $max > 0)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Maximum amount you can purchase is '.getAmount($max)],400);
        }
        $payment = $amount/$rate;
        if($wallet == 'main')
        {
            $balance = $user->balance;
        }
        else
        {
            $balance = $user->ref_balance;
        }
        if($payment > $balance)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
        }
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        $headers = array(
        "Authorization: Bearer ".$token."",
        "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $code = getTrx();
        $data = <<<DATA
        {
            "operatorId": "$operatorId",
            "amount": "$amount",
            "useLocalAmount": true,
            "customIdentifier": "$code",
            "recipientEmail": "$user->email",
            "recipientPhone": {
                "countryCode": "$countryCode",
                "number": "$phone"
            }
        }
        DATA;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        //var_dump($resp);
        $response = json_decode($resp,true);

        // END AIRTIME VENDING \\
        if(isset($response['status']) && isset($response['transactionId']) > 0)
        {
            if($wallet == 'main')
            {
                $user->balance -= $payment;
                $balance_after = $user->balance;
            }
            else
            {
                $user->ref_balance -= $payment;
                $balance_after = $user->ref_balance;
            }
            $user->save();
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'internet';
            $order->val_1   = $phone;
            $order->val_2   = $plan;
            $order->product_id   = $operatorId;
            $order->product_name = @$operatorName;
            $order->product_logo = @$operatorLogo;
            $order->details      = json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = $amount;
            $order->currency     = @$response['requestedAmountCurrencyCode'];
            $order->status       = @$response['status'];
            $order->payment      = @$payment;
            $order->trx          = $code;
            $order->source       = $wallet;
            $order->balance_before  = $balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = $response['transactionId'];
            $order->save();


            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchased internet subscription via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'internet';
            $transaction->save();

            notify($user,'INTERNET_BUY', [
                'provider'        => @$operatorName,
                'currency'        => @$operatorCurrency,
                'amount'          => @showAmount($amount),
                'product'         => @$plan, 
                'beneficiary'     => @$phone, 
                'rate'           => @showAmount($payment),
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$code,
            ]);

            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successful','orderid'=> $response['transactionId']],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> $response['message']. 'API ERROR'],400);
        }
        //return json_decode($resp,true);
    }


    public function trxpass(Request $request)
    {
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $password = $input['password'];
        if (Hash::check($password, $user->trx_password)) {
            return response()->json(['ok'=>true,'status'=>'success','message'=>'The password Correct!'],200);
        } else {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
        }
 
    }


    public function history(Request $request)
    {
        $pageTitle       = 'Internet';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('internet')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.internet.internet_log', compact('pageTitle', 'log'));
    }


    
}
