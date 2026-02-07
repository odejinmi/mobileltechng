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
class CabletvController extends Controller
{


    public function __construct()
    {
        $this->middleware('cabletv.status');
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }


    public function cabletv_operators(Request $request)
    {
        $general   = gs();
        $user = auth()->user();
        $network = $request->decoder;

        if($general->cabletv_provider == 'VTPASS')
        {
           return $this->cabletv_operators_vtpass($network);
        }
        if($general->cabletv_provider == 'N3TDATA')
        {
           return $this->cabletv_operators_n3t($network);
        }
    }

    public function cabletv_operators_n3t($network)
    {
        $plans = json_decode(file_get_contents(resource_path('mobileapp/partials/n3tcable.json')));

        if($network == 'dstv')
        {
            $image = url('/').'/assets/templates/basic/images/brands/'.'dstv.png';
        }
        if($network == 'gotv')
        {
            $image = url('/').'/assets/templates/basic/images/brands/'.'gotv.jpeg';
        }
        if($network == 'startimes')
        {
            $image = url('/').'/assets/templates/basic/images/brands/startimes.jpeg';
        }
        if($network == 'showmax')
        {
            $image = url('/').'/assets/templates/basic/images/brands/showmax.png';
        }
        $bouquet = array();
        foreach($plans as $item) {
            if($item->cable_name == strToUpper($network))
            {
                $bouquet[] = $item;
            }
         }
        return response()->json(['status'=>'true','message'=>'Network Fetched', 'image'=>$image, 'content'=>$bouquet],200);

    }



    public function cabletv_operators_vtpass($network)
    {
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
        $url = 'https://sandbox.vtpass.com/api/service-variations?serviceID='.$network;
        }
        else
        {
        $url = 'https://vtpass.com/api/service-variations?serviceID='.$network;
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
        CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
    'Authorization: Basic '.$auth,
    'Content-Type: application/json',
      ),
    ));
    if($network == 'dstv')
    {
        $image = url('/').'/assets/templates/basic/images/brands/'.'dstv.png';
    }
    if($network == 'gotv')
    {
        $image = url('/').'/assets/templates/basic/images/brands/'.'gotv.jpeg';
    }
    if($network == 'startimes')
    {
        $image = url('/').'/assets/templates/basic/images/brands/startimes.jpeg';
    }
    if($network == 'showmax')
    {
        $image = url('/').'/assets/templates/basic/images/brands/showmax.png';
    }
    $resp = curl_exec($curl);
    $reply = json_decode($resp, true);
    curl_close($curl);
    //$image = json_decode($image,true)
    return response()->json(['status'=>'true','message'=>'Network Fetched', 'image'=>$image, 'content'=>$reply['content']['varations']],200);

    }

    public function cabletv(Request $request)
    {
        $pageTitle = 'Cable TV';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('cabletv')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.cabletv.index', compact('pageTitle', 'log'));
    }

    public function buy_cabletv(Request $request)
    {
        $pageTitle = 'Pay Cabletv Fee';
        $networks =  '[
            {
                "name": "dstv"
            },
            {
                "name": "gotv"
            },
            {
                "name": "startimes"
            },
            {
                "name": "showmax"
            }
            ]';
        $networks = json_decode($networks,true);
        return view($this->activeTemplate . 'user.bills.cabletv.cabletv_buy', compact('pageTitle','networks'));
    }

    public function cabletv_verify(Request $request)
    {
        $general = gs();
        if($general->cabletv_provider == 'VTPASS')
        {
           return $this->cabletv_verify_vtpass($request);
        }
        if($general->cabletv_provider == 'N3TDATA')
        {
           return $this->cabletv_verify_n3t($request);
        }
    }

    public function cabletv_verify_vtpass($request){

		$decoder = $request->decoder;
		$number = $request->number;
        $mode = env('MODE');
        $username = env('VTPASSUSERNAME');
        $password = env('VTPASSPASSWORD');
        $str = $username.':'.$password;
        $auth = base64_encode($str);
        if($mode == 'TEST')
        {
        $url = 'https://sandbox.vtpass.com/api/merchant-verify';
        }
        else
        {
        $url = 'https://vtpass.com/api/merchant-verify';
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
        "serviceID": "'.$decoder.'"
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
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($resp).' Invalid Decoder Number'],400);
        }
        else
        {
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Valid Decoder Number','content'=> @$reply['content']['Customer_Name']],200);
        }
	}

    public function cabletv_verify_n3t($request){

		$decoder = $request->decoder;
		$number = $request->number;
        if($decoder == 'dstv')
        {
            $decoderid = 2;
        }
        if($decoder == 'gotv')
        {
            $decoderid = 1;
        }
        if($decoder == 'startimes')
        {
            $decoderid = 3;
        }
        if($decoder == 'showmax')
        {
            $decoderid = 4;
        }
        $token = getN3TToken();
        $url = 'https://n3tdata.com/api/cable/cable-validation?iuc='.$number.'&cable='.$decoderid;
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
            "Authorization: Token ".$token."",
            'Content-Type: application/json',
      ),
    ));

    $resp = curl_exec($curl);
    $reply = json_decode($resp, true);

    curl_close($curl);
    //$rep = json_encode($reply);
        if(!isset($reply['name']))
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($resp).' Invalid Decoder Number'],400);
        }
        else
        {
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Valid Decoder Number','content'=> @$reply['name']],200);
        }
	}



    public function buy_cabletv_post()
    {
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $password = $input['password'];
        $arr = explode("|", $input['plan'], 2);
        $amount =  @$arr[1];
        $plan = @$arr['0'];
        $customername = $input['customername'];
        $number = $input['number'];
        $wallet = @$input['wallet'];
        $decoder = @$input['decoder'];
        $general   = gs();

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
        }
        $total = env('CABLECHARGE')+$amount;
        $payment = $total;

        if($general->cabletv_provider == 'VTPASS')
        {
           return $this->buy_cabletv_vtpass($decoder,$wallet,$number,$customername,$plan,$amount,$payment);
        }
        if($general->cabletv_provider == 'N3TDATA')
        {
           return $this->buy_cabletv_n3t($decoder,$wallet,$number,$customername,$plan,$amount,$payment);
        }
    }

    public function buy_cabletv_vtpass($decoder,$wallet,$number,$customername,$plan,$amount,$payment)
    {
        $user = auth()->user();
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
        "phone": "'.$number.'",
        "variation_code": "'.$plan.'",
        "serviceID": "'.$decoder.'",
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
        return response()->json(['ok'=>false,'status'=>'danger','message'=> @json_encode($reply).'We cant processs this request at the moment'],400);
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


            $bonusAmount = BonusService::processBonus(
                $user->id,
                'cable',
                $amount,
                @$reply['content']['transactions']['transactionId']
            );

            if ($bonusAmount) {
                // You can add a notification or log here
                \Log::info("Bonus of {$bonusAmount} awarded for airtime purchase");
            }

            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'cabletv';
            $order->val_1   = $customername;
            $order->val_2   = $number;
            $order->product_id   = @$decoder;
            $order->product_name = @$plan;
            $order->product_logo = @$decoder;
            $order->details      = @json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['content']['transactions']['amount'];
            $order->currency     = @$reply['content']['transactions']['product_name'];
            $order->status       = @$reply['content']['transactions']['status'];
            $order->payment      = @$payment;
            $order->trx          = @$trx;
            $order->source       = $wallet;
            $order->balance_before  = $user->ref_balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = @$reply['content']['transactions']['transactionId'];
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = env('CABLECHARGE');
            $transaction->trx_type     = '-';
            $transaction->details      = 'Paid cabletv bill via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'cabletv';
            $transaction->save();

            notify($user,'CABLETV_BUY', [
                'provider'        => @$decoder,
                'amount'          => @showAmount($payment),
                'product'         => @$plan,
                'beneficiary'     => @$customername.'|Decoder:'.$number,
                'rate'            => @showAmount($payment),
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);

            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successfull','orderid'=> $trx],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($response). 'API ERROR'],400);
        }
        //return json_decode($resp,true);
    }

    public function buy_cabletv_n3t($decoder,$wallet,$number,$customername,$plan,$amount,$payment)
    {
        $user = auth()->user();
        if($decoder == 'gotv')
        {
          $operatorId = 1;
        }
        if($decoder == 'dstv')
        {
          $operatorId = 2;
        }
        if($decoder == 'startimes')
        {
          $operatorId = 3;
        }
        $token = getN3TToken();
        $url = 'https://n3tdata.com/api/cable';
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
            "cable": "$operatorId",
            "iuc": "$number",
            "request-id": "$code",
            "cable_plan": "$plan",
            "bypass": "false"
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
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Sorry we cant process this request at the moment'],400);
        }

        if($response['status'] == 'success')
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

            $bonusAmount = BonusService::processBonus(
                $user->id,
                'cable',
                $amount,
                @$response['request-id']
            );

            if ($bonusAmount) {
                // You can add a notification or log here
                \Log::info("Bonus of {$bonusAmount} awarded for airtime purchase");
            }
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'cabletv';
            $order->val_1   = $customername;
            $order->val_2   = $number;
            $order->product_id   = @$decoder;
            $order->product_name = @$response['plan_name'];
            $order->product_logo = @$decoder;
            $order->details      = @json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$response['amount'];
            $order->currency     = @$response['iuc'];
            $order->status       = @$response['status'];
            $order->payment      = @$payment;
            $order->trx          = @$code;
            $order->source       = $wallet;
            $order->balance_before  = $balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = @$response['request-id'];
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = env('CABLECHARGE');
            $transaction->trx_type     = '-';
            $transaction->details      = 'Paid cabletv bill via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'cabletv';
            $transaction->save();

            notify($user,'CABLETV_BUY', [
                'provider'        => @$decoder,
                'amount'          => @showAmount($payment),
                'product'         => @$plan,
                'beneficiary'     => @$customername.'|Decoder:'.$number,
                'rate'            => @showAmount($payment),
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);

            return response()->json(['ok'=>true,'status'=>'success','message'=> @$response['message'],'orderid'=> $code],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> @$response['message']. 'API ERROR'],400);
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
        $pageTitle       = 'Cable TV';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('cabletv')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.cabletv.cabletv_log', compact('pageTitle', 'log'));
    }


}
