<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\NotificationLog;
use App\Models\Order;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use DB;
class ManageUsersController extends Controller
{
 

    public function kycpending()
    {
        $pageTitle = 'Pending KYC';
        $users     = User::whereKycComplete(3)->paginate(10);
        return view('admin.users.kyc', compact('pageTitle', 'users'));
    }
    public function kycapproved()
    {
        $pageTitle = 'Approved KYC';
        $users     = User::whereKycComplete(1)->paginate(10);
        return view('admin.users.kyc', compact('pageTitle', 'users'));
    }
    public function kycapprove($id)
    {
        $user      = User::findOrFail($id);
        $user->kyc_complete = 1;
        $user->save();
        // Send Mail
        notify($user, 'USER_MESSAGE', [
            'message' => 'Your KYC document has been verified successfuly',
            'subject' => 'KYC Document Verified'
        ]);
        $notify[] = ['success', $user->username . ' kyc approved successfuly.'];
        return back()->withNotify($notify);
    }
    public function kycreject($id)
    {
        $user      = User::findOrFail($id);
        $user->kyc_complete = 2;
        $user->save();

        // Send Mail
        notify($user, 'USER_MESSAGE', [
            'message' => 'Your KYC document has been rejected. Please review document and try to resubmit',
            'subject' => 'KYC Document Rejected'
        ]);
        $notify[] = ['success', $user->username . ' kyc rejected successfuly.'];
        return back()->withNotify($notify);
    }

    public function generatenuban(Request $request, $id)
    {
        $general = gs();
        if($general->nuban_provider == 'MONNIFY')
        {
          return $this->generatenubanMonnify($request, $id); 
        }
        if($general->nuban_provider == 'STROWALLET')
        {
          return $this->generatenubanstrowallet($request, $id); 
        }
        if($general->nuban_provider == 'PAYLONY')
        {
          return $this->generatenubanpaylony($request, $id); 
        }
        
    }

