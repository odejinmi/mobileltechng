<?php

namespace App\Http\Controllers\User;

use App\Models\ChargesLimit;
use App\Models\Cryptocurrency;
use App\Models\Cryptowallet;
use App\Models\Cryptotrx;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankTransferRequest;
use App\Services\StrowalletService;

class BankTransferController extends Controller
{

	protected $strowalletService;
    public function __construct(StrowalletService $strowalletService)
    {
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
        $this->strowalletService = $strowalletService;
    }

	public function index()
	{
            $pageTitle = 'Bank Transfer';
			return view($this->activeTemplate.'user.bank.index', compact('pageTitle'));
	}

	public function start()
    {
        try {
            $banks = $this->strowalletService->getBanks();
            Log::info('Bank list:', $banks);
            $pageTitle = 'Bank Transfer';
            return view($this->activeTemplate.'user.bank.strowallet', compact('pageTitle', 'banks'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch bank list: ' . $e->getMessage());
            $notify[] = ['error', 'Error fetching bank list. Please try again later.'];
            return back()->withNotify($notify);
        }
    }


    public function validatebankstrowallet(Request $request)
    {
        try {
            Log::info('validatebankstrowallet request:', $request->all());

            $validated = $request->validate([
                'bankcode' => 'required|string|size:3',
                'account' => 'required|string|digits:10'
            ]);

            $response = $this->strowalletService->validateAccount(
                $validated['bankcode'],
                $validated['account']
            );

            return response()->json([
                'ok' => true,
                'message' => $response['account_name'],
                'sessionId' => $response['session_id'] ?? null,
                'status' => 'success'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessages = collect($e->errors())->flatten()->implode(' ');
            
            Log::error('Validation error in validatebankstrowallet:', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);

            return response()->json([
                'ok' => false,
                'message' => 'Validation failed: ' . $errorMessages,
                'status' => 'error'
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error in validatebankstrowallet:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'ok' => false,
                'message' => 'Failed to validate account: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

	 public function bankTransferStrowallet(BankTransferRequest $request)
    {
        $user = Auth::user();

        // Verify transaction PIN
        if (!Hash::check($request->pin, $user->trx_password)) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Invalid transaction PIN'
            ], 400);
        }

        // Check daily limit
        if (!$this->checkDailyLimit($user, $request->amount)) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Daily transfer limit exceeded'
            ], 400);
        }

        // Calculate total amount with fee
        $fee = env('TRANSFERFEE', 0);
        $total = $request->amount + $fee;

        // Check sufficient balance
        if ($total > $user->balance) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Insufficient balance'
            ], 400);
        }

