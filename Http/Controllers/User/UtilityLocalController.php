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
class UtilityLocalController extends Controller
{

 
    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->middleware('utilitylocal.status');
        $this->activeTemplate = activeTemplate();
    }

     
    
    public function utility(Request $request)
    {
        $pageTitle       = 'Utility Bills';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.bills.utilityLocal.index', compact('pageTitle'));
    }

    public function buy_utility(Request $request)
    {
        $pageTitle = 'Pay Utility Bill';
        $networks =  '[
            {
                "name": "ikeja-electric"
            },
            {
                "name": "eko-electric"
            },
            {
                "name": "kano-electric"
            },
            {
                "name": "portharcourt-electric"
            },
            {
                "name": "jos-electric"
            },
            {
                "name": "ibadan-electric"
            },
            {
                "name": "kaduna-electric"
            },
            {
                "name": "abuja-electric"
            },
            {
                "name": "enugu-electric"
            },
            {
                "name": "benin-electric"
            }
        ]';
        $networks = json_decode($networks,true);
        return view($this->activeTemplate . 'user.bills.utilityLocal.utility_buy', compact('pageTitle','networks'));
    }

    public function verify_utility(Request $request)
    {
		$type = $request->metertype;
		$company = $request->company;
		$number = $request->number;
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
        $url = 'https://sandbox.vtpass.com/api/merchant-verify';
        }
        else
        {
        $url = 'https://api-service.vtpass.com/api/merchant-verify';
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
        "billersCode": "'.$number.'",
        "serviceID": "'.strToLower($company).'",
        "type": "'.$type.'"
        }',
        
        CURLOPT_HTTPHEADER => array(
        'Authorization: Basic '.$auth,
        'Content-Type: application/json',
      ),
    ));

    $resp = curl_exec($curl);
    $reply = json_decode($resp, true);

    curl_close($curl);
    //$rep = json_encode($reply);
        if(!isset($reply['content']['Customer_Name']))
        {
            return response()->json(['ok'=>false,'status'=>'danger','content'=> @$reply['response_description'].'Error validating meter number'],200);
        }
        else
        {
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Valid Decoder Number','content'=> @$reply['content']['Customer_Name']],200);
        }
    
	}
	


    public function buy_utility_post()
    {
         
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $password = $input['password'];
        
        $amount =  @$input['amount'];
        $customername = $input['customername'];
        $number = $input['number'];
        $metertype = $input['metertype'];
        $wallet = @$input['wallet'];
        $company = @$input['company'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


        $total = env('CABLECHARGE')+$amount;
        $payment = $total;
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
        "billersCode": "'.$number.'",
        "amount": "'.$amount.'",
        "phone": "'.$user->mobile.'",
        "variation_code": "'.$metertype.'",
        "serviceID": "'.$company.'",
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
    curl_close($curl);
    if(!isset($reply['code'] )) 
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'],400);

    }
    
    if(isset($reply['content']['errors'] )) 
    {
    
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @$reply['response_description'].'We cant processs this request at the moment'],400);

  
    }
  

    if($reply['code'] != "000") 
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'],400);

    }
    
        if(!isset($reply['content']['transactions']['transactionId']))
        {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'],400);
        }

        if($reply['code'] == 000)
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
           //return $reply;

            $user->save();
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'utility';
            $order->val_1        = $customername;
            $order->val_2        = $number;
            $order->product_id   = @$company;
            $order->product_name = @$metertype;
            $order->product_logo = @$company;
            $order->details      = @json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['content']['transactions']['amount'];
            $order->currency     = @$reply['content']['transactions']['product_name'];
            $order->status       = @$reply['content']['transactions']['status'];
            $order->deposit_code = @$reply['purchased_code'];;
            $order->payment      = @$payment;
            $order->trx          = @$trx;
            $order->source       = $wallet;
            $order->balance_before  = $balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = @$reply['content']['transactions']['transactionId'];
            $order->save();


            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = env('POWERCHARGE');
            $transaction->trx_type     = '-';
            $transaction->details      = 'Paid utility bill via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'utility';
            $transaction->save();


            notify($user,'UTILITY_BUY', [
                'provider'        => @$company,
                'amount'          => @showAmount($payment),
                'type'            => @$metertype, 
                'token'           => @$reply['purchased_code'], 
                'beneficiary'     => @$customername, 
                'number'          =>  @$number, 
                'rate'            => @showAmount($payment),
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);
            
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successful','orderid'=> $trx],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($response). 'API ERROR'],400);
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
        $pageTitle       = 'Utility Bills';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('utility')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.utilityLocal.utility_log', compact('pageTitle', 'log'));
    }


    
}
