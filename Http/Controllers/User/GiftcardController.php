<?php

namespace App\Http\Controllers\User;

use App\Lib\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Admin;  
use App\Models\Transaction;  
use App\Models\Giftcard;
use App\Models\Giftcardtype;
use App\Models\Giftcardsale;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use Session;
use Route;

class GiftcardController extends Controller
{
    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $get['pageTitle'] = "Trade Giftcard";
        $get['log'] = Giftcardsale::whereUser_id(Auth::id())->orderBy('created_at','desc')->take(6)->get();
       return view($this->activeTemplate. 'user.giftcard.index', $get);
    }

    public function buygift()
    {
        $get['pageTitle'] = "Buy Giftcard";
        $get['currency'] = Giftcard::whereStatus(1)->orderBy('name','asc')->get();
        
            $notify[] = ['warning', 'Currently not available'];
            return back()->withNotify($notify);
            
       return view($this->activeTemplate. 'user.giftcard.giftcard', $get);
    }

    public function sellgift()
    {
        $get['pageTitle'] = "Sell Giftcard";
        $get['currency'] = Giftcard::whereStatus(1)->orderBy('name','asc')->get();
       return view($this->activeTemplate. 'user.giftcard.giftcard', $get);
    }


    public function selectgiftcard($id)
    {
        if(Route::is('user.selectgiftcardsell') )
        {
            $get['pageTitle'] = "Sell Giftcard";
            $get['tradetype'] = "sell";
        }
        else
        {
            $get['pageTitle'] = "Buy Giftcard";
            $get['tradetype'] = "buy";
        }
        $get['card'] = Giftcard::whereId($id)->first();
        $get['type'] = Giftcardtype::whereStatus(1)->whereCard_id($id)->orderBy('name','asc')->get();

        return view($this->activeTemplate. 'user.giftcard.giftcard-select', $get);
    }

    public function sellcard(Request $request)
    {
     $this->validate($request,
            [
            'card' => 'required',
            'typeofcard' => 'required',
            'amount' => 'required',
            'type' => 'required',
            ]);
       $card = Giftcard::whereId($request->card)->first();
       if($request->typeofcard == "Physical")
            {
              $this->validate($request,
            [
            'front' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'back' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            }

             if($request->typeofcard == "Digital")
            {
              $this->validate($request,
            [
             'code' => 'required',
            ]);

            }

         $type = Giftcardtype::whereId($request->type)->first();
         if(!$type){
            $notify[] = ['warning', 'There is no giftcard type available for '.$card->name.' at the moment. Please check back or try another giftcard'];
            return back()->withNotify($notify);
          }
         $get = $request->amount * $type->rate;

        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->typeofcard;
        $docm['card_id'] = $request->card;
        $docm['currency'] = $request->typeid;
        $docm['amount'] = $request->amount;
        $docm['country'] = $request->typecurrency;
        $docm['rate'] = $request->typerate;
        $docm['pay'] = $get;
        $docm['trx_type'] = 'sell';
        $docm['status'] = 0;
        $docm['source'] = 'mobile';
        $docm['trx'] = getTrx();
        if($request->code)
            {
            $docm['code'] = $request->code;
            }
        if($request->hasFile('front'))
            {
             $this->validate($request,
            [
            'front' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
                $docm['image'] = uniqid().'.jpg';
                $request->front->move('assets/images/giftcards',$docm['image']);
            }
          if($request->hasFile('back'))
            {
             $this->validate($request,
            [
            'back' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
                $docm['image2'] = uniqid().'.jpg';
                $request->back->move('assets/images/giftcards',$docm['image2']);
            }

            Giftcardsale::create($docm);


        $auth = Auth::user();
        
        
        
        $general      = GeneralSetting::first();
        $admins       = Admin::whereRoleId(0)->orWhere('role_id',3)->get();
        $config       = $general->mail_config;
        $subject      = 'New '.@$card->name.' sell order';
        $message      = 'A new '.$card->name.' sell order has been initiated by <b>'.$auth->username.'</b> with order reference number <b>'.$docm['trx'].'</b>. Please login to account to review pending order';

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
        
        
 
                $notify[] = ['success', 'Giftcard Exchange Request Sent Successfully.'];
                return redirect()->route('user.giftcard.log')->withNotify($notify); 
    }

    public function buycard(Request $request)
    {
        
            $notify[] = ['warning', 'Currently not available'];
            return back()->withNotify($notify);
     $this->validate($request,
            [
            'card' => 'required',
            'typeofcard' => 'required',
            'amount' => 'required',
            'type' => 'required',
            ]);
        $card = Giftcard::whereId($request->card)->first();
       
        $type = Giftcardtype::whereId($request->type)->first();
         if(!$type){

    $notify[] = ['There is no giftcard type available for '.$card->name.' at the moment. Please check back or try another giftcard'];
    return back()->withNotify($notify);

          }
        $get = $request->amount * $type->buy_rate;
        $docm['user_id'] = Auth::id();
        $docm['type'] = $request->typeofcard;
        $docm['card_id'] = $request->card;
        $docm['currency'] = $request->typeid;
        $docm['amount'] = $request->amount;
        $docm['country'] = $request->typecurrency;
        $docm['rate'] = $request->typerate;
        $docm['pay'] = $get;
        $docm['status'] = 0;
        $docm['trx_type'] = 'buy';
        $docm['trx'] = getTrx();
         
        Giftcardsale::create($docm);


        $auth = Auth::user();  
 

    $notify[] = ['success', 'Giftcard Purchase Request Successfully.'];
    return redirect()->route('user.giftcard.log')->withNotify($notify); 
}


    public function sellcardlog()
    {
        $auth = Auth::user();
        $get['pageTitle'] = "Sell Giftcard Log";
        $get['card'] = Giftcardsale::whereUser_id($auth->id)->whereTrxType('sell')->orderBy('created_at','desc')->paginate(7);

       return view($this->activeTemplate. 'user.giftcard.giftcard-log', $get);
    }

    public function buycardlog()
    {
        $auth = Auth::user();
        $get['pageTitle'] = "Buy Giftcard Log";
        $get['card'] = Giftcardsale::whereUser_id($auth->id)->whereTrxType('buy')->orderBy('created_at','desc')->paginate(7);

       return view($this->activeTemplate. 'user.giftcard.giftcard-log', $get);
    }

    public function giftcardlog()
    {
        $auth = Auth::user();
        $get['pageTitle'] = "Giftcard Log";
        $get['card'] = Giftcardsale::whereUser_id($auth->id)->orderBy('created_at','desc')->paginate(7);

       return view($this->activeTemplate. 'user.giftcard.giftcard-log', $get);
    }

}
