<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Order; 
use App\Models\AirtimeCash; 
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
class AirtimeController extends Controller
{

 
    public function __construct()
    {
        $this->middleware('airtime.status');
        $this->middleware('kyc.status');
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
    
    public function airtime_operators(Request $request)
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
        CURLOPT_URL => $url."/operators/countries/".$request->isocode."?includeData=false&includeBundles=false",
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

    public function airtime(Request $request)
    {
        $pageTitle       = 'Airtime';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.airtime.index', compact('pageTitle', 'log'));
    }

    public function buy_airtime(Request $request)
    {
        $pageTitle = 'Buy Airtime';
        $countries = $this->getCountries();
        return view($this->activeTemplate . 'user.bills.airtime.airtime_buy', compact('pageTitle','countries'));
    }
    public function buy_airtime_post()
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
        $amount = $input['amount'];
        $phone = $input['phone'];
        $wallet = @$input['wallet'];
        $operatorId = @$input['operator'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The transaction password doesn\'t match!'],400);
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
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You currently do not have sufficient wallet balance to complete this process'],400);
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
            $order->type         =  'airtime';
            $order->val_1        = $phone;
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
            $transaction->details      = 'Purchase airtime Via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'airtime';
            $transaction->save();

            notify($user,'AIRTIME_BUY', [
                'provider'        => @$operatorName,
                'currency'        => @$operatorCurrency,
                'amount'          => @showAmount($amount),
                'rate'           =>  @showAmount($payment),
                'beneficiary'     => @$phone, 
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

     

    public function airtimelocal(Request $request)
    {
        $pageTitle = 'Buy Airtime';
        $countries = []; 
        $networks =  '[
            {
                "name": "MTN",
                "logo": "mtn.png",
                "networkid": "mtn"
            },
            {
                "name": "AIRTEL", 
                "logo": "airtel.jpeg",
                "networkid": "airtel"
            },
            {
                "name": "GLO",
                "logo": "glo.jpeg",
                "networkid": "glo"
            },
            {
                "name": "9MOBILE",
                "logo": "9mobile.jpeg",
                "networkid": "etisalat"
            }
            ]';
        $general   = gs();         
        return view($this->activeTemplate . 'user.bills.airtime.airtime_buy_local', compact('pageTitle','countries','networks'));
     }

     public function buy_airtime_post_local()
    {
        $general   = gs(); 
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
                
        if($general->airtime_provider == 'VTPASS')
        {
           return $this->buy_airtime_post_vtpass($input);
        }
        if($general->airtime_provider == 'N3TDATA')
        {
           return $this->buy_airtime_post_n3tdata($input);
        }
    }
   
    public function buy_airtime_post_vtpass($input)
    {
        $user = auth()->user(); 
        $password = $input['password'];
        $amount =  @$input['amount'];
        $operator = @$input['operator'];
        $wallet = @$input['wallet'];
        $phone = @$input['phone'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


        if($wallet == 'ref')
        {
            $balance = $user->ref_balance;
        }
        else
        {
            $balance = $user->balance;
        }
        if($amount > $user->balance)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
        }

        $mode = env('MODE');
        $username = env('VTPASSUSERNAME');
        $password = env('VTPASSPASSWORD');
        $str = $username.':'.$password;
        $auth = base64_encode($str);
        $datecode = date('Y').date('m').date('d').date('H').date('i').date('s');
        $codex = substr(str_shuffle('01234567890') , 0 , 5 );
        $trx = $datecode.$codex;
        if($mode == 'TEST')
        {
        $url = 'https://sandbox.vtpass.com/api/pay';
        }
        else
        {
        $url = 'https://vtpass.com/api/pay';
        }
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
        CURLOPT_POSTFIELDS =>'{
        "amount": "'.$amount.'",
        "phone": "'.$phone.'",
        "serviceID": "'.$operator.'",
        "request_id": "'.$trx.'"
        }',
      CURLOPT_HTTPHEADER => array(
    'Authorization: Basic '.$auth,
    'Content-Type: application/json',
      ),
    ));

    $resp = curl_exec($curl);
    $response = $resp;
    $reply = json_decode($resp, true);
    // return $response;
    curl_close($curl);
    if(!isset($reply['code'] ))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'.@$resp],400);
    }

    if(isset($reply['content']['errors'] ))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'.@$resp],400);
    }

  
    if(!isset($reply['content']['transactions']['transactionId']))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'],400);
    }

        // END AIRTIME VENDING \\
        if($reply['content']['transactions']['transactionId'] && $reply['content']['transactions']['status'] != "failed")
        {
        
             
            
            $user->balance -= $amount;
            
            $user->save();
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'airtime';
            $order->val_1        = $phone;
            $order->product_id   = $operator;
            $order->product_name = @$operator;
            $order->product_logo = @$operator;
            $order->details      = json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['content']['transactions']['amount'];
            $order->currency     = @$reply['content']['transactions']['product_name'];
            $order->status       = @$reply['content']['transactions']['status'];
            $order->payment      = @$amount;
            $order->trx          = $trx;
            $order->source       = $wallet;
            $order->balance_before  = $balance;
            $order->balance_after   = @$user->balance;
            $order->transaction_id  = @$reply['content']['transactions']['transactionId'];
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchase airtime Via Main Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'airtime';
            $transaction->save();

            notify($user,'AIRTIME_BUY', [
                'provider'        => @$operator,
                'currency'        => @$operator,
                'amount'          => @showAmount($amount),
                'rate'           =>  @showAmount($amount),
                'beneficiary'     => @$phone, 
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);
            
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successful','orderid'=> $order->trx],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'API ERROR. PLEASE TRY AGAIN LATER'],400);
        }
        //return json_decode($resp,true);
    }


    public function buy_airtime_post_n3tdata($input)
    {
        $user = auth()->user(); 
        $password = $input['password'];
        $amount =  @$input['amount'];
        $operator = @$input['operator'];
        $wallet = @$input['wallet'];
        $phone = @$input['phone'];

        if($operator == 'mtn')
        {
          $operatorId = 1;  
        }
        if($operator == 'airtel')
        {
          $operatorId = 2;  
        }
        if($operator == 'glo')
        {
          $operatorId = 3;  
        }
        if($operator == 'etisalat')
        {
          $operatorId = 4;  
        }
        

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


         
            $balance = $user->balance;
        
        if($amount > $balance)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
        }
        $token = getN3TToken();
        $url = 'https://n3tdata.com/api/topup';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        $headers = array(
        "Authorization: Token ".$token."",
        "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $code = getTrx();
        $data = <<<DATA
        {
            "network": "$operatorId",
            "request-id": "$code",
            "plan_type": "VTU",
            "bypass": "false",
            "amount": "$amount",
            "phone": "$phone"
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

        if(!isset($response['status']) && !isset($response['newbal']))
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($response).'Sorry we cant process this request at the moment'],400);
        }
 
        // END AIRTIME VENDING \\
        if($response['status'] == 'success')
        {
             
                $user->balance -= $amount;
                $balance_after = $user->balance;
            
            $user->save();
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'airtime';
            $order->val_1        = $phone;
            $order->product_id   = $operator;
            $order->product_name = @$operator;
            $order->product_logo = @$operator;
            $order->details      = json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$response['amount'];
            $order->currency     = @$response['content']['transactions']['product_name'];
            $order->status       = @$response['status'];
            $order->payment      = @$amount;
            $order->trx          = getTrx();
            $order->source       = 'main';
            $order->balance_before  = $balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = @$response['transid'];
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchase airtime Via Main Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'airtime';
            $transaction->save();

            notify($user,'AIRTIME_BUY', [
                'provider'        => @$operator,
                'currency'        => @$operator,
                'amount'          => @showAmount($amount),
                'rate'           =>  @showAmount($amount),
                'beneficiary'     => @$phone, 
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);
            
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successful','orderid'=> $order->trx],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> $response['message']. 'API ERROR'],400);
        }
        //return json_decode($resp,true);
    }

    public function history(Request $request)
    {
        $pageTitle       = 'Airtime';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.airtime.airtime_log', compact('pageTitle', 'log'));
    }

    public function to_cash(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime2cash')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.airtime2cash.index', compact('pageTitle', 'log'));
    }

    public function to_cash_request(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.bills.airtime2cash.create', compact('pageTitle'));
    }

    public function to_cash_request_fee()
    {
        
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $fee = $input['fee'];
        $network = $input['network'];
        $range = AirtimeCash::whereNetwork($network)->whereStatus(1)->get();
        if($fee == true)
        { 
            if(count($range) < 1)
            {
                return response()->json(['ok'=>false,'status'=>'error','message'=> 'Sorry we are not buying this network at the moment','range'=> $range],200); 
            }
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Network Available','range'=> $range],200);
        }

            $amount = $input['amount'];
         
            foreach($range as $data)
            {
                if($amount >= $data->min && $amount <= $data->max)
                {
                    return response()->json(['ok'=>true,'status'=>'success','message'=> 'Successful','range'=> $data],200);
                }
            } 
        
        return response()->json(['ok'=>false,'status'=>'error','message'=>'Sorry, there is no amount range in the entered amount for this network'],200);  
         
    }


    public function to_cash_request_post(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash';
        $request->validate([
            'network'        => 'required',
            'amount'      => 'required|numeric|gt:0',
            'code'      => 'required|string',
            'pin' => 'required',
        ]);
        $user = auth()->user();
        $password = $request->pin;
        if (Hash::check($password, $user->trx_password)) {
            $range = AirtimeCash::whereNetwork($request->network)->whereStatus(1)->get();
            foreach($range as $data)
            {
                if($request->amount >= $data->min && $request->amount <= $data->max)
                {
                    $com = (@$request->amount / 100) * @$data->fee; // Correct Calculation
                }
            } 
            if(count($range) < 1)
            {
            $notify[] = ['error', 'Sorry, we are not buying this network amount at the moment'];
            return back()->withNotify($notify);
            }
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         = 'airtime2cash';
            $order->product_name = $request->network;
            $order->val_1          = $com;
            $order->val_2        = $request->code;
            $order->price        = $request->amount;
            $order->payment        = $request->amount - $com;
            $order->status       = 0;
            $order->trx          = getTrx();
            $order->save(); 
            $notify[] = ['success', 'Airtime Logged Successfuly'];
            return redirect()->route('user.airtime.tocash.history')->withNotify($notify);
            
        } else {
            $notify[] = ['error', 'Invalid transaction password'];
            return back()->withNotify($notify);
        }
    }


    public function to_cash_history(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime2cash')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.airtime2cash.history', compact('pageTitle', 'log'));
    }



    
}