    public function generatenubanpaylony($request, $id)
    {
        $user    = User::findOrFail($id);
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $fee = env('DEDICATEDACCOUNTFEE');
        
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
            $notify[] = ['error', 'Error Setting up account'];
            return back()->withNotify($notify);
        }
        if($reply['success'] != true)
        { 
            $notify[] = ['error', @json_encode($reply['message'])];
            return back()->withNotify($notify);
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
        $notify[] = ['success', @json_encode($reply['message'])];
        return back()->withNotify($notify);        }
    }


    public function generatenubanMonnify($request, $id)
    {
        $user    = User::findOrFail($id);
        
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
            $notify[] = ['error', 'Error setting up nuban account!'];
            return back()->withNotify($notify);
        }
        if($reply['requestSuccessful'] != true)
        { 
            $notify[] = ['error', 'Error setting up nuban account!'];
            return back()->withNotify($notify);
        }
        if($reply['requestSuccessful'] = true)
        {  
        $user->nuban   = json_encode($reply['responseBody']['accounts']);
        $user->nuban_ref = $reply['responseBody']['accountReference'];
        $user->save();  

        $notify[] = ['success', 'Account number created!'];
        return back()->withNotify($notify);
    
        }
    }

    
    public function generatenubanstrowallet($request, $id)
    {
        $user    = User::findOrFail($id);
        // $webhook = "https://webhook.site/fe9418b0-a382-4d80-87f9-1d699bd3a4ae";
        $webhook = url('/').'/api/nuban/webhook';
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
            $notify[] = ['error', 'Error setting up nuban account!'];
            return back()->withNotify($notify);
        }
        if($reply['success'] != true)
        { 
            $notify[] = ['error', @json_encode($reply['message'])];
            return back()->withNotify($notify);
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
        
        $notify[] = ['success', @$reply['message']];
        return back()->withNotify($notify);
        }
        $notify[] = ['error', 'Error setting up nuban account!'];
        return back()->withNotify($notify);
    }
    

    public function allUsers()
    {
        $pageTitle = 'All Users';
        $users     = $this->userData();
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function activeUsers()
    {
        $pageTitle = 'Active Users';
        $users     = $this->userData('active');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function bannedUsers()
    {
        $pageTitle = 'Banned Users';
        $users     = $this->userData('banned');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function activeVendor()
    {
        $pageTitle = 'Email Unverified Users';
        $users     = User::whereVendor(1)->paginate(10);
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailUnverifiedUsers()
    {
        $pageTitle = 'Email Unverified Users';
        $users     = $this->userData('emailUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function emailVerifiedUsers()
    {
        $pageTitle = 'Email Verified Users';
        $users     = $this->userData('emailVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function mobileUnverifiedUsers()
    {
        $pageTitle = 'Mobile Unverified Users';
        $users     = $this->userData('mobileUnverified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function mobileVerifiedUsers()
    {
        $pageTitle = 'Mobile Verified Users';
        $users     = $this->userData('mobileVerified');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    public function usersWithBalance()
    {
        $pageTitle = 'Users with Balance';
        $users     = $this->userData('withBalance');
        return view('admin.users.list', compact('pageTitle', 'users'));
    }

    protected function vendorData($scope = null)
    {

        if ($scope) {
            $users = User::$scope();
        } else {
            $users = User::query();
        }

        return $users->searchable(['username', 'email'])->whereVendor(1)->orderBy('id', 'desc')->paginate(getPaginate());
    }


    protected function userData($scope = null)
    {

        if ($scope) {
            $users = User::$scope();
        } else {
            $users = User::query();
        }

        return $users->searchable(['username', 'email'])->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function detail($id)
    {
        $user      = User::findOrFail($id);
        $pageTitle = 'User Detail - ' . $user->username;
        $totalSpent                 = Transaction::where('user_id', $user->id)->whereTrxType('-')->sum('amount');
        $totalDeposit               = Deposit::where('user_id', $user->id)->where('status', Status::PAYMENT_SUCCESS)->sum('amount');
        $totalTransaction           = Transaction::where('user_id', $user->id)->count();
        $widget['airtime']          = Order::where('user_id', $user->id)->whereType('airtime')->searchable(['trx'])->orderBy('id', 'desc')->sum('price');
        $widget['internet']          = Order::where('user_id', $user->id)->whereType('internet')->searchable(['trx'])->orderBy('id', 'desc')->sum('price');
        $widget['cabletv']          = Order::where('user_id', $user->id)->whereType('cabletv')->searchable(['trx'])->orderBy('id', 'desc')->sum('price');
        $widget['insurance']          = Order::where('user_id', $user->id)->whereType('insurance')->searchable(['trx'])->orderBy('id', 'desc')->sum('price');
        $widget['utility']          = Order::where('user_id', $user->id)->whereType('utility')->searchable(['trx'])->orderBy('id', 'desc')->sum('price');
        $countries                  = json_decode(file_get_contents(resource_path('mobileapp/partials/country.json')));


		$last30 = date('Y-m-d', strtotime('-30 days'));
		$last7 = date('Y-m-d', strtotime('-7 days'));
		$today = today();
		$dayCount = date('t', strtotime($today));

        $deposits = Deposit::select('created_at')
            ->where('user_id', $user->id)
            ->where('status', 1)
			->whereYear('created_at', $today)
			->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'method_code'])
			->selectRaw("SUM(amount) as Deposit")
			->get()
			->groupBy([function ($query) {
				return $query->created_at->format('F');
			}, 'method_code']);
            
		$payouts = Withdrawal::select('created_at')
            ->where('user_id', $user->id)
			->whereYear('created_at', $today)
			->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'method_id'])
			->selectRaw("SUM(amount) as Payout")
			->get()
			->groupBy([function ($query) {
				return $query->created_at->format('F');
			}, 'method_code']);

		$data['yearLabels'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

		$yearDeposit = [];
		$yearPayout = [];

		foreach ($data['yearLabels'] as $yearLabel) {
			$currentYearDeposit = 0;
			$currentYearPayout = 0;

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

			$yearDeposit[] = round($currentYearDeposit, 2);
			$yearPayout[] = round($currentYearPayout, 2);
		}

		$data['yearDeposit'] = $yearDeposit;
		$data['yearPayout'] = $yearPayout;
        $data['yearLabels'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        return view('admin.users.detail', $data, compact('pageTitle', 'user', 'totalDeposit', 'totalSpent', 'totalTransaction', 'countries', 'widget'));
    }

    public function update(Request $request, $id)
    {
        $user         = User::findOrFail($id);
        $countryData  = json_decode(file_get_contents(resource_path('mobileapp/partials/country.json')));
        $countryArray = (array) $countryData;
        $countries    = implode(',', array_keys($countryArray));

        $countryCode = $request->country;
        $country     = $countryData->$countryCode->country;
        $dialCode    = $countryData->$countryCode->dial_code;

        $request->validate([
            'firstname' => 'required|string|max:40',
            'lastname'  => 'required|string|max:40',
            'email'     => 'required|email|string|max:40|unique:users,email,' . $user->id,
            'mobile'    => 'required|string|max:40|unique:users,mobile,' . $user->id,
            'country'   => 'required|in:' . $countries,
        ]);
        $user->mobile       = $dialCode . $request->mobile;
        $user->country_code = $countryCode;
        $user->firstname    = $request->firstname;
        $user->lastname     = $request->lastname;
        $user->email        = $request->email;
        $user->address      = [
            'address' => $request->address,
            'city'    => $request->city,
            'state'   => $request->state,
            'zip'     => $request->zip,
            'country' => @$country,
        ]; 

        if(isset($request->terminal_pin))
        {
            $user->terminal_pin = bcrypt($request->terminal_pin);
        }

        $user->vendor = $request->vendor ? Status::YES : Status::NO;
        $user->api_access = $request->api_access ? Status::YES : Status::NO;
        $user->ev = $request->ev ? Status::YES : Status::NO;
        $user->sv = $request->sv ? Status::YES : Status::NO;
        $user->ts = $request->ts ? Status::YES : Status::NO;
        $user->save();

        $notify[] = ['success', 'User details updated successfully'];
        return back()->withNotify($notify);
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'act'    => 'required|in:add,sub',
            'remark' => 'required|string|max:255',
        ]);

        $user    = User::findOrFail($id);
        $amount  = $request->amount;
        $general = gs();
        $trx     = getTrx();

        $transaction = new Transaction();

        if ($request->act == 'add') {
            $user->balance += $amount;

            $transaction->trx_type = '+';
            $transaction->remark   = 'balance_add';

            $notifyTemplate = 'BAL_ADD';

            $notify[] = ['success', $general->cur_sym . $amount . ' added successfully'];
        } else {

            if ($amount > $user->balance) {
                $notify[] = ['error', $user->username . ' doesn\'t have sufficient balance.'];
                return back()->withNotify($notify);
            }

            $user->balance -= $amount;

            $transaction->trx_type = '-';
            $transaction->remark   = 'balance_subtract';

            $notifyTemplate = 'BAL_SUB';
            $notify[]       = ['success', $general->cur_sym . $amount . ' subtracted successfully'];
        }

        $user->save();

        $transaction->user_id      = $user->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx          = $trx;
        $transaction->details      = $request->remark;
        $transaction->save();

        notify($user, $notifyTemplate, [
            'trx'          => $trx,
            'amount'       => showAmount($amount),
            'remark'       => $request->remark,
            'post_balance' => showAmount($user->balance),
        ]);

        return back()->withNotify($notify);
    }

    public function login($id)
    {
        Auth::loginUsingId($id);
        return to_route('user.home');
    }

    public function status(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->status == Status::USER_ACTIVE) {
            $request->validate([
                'reason' => 'required|string|max:255',
            ]);
            $user->status     = Status::USER_BAN;
            $user->ban_reason = $request->reason;
            $notify[]         = ['success', 'User banned successfully'];
        } else {
            $user->status     = Status::USER_ACTIVE;
            $user->ban_reason = null;
            $notify[]         = ['success', 'User unbanned successfully'];
        }

        $user->save();
        return back()->withNotify($notify);
    }

    public function showNotificationSingleForm($id)
    {
        $user    = User::findOrFail($id);
        $general = gs();

        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.users.detail', $user->id)->withNotify($notify);
        }

        $pageTitle = 'Send Notification to ' . $user->username;
        return view('admin.users.notification_single', compact('pageTitle', 'user'));
    }

    public function sendNotificationSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
            'subject' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        notify($user, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $notify[] = ['success', 'Notification sent successfully'];
        return back()->withNotify($notify);
    }

    public function showNotificationAllForm()
    {
        $general = gs();

        if (!$general->en && !$general->sn) {
            $notify[] = ['warning', 'Notification options are disabled currently'];
            return to_route('admin.dashboard')->withNotify($notify);
        }

        $users     = User::active()->count();
        $pageTitle = 'Notification to Verified Users';
        return view('admin.users.notification_all', compact('pageTitle', 'users'));
    }

    public function sendNotificationAll(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'subject' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $user = User::active()->skip($request->skip)->first();

        if (!$user) {
            return response()->json([
                'error' => 'User not found',
                'total_sent' => 0,
            ]);
        }

        notify($user, 'DEFAULT', [
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return response()->json([
            'success'    => 'message sent',
            'total_sent' => $request->skip + 1,
        ]);
    }

    public function notificationLog($id)
    {
        $user      = User::findOrFail($id);
        $pageTitle = 'Notifications Sent to ' . $user->username;
        $logs      = NotificationLog::where('user_id', $id)->with('user')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.reports.notification_history', compact('pageTitle', 'logs', 'user'));
    }
}