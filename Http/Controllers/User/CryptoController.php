<?php

namespace App\Http\Controllers\User;

use App\Models\ChargesLimit;
use App\Models\Cryptocurrency;
use App\Models\Cryptowallet; 
use App\Models\Cryptotrx; 
use App\Models\Transaction; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CryptoController extends Controller
{

	public function __construct()
    {
        $this->middleware('crypto.status');
        $this->activeTemplate = activeTemplate();
    }


	public function CryptoTrade(Request $request)
    {
        $general = gs();
        if ($general->buy_crypto == 0 || $general->sell_crypto == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        $pageTitle       = 'Trade Crypto';
		$coins = Cryptocurrency::whereStatus(1)->get();

        return view($this->activeTemplate . 'user.assets.crypto.index', compact('pageTitle','coins'));
    }



	public function rates()
	{
		$user = Auth::user();
		$pageTitle = 'Currency Rates';
		$coins = Cryptocurrency::whereStatus(1)->get();
		return view($this->activeTemplate .'user.assets.crypto.rates', compact('pageTitle', 'user', 'coins'));
	}

	public function currencies()
	{
		$user = Auth::user();
		$pageTitle = 'Currencies';
		$coins = Cryptocurrency::whereStatus(1)->get();
		return view($this->activeTemplate .'user.wallet.index', compact('pageTitle', 'user', 'coins'));
	}

	public function index($id)
	{
		$user = Auth::user();
		$coin = Cryptocurrency::whereId(decrypt($id))->whereStatus(1)->firstOrFail();
		$wallet = Cryptowallet::whereCoinId($coin->id)->whereUserId($user->id)->whereStatus(1)->first();
		if(!$wallet)
		{
		$baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/get-new-address";
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
		  CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'label' => $user->username),
		));

		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		// return $response;
		if(!isset($reply['data']['address']))
		{
			$notify[] = ['error', 'Error, Erro creating wallet address!'];
			return back()->withNotify($notify);
		}
		$wallet = new Cryptowallet();
        $wallet->coin_id = $coin->id;
        $wallet->user_id = $user->id;
        $wallet->label = $reply['data']['label'];
        $wallet->address =$reply['data']['address'];
        $wallet->qrcode = $reply['data']['qr_code'];
        $wallet->status = 1; 
        $wallet->save(); 
		}
		
		$pageTitle = $coin->name.' Wallet';
		$trx = Cryptotrx::where('user_id', $user->id)->whereCoin_id($coin->id)->take(5)->latest()->get();
		return view($this->activeTemplate.'user.wallet.wallet', compact('pageTitle', 'user', 'wallet', 'trx', 'coin'));
	}


	public function validatewallet(Request $request, $id)
	{
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);	 
		$address = $input['address'];
		$coin = Cryptocurrency::whereId(decrypt($id))->whereStatus(1)->firstOrFail();
		try{
			$baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/validate-address";
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
			CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'address' => $address),
			));
			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['data']['valid']))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error, Please check network'],400);
			}
			if($reply['data']['valid'] == true)
			{
				return response()->json(['ok'=>true,'status'=>'success','message'=> 'Wallet Address Validated','content'=> $response],200);
			}
			if($reply['data']['valid'] != true)
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'wrong wallet address'],400);
			}
		}
		catch (\Exception $e) {  
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}
	
	
	public function sellall(Request $request, $id)
	{
		$user = auth()->user();
		$json = file_get_contents('php://input'); 
		$coin = Cryptocurrency::whereId(decrypt($id))->whereStatus(1)->firstOrFail();
		$wallet = Cryptowallet::whereCoinId($coin->id)->whereUserId($user->id)->whereStatus(1)->first();
			if(!$wallet)
			{
			    $notify[] = ['error', 'Invalid wallet'];
			   return back()->withNotify($notify);
			}
			
			if($wallet->balance <= 0)
			{
			    $notify[] = ['error', 'Insufficient wallet balance'];
			   return back()->withNotify($notify);
			}
		try{
		     
			$baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/get-fiat-to-crypto-rate";
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
			CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'fiat_symbol' => 'USD','fiat_amount' => 1),
			));

			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['data']['crypto_amount']))
			{
				$notify[] = ['error', 'Error'];
			   return back()->withNotify($notify);
			}

				//Create Credit Transaction
                
				$usd = 	$wallet->balance / $reply['data']['crypto_amount'];
				$get = 	$usd * $coin->swap_rate;

				

				$wallet->balance = 0;
				$wallet->save();

				$user->balance += $get;
				$user->save();

				$transaction               = new Transaction();
				$transaction->user_id      = $user->id;
				$transaction->amount       = $get;
				$transaction->post_balance = $user->balance;
				$transaction->trx_type     = '+';
				$transaction->details      = 'Crypto Swap';
				$transaction->trx          = getTrx();
				$transaction->remark       = 'Coin Swap';
				$transaction->save();

				$trx = new Cryptotrx();
				$trx->coin_id = $coin->id;
				$trx->user_id = $user->id;
				$trx->amount = $wallet->balance;
				$trx->to_address = null;
				$trx->usd = $usd;
				$trx->address = $wallet->address;
				$trx->type = 'swap';
				$trx->hash = null;
				$trx->trxid = getTrx();
				$trx->explorer_url = "#";
				$trx->wallet_id = $wallet->id; 
				$trx->status = 1; 
				$trx->save(); 
				
				
				
				 // Send Mail
				 notify($user, 'USER_MESSAGE', [
					'message' => 'Your currency sell all transaction was successful. Your account has been credited with accordingly. Please login to account to check status',
					'subject' => 'Currency Swap'
				]);
				
 $notify[] = ['success', 'Transaction succesful'];
			   return back()->withNotify($notify);
			   		 
		}
		catch (\Exception $e) {  
		     $notify[] = ['error', $e->getMessage()];
			   return back()->withNotify($notify);
			   
			   
			//return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}


	public function exchange(Request $request, $id)
	{
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);	 
		$amount = $input['amount'];
		$coin = Cryptocurrency::whereId(decrypt($id))->whereStatus(1)->firstOrFail();
		$wallet = Cryptowallet::whereCoinId($coin->id)->whereUserId($user->id)->whereStatus(1)->first();
		if(!$wallet)
		{
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid Source Wallet'],400);
		}
		if($coin->minimum_amount < $amount)
		{
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Minimum Amount is '.$coin->minimum_amount.'USD'],400);
		}
		if($amount > $coin->maximum_amount)
		{
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Maximum Amount is '.$coin->maximum_amount.'USD'],400);
		}
		
		
		try{
			$baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/get-fiat-to-crypto-rate";
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
			CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'fiat_symbol' => 'USD','fiat_amount' => $amount),
			));

			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['data']['crypto_amount']))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error, Please check network'],400);
			}
			if($wallet->balance < $reply['data']['crypto_amount'])
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
			}
			if($reply['data']['crypto_amount'])
			{
				return response()->json(['ok'=>true,'status'=>'success','message'=> $reply['data']['crypto_amount'].$reply['data']['crypto_symbol'],'content'=> ''],200);
			} 
		}
		catch (\Exception $e) {  
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}

	public function swap(Request $request, $id)
	{
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);	 
		$amount = $input['amount'];	 
		$source = $input['source'];
		$coin = Cryptocurrency::whereId(decrypt($id))->whereStatus(1)->firstOrFail();
		$wallet = Cryptowallet::whereCoinId($coin->id)->whereUserId($user->id)->whereAddress($source)->whereStatus(1)->first();
			if(!$wallet)
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid Source Wallet'],400);
			}
		try{
			$baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/get-fiat-to-crypto-rate";
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
			CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'fiat_symbol' => 'USD','fiat_amount' => $amount),
			));

			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['data']['crypto_amount']))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error, Please check network'],400);
			}
			if($wallet->balance < $reply['data']['crypto_amount'])
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
			}   

				$wallet->balance -= $reply['data']['crypto_amount'];
				$wallet->save();

				//Create Credit Transaction

				$get = $amount * $coin->swap_rate;
				$user->balance += $get;
				$user->save();

				$transaction               = new Transaction();
				$transaction->user_id      = $user->id;
				$transaction->amount       = $get;
				$transaction->post_balance = $user->balance;
				$transaction->trx_type     = '+';
				$transaction->details      = 'Crypto Swap';
				$transaction->trx          = getTrx();
				$transaction->remark       = 'Coin Swap';
				$transaction->save();

				$trx = new Cryptotrx();
				$trx->coin_id = $coin->id;
				$trx->user_id = $user->id;
				$trx->amount = $reply['data']['crypto_amount'];
				$trx->to_address = null;
				$trx->usd = $amount;
				$trx->address = $wallet->address;
				$trx->type = 'swap';
				$trx->hash = null;
				$trx->trxid = getTrx();
				$trx->explorer_url = "#";
				$trx->wallet_id = $wallet->id; 
				$trx->status = 1; 
				$trx->save(); 
				
				 // Send Mail
				 notify($user, 'USER_MESSAGE', [
					'message' => 'Your currency swap transaction was successful. Your account has been credited with accordingly. Please login to account to check status',
					'subject' => 'Currency Swap'
				]);
				
				return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Successful','content'=> json_encode($reply['data'])],200);
		 
		}
		catch (\Exception $e) {  
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}

	public function send(Request $request, $id)
	{
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);	 
		$amount = $input['amount'];	 
		$address = $input['address'];
		$source = $input['source'];
		$coin = Cryptocurrency::whereId(decrypt($id))->whereStatus(1)->firstOrFail();
		$wallet = Cryptowallet::whereCoinId($coin->id)->whereUserId($user->id)->whereAddress($source)->whereStatus(1)->first();
			if(!$wallet)
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid Source Wallet'],400);
			}
			if($wallet->balance < $amount)
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet'],400);
			}

		try{
			$baseurl = "https://coinremitter.com/api/v3/".$coin->symbol."/withdraw";
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
			CURLOPT_POSTFIELDS => array('api_key' => $coin->apikey,'password' => $coin->apipass,'to_address' => $address,'amount' => $amount),
			));
			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['data']['txid']))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error, Please check network'],400);
			}
			if($reply['data']['txid'])
			{
				$trx = new Cryptotrx();
				$trx->coin_id = $coin->id;
				$trx->user_id = $user->id;
				$trx->amount = $reply['data']['amount'];
				$trx->to_address = $reply['data']['to_address'];
				$trx->usd = $amount;
				$trx->address = $wallet->address;
				$trx->type = 'send';
				$trx->hash = $reply['data']['txid'];
				$trx->trxid = $reply['data']['id'];
				$trx->explorer_url = $reply['data']['explorer_url'];
				$trx->wallet_id = $reply['data']['wallet_id']; 
				$trx->status = 1; 
				$trx->save(); 
				$wallet->balance -= $reply['data']['total_amount'];
				$wallet->save();

				// Send Mail
				notify($user, 'USER_MESSAGE', [
					'message' => 'You have successfully sent '.$reply['data']['amount'].$coin->name.' to '.$reply['data']['to_address'],
					'subject' => 'Currency Sent'
				]);

				return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Successful','content'=> json_encode($reply['data'])],200);
			} 
		}
		catch (\Exception $e) {  
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}

	public function transactions($id)
	{
		$user = Auth::user();
		$wallet = Cryptowallet::whereAddress($id)->whereUserId($user->id)->whereStatus(1)->firstOrFail();
		$coin = Cryptocurrency::whereId($wallet->coin_id)->whereStatus(1)->firstOrFail();
		$pageTitle = $coin->name.' Wallet Transactions';
		$trx = Cryptotrx::where('user_id', $user->id)->whereCoin_id($coin->id)->latest()->paginate(10);
		 
		return view($this->activeTemplate.'user.wallet.transactions', compact('pageTitle', 'user', 'wallet', 'trx', 'coin'));
	}

	 

	 
}
