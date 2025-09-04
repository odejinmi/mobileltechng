<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Order; 
use App\Models\Cryptocurrency; 
use App\Models\GeneralSetting; 
 use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\FileTypeValidate;
use Illuminate\Validation\Rules\Password;
use DB;
use Image;
use Carbon\Carbon;
class SellCryptoController extends Controller
{

 
    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->middleware('sell_crypto.status');
        $this->activeTemplate = activeTemplate();
    }

       
    public function index(Request $request)
    {
        $pageTitle       = 'Sell Crypto';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('sell_crypto')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.assets.crypto.sellcrypto.index', compact('pageTitle', 'log'));
    }

    public function sell(Request $request)
    {
        $pageTitle = 'Sell Crypto';
        $countries = []; 
        $plans = [];
        $currencies = Cryptocurrency::whereStatus(1)->get();
        return view($this->activeTemplate . 'user.assets.crypto.sellcrypto.sell', compact('pageTitle','currencies'));
    }

      
 
    public function sellProcess()
    {
        $general = gs();
         
            try {
                $json = file_get_contents('php://input');
                $input = json_decode($json, true); 
                $coin = $input['coin'];
                $amount = $input['amount'];
                $currency = Cryptocurrency::whereId($coin)->firstOrFail();
                 
                $user = auth()->user();
                $value = $amount*$currency->sell_rate;
                $order               = new Order();
                    $order->user_id      = @$user->id;
                    $order->type         = 'sell_crypto';
                    $order->deposit_code   = @getTrx();
                    $order->product_id   = @$currency->id;
                    $order->product_name = @$currency->name;
                    $order->product_logo = @$currency->image;
                    $order->details      = json_encode($input,true);
                    $order->quantity     = 1;
                    $order->value        = @$value;
                    $order->price        = $currency->sell_rate;
                    $order->currency     = 'USD';
                    $order->status       = 'pending';
                    $order->payment      = $amount;
                    $order->trx          = getTrx();
                    $order->source       = @$wallet; 
                    $order->transaction_id  = rand(1000000,100000000);
                    $order->save();
                return response()->json(['ok'=>true,'status'=>'success','message'=> 'Trade Invoice Created Successfully','coin'=> $currency,'data'=> $order,'auto'=> false],200);
                } catch (\Exception $exp) {
                    return response()->json(['ok'=>false,'status'=>'error','message'=> $exp->getMessage()],200);
        
                }
    }


    public function sellConfirmManual(Request $request)
    {
        $general = gs();
        $user = auth()->user();
        $order = Order::whereTrx($request->trx)->whereUserId($user->id)->firstOrFail();         
        $order->val_1 = $request->trxhash;
        $path = imagePath()['trade']['path'].'/'.$user->username;
        if ($request->hasFile('proof')) {
            $request->validate([ 
                'proof'     => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            ]);
            try {
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
               $file = getTrx().'.png';
               $image = Image::make($request->proof)->save($path . '/'.$file);
               $order->val_2 = $file;

            } catch (\Exception $exp) {
                //return $exp;
                //$notify[] = ['error', 'Could not upload your Proof of payment'];
                //return back()->withNotify($notify)->withInput();
            }
        } 
        $order->save();
        
         $general      = GeneralSetting::first();
        $admins       = Admin::whereRoleId(0)->orWhere('role_id',3)->get();
        $config       = $general->mail_config;
        $subject      = 'New '.$order->product_name.' sell order';
        $message      = 'A new '.$order->product_name.' sell order has been initiated by <b>'.$user->username.'</b> with order reference number <b>'.$order->trx.'</b>. Please login to account to review pending order';

        foreach($admins as $admin)
        {
            
            $receiverName = $admin->name;
            if ($general->en) {
                $user = [
                    'username' => $admin->username,
                    'email'    => $admin->email,
                    'fullname' => $receiverName,
                ];
                notify($user, 'DEFAULT', [
                    'subject' => $subject,
                    'message' => $message,
                ], ['email'], false);
            } 
        
        }
        
        $notify[] = ['success', 'Transaction submitted successfuly successfuly.'];
        return redirect()->route('user.crypto.sell.log')->withNotify($notify);  
    }
 
    public function log(Request $request)
    {
        $pageTitle       = 'Sales Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('sell_crypto')->searchable(['deposit_code'])->with('asset')->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.assets.crypto.sellcrypto.sell_log', compact('pageTitle', 'log'));
    }
  
    
}
