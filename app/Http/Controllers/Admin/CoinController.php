<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Cryptotrx;
use App\Models\Order;
use App\Models\Cryptocurrency;
use App\Models\Cryptowallet;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
use Image;

class CoinController extends Controller
{


    public function coinAdd(Request $request)
    {
         $request->validate([
          'name' => 'required|string',
          'symbol' => 'required|string',
        ]);
        $coin = new Cryptocurrency();
        $path = imagePath()['coin']['path'];
        if ($request->hasFile('logo')) {
            $request->validate([ 
                'logo'     => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            ]);
            try {
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
               $file = getTrx().'.png';
               $image = Image::make($request->logo)->save($path . '/'.$file);
               $coin->image = $file;

            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload your currency logo'];
                return back()->withNotify($notify)->withInput();
            }
        } 

        $coin->name = $request->name;
        $coin->symbol = $request->symbol;
        $coin->save(); 
        $notify[] = ['success', 'New Asset Added Successfully'];
        return back()->withNotify($notify);
        
    }


    public function index()
    {
        $pageTitle = 'Manage Cryptocurrency';
        $emptyMessage = 'No Coin.';
        $currency = Cryptocurrency::all();
        return view('admin.currency.index', compact('pageTitle', 'emptyMessage', 'currency'));
    }

     public function activate($id)
    {
        $general_setting = GeneralSetting::first();
        $page_title = 'Currency Settings';
        $currency = Cryptocurrency::whereId($id)->first();

        if (!$currency){
		 $notify[] = ['error', 'Invalid Currency. Contact server admin'];
            return back()->withNotify($notify);
         }
         else{
         $currency->status = 1;
         $currency->save();
         $notify[] = ['success', 'Cryotocurrency Activated'];
         return back()->withNotify($notify);
         }

    }

     public function deactivate($id)
    {
        $general_setting = GeneralSetting::first();
        $page_title = 'Currency Settings';
        $currency = Cryptocurrency::whereId($id)->first();

        if (!$currency){
		 $notify[] = ['error', 'Invalid Currency. Contact server admin'];
         return back()->withNotify($notify);
         }
         else{
         $currency->status = 0;
         $currency->save();
         $notify[] = ['success', 'Cryotocurrency Deactivated'];
         return back()->withNotify($notify);
         }

    }

     public function edit($id)
    {
       $general_setting = GeneralSetting::first();

        $general_setting = GeneralSetting::first();
         $pageTitle  = 'Currency Settings';
        $currency = Cryptocurrency::whereId($id)->first();

        if (!$currency){
		 $notify[] = ['error', 'Invalid Currency. Contact server admin'];
            return back()->withNotify($notify);
         }
         else{
          return view('admin.currency.edit', compact('currency','pageTitle', 'general_setting'));
         }

    }

      public function apiupdate(Request $request, $id)
    {
    $general_setting = GeneralSetting::first();

         $request->validate([
            'apikey' => 'required',
            'apipass' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required',
            'api_trx_fee' => 'required',
            'api_processing_fee' => 'required',
            'merchant_trx_fee' => 'required',
            'swap_rate' => 'required',
            'buy_rate' => 'required',
            'sell_rate' => 'required',
        ]);

        $currency = Cryptocurrency::whereId($id)->first();

        if (!$currency){
		 $notify[] = ['error', 'Invalid Currency. Contact server admin'];
            return back()->withNotify($notify);
         }
         else{
          $currency->wallet_address = $request->wallet_address;
          $currency->account_details = $request->account_details;
          $currency->apikey = $request->apikey;
         $currency->apipass = $request->apipass;
         $currency->swap_rate = $request->swap_rate;
         $currency->buy_rate = $request->buy_rate;
         $currency->sell_rate = $request->sell_rate;
         $currency->merchant_trx_fee = $request->merchant_trx_fee;
         $currency->api_trx_fee = $request->api_trx_fee;
         $currency->api_processing_fee = $request->api_processing_fee;
         $currency->minimum_amount = $request->minimum_amount;
         $currency->maximum_amount = $request->maximum_amount;
         $currency->save();
          $notify[] = ['success', $currency->name.' API Credentials Updated Successfully'];
            return back()->withNotify($notify);
         }

    }



