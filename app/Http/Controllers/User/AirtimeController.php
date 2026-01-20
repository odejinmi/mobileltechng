<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Order;
use App\Models\AirtimeCash;
use App\Models\GeneralSetting;
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Transaction;
use App\Services\BonusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
class AirtimeController extends Controller
{


    protected $maxAttempts = 5; // Maximum number of attempts
    protected $decayMinutes = 1; // Time to wait before retrying
    public $activeTemplate;

    public function __construct()
    {
        $this->middleware('airtime.status');
        $this->middleware('kyc.status');
        $this->middleware('auth');
        $this->middleware('verified');
//        $this->middleware('password.confirm')->only('buy_airtime_post', 'buy_airtime_post_local');
        $this->activeTemplate = activeTemplate();
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->ip());
    }

    /**
     * Get list of supported countries from cache or API
     *
     * @return array
     */
    public function getCountries()
    {
        // Cache the response for 1 day to reduce API calls
        return Cache::remember('airtime_countries', now()->addDay(), function () {
            try {
                $baseUrl = config('services.reloadly.mode') === 'test'
                    ? 'https://topups-sandbox.reloadly.com/countries'
                    : 'https://topups.reloadly.com/countries';

                $response = Http::withHeaders([
                    'Accept' => 'application/com.reloadly.topups-v1+json',
                    'Authorization' => 'Bearer ' . getToken('topups')
                ])
                ->timeout(15)
                ->retry(3, 100)
                ->get($baseUrl);

                return $response->json() ?? [];

            } catch (\Exception $e) {
                Log::error('Failed to fetch countries: ' . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get operators for a specific country
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function airtime_operators(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isocode' => 'required|string|size:2|alpha',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid country code',
                'errors' => $validator->errors()
            ], 422);
        }

        // Rate limiting
        $key = 'airtime_operators:' . $this->throttleKey($request);
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'status' => 'error',
                'message' => 'Too many attempts. Please try again in ' . $seconds . ' seconds.'
            ], 429);
        }
        RateLimiter::hit($key, $this->decayMinutes * 60);

        try {
            $baseUrl = config('services.reloadly.mode') === 'test'
                ? 'https://topups-sandbox.reloadly.com'
                : 'https://topups.reloadly.com';

            $response = Http::withHeaders([
                'Accept' => 'application/com.reloadly.topups-v1+json',
                'Authorization' => 'Bearer ' . getToken('topups')
            ])
            ->timeout(15)
            ->get($baseUrl . "/operators/countries/" . urlencode($request->isocode), [
                'includeData' => 'false',
                'includeBundles' => 'false'
            ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch operators: ' . $response->body());
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Operators fetched successfully',
                'content' => [
                    'code' => '00',
                    'response' => $response->json()
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching operators: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch operators. Please try again later.'
            ], 500);
        }

    }


    /**
     * Get operator details by ID
     *
     * @param  string  $id
     * @return array
     */
    protected function operatorsdetails($id)
    {
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException('Invalid operator ID');
        }

        $cacheKey = 'operator_details_' . $id;

        return Cache::remember($cacheKey, now()->addHour(), function () use ($id) {
            try {
                $baseUrl = config('services.reloadly.mode') === 'test'
                    ? 'https://topups-sandbox.reloadly.com'
                    : 'https://topups.reloadly.com';

                $response = Http::withHeaders([
                    'Accept' => 'application/com.reloadly.topups-v1+json',
                    'Authorization' => 'Bearer ' . getToken('topups')
                ])
                ->timeout(10)
                ->get($baseUrl . "/operators/" . urlencode($id));

                if (!$response->successful()) {
                    throw new \Exception('Failed to fetch operator details: ' . $response->body());
                }

                return $response->json();

            } catch (\Exception $e) {
                Log::error('Error fetching operator details: ' . $e->getMessage());
                throw new \Exception('Failed to retrieve operator information');
            }
        });
    }

    /**
     * Display airtime transaction history
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function airtime(Request $request)
    {
        $pageTitle = 'Airtime Transactions';
        $user = auth()->user();

        // Secure query with proper validation
        $query = Order::where('user_id', $user->id)
            ->where('type', 'airtime')
            ->orderBy('id', 'desc');

        // Add search functionality with proper escaping
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('trx', 'like', '%' . $search . '%')
                  ->orWhere('product_name', 'like', '%' . $search . '%')
                  ->orWhere('val_1', 'like', '%' . $search . '%');
            });
        }

        $log = $query->paginate(getPaginate())
            ->appends($request->except('page'));

        return view($this->activeTemplate . 'user.bills.airtime.index', compact('pageTitle', 'log'));
    }

    public function buy_airtime(Request $request)
    {
        $pageTitle = 'Buy Airtime';
        $countries = $this->getCountries();
        return view($this->activeTemplate . 'user.bills.airtime.airtime_buy', compact('pageTitle','countries'));
    }
    /**
     * Process airtime purchase
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function buy_airtime_post()
    {
        $user = auth()->user();

        // Validate request
        $validator = Validator::make(request()->all(), [
            'password' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|string|min:5|max:20',
            'wallet' => 'required|in:main,ref',
            'operator' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Rate limiting
        $key = 'airtime_purchase:' . $this->throttleKey(request());
        if (RateLimiter::tooManyAttempts($key, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Too many attempts. Please try again in ' . $seconds . ' seconds.'
            ], 429);
        }
        RateLimiter::hit($key, $this->decayMinutes * 60);

        // Verify transaction password
        if (!Hash::check(request('password'), $user->trx_password)) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'The transaction password is incorrect.'
            ], 401);
        }

        $amount = (float)request('amount');
        $phone = $this->sanitizePhoneNumber(request('phone'));
        $wallet = request('wallet');
        $operatorId = (int)request('operator');

        // Check if user is authorized to make this transaction
        if (!$this->authorizeTransaction($user, $amount, $wallet)) {
            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'You are not authorized to perform this transaction.'
            ], 403);
        }

        // return $this->operatorsdetails($operatorId);
        try {
            // Get operator details with validation
            $operator = $this->operatorsdetails($operatorId);

            if (empty($operator) || !isset($operator['operatorId'])) {
                throw new \Exception('Invalid operator selected');
            }

            $operatorId = $operator['operatorId'];
            $operatorName = $operator['name'] ?? 'Unknown';
            $operatorLogo = $operator['logoUrls'][0] ?? null;
            $operatorCurrency = $operator['destinationCurrencyCode'] ?? 'USD';
            $countryCode = $operator['country']['isoName'] ?? 'US';

            // Validate amount against operator limits
            $min = (float)($operator['minAmount'] ?? 0);
            $max = (float)($operator['maxAmount'] ?? 0);
            $rate = (float)($operator['fx']['rate'] ?? 1);

            if ($min > 0 && $amount < $min) {
                return response()->json([
                    'ok' => false,
                    'status' => 'danger',
                    'message' => 'Minimum amount you can purchase is ' . getAmount($min)
                ], 400);
            }

            if ($max > 0 && $amount > $max) {
                return response()->json([
                    'ok' => false,
                    'status' => 'danger',
                    'message' => 'Maximum amount you can purchase is ' . getAmount($max)
                ], 400);
            }

            // Calculate payment amount with rate
            $payment = $amount / $rate;

            // Get user's balance based on wallet type
            $balance = $wallet === 'main' ? $user->balance : $user->ref_balance;

            // Check if user has sufficient balance
            if ($payment > $balance) {
                return response()->json([
                    'ok' => false,
                    'status' => 'danger',
                    'message' => 'Insufficient balance in your ' . ($wallet === 'main' ? 'main' : 'referral') . ' wallet'
                ], 400);
            }
            // Generate a unique transaction reference
            $code = getTrx();

            // Prepare the API request data
            $apiData = [
                'operatorId' => $operatorId,
                'amount' => (string)$amount,
                'useLocalAmount' => true,
                'customIdentifier' => $code,
                'recipientEmail' => $user->email,
                'recipientPhone' => [
                    'countryCode' => $countryCode,
                    'number' => $phone
                ]
            ];

            // Log the request (without sensitive data)
            $logData = $apiData;
            unset($logData['recipientPhone']['number']);
            Log::info('Airtime purchase request', $logData);

            try {
                // Make the API request using Laravel HTTP client
                $baseUrl = config('services.reloadly.mode') === 'test'
                    ? 'https://topups-sandbox.reloadly.com/topups'
                    : 'https://topups.reloadly.com/topups';

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . getToken('topups'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/com.reloadly.topups-v1+json'
                ])
                    ->timeout(30)
                    ->post($baseUrl, $apiData);

                $responseData = $response->json();

                // Log the response (without sensitive data)
                $logResponse = $responseData;
                if (isset($logResponse['recipientPhone'])) {
                    unset($logResponse['recipientPhone']['number']);
                }
                Log::info('Airtime purchase response', $logResponse);

                if (!$response->successful()) {
                    throw new \Exception($responseData['message'] ?? 'API request failed');
                }

                // Process successful response
                if (isset($responseData['status']) && !empty($responseData['transactionId'])) {
                    // Start database transaction
                    DB::beginTransaction();

                    try {
                        // Update user balance
                        if ($wallet === 'main') {
                            $user->balance -= $payment;
                            $balanceAfter = $user->balance;
                        } else {
                            $user->ref_balance -= $payment;
                            $balanceAfter = $user->ref_balance;
                        }
                        $user->save();

                        // Create order record
                        $order = Order::create([
                            'user_id' => $user->id,
                            'type' => 'airtime',
                            'val_1' => $phone,
                            'product_id' => $operatorId,
                            'product_name' => $operatorName,
                            'product_logo' => $operatorLogo,
                            'details' => json_encode($responseData),
                            'quantity' => 1,
                            'price' => $amount,
                            'currency' => $responseData['requestedAmountCurrencyCode'] ?? $operatorCurrency,
                            'status' => $responseData['status'] ?? 'PENDING',
                            'payment' => $payment,
                            'trx' => $code,
                            'source' => $wallet,
                            'balance_before' => $balance,
                            'balance_after' => $balanceAfter,
                            'transaction_id' => $responseData['transactionId'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        // Record transaction
                        $transaction = new Transaction([
                            'user_id' => $user->id,
                            'amount' => $payment,
                            'post_balance' => $balanceAfter,
                            'charge' => 0,
                            'trx_type' => '-',
                            'details' => 'Purchase airtime via ' . strtoupper($wallet) . ' wallet',
                            'trx' => $code,
                            'remark' => 'airtime',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        $transaction->save();

                        // Send notification
                        $this->sendAirtimeNotification($user, [
                            'provider' => $operatorName,
                            'currency' => $operatorCurrency,
                            'amount' => $amount,
                            'rate' => $payment,
                            'beneficiary' => $phone,
                            'trx' => $code
                        ]);

                        // Commit the transaction
                        DB::commit();

                        // Clear rate limiter on success
                        RateLimiter::clear($key);

                        return response()->json([
                            'ok' => true,
                            'status' => 'success',
                            'message' => 'Transaction was successful',
                            'orderid' => $responseData['transactionId']
                        ]);

                    } catch (\Exception $e) {
                        // Rollback transaction on error
                        DB::rollBack();
                        Log::error('Transaction processing failed: ' . $e->getMessage());

                        return response()->json([
                            'ok' => false,
                            'status' => 'danger',
                            'message' => 'Transaction processing failed. Please contact support.'
                        ], 500);
                    }
                } else {
                    throw new \Exception('Invalid response from payment gateway');
                }

            } catch (\Exception $e) {
                Log::error('Airtime purchase error: ' . $e->getMessage());

                return response()->json([
                    'ok' => false,
                    'status' => 'danger',
                    'message' => 'Failed to process airtime purchase. ' .
                        (config('app.debug') ? $e->getMessage() : 'Please try again later.')
                ], 500);
            }
            //return json_decode($resp,true);
        }catch (\Exception $e) {
            Log::error('Airtime purchase error: ' . $e->getMessage());

            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Failed to process airtime purchase. ' .
                    (config('app.debug') ? $e->getMessage() : 'Please try again later.')
            ], 500);
        }
    }



    public function airtimelocal(Request $request)
    {
        $pageTitle = 'Buy Airtime';
        $countries = [];
        $networks =  '[
            {
                "name": "MTN",
                "logo": "mtn.png",
                "networkid": "mtn"
            },
            {
                "name": "AIRTEL",
                "logo": "airtel.jpeg",
                "networkid": "airtel"
            },
            {
                "name": "GLO",
                "logo": "glo.jpeg",
                "networkid": "glo"
            },
            {
                "name": "9MOBILE",
                "logo": "9mobile.jpeg",
                "networkid": "etisalat"
            }
            ]';
        $general   = gs();
        return view($this->activeTemplate . 'user.bills.airtime.airtime_buy_local', compact('pageTitle','countries','networks'));
     }

     public function buy_airtime_post_local()
    {
        $general   = gs();
        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);

        if($general->airtime_provider == 'VTPASS')
        {
           return $this->buy_airtime_post_vtpass($input);
        }
        if($general->airtime_provider == 'N3TDATA')
        {
           return $this->buy_airtime_post_n3tdata($input);
        }
    }

    public function buy_airtime_post_vtpass($input)
    {
        $user = auth()->user();
        $password = $input['password'];
        $amount =  @$input['amount'];
        $operator = @$input['operator'];
        $wallet = @$input['wallet'];
        $phone = @$input['phone'];

        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }


        if($wallet == 'ref')
        {
            $balance = $user->ref_balance;
        }
        else
        {
            $balance = $user->balance;
        }
        if($amount > $user->balance)
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
        "amount": "'.$amount.'",
        "phone": "'.$phone.'",
        "serviceID": "'.$operator.'",
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
    // return $response;
    curl_close($curl);
    \Log::info('airtime purchase response '. $reply);
    if(!isset($reply['code'] ))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'.@$resp],400);
    }

    if(isset($reply['content']['errors'] ))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'.@$resp],400);
    }


    if(!isset($reply['content']['transactions']['transactionId']))
    {
        return response()->json(['ok'=>false,'status'=>'danger','message'=> 'We cant processs this request at the moment'],400);
    }

        // END AIRTIME VENDING \\
        if($reply['content']['transactions']['transactionId'] && $reply['content']['transactions']['status'] != "failed")
        {



            $user->balance -= $amount;

            $user->save();

            $bonusAmount = BonusService::processBonus(
                $user->id,
                'airtime',
                $amount,
                $reply['content']['transactions']['transactionId']
            );

            if ($bonusAmount) {
                // You can add a notification or log here
                \Log::info("Bonus of {$bonusAmount} awarded for airtime purchase");
            }

            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'airtime';
            $order->val_1        = $phone;
            $order->product_id   = $operator;
            $order->product_name = @$operator;
            $order->product_logo = @$operator;
            $order->details      = json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$reply['content']['transactions']['amount'];
            $order->currency     = @$reply['content']['transactions']['product_name'];
            $order->status       = @$reply['content']['transactions']['status'];
            $order->payment      = @$amount;
            $order->trx          = $trx;
            $order->source       = $wallet;
            $order->balance_before  = $balance;
            $order->balance_after   = @$user->balance;
            $order->transaction_id  = @$reply['content']['transactions']['transactionId'];
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchase airtime Via Main Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'airtime';
            $transaction->save();

            notify($user,'AIRTIME_BUY', [
                'provider'        => @$operator,
                'currency'        => @$operator,
                'amount'          => @showAmount($amount),
                'rate'           =>  @showAmount($amount),
                'beneficiary'     => @$phone,
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);

            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successful','orderid'=> $order->trx],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'API ERROR. PLEASE TRY AGAIN LATER'],400);
        }
        //return json_decode($resp,true);
    }


    public function buy_airtime_post_n3tdata($input)
    {
        $user = auth()->user();
        $password = $input['password'];
        $amount =  @$input['amount'];
        $operator = @$input['operator'];
        $wallet = @$input['wallet'];
        $phone = @$input['phone'];

        if($operator == 'mtn')
        {
          $operatorId = 1;
        }
        if($operator == 'airtel')
        {
          $operatorId = 2;
        }
        if($operator == 'glo')
        {
          $operatorId = 3;
        }
        if($operator == 'etisalat')
        {
          $operatorId = 4;
        }


        if (Hash::check($password, $user->trx_password)) {
            $passcheck = true;
            } else {
            $passcheck = false;
                return response()->json(['ok'=>false,'status'=>'danger','message'=> 'The password doesn\'t match!'],400);
            }



            $balance = $user->balance;

        if($amount > $balance)
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> 'Insufficient wallet balance'],400);
        }
        $token = getN3TToken();
        $url = 'https://n3tdata.com/api/topup';
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
            "network": "$operatorId",
            "request-id": "$code",
            "plan_type": "VTU",
            "bypass": "false",
            "amount": "$amount",
            "phone": "$phone"
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

        \Log::info('airtime purchase response', $response);
        if(!isset($response['status']) && !isset($response['newbal']))
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> json_encode($response).'Sorry we cant process this request at the moment'],400);
        }

        // END AIRTIME VENDING \\
        if($response['status'] == 'success')
        {
            Log::info('airtime purchase success');
                $user->balance -= $amount;
                $balance_after = $user->balance;

            $user->save();

            $bonusAmount = BonusService::processBonus(
                $user->id,
                'airtime',
                $amount,
                $response['transactionId']
            );

            if ($bonusAmount) {
                // You can add a notification or log here
                \Log::info("Bonus of {$bonusAmount} awarded for airtime purchase");
            }
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'airtime';
            $order->val_1        = $phone;
            $order->product_id   = $operator;
            $order->product_name = @$operator;
            $order->product_logo = @$operator;
            $order->details      = json_encode($response,true);
            $order->quantity     = 1;
            $order->price        = @$response['amount'];
            $order->currency     = @$response['content']['transactions']['product_name'];
            $order->status       = @$response['status'];
            $order->payment      = @$amount;
            $order->trx          = getTrx();
            $order->source       = 'main';
            $order->balance_before  = $balance;
            $order->balance_after   = $balance_after;
            $order->transaction_id  = @$response['transid'];
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $order->payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchase airtime Via Main Wallet';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'airtime';
            $transaction->save();

            notify($user,'AIRTIME_BUY', [
                'provider'        => @$operator,
                'currency'        => @$operator,
                'amount'          => @showAmount($amount),
                'rate'           =>  @showAmount($amount),
                'beneficiary'     => @$phone,
                'purchase_at'     => @Carbon::now(),
                'trx'             => @$trx,
            ]);

            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Transaction Was Successful','orderid'=> $order->trx],200);
        }
        else
        {
            return response()->json(['ok'=>false,'status'=>'danger','message'=> $response['message']. 'API ERROR'],400);
        }
        //return json_decode($resp,true);
    }

    public function history(Request $request)
    {
        $pageTitle       = 'Airtime';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.airtime.airtime_log', compact('pageTitle', 'log'));
    }

    public function to_cash(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime2cash')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.airtime2cash.index', compact('pageTitle', 'log'));
    }

    public function to_cash_request(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.bills.airtime2cash.create', compact('pageTitle'));
    }

    public function to_cash_request_fee()
    {

        $user = auth()->user();
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $fee = $input['fee'];
        $network = $input['network'];
        $range = AirtimeCash::whereNetwork($network)->whereStatus(1)->get();
        if($fee == true)
        {
            if(count($range) < 1)
            {
                return response()->json(['ok'=>false,'status'=>'error','message'=> 'Sorry we are not buying this network at the moment','range'=> $range],200);
            }
            return response()->json(['ok'=>true,'status'=>'success','message'=> 'Network Available','range'=> $range],200);
        }

            $amount = $input['amount'];

            foreach($range as $data)
            {
                if($amount >= $data->min && $amount <= $data->max)
                {
                    return response()->json(['ok'=>true,'status'=>'success','message'=> 'Successful','range'=> $data],200);
                }
            }

        return response()->json(['ok'=>false,'status'=>'error','message'=>'Sorry, there is no amount range in the entered amount for this network'],200);

    }


    public function to_cash_request_post(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash';
        $request->validate([
            'network'        => 'required',
            'amount'      => 'required|numeric|gt:0',
            'code'      => 'required|string',
            'pin' => 'required',
        ]);
        $user = auth()->user();
        $password = $request->pin;
        if (Hash::check($password, $user->trx_password)) {
            $range = AirtimeCash::whereNetwork($request->network)->whereStatus(1)->get();
            foreach($range as $data)
            {
                if($request->amount >= $data->min && $request->amount <= $data->max)
                {
                    $com = (@$request->amount / 100) * @$data->fee; // Correct Calculation
                }
            }
            if(count($range) < 1)
            {
            $notify[] = ['error', 'Sorry, we are not buying this network amount at the moment'];
            return back()->withNotify($notify);
            }
            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         = 'airtime2cash';
            $order->product_name = $request->network;
            $order->val_1          = $com;
            $order->val_2        = $request->code;
            $order->price        = $request->amount;
            $order->payment        = $request->amount - $com;
            $order->status       = 0;
            $order->trx          = getTrx();
            $order->save();
            $notify[] = ['success', 'Airtime Logged Successfuly'];
            return redirect()->route('user.airtime.tocash.history')->withNotify($notify);

        } else {
            $notify[] = ['error', 'Invalid transaction password'];
            return back()->withNotify($notify);
        }
    }


    public function to_cash_history(Request $request)
    {
        $pageTitle       = 'Airtime 2 Cash Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('airtime2cash')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.airtime2cash.history', compact('pageTitle', 'log'));
    }




}
