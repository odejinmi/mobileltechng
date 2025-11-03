<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Deposit;
use App\Models\Order;
use App\Models\Upgrade;
use App\Models\P2p;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\SupportTicket;
use App\Models\Transaction;
use App\Models\GeneralSetting;
use App\Models\WithdrawMethod;
use App\Models\VirtualCard;
use App\Models\Withdrawal;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Response;
use Image;
use Carbon\Carbon;
class UserController extends Controller
{

    public function contact()
    {
        $general = gs();
        $pageTitle       = 'Contact Us';
        return view($this->activeTemplate . 'user.contact', compact('pageTitle','general'));
    }

    public function home()
    {

        $user  = User::whereId(auth()->user()->id)->first();
        $last30 = date('Y-m-d', strtotime('-30 days'));
		$last7 = date('Y-m-d', strtotime('-7 days'));
		$today = today();
		$dayCount = date('t', strtotime($today));

        $pageTitle                   = 'Dashboard';
        $widget['ref_balance']       = $user->ref_balance;
        $widget['balance']           = $user->balance;
        $widget['total_transaction'] = Transaction::where('user_id', $user->id)->count();
        $widget['deposit'] = Transaction::where('user_id', $user->id)->whereTrxType('+')->sum('amount');
        $widget['payout'] = Transaction::where('user_id', $user->id)->whereTrxType('-')->sum('amount');
        $widget['total_ticket']      = SupportTicket::where('user_id', $user->id)->count();

        $deposits = Transaction::select('remark', 'created_at')
            ->where('user_id', $user->id)
			->where('trx_type', '+')
			->whereYear('created_at', $today)
			->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'remark'])
			->selectRaw("SUM(amount) as Deposit")
			->get()
			->groupBy([function ($query) {
				return $query->created_at->format('F');
			}, 'remark']);

            $payouts = Transaction::select('remark', 'created_at')
            ->where('user_id', $user->id)
            ->where('trx_type', '-')
			->whereYear('created_at', $today)
			->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'remark'])
			->selectRaw("SUM(amount) as Payout")
			->get()
			->groupBy([function ($query) {
				return $query->created_at->format('F');
			}, 'remark']);



                $airtime = Transaction::select('remark', 'created_at')
                    ->where('user_id', $user->id)
                    ->where('remark', 'airtime')
                    ->whereYear('created_at', $today)
                    ->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'remark'])
                    ->selectRaw("SUM(amount) as Airtime")
                    ->get()
                    ->groupBy([function ($query) {
                        return $query->created_at->format('F');
                }, 'remark']);

                $internet = Transaction::select('remark', 'created_at')
                ->where('user_id', $user->id)
                ->where('remark','internet')
                ->whereYear('created_at', $today)
                ->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'remark'])
                ->selectRaw("SUM(amount) as Internet")
                ->get()
                ->groupBy([function ($query) {
                    return $query->created_at->format('F');
                }, 'remark']);
                $cabletv = Transaction::select('remark', 'created_at')
                    ->where('user_id', $user->id)
                    ->where('remark', 'cabletv')
                    ->whereYear('created_at', $today)
                    ->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'remark'])
                    ->selectRaw("SUM(amount) as Cabletv")
                    ->get()
                    ->groupBy([function ($query) {
                        return $query->created_at->format('F');
                }, 'remark']);
                $utility = Transaction::select('remark', 'created_at')
                    ->where('user_id', $user->id)
                    ->where('remark', 'utility')
                    ->whereYear('created_at', $today)
                    ->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'remark'])
                    ->selectRaw("SUM(amount) as Utility")
                    ->get()
                    ->groupBy([function ($query) {
                        return $query->created_at->format('F');
                }, 'remark']);
                $insurance = Transaction::select('remark', 'created_at')
                    ->where('user_id', $user->id)
                    ->where('remark', 'insurance')
                    ->whereYear('created_at', $today)
                    ->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'remark'])
                    ->selectRaw("SUM(amount) as Insurance")
                    ->get()
                    ->groupBy([function ($query) {
                        return $query->created_at->format('F');
                }, 'remark']);

		$data['yearLabels'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$yearDeposit = [];
		$yearPayout = [];
		$yearAirtime = [];
		$yearInternet = [];
		$yearCabletv = [];
		$yearUtility = [];
		$yearInsurance = [];

		foreach ($data['yearLabels'] as $yearLabel) {
			$currentYearDeposit = 0;
			$currentYearPayout = 0;
			$currentYearAirtime = 0;
			$currentYearInternet = 0;
			$currentYearCabletv = 0;
			$currentYearUtility = 0;
			$currentYearInsurance = 0;
			if (isset($deposits[$yearLabel])) {
				foreach ($deposits[$yearLabel] as $key => $deposit) {
						$currentYearDeposit += $deposit[0]->Deposit;
				}
			}
			if (isset($payouts[$yearLabel])) {
				foreach ($payouts[$yearLabel] as $key => $payout) {
						$currentYearPayout += $payout[0]->Payout;
				}
			}
            if (isset($airtime[$yearLabel])) {
				foreach ($airtime[$yearLabel] as $key => $airtime) {
						$currentYearAirtime += $airtime[0]->Airtime;
				}
			}
            if (isset($internet[$yearLabel])) {
				foreach ($internet[$yearLabel] as $key => $internet) {
						$currentYearInternet += $internet[0]->Internet;
				}
			}
            if (isset($cabletv[$yearLabel])) {
				foreach ($cabletv[$yearLabel] as $key => $cabletv) {
						$currentYearCabletv += $cabletv[0]->Cabletv;
				}
			}
            if (isset($utility[$yearLabel])) {
				foreach ($utility[$yearLabel] as $key => $utility) {
						$currentYearUtility += $utility[0]->Utility;
				}
			}
            if (isset($insurance[$yearLabel])) {
				foreach ($insurance[$yearLabel] as $key => $insurance) {
						$currentYearInsurance += $insurance[0]->Insurance;
				}
			}

			$yearDeposit[] = round($currentYearDeposit, 2);
			$yearPayout[] = - round($currentYearPayout, 2);
			$yearAirtime[] = round($currentYearAirtime, 2);
			$yearInternet[] = round($currentYearInternet, 2);
			$yearCabletv[] = round($currentYearCabletv, 2);
			$yearUtilty[] = round($currentYearUtility, 2);
			$yearInsurance[] = round($currentYearInsurance, 2);
		}

		$data['yearDeposit'] = $yearDeposit;
		$data['yearPayout'] = $yearPayout;
		$data['yearAirtime'] = $yearAirtime;
		$data['yearInternet'] = $yearInternet;
		$data['yearCabletv'] = $yearCabletv;
		$data['yearUtility'] = $yearUtilty;
		$data['yearInsurance'] = $yearInsurance;
        $data['ref'] = User::where('ref_by', $user->id)->orderBy('id', 'desc')->count();

        //return $payouts;
        $data['top_earner'] = Transaction::select('user_id',DB::raw('sum(amount) as sums'))
            // ->whereDate('created_at', Carbon::today())
            ->whereYear('created_at', $today)
            ->orderBy('amount','DESC')
            ->take(5)
			->where('trx_type', '+')
            ->with('user')
		    ->groupBy(['user_id'])
			->get();
        $data['user'] =  $user;
        // user Browsing, Country, Operating Log
        $userLoginData = UserLogin::where('created_at', '>=', Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $data['user_browser_counter'] = $userLoginData->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $data['user_os_counter'] = $userLoginData->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $data['user_login_counter'] = $userLoginData->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $data['yearLabels'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data['logins']      = UserLogin::where('user_id', $user->id)->orderBy('id', 'desc')->skip(1)->take(5)->get();
        $data['current_login']      = UserLogin::where('user_id', $user->id)->orderBy('id', 'desc')->take(1)->first();
        $data['last_login']      = UserLogin::where('user_id', $user->id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        $data['credit'] = Transaction::where('user_id', $user->id)->orderBy('id', 'desc')->whereTrxType('+')->take(10)->get();
        $data['debit'] = Transaction::where('user_id', $user->id)->orderBy('id', 'desc')->whereTrxType('-')->take(10)->get();
        $data['trx'] = Transaction::where('user_id', $user->id)->orderBy('id', 'desc')->take(5)->get();
        $data['cards'] = VirtualCard::whereUserId($user->id)->searchable(['pan'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view($this->activeTemplate . 'user.dashboard', $data, compact('pageTitle', 'widget'));
    }


    public function apikey(Request $request)
    {
        $user = auth()->user();
        if ($user->api_access != 1 || $user->vendor != 1) {
            $notify[] = ['error', 'You do not have API access'];
            return back()->withNotify($notify);
        }
        $key = $user->api_key;
        if($key == null)
        {
        $user->api_key  = 'sk_'.strToLower(getTrx().getTrx());
        $user->save();
        }
        $key = $user->api_key;
        $pageTitle = 'API Key';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.api_key', compact('pageTitle','key','user'));
    }

    public function apikeyGenerate(Request $request)
    {
        $user = auth()->user();
        if ($user->api_access != 1 || $user->vendor != 1) {
            $notify[] = ['error', 'You do not have API access'];
            return back()->withNotify($notify);
        }

        $user->api_key  = 'sk_'.strToLower(getTrx().getTrx());

        $user->save();
        $notify[] = ['success', 'API Key Generated Successfuly'];
        return back()->withNotify($notify);
    }

    public function apiWebhook(Request $request)
    {
        $user = auth()->user();
        $user->webhook_url  = $request->webhook;
        $user->redirect_url  = $request->callback;
        $user->save();
        $notify[] = ['success', 'Webhook & Callback URL Updated Successful'];
        return back()->withNotify($notify);
    }


    public function qrcode(Request $request)
    {
        $user = auth()->user();
        $pageTitle       = 'QR Code';
        $url = url('/').'/user/qr/'.encrypt($user->username);
        $payment = Transaction::whereUserId($user->id)->whereRemark('QR Payment')->whereTrxType('-')->sum('amount');
        $received = Transaction::whereUserId($user->id)->whereRemark('QR Payment')->whereTrxType('+')->sum('amount');
        $trx = Transaction::whereUserId($user->id)->whereRemark('QR Payment')->with('customer')->paginate(10);
        $today = Transaction::whereUserId($user->id)->whereRemark('QR Payment')->whereDay('created_at', now()->day)->whereTrxType('+')->sum('amount');

        return view($this->activeTemplate . 'user.qr.index', compact('today','trx','pageTitle','url','payment','received'));
    }
    public function kyc(Request $request)
    {
        $user = auth()->user();
        $pageTitle  = 'KYC Verification';
        return view($this->activeTemplate . 'user.kyc.index_new', compact('pageTitle','user','pageTitle'));
    }
    public function kycpost(Request $request)
    {
        $user = auth()->user();
        if($user->kyc_complete == 3)
        {
            $notify[] = ['error', 'Your KYC document is pending'];
            return back()->withNotify($notify)->withInput();
        }
        if($user->kyc_complete == 1)
        {
            $notify[] = ['error', 'Your KYC document is already approved'];
            return back()->withNotify($notify)->withInput();
        }
        $path = imagePath()['kyc']['path'].'/'.$user->username;
        if ($request->hasFile('front')) {
            $request->validate([
                'front'     => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            ]);
            try {

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
               $front = 'front_kyc_image.png';
               $image = Image::make($request->front)->save($path . '/'.$front);
               $idimage = url('/').'/'.$path.'/'.$front;
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload your front kyc id image'];
                return back()->withNotify($notify)->withInput();
            }
        }
        if ($request->hasFile('back')) {
            $request->validate([
                'back'     => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
            ]);
            try {
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
               $back = 'back_kyc_image.png';
               $image = Image::make($request->back)->save($path . '/'.$back);
               $idimage = url('/').'/'.$path.'/'.$back;
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload your back kyc id image'];
                return back()->withNotify($notify)->withInput();
            }
        }

        $user->kyc   = [
            'type' => $request->type,
            'front'   => @$front,
            'back'     => @$back,
            'date'     => @Carbon::now(),
        ];
        $user->kyc_complete = 3;
        $user->kyc_source = 'mobile';
        $user->save();


        // Send Mail
        notify($user, 'USER_MESSAGE', [
                'message' => 'You have successfuly submitted your KYC document for verification. Please wait while we verify your document',
                'subject' => 'KYC Submitted'
        ]);

        $notify[] = ['success', 'KYC document submitted successfuly'];
        return back()->withNotify($notify)->withInput();
    }

    public function kycbvnpost(Request $request)
    {
        $user = auth()->user();
        if($user->kyc_complete == 3)
        {
            $notify[] = ['error', 'Your KYC document is pending'];
            return back()->withNotify($notify)->withInput();
        }
        if($user->kyc_complete == 1)
        {
            $notify[] = ['error', 'Your KYC document is already approved'];
            return back()->withNotify($notify)->withInput();
        }

        $user->kyc   = [
            'type' => $request->type,
            'response'   => $request->response,
            'date'     => @Carbon::now(),
        ];
        $user->kyc_complete = 1;
        $user->kyc_source = 'mobile';
        $user->save();


        // Send Mail
        notify($user, 'USER_MESSAGE', [
                'message' => 'You have successfuly submitted your '. $request->type .' and it has been verified successfully',
            'subject' => $request->type . ' Verified'
        ]);

        $notify[] = ['success', 'KYC document submitted successfuly'];
        return response()->json(['ok'=>true,'status'=>'success','message'=> 'KYC document submitted successfuly'],200);
//        return back()->withNotify($notify)->withInput();
    }

    public function generatenuban()
    {
        $general = gs();
        if($general->nuban_provider == 'MONNIFY')
        {
          return $this->generatenubanMonnify();
        }
        if($general->nuban_provider == 'STROWALLET')
        {
          return $this->generatenubanstrowallet();
        }
        if($general->nuban_provider == 'PAYLONY')
        {
          return $this->generatenubanpaylony();
        }

    }

    public function generatenubanMonnify()
    {
        $user = auth()->user();
        if($user->nuban != null)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You already have an account number'],400);
        }

        $fee = env('DEDICATEDACCOUNTFEE');

        $token = monnifyToken();
        $url = "https://monnify.com/api/v2/bank-transfer/reserved-accounts";
        if(env('MONIFYSTATUS') == 'TEST')
        {
            $url = "https://sandbox.monnify.com/api/v2/bank-transfer/reserved-accounts";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "accountReference": "'.getTrx().'",
            "accountName": "'.$user->fullname.'",
            "currencyCode": "NGN",
            "contractCode": "'.env('MONNIFYCONTACTCODE').'",
            "customerEmail": "'.$user->email.'",
            "bvn": "'.env('MONNIFYBVN').'",
            "customerName": "'.$user->fullname.'",
            "getAllAvailableBanks": true
        }',
        CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$token.'',
        'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $reply = json_decode($response,true);
        if(!isset($reply['responseBody']))
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Sorry we cant process this request at the moment'],400);
        }
        if($reply['requestSuccessful'] != true)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Sorry we cant process this request at the moment'],400);
        }
        if($reply['requestSuccessful'] = true)
        {
        $user->nuban   = json_encode($reply['responseBody']['accounts']);
        $user->nuban_ref = $reply['responseBody']['accountReference'];
        $user->save();

        // Send Mail
        notify($user, 'USER_MESSAGE', [
            'message' => 'A dedicated account number has been generated for you successfuly. Please login to  your account to check details',
            'subject' => 'Account Number Generated'
        ]);

        return response()->json(['ok'=>true,'status'=>'success','message'=> 'Account number created successfuly'],400);
        }
    }

    public function generatenubanstrowallet()
    {
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $fee = env('DEDICATEDACCOUNTFEE');

        if($user->nuban != null)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You already have an account number'],400);
        }
        //$webhook = "https://webhook.site/516932b1-20b2-4936-9d11-50f34183b6e2";
        $webhook = url('/').'/api/strowallet/webhook';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://strowallet.com/api/virtual-bank/new-customer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "public_key": "'.env('STROPAYKEY').'",
            "email": "'.$user->email.'",
            "account_name": "'.$user->fullname.'",
            "phone": "'.$user->mobile.'",
            "webhook_url": "'.$webhook.'"
        }',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $reply = json_decode($response,true);
        if(!isset($reply['success']))
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Sorry we cant process this request at the moment'],400);
        }
        if($reply['success'] != true)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> @$reply['message']],400);
        }
        if($reply['success'] = true)
        {
        $user->nuban   = [
                'bank_name' => @$reply['bank_name'],
                'account_name' => @$reply['account_name'],
                'account_number'   => @$reply['account_number']
        ];

        $user->nuban_ref = @$reply['account_number'];
        $user->save();
        // Send Mail
        notify($user, 'USER_MESSAGE', [
            'message' => 'A dedicated account number has been generated for you successfuly. Please login to  your account to check details',
            'subject' => 'Account Number Generated'
        ]);
        return response()->json(['ok'=>true,'status'=>'success','message'=> @$reply['message']],200);
        }
    }


    public function generatenubanpaylony()
    {
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $fee = env('DEDICATEDACCOUNTFEE');

        if($user->nuban != null)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You already have an account number'],400);
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.paylony.com/api/v1/create_account',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "firstname":"'.$user->firstname.'",
            "lastname":"'.$user->lastname.'",
            "address":"'.@$user->address->address.'",
            "gender":"Male",
            "email": "'.$user->email.'",
            "phone": "'.$user->mobile.'",
            "dob":"2024-01-01",
            "bvn":"",
            "provider":"safehaven"
        }',
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer '.env('PAYLONYSK')
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $reply = json_decode($response,true);

        if(!isset($reply['success']))
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Sorry we cant process this request at the moment'],400);
        }
        if($reply['success'] != true)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> @$reply['message']],400);
        }

        if($reply['success'] = true && isset($reply['data']['reference']))
        {

        $user->nuban   = [
                'bank_name' => @$reply['data']['provider'],
                'account_name' => @$reply['data']['account_name'],
                'account_number'   => @$reply['data']['account_number']
        ];

        $user->nuban_ref = @$reply['data']['reference'];
        $user->save();
        // Send Mail
        notify($user, 'USER_MESSAGE', [
            'message' => 'A dedicated account number has been generated for you successfuly. Please login to  your account to check details',
            'subject' => 'Account Number Generated'
        ]);
        return response()->json(['ok'=>true,'status'=>'success','message'=> @$reply['message']],200);
        }
    }


    public function p2p(Request $request)
    {
        $general = gs();
        if ($general->p2p == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        $pageTitle       = 'P2P Transfer';
        return view($this->activeTemplate . 'user.p2p.create', compact('pageTitle'));
    }

    public function p2plog(Request $request)
    {
        $general = gs();
        if ($general->p2p == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        $pageTitle       = 'P2P History';
        $p2p = auth()->user()->p2p()->searchable(['trx'])->with('beneficiary')->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.p2p.history', compact('pageTitle', 'p2p'));
    }

    public function p2ppost(Request $request)
{
    $general = gs();

    if ($general->p2p == 0) {
        return back()->with('error', 'Feature is currently disabled');
    }

    $this->validate($request, [
        'pin' => 'required',
        'recipient' => 'required',
        'amount' => 'required|int|gt:0',
        'wallet' => 'required',
    ]);

    $user = auth()->user();
    $code = $request->pin;
     $int = (int)$request->amount;
            if($int < 2)
            {
               $user = auth()->user();
               $user->status = 0;
               $user->save();
               $notify[] = ['error', 'You are scammer'];
               return back()->withNotify($notify);
            }

    //$number = rand(1,10);
    //sleep($number);
    if (!Hash::check($code, $user->trx_password)) {
        return back()->with('error', 'Invalid Account Password!');
    }

    // Check beneficiary
    $beneficiary = User::whereUsername($request->recipient)->orWhere('email', $request->recipient)->first();
    if (!$beneficiary) {
        return back()->with('error', 'Invalid beneficiary details.');
    }

    if ($beneficiary->id == $user->id) {
        return back()->with('error', 'You cant transfer fund to the same beneficiary account.');
    }

    // Validate balances
    $walletType = $request->wallet == 'ref_wallet' ? 'ref_balance' : 'balance';

    if ($request->amount > $user->$walletType) {
        $notifyMessage = "You do not have sufficient balance in your $walletType for this transfer.";
        return back()->with('error', $notifyMessage);
    }

    // Transaction creation block
    $transaction = new P2p();
    $transaction->user_id = $user->id;
    $transaction->receiver = $beneficiary->id;
    $transaction->amount = $request->amount;
    $transaction->post_balance = $user->$walletType;
    $transaction->trx_type = $request->wallet;
    $transaction->details = 'P2P Transfer to ' . $beneficiary->username;
    $transaction->trx = getTrx();
    $transaction->remark = 'P2P';
    $transaction->save();

    $user->$walletType -= $request->amount;
    $user->save();

    // Create Debit Transaction
    $transaction = new Transaction();
    $transaction->user_id = $user->id;
    $transaction->amount = $request->amount;
    $transaction->post_balance = $user->$walletType;
    $transaction->trx_type = $user->wallet;
    $transaction->details = 'P2P Transfer';
    $transaction->trx = getTrx();
    $transaction->remark = 'P2P';
    $transaction->save();

    $beneficiary->$walletType += $request->amount;
    $beneficiary->save();

    // Create Credit Transaction
    $transaction = new Transaction();
    $transaction->user_id = $beneficiary->id;
    $transaction->amount = $request->amount;
    $transaction->post_balance = $beneficiary->$walletType;
    $transaction->trx_type = '+';
    $transaction->details = 'P2P Transfer';
    $transaction->trx = getTrx();
    $transaction->remark = 'P2P';
    $transaction->save();

    $notifyMessage = 'P2P fund transfer completed successfully';
    return back()->with('success', $notifyMessage);
}

    public function p2pposts(Request $request)
    {
        $general = gs();
        if ($general->p2p == 0) {
            $notify[] = ['error', 'Feature is currently disabled'];
            return back()->withNotify($notify);
        }
        $passwordValidation = Password::min(4);
        $general            = gs();

        $this->validate($request, [
            'pin' => 'required',
            'recipient' => 'required',
            'amount' => 'required|int|gt:0',
            'wallet' => 'required',
        ]);


        //return $request;
        $number = rand(1,10);
        sleep($number);

        $user = auth()->user();
        $code = $request->pin;
        if (Hash::check($code, $user->trx_password)) {
            $user = auth()->user();

            $amount = floor($request->amount);

            $beneficiary = User::whereUsername($request->recipient)->orWhere('email',$request->recipient)->first();
            if (!$beneficiary) {
                $notify[] = ['error', 'Invalid beneficiary details.'];
                return back()->withNotify($notify);
            }

            if ($beneficiary->id == $user->id) {
                $notify[] = ['error', 'You cant transfer fund to the same beneficiary account.'];
                return back()->withNotify($notify);
            }

            if ($amount > $user->ref_balance && $request->wallet == 'ref_wallet') {
                $notify[] = ['error', 'You do not have sufficient balance in your referral wallet for this transfer.'];
                return back()->withNotify($notify);
            }
            if ($amount > $user->balance && $request->wallet == 'act_wallet') {
                $notify[] = ['error', 'You do not have sufficient balance in your activity wallet for this transfer.'];
                return back()->withNotify($notify);
            }
            $transaction               = new P2p();
            $transaction->user_id      = $user->id;
            $transaction->receiver      = $beneficiary->id;
            $transaction->amount       = $amount;
            $transaction->post_balance = $user->ref_balance;
            $transaction->trx_type     = $request->wallet;
            $transaction->details      = 'P2P Transfer to '.$beneficiary->username;
            $transaction->trx          = getTrx();
            $transaction->remark       = 'P2P';
            $transaction->save();

            if($amount <= $user->ref_balance && $request->wallet == 'ref_wallet') {
            $user->ref_balance -= $amount;
            $user->save();
            //Create Debit Transaction
            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $amountamount;
            $transaction->post_balance = $user->ref_balance;
            $transaction->trx_type     = $user->wallet;
            $transaction->details      = 'P2P Transfer';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'P2P';
            $transaction->save();

            $beneficiary->ref_balance += $request->amount;
            $beneficiary->save();
            //Create Credit Transaction
            $transaction               = new Transaction();
            $transaction->user_id      = $beneficiary->id;
            $transaction->amount       = $request->amount;
            $transaction->post_balance = $beneficiary->ref_balance;
            $transaction->trx_type     = '+';
            $transaction->details      = 'P2P Transfer';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'P2P';
            $transaction->save();

            }
            if($request->amount <= $user->balance && $request->wallet == 'act_wallet') {
            $user->balance -= $request->amount;
            $user->save();

            //Create Debit Transaction
            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $request->amount;
            $transaction->post_balance = $user->balance;
            $transaction->trx_type     = '-';
            $transaction->details      = 'P2P Transfer';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'P2P';
            $transaction->save();

            $beneficiary->balance += $request->amount;
            $beneficiary->save();

            //Create Credit Transaction
            $transaction               = new Transaction();
            $transaction->user_id      = $beneficiary->id;
            $transaction->amount       = $request->amount;
            $transaction->post_balance = $beneficiary->balance;
            $transaction->trx_type     = '+';
            $transaction->details      = 'P2P Transfer';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'P2P';
            $transaction->save();
            }


            $notify[] = ['success', 'P2P fund transfer completed successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Invalid Account Password!'];
            return back()->withNotify($notify);
        }
    }




    public function login_earn(Request $request)
    {
        $general = gs();
        if($general->login_bonus == 1)
        {
            $user = auth()->user();
            if ($user->earn_at > Carbon::now() || $user->earn_at = null) {
                $notify[] = ['error', 'Sorry you can\'t earn daily passive income at the moment, come back tomorrow'];
                return back()->withNotify($notify);
            }
            $nextEarn = Carbon::now()->addDay(1);
            $user->balance += $general->login_earn;
            $user->earn_at = $nextEarn;
            $user->save();
            //LOG
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $general->login_earn;
            $transaction->post_balance = $user->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '+';
            $transaction->remark = 'Login Earn';
            $transaction->details = showAmount($general->login_earn) . ' ' . $general->cur_text . ' for login in to the system at' . Carbon::now();
            $transaction->trx =  getTrx();
            $transaction->save();

            $notify[] = ['success', 'Daily income earned successfuly. Please comeback tomorrow to earn more'];
            return back()->withNotify($notify);
        }
        $notify[] = ['error', 'Sorry you can\'t earn daily passive income at the moment'];
        return back()->withNotify($notify);

    }
    public function withdrawMoney()
    {
        $user = Auth::user();
        $withdrawMethod = WithdrawMethod::where('status',1)->where('affiliate','!=',1)->get();
        if($user->vendor == 1)
        {
            $withdrawMethod = WithdrawMethod::where('status',1)->where('affiliate',1)->get();
        }
        $pageTitle = 'Withdraw Money';
        return view($this->activeTemplate.'user.withdraw.methods', compact('pageTitle','withdrawMethod'));
    }

    public function withdrawStore(Request $request)
    {

        $this->validate($request, [
            'methodId' => 'required',
            'amount' => 'required|numeric',
        ]);
        $methodid = json_decode($request->methodId);
        $method = WithdrawMethod::where('id', $methodid->id)->where('status', 1)->firstOrFail();
        $today = date('l');
        $payoutdays = json_decode($method->payout_days);

         if(in_array($today, $payoutdays, true ) == false)
         {
            $notify[] = ['error', 'Sorry  you can\'t request for payout on '.$today];
            return back()->withNotify($notify);
         }

         $user = auth()->user();
         //Check Balance

        if ($request->amount > $user->balance) {
            $notify[] = ['error', 'You do not have sufficient balance in your wallet for this request.'];
            return back()->withNotify($notify);
        }

        if ($request->amount < $method->min_limit) {
            $notify[] = ['error', 'Your requested amount is smaller than minimum amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Your requested amount is larger than maximum amount.'];
            return back()->withNotify($notify);
        }



        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = $afterCharge * $method->rate;

        $withdraw = new Withdrawal();
        $withdraw->method_id = $method->id; // wallet method ID
        $withdraw->user_id = $user->id;
        $withdraw->amount = $request->amount;
        $withdraw->wallet = 'act_wallet';
        $withdraw->currency = $method->currency;
        $withdraw->rate = $method->rate;
        $withdraw->charge = $charge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->after_charge = $afterCharge;
        $withdraw->trx = getTrx();
        $withdraw->save();
        session()->put('wtrx', $withdraw->trx);
        return redirect()->route('user.withdraw.preview');
    }

    public function withdrawPreview()
    {
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();
        $pageTitle = 'Withdraw Preview';
        return view($this->activeTemplate . 'user.withdraw.preview', compact('pageTitle','withdraw'));
    }



    public function withdrawSubmit(Request $request)
    {
        $general = gs();
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->orderBy('id','desc')->firstOrFail();

        $rules = [];
        $inputField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($withdraw->method->user_data as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg','jpeg','png']));
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }

        $this->validate($request, $rules);

        $user = auth()->user();

        if ($withdraw->amount > $user->ref_balance && $withdraw->wallet == 'ref_wallet') {
            $notify[] = ['error', 'You do not have sufficient balance in your referral wallet for this transfer.'];
            return back()->withNotify($notify);
        }
        if ($withdraw->amount > $user->balance && $withdraw->wallet == 'act_wallet') {
            $notify[] = ['error', 'You do not have sufficient balance in your activity wallet for this transfer.'];
            return back()->withNotify($notify);
        }

        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['withdraw']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($collection as $k => $v) {
                foreach ($withdraw->method->user_data as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory.'/'.uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $withdraw['withdraw_information'] = $reqField;
        } else {
            $withdraw['withdraw_information'] = null;
        }


        $withdraw->status = 2;
        $withdraw->save();
        if ($withdraw->wallet == 'ref_wallet') {
            $user->ref_balance  -=  $withdraw->amount;
        }
        if ($withdraw->wallet == 'act_wallet') {
            $user->balance  -=  $withdraw->amount;
        }
        $user->save();



        $transaction = new Transaction();
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = $withdraw->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = $withdraw->charge;
        $transaction->trx_type = '-';
        $transaction->remark = 'Payout';
        $transaction->details = showAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
        $transaction->trx =  $withdraw->trx;
        $transaction->save();


        notify($user, 'WITHDRAW_REQUEST', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => showAmount($withdraw->final_amount),
            'amount' => showAmount($withdraw->amount),
            'charge' => showAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => showAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'post_balance' => showAmount($user->balance),
            'delay' => $withdraw->method->delay
        ]);

         //Start Send Mail
         $general = GeneralSetting::first();
         $user = [
                'username' => 'Admin',
                'email'    => $general->email_from,
                'fullname' => 'Admin',
            ];
            notify($user, 'DEFAULT', [
                'subject' => 'Pending Withdrawal',
                'message' => 'There is a pending withdrawal of '.showAmount($withdraw->amount).$general->cur_text.' with transaction number '.$withdraw->trx.'. Please login to admin dashboard to complete request.',
            ], ['email'], "bc",false);
        // End Send Email

        $notify[] = ['success', 'Withdraw request sent successfully'];
        return redirect()->route('user.withdraw.history')->withNotify($notify);
    }

    public function withdrawLog()
    {
        $pageTitle = "Withdraw Log";
        $withdraws = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->orderBy('id','desc')->paginate(getPaginate());
        $emptyMessage = "No Data Found!";
        return view($this->activeTemplate.'user.withdraw.log', compact('pageTitle','withdraws', 'emptyMessage'));
    }



    public function giftcardHistory(Request $request)
    {
        $pageTitle       = 'Giftcard History';
        $user = auth()->user();
        // $log = auth()->user()->orders()->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        $log = Order::whereUserId($user->id)->searchable(['deposit_code'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view($this->activeTemplate . 'user.giftcard.giftcard_history', compact('pageTitle', 'log'));
    }


    public function giftcardDetails($id)
    {
        $pageTitle       = 'Giftcard Details';
        $user = auth()->user();
        $card = Order::whereUserId($user->id)->whereTransactionId(decrypt($id))->firstOrFail();
        return view($this->activeTemplate . 'user.giftcard.giftcard_details', compact('pageTitle', 'card'));
    }

    public function giftcardRedeemCode($id)
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
        $user = auth()->user();
        $card = Order::whereUserId($user->id)->whereTransactionId($id)->firstOrFail();

        $token = getToken();
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $baseurl.'/orders/transactions/'.$id.'/cards',
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
        $card->details = $giftcards;
        $card->save();
        return response()->json([
            'code'=>200,
            'status'=>'ok',
            'data'=> $giftcards,
        ],200);
    }


    public function depositHistory(Request $request)
    {
        $pageTitle       = 'Deposit History';
        $deposits = auth()->user()->deposits()->searchable(['trx'])->with(['gateway'])->whereType('deposit')->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function show2faForm()
    {
        $general   = gs();
        $ga        = new GoogleAuthenticator();
        $user      = auth()->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->site_name, $secret);
        $pageTitle = '2FA Setting';
        return view($this->activeTemplate . 'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key'  => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);

        if ($response) {
            $user->tsc = $request->key;
            $user->ts  = Status::ENABLE;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user     = auth()->user();
        $response = verifyG2fa($user, $request->code);

        if ($response) {
            $user->tsc = null;
            $user->ts  = Status::DISABLE;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }

        return back()->withNotify($notify);
    }

    public function transactions(Request $request)
    {
        $pageTitle    = 'Transactions';
        $remarks      = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('created_at', 'desc')->paginate(getPaginate());

        if(isset($request->start))
        {
                $headers = array(
                    'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
                    'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                    'Content-Disposition' => 'attachment; filename=abc.csv',
                    'Expires' => '0',
                    'Pragma' => 'public',
                );
                $filename =  auth()->user()->username.".csv";
                $handle = fopen($filename, 'w');
                fputcsv($handle, [
                    "#",
                    "Transaction Ref",
                    "Transaction Type",
                    "Transaction Amount",
                    "Transaction Charge",
                    "Available Balance",
                    "Transaction Details",
                    "Transaction Date"
                ]);

                $startDate = $request->start;
                $endDate = $request->end;
                $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('created_at', 'desc')->paginate(getPaginate());
                 DB::table("transactions")->whereBetween('created_at', [$startDate, $endDate])->orderBy('id','DESC')->chunk(100, function ($data) use ($handle) {
                    foreach ($data as $row) {
                        $type = 'CREDIT';
                        if($row->trx_type == '-')
                        {
                            $type = 'DEBIT';
                        }
                        // Add a new row with data
                        fputcsv($handle, [
                            $row->id,
                            $row->trx,
                            $type,
                            $row->amount,
                            $row->charge,
                            $row->post_balance,
                            $row->details,
                            $row->created_at
                        ]);
                    }
                });
                fclose($handle);
                Response::download($filename, auth()->user()->username.".csv", $headers);

        }
        return view($this->activeTemplate . 'user.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }

    public function Postransactions(Request $request)
    {
        $pageTitle    = 'POS Transactions';
        $remarks      = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id())->where('remark', 'POS')->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('created_at', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }

    public function attachmentDownload($fileHash)
    {
        $filePath  = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general   = gs();
        $title     = slug($general->site_name) . '- attachments.' . $extension;
        $mimetype  = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function userData()
    {
        $user = auth()->user();

        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }

        $pageTitle = 'Update User Details';
        return view($this->activeTemplate . 'user.user_data', compact('pageTitle', 'user'));
    }

    public function userDataSubmit(Request $request)
    {
        $user = auth()->user();

        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }

        $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'image'     => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],

        ]);
        if ($request->hasFile('image')) {
            try {
                $old         = $user->image;
                $user->image = fileUploader($request->image, getFilePath('userProfile'), getFileSize('userProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
            //GD OR FILE INFO NOT AVAILABLE?
            /*  $path = getFilePath('userProfile');

                $imageName = time().'.'.$request->image->extension();

                // Public Folder
                $request->image->move($path, $imageName);
                $user->image = $imageName;
            */
        }
        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->address   = [
            'country' => @$user->address->country,
            'address' => $request->address,
            'state'   => $request->state,
            'zip'     => $request->zip,
            'city'    => $request->city,
        ];
        $user->profile_complete = 1;
        $user->save();

        $notify[] = ['success', 'Registration process completed successfully'];
        return to_route('user.home')->withNotify($notify);
    }

    public function trxpass(Request $request)
    {
        $user = auth()->user();
        if($user->trx_password == null)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You have not setup your transaction password yet. Try setting up your transaction password from account settings page!'],400);
        }
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $password = $input['password'];
        if (Hash::check($password, $user->trx_password)) {
            return response()->json(['ok'=>true,'status'=>'success','message'=>'The password Correct!'],200);
        } else {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The transaction password doesn\'t match!'],400);
        }

    }


}