        try {
            return DB::transaction(function () use ($user, $request, $total, $fee) {
                // Deduct balance
                $user->decrement('balance', $total);

                // Process transfer
                $response = $this->strowalletService->transferFunds(
                    $request->bankcode,
                    $request->account,
                    $request->amount,
                    $request->narration,
                    $request->sessionid
                );

                // Log transaction
                $transaction = $this->logTransaction(
                    $user,
                    $request->amount,
                    $fee,
                    $request->narration,
                    $request->bankcode,
                    $request->account,
                    $request->account_name
                );

                return response()->json([
                    'ok' => true,
                    'status' => 'success',
                    'message' => 'Transaction successful',
                    'transaction' => $transaction
                ]);

            });
        } catch (\Exception $e) {
            Log::error('Bank transfer failed: ' . $e->getMessage());
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Transaction failed. Please try again.'
            ], 500);
        }
    }


	public function validatebankmonnify()
	{
        $token = monnifyToken();
		$user = auth()->user();
		$json = file_get_contents('php://input');
		$input = json_decode($json, true);
		$bank = $input['bankcode'];
		$account = $input['account'];
		try{
			$url = "https://monnify.com/api/v1/disbursements/account/validate?accountNumber=".$account."&bankCode=".$bank;
			if(env('MONIFYSTATUS') == 'TEST')
			{
			$url = "https://sandbox.monnify.com/api/v1/disbursements/account/validate?accountNumber=".$account."&bankCode=".$bank;
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
			CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token.'',
                'Content-Type: application/json'
                ),
			));
			$response = curl_exec($curl);
			$reply = json_decode($response,true);
			curl_close($curl);
			// return $response;
			if(!isset($reply['responseBody']['accountName']))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error!!!! ,'.@$reply['responseMessage']],400);
			}
			if($reply['responseBody']['accountName'])
			{
				return response()->json(['ok'=>true,'status'=>'success','message'=> $reply['responseBody']['accountName']],200);
			}
		}
		catch (\Exception $e) {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

	}

    public function banktransfernubanMonnify()
    {
        $user = auth()->user();
		$json = file_get_contents('php://input');
		try{
        	$input = json_decode($json, true);
			$bankcode = $input['bankcode'];
			$account = $input['account'];
			$amount = $input['amount'];
			$wallet = $input['wallet'];
			$narration = $input['narration'];
			$account_name = $input['account_name'];
			$bank_name = $input['bank_name'];
			$pin = $input['pin'];
			if (!Hash::check($pin, $user->trx_password))
			{
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Invalid transaction PIN'],400);
			}
			//$fee = ($amount / 100) * env('TRANSFERFEE');
			$fee = env('TRANSFERFEE');

			$total = $amount + $fee;
			if ($total > $user->balance && $wallet == 'main') {
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your main wallet for this transfer.'],400);
			}
			if ($total > $user->ref_balance && $wallet == 'ref') {
				return response()->json(['ok'=>false,'status'=>'danger','message'=> 'You do not have sufficient balance in your referral wallet for this transfer.'],400);
			}

        $code = getTrx();
        $token = monnifyToken();
        $url = "https://monnify.com/api/v2/disbursements/single";
        if(env('MONIFYSTATUS') == 'TEST')
        {
            $url = "https://sandbox.monnify.com/api/v2/disbursements/single";
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
            "amount": "'.$amount.'",
            "reference": "'.$code.'",
            "narration": "'.$narration.'",
            "destinationBankCode": "'.$bankcode.'",
            "destinationAccountNumber": "'.$account.'",
            "currency": "NGN",
            "sourceAccountNumber": "'.env('MONIFYSOURCEACCOUNT').'"
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
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error '.@$reply['responseMessage']],400);
        }
        if($reply['requestSuccessful'] !== true)
        {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Error '.@$reply['responseMessage']],400);
        }
        if($reply['requestSuccessful'] === true)
        {

            if($wallet == 'main')
				{
					$user->balance -= $total;
					$user->save();
					$balance = $user->balance;
				}
				if($wallet == 'ref')
				{
					$user->ref_balance -= $total;
					$user->save();
					$balance = $user->ref_balance;
				}

				$transaction               = new Transaction();
				$transaction->user_id      = $user->id;
				$transaction->amount       = $amount;
				$transaction->charge       = $fee;
				$transaction->post_balance = $balance;
				$transaction->trx_type     = '-';
				$transaction->details      = $narration;
				$transaction->val_1        = [
					'bank' => $bank_name,
					'account_name'   => $account_name,
					'account_number'     => $account,
				];
				$transaction->trx          = $code;
				$transaction->remark       = 'Bank Transfer';
				$transaction->save();
				return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Successful','content'=> json_encode($reply)],200);
        }
	}
		catch (\Exception $e) {
			return response()->json(['ok'=>false,'status'=>'danger','message'=> $e->getMessage()],400);
		}

    }

	public function history(Request $request)
    {
        $pageTitle    = 'Bank Transfer Log';
        $remarks      = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->whereRemark('Bank Transfer')->orderBy('created_at', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bank.history', compact('pageTitle', 'transactions', 'remarks'));
    }

	private function checkDailyLimit($user, $amount)
    {
        $today = now()->startOfDay();
        $tomorrow = now()->addDay()->startOfDay();

        $dailyTotal = Transaction::where('user_id', $user->id)
            ->where('remark', 'Bank Transfer')
            ->whereBetween('created_at', [$today, $tomorrow])
            ->sum('amount');

        return ($dailyTotal + $amount) <= 200000; // 200,000 daily limit
    }

    private function logTransaction($user, $amount, $fee, $narration, $bankCode, $accountNumber, $accountName)
    {
        return Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'charge' => $fee,
            'post_balance' => $user->balance - $amount - $fee,
            'trx_type' => '-',
            'details' => $narration,
            'trx' => getTrx(),
            'val_1' => [
                'bank' => $bankCode,
                'account_name' => $accountName,
                'account_number' => $accountNumber,
            ],
            'remark' => 'Bank Transfer'
        ]);
    }


}
