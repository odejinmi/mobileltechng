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
class InsuranceController extends Controller
{

 
    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->middleware('insurance.status');
        $this->activeTemplate = activeTemplate();
    }

    

    public function insurance_operators(Request $request)
    {
        $serviceid = $request->code;
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
        $url = 'https://sandbox.vtpass.com/api/service-variations?serviceID='.$serviceid;
        }
        else
        {
        $url = 'https://api-service.vtpass.com/api/service-variations?serviceID='.$serviceid;
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
    
    if($serviceid == 'ui-insure')
    {
        $image = url('/').'/assets/assets/dist/images/backgrounds/carsecure.png';
    }
    elseif($serviceid == 'health-insurance-rhl')
    {
        $image = url('/').'/assets/assets/dist/images/backgrounds/healthsecure.png';
    }
    elseif($serviceid == 'personal-accident-insurance')
    {
        $image = url('/').'/assets/assets/dist/images/backgrounds/familysecure.png';
    }
    else
    {
        $image = url('/').'/assets/assets/dist/images/backgrounds/insurance.png';
    }
    
    $resp = curl_exec($curl);
    $reply = json_decode($resp, true);
    curl_close($curl);
    return response()->json(['status'=>'true','message'=>'Service Fetched', 'image'=>$image, 'content'=>$reply['content']],200);
 
    }
    
    public function insurance(Request $request)
    {
        $pageTitle       = 'Insurance';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('cabletv')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.insurance.index', compact('pageTitle', 'log'));
    }

    public function buy_insurance(Request $request)
    {
        $pageTitle = 'Pay Insurance Fee';
        $providers =  '[
            {
                "name": "3rd Party Motor Insurance",
                "code": "ui-insure"
            },
            {
                "name": "Health Insurance - HMO",
                "code": "health-insurance-rhl"
            },
            {
                "name": "Personal Accident Insurance",
                "code": "personal-accident-insurance"
            }
            ]';
        $providers = json_decode($providers,true);
        return view($this->activeTemplate . 'user.bills.insurance.insurance_buy', compact('pageTitle','providers'));
    }

    
    public function buy_insurance_post_motor()
    {
        try {
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $password = $input['password'];

        $customername = @$input['customername'];
        $Chasis_Number = @$input['Chasis_Number'];
        $Contact_Address = @$input['Contact_Address'];
        $Engine_Number = @$input['Engine_Number'];
        $Insured_Name = @$input['Insured_Name'];
        $Vehicle_Color = @$input['Vehicle_Color'];
        $Vehicle_Make = @$input['Vehicle_Make'];
        $Vehicle_Model = @$input['Vehicle_Model'];
        $Year_of_Make = @$input['Year_of_Make'];
        $billersCode = @$input['billersCode'];
        $serviceID = @$input['serviceID'];
        $variation_code = @$input['variation_code'];
        $variation_name = @$input['variation_name'];
        $phone = @$input['phone'];
        $amount = @$input['amount'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


        $total = env('INSURANCECHARGE')+$amount;
        $payment = $total;
        
            $balance = $user->balance;
        
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
            "request_id": "'.$trx.'",
            "Chasis_Number": "'.$Chasis_Number.'",
            "Contact_Address": "'.$Contact_Address.'",
            "Engine_Number": "'.$Engine_Number.'",
            "Insured_Name": "'.$Insured_Name.'",
            "Vehicle_Color": "'.$Vehicle_Color.'",
            "Vehicle_Make": "'.$Vehicle_Make.'",
            "Vehicle_Model": "'.$Vehicle_Model.'",
            "Year_of_Make": "'.$Year_of_Make.'",
            "amount": "'.$amount.'",
            "billersCode": "'.$billersCode.'",
            "Plate_Number": "'.$billersCode.'",
            "phone": "'.$phone.'",
            "serviceID": "'.$serviceID.'",
            "variation_code": "'.$variation_code.'"
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
        return response()->json(['ok'=>false,'status'=>'danger','message'=> $reply['response_description'].' We cant processs this request at the moment'],400);

    }
    
    
    if(!isset($reply['content']['transactions']['transactionId']))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'],400);
  
    }

        if($reply['code'] == 000)
        {
            
                $user->balance -= $payment;
                $balance_after = $user->balance;
             
           //return $reply;

            $user->save();
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         = 'insurance';
            $order->val_1        = @$reply['purchased_code'];
            $order->val_2        = @$reply['certUrl'];
            $order->deposit_code = 'motor';
            $order->val_3        = 'Customer Name: <b>'.$Insured_Name.'</b><br> Car Make: <b>'.$Vehicle_Make.'</b><br> Number Plate: <b>'.$billersCode.'</b>';
            $order->product_id   = @$billersCode;
            $order->product_name = @$reply['content']['transactions']['product_name'];
            $order->product_logo = @$variation_name;
            $order->details      = @json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['content']['transactions']['amount'];
            $order->currency     = @$reply['content']['transactions']['product_name'];
            $order->status       = @$reply['content']['transactions']['status'];
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
            $transaction->charge       = env('INSURANCECHARGE');
            $transaction->trx_type     = '-';
            $transaction->details      = 'Paid insurance levy via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'insurance';
            $transaction->save();

            notify($user,'INSURANCE_BUY', [
                'provider'        => @$decoder,
                'amount'          => @showAmount($payment),
                'product'         => @$variation_name, 
                'beneficiary'     => @$billersCode, 
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
    } catch (\Exception $e) {  
        return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);

    }
    }
  
    public function buy_insurance_post_personal()
    {
        try {
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $password = $input['password'];

        $customername = @$input['customername'];
        $wallet = @$input['wallet'];
        $full_name = @$input['billersCode'];
        $address = @$input['address'];
        $dob = @$input['dob'];
        $next_kin_name = @$input['next_kin_name'];
        $next_kin_phone = @$input['next_kin_phone'];
        $business_occupation = @$input['business_occupation'];
        $billersCode = @$input['billersCode'];
        $serviceID = @$input['serviceID'];
        $variation_code = @$input['variation_code'];
        $variation_name = @$input['variation_name'];
        $phone = @$input['phone'];
        $amount = @$input['amount'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


        $total = env('INSURANCECHARGE')+$amount;
        $payment = $total;
        
            $balance = $user->balance;
         
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
            "request_id": "'.$trx.'",
            "full_name": "'.$full_name.'",
            "address": "'.$address.'",
            "dob": "'.$dob.'",
            "next_kin_name": "'.$next_kin_name.'",
            "next_kin_phone": "'.$next_kin_phone.'",
            "business_occupation": "'.$business_occupation.'",
            "amount": "'.$amount.'",
            "billersCode": "'.$billersCode.'",
            "phone": "'.$phone.'",
            "serviceID": "'.$serviceID.'",
            "variation_code": "'.$variation_code.'"
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
        return response()->json(['ok'=>false,'status'=>'danger','message'=> $reply['response_description'].' We cant processs this request at the moment'],400);
    }
    
    
    if(!isset($reply['content']['transactions']['transactionId']))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'],400);
    }

        if($reply['code'] == 000)
        {
            
                $user->balance -= $payment;
                $balance_after = $user->balance;
           
            //return $reply;

            $user->save();
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         = 'insurance';
            $order->deposit_code = 'personal';
            $order->val_1        = @$reply['purchased_code'];
            $order->val_3        = 'Customer Name: '.$billersCode.'</b>';
            $order->product_id   = @$billersCode;
            $order->product_name = @$reply['content']['transactions']['product_name'];
            $order->product_logo = @$variation_name;
            $order->details      = @json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['content']['transactions']['amount'];
            $order->currency     = @$reply['content']['transactions']['product_name'];
            $order->status       = @$reply['content']['transactions']['status'];
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
            $transaction->charge       = env('INSURANCECHARGE');
            $transaction->trx_type     = '-';
            $transaction->details      = 'Paid insurance levy via ' . strToUpper($wallet).' Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'insurance';
            $transaction->save();

            notify($user,'INSURANCE_BUY', [
                'provider'        => @$reply['content']['transactions']['product_name'],
                'amount'          => @showAmount($payment),
                'product'         => @$deposit_code,
                'beneficiary'     => $billersCode, 
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
    } catch (\Exception $e) {  
        return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);

    }
    }
  

    public function history(Request $request)
    {
        $pageTitle       = 'Insurance Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('insurance')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.insurance.insurance_log', compact('pageTitle', 'log'));
    }


    
}