    public function swap()
    {
        $pageTitle = 'Coin Swap';
        $emptyMessage = 'No Swap Log.';
        $log = Cryptocurrency::whereType('swap')->get();
        return view('admin.wallet.swap', compact('pageTitle', 'emptyMessage', 'log'));
    }

      public function wallet()
    {
        $pageTitle = 'Select Currency';
        $emptyMessage = 'No Currency Log.';
        $coins = Cryptocurrency::whereStatus(1)->get();
        return view('admin.currency.wallet.index', compact('pageTitle', 'emptyMessage', 'coins'));
    }

     public function viewwallet($id)
    {
        $id = decrypt($id);
        $currency = Cryptocurrency::whereId($id)->first();
        $unit = Cryptowallet::whereCoin_id($currency->id)->sum('balance');
        $pageTitle = $currency->name.' Wallet';
        $user = User::all();
        $wallets = Cryptowallet::whereCoin_id($currency->id)->get();
        $general = GeneralSetting::first();
        $baseurl = "https://coinremitter.com/api/v3/get-coin-rate";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $baseurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'fiat_amount' => 1,'fiat_symbol' => 'USD'),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);

		if (!isset($reply['msg']))
         {
		        $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         if ($reply['msg'] != 'success')
         {
		        $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }

         $rate = $reply['data'][$currency->symbol]['price'];
         $usd = $rate * $unit;
         foreach ($wallets as $dataw)
        {
         $usdrate = $rate * $dataw->balance;
         $dataw->usd = $usdrate;
         $dataw->save();
        }
        $wallets = Cryptowallet::whereCoin_id($currency->id)->with('coin')->get();

        return view('admin.currency.wallet.wallets', compact('user','pageTitle','currency','wallets','unit','rate','usd'));
      }


        public function activatewallet($id)
    {
        $general_setting = GeneralSetting::first();
        $wallet = Cryptowallet::whereAddress($id)->first();

        if (!$wallet){
		 $notify[] = ['error', 'Invalid Wallet. Contact server admin'];
            return back()->withNotify($notify);
         }
         else{
         $wallet->status = 1;
         $wallet->save();
          $notify[] = ['success', 'Wallet Activated'];
            return back()->withNotify($notify);
         }

    }

     public function deactivatewallet($id)
    {
        $general_setting = GeneralSetting::first();
        $wallet = Cryptowallet::whereAddress($id)->first();

        if (!$wallet){
		 $notify[] = ['error', 'Invalid Wallet. Contact server admin'];
            return back()->withNotify($notify);
         }
         else{
         $wallet->status = 0;
         $wallet->save();
          $notify[] = ['success', 'Wallet Deactivated'];
            return back()->withNotify($notify);
         }

    }

      public function createwallet(Request $request, $id)
       {
        $this->validate($request, [
            'label' => 'required|max:10',
            'user' => 'required',
        ]);
        $currency = Currency::where('status', '!=', 0)->whereCanwallet(1)->whereSymbol($id)->first();
        $walletcount = Cryptowallet::where('user_id', $request->user)->whereCoin_id($currency->id)->whereLabel($request->label)->where('status', 1)->count();
        if($walletcount > 0){
         $notify[] = ['error', 'User already have a '.$currency->name.' wallet with this label. Please try another label'];
            return back()->withNotify($notify);
        }
        $general = GeneralSetting::first();
        $label = $request->label;;
        $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-new-address";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $baseurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'label' => $label),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		//return $response;

		 if (!isset($reply['flag'])){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         if ($reply['flag'] != '1'){
		 $notify[] = ['error', 'An error occur. Contact server admin'];
            return back()->withNotify($notify);
         }
         $address = $reply['data']['address'];
         $qrcode = $reply['data']['qr_code'];

         $w['user_id'] = $request->user;
         $w['address'] = $address;
         $w['qrcode'] = $qrcode;
         $w['coin_id'] = $currency->id;
         $w['label'] = $label;
         $w['balance'] = 0;
         $w['status'] = 1;
         $result = Cryptowallet::create($w);

         if($result){
         $notify[] = ['success', 'Your new '.$currency->name.' wallet has been created successfully.'];
         return back()->withNotify($notify);
            }


    }



     public function creditwallet(Request $request, $id)
    {
         $request->validate([
            'amount' => 'required|integer'
        ]);

         $wallet = Cryptowallet::whereAddress($id)->first();
        if(!$wallet){
         $notify[] = ['error', 'Wallet not found'];
            return back()->withNotify($notify);
        }

         else{
         $wallet->balance += $request->unit;
         $wallet->usd += $request->amount;
         $wallet->save();
          $notify[] = ['success', 'Wallet Credited Successfully'];
            return back()->withNotify($notify);
         }

    }


     public function debitwallet(Request $request, $id)
    {
         $request->validate([
            'amount' => 'required|integer'
        ]);

         $wallet = Cryptowallet::whereAddress($id)->first();
        if(!$wallet){
         $notify[] = ['error', 'Wallet not found'];
            return back()->withNotify($notify);
        }

         else{
         $wallet->balance = $wallet->balance - $request->unit;
         $wallet->usd  = $wallet->usd - $request->amount;
         $wallet->save();
          $notify[] = ['success', 'Wallet Debited Successfully'];
            return back()->withNotify($notify);
         }

    }

      public function viewwalletaddress($id)
    {
        $pageTitle = 'View Wallet';
        $wallet = Cryptowallet::where('address', $id)->first();
         if(!$wallet){
         $notify[] = ['error', 'Invalid Wallet or Wallet Not Found'];
            return back()->withNotify($notify);
         }
        $currency = Cryptocurrency::where('id', $wallet->coin_id)->where('status', 1)->first();
         if(!$currency){
         $notify[] = ['error', 'Invalid Currency or Currency Not Found'];
            return back()->withNotify($notify);
         } 

         $baseurl = "https://coinremitter.com/api/v3/".$currency->symbol."/get-transaction-by-address";
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => $currency->apikey,'password' => $currency->apipass,'address' => $wallet->address),
          ));

          $response = curl_exec($curl);
          $transactions = json_decode($response,true);
          curl_close($curl);
          //return $response;
        return view('admin.currency.wallet.transactions', compact('pageTitle','transactions','wallet'));
    }


    public function selllog(Request $request, $id)
    {
        $pageTitle       = 'Sales Log';
        $log = Order::whereType('sell_crypto')->whereStatus($id)->searchable(['deposit_code'])->with('asset','user')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.currency.sell_log', compact('pageTitle', 'log'));
    }

    public function selllogApprove($id)
    {
        $order = Order::whereType('sell_crypto')->whereTrx($id)->whereStatus('pending')->firstOrFail();
        $order->status = 'success';
        $order->save();
        $user = User::whereId($order->user_id)->firstOrFail();
        $currency = Cryptocurrency::whereId($order->product_id)->firstOrFail();

        if($order->source == 'main')
        {
          $user->balance += $order->value;
        }
        else
        {
          $user->ref_balance += $order->value;
        }
        $user->save();
        $transaction               = new Transaction();
        $transaction->user_id      = $order->user_id;
        $transaction->amount       = $order->value;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Sold '. $currency->name.' Digital Asset';
        $transaction->trx          = $order->trx;
        $transaction->remark       = 'sell_crypto';
        $transaction->save();

        $notify[] = ['success', 'Transaction Approved'];
        return back()->withNotify($notify);
    }

    public function selllogDecline($id)
    {
        $trade = Order::whereType('sell_crypto')->whereTrx($id)->whereStatus('pending')->firstOrFail();
        $trade->status = 'declined';
        $trade->save();
        $notify[] = ['success', 'Transaction Declined'];
        return back()->withNotify($notify);
    }

    public function buylog(Request $request, $id)
    {
        $pageTitle       = 'Purchase Log';
        $log = Order::whereType('buy_crypto')->whereStatus($id)->searchable(['deposit_code'])->with('asset')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.currency.buy_log', compact('pageTitle', 'log'));
    }
    public function buylogApprove($id)
    {
        $order = Order::whereType('buy_crypto')->whereTrx($id)->whereStatus('pending')->firstOrFail();
        $order->status = 'success';
        $order->save();
        $user = User::whereId($order->user_id)->firstOrFail();
        
        $notify[] = ['success', 'Transaction Approved'];
        return back()->withNotify($notify);
    }

    public function buylogDecline($id)
    {
        $trade = Order::whereType('buy_crypto')->whereTrx($id)->whereStatus('pending')->firstOrFail();
        $trade->status = 'declined';
        $trade->save();
        $notify[] = ['success', 'Transaction Declined'];
        return back()->withNotify($notify);
    }

}
