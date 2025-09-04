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
class GiftcardAutoController extends Controller
{

 
    public function __construct()
    {
        $this->middleware('giftauto.status');
        $this->activeTemplate = activeTemplate();
    }


    public function index(Request $request)
    {
        $pageTitle       = 'Digital Giftcard';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.giftcard_auto.index', compact('pageTitle'));
    }


    public function start(Request $request)
    {
        $pageTitle       = 'Digital Giftcard';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.giftcard_auto.index', compact('pageTitle'));
    }


    public function shop()
    { 
        $pageTitle = 'Buy Card';
        $country = (array)json_decode(file_get_contents(resource_path('views/partials/country_full.json')));
       // return $country;
        return view($this->activeTemplate . 'user.giftcard_auto.shop', compact('pageTitle','country'));
    }
    public function giftcard(Request $request)
    { 
        $pageTitle = 'Giftcard Details';
        return view($this->activeTemplate . 'user.giftcard_auto.details', compact('pageTitle'));
    }

    public function giftcardbyid(Request $request)
    {
        //GET CARD API\\
        if(env('MODE') == "TEST")
        {
            $baseurl = "https://giftcards-sandbox.reloadly.com";
        }
        else
        {
            $baseurl = "https://giftcards.reloadly.com";
        }
        $token = getTokenGiftcard();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $baseurl.'/products/'.$request->product,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/com.reloadly.giftcards-v1+json',
            'Authorization: Bearer '.$token
        ),
        ));

        $cardresponse = curl_exec($curl);
        curl_close($curl);
        $giftcards = json_decode($cardresponse, true);
        $giftcard = $giftcards;
        
        return response()->json([
            'code'=>200,
            'status'=>'ok',
            'data'=> $giftcard,
        ],200);
    }

      
    public function fecthgiftcards(Request $request)
    {
        $page = 1;
        $countryCode = null;
        $productName = null;
        
        if(isset($request->page))
        {
         $page = $request->page;
        }
        if(isset($request->countryCode))
        {
         $countryCode = $request->countryCode;
        }
        if(isset($request->productName))
        {
         $productName = $request->productName;
        }
        //GET CARD API\\
        if(env('MODE') == "TEST")
        {
            $baseurl = "https://giftcards-sandbox.reloadly.com";
        }
        else
        {
            $baseurl = "https://giftcards.reloadly.com";
        }
        $token = getTokenGiftcard();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $baseurl.'/products?size=10&page='.$page.'&countryCode='.$countryCode.'&productName='.$productName.'&includeRange=false&includeFixed=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/com.reloadly.giftcards-v1+json',
            'Authorization: Bearer '.$token
        ),
        ));

        $cardresponse = curl_exec($curl);
        curl_close($curl);
        $giftcards = json_decode($cardresponse, true);
        $giftcards = $giftcards;
        $countryData = (array)json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $country = $countryData;
        if(!isset($cardresponse))
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Error fetching data',
            ],200); 
        }

        if(isset($cardresponse['status']) == 500)
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Sorry we cant find any matching data on this request',
            ],200); 
        }
        
        if(isset($giftcards['path']))
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Error fetching record. '.@$giftcards['message'],
            ],200); 
        }

        if(!isset($giftcards['content']))
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Error fetching record. '.@$giftcards['message'],
            ],200); 
        }

        return response()->json([
            'status'=> true,
            'data'=> $giftcards,
        ],200);
       // return $giftcards;
    }

    


    public function giftcardHistory(Request $request)
    {
        $pageTitle       = 'Digital Giftcard History';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->searchable(['deposit_code'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.giftcard_auto.giftcard_history', compact('pageTitle', 'log'));
    }


    public function giftcardDetails($id)
    {
        $pageTitle       = 'Digital Giftcard Details';
        $user = auth()->user();
        $card = Order::whereUserId($user->id)->whereTrx(decrypt($id))->firstOrFail();
        return view($this->activeTemplate . 'user.giftcard_auto.giftcard_details', compact('pageTitle', 'card'));
    }


    public function giftcardBuy(Request $request, $id)
    {
        $user = auth()->user();  
        try {


            $detail = $this->giftcardbyiddetails($request->product_id);
            $amounts = json_encode($detail['fixedRecipientToSenderDenominationsMap']);
            $array = json_decode($amounts,true);
            $amount = null;
            foreach($array as $key  => $data)
            {
             if($request->product_amount == $key)
             $amount = $data;
            }
            if($amount == null)
            {
                $notify[] = ['error', 'Sorry we cant determine card price'];
                return back()->withNotify($notify);
            }
            $total = $amount * $request->quantity;

            if($user->balance < $total)
            {
                $notify[] = ['error', 'You dont have enough Wallet Balance'];
                return back()->withNotify($notify);
            }
            
                    //GET CARD API\\
                        if(env('MODE') == "TEST")
                        {
                            $baseurl = "https://giftcards-sandbox.reloadly.com";
                        }
                        else
                        {
                            $baseurl = "https://giftcards.reloadly.com";
                        }
                        $trx = getTrx();
                        $token = getTokenGiftcard();
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => $baseurl.'/orders',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                            "productId": "'.$request->product_id.'",
                            "quantity": "'.$request->quantity.'",
                            "unitPrice": "'.$request->product_amount.'",
                            "customIdentifier": "'.$trx.'",
                            "recipientEmail": "'.$user->email.'",
                            "recipientPhoneDetails": {
                                "countryCode": "'.$user->country_code.'",
                                "phoneNumber": "'.$user->mobile.'"
                            }
                        }',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Authorization: Bearer '.$token
                            ),
                        ));

                        $response = curl_exec($curl);
                        $reply = json_decode($response, true);
                        curl_close($curl);
                        if(!isset($reply['transactionId']))
                        {
                            $notify[] = ['error', 'API ERROR. '.$reply['message']];
                            return back()->withNotify($notify);
                        }

                        $order               = new Order();
                        $order->user_id      = $user->id;
                        $order->product_id   = $request->product_id;
                        $order->product_name     = @$request->productName;
                        $order->product_logo     = @$request->logoUrls;
                        $order->details      = null;
                        $order->quantity     = $request->quantity;
                        $order->price        = $request->product_amount;
                        $order->currency     = @$request->recipientCurrencyCode;
                        $order->payment      = @$amount;
                        $order->deposit_code   = getTrx();
                        $order->trx = $trx;
                        $order->status = $reply['status'];
                        $order->transaction_id = $reply['transactionId'];
                        $order->save();

                        $transaction               = new Transaction();
                        $transaction->user_id      = $user->id;
                        $transaction->amount       = $amount;
                        $transaction->post_balance = $user->balance;
                        $transaction->charge       = 0;
                        $transaction->trx_type     = '-';
                        $transaction->details      = 'Payment For Giftcard Via Wallet';
                        $transaction->trx          = $trx;
                        $transaction->remark       = 'giftcard';
                        $transaction->save();

                        $notify[] = ['success', 'Giftcard Purchase Request Sent Successfully.'];
                        return redirect()->route('user.giftcard.digital.history')->withNotify($notify); 
 
                } catch (\Exception $ex) {
                    
                }

    }


    public function giftcardbyiddetails($id)
    {
       
        //GET CARD API\\
        if(env('MODE') == "TEST")
        {
            $baseurl = "https://giftcards-sandbox.reloadly.com";
        }
        else
        {
            $baseurl = "https://giftcards.reloadly.com";
        }
        $token = getTokenGiftcard();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $baseurl.'/products/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/com.reloadly.giftcards-v1+json',
            'Authorization: Bearer '.$token
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $reply = json_decode($response, true);
        return $reply;
    }

      

    public function giftcardRedeemCode($id)
    {
        //GET CARD API\\
        $general = gs();
        
        if(env('MODE') == "TEST")
        {
            $baseurl = "https://giftcards-sandbox.reloadly.com";
        }
        else
        {
            $baseurl = "https://giftcards.reloadly.com";
        }
        $user = auth()->user();
        $card = Order::whereUserId($user->id)->whereDepositCode($id)->firstOrFail();

        $token = getTokenGiftcard();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $baseurl.'/orders/transactions/'.$card->transaction_id.'/cards',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/com.reloadly.giftcards-v1+json',
            'Authorization: Bearer '.$token
        ),
        ));

        $cardresponse = curl_exec($curl);
        curl_close($curl);
        if(!isset($cardresponse))
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Error fetching data.',
            ],200); 
        }
        $giftcards = json_decode($cardresponse, true);
        //return $cardresponse;
        if(isset($cardresponse['status']) == 500)
        {
            return response()->json([
                'status'=> false,
                'message'=> 'Sorry we cant find any matching data on this request',
            ],200); 
        }
        if(isset($giftcards['path']))
        {
            return response()->json([
                'status'=> false,
                'message'=> '<b>'.@$giftcards['error'].@$giftcards['message'].'</b> <br>Please check back later. ',
            ],200); 
        }
        $card->details = $giftcards;
        $card->save();
        return response()->json([
            'status'=> true,
            'data'=> $giftcards,
        ],200);
    }


    
}
