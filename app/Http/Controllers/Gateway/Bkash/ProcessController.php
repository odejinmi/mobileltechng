<?php

namespace App\Http\Controllers\Gateway\Bkash;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Lib\CurlRequest;
use App\Models\Deposit;
use Illuminate\Http\Request;

class ProcessController extends Controller
{ 
    public static function process($deposit)
    {
        static::getBkashToken($deposit);
        $token = session()->get('bkash_token');
        $config = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $bkash_app_key = $config->api_key; // bKash Merchant API APP KEY  
        $bkash_base_url = ($config->access == 'LIVE') ? 'https://tokenized.pay.bka.sh/v1.2.0-beta' : 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        $url = $bkash_base_url."/tokenized/checkout/create";
        try {
        $curl = curl_init();
        $amount = round($deposit->final_amo);
        $user = auth()->user();
        curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST", 
        
        CURLOPT_POSTFIELDS => json_encode([
        'callbackURL' => route('ipn.' . $deposit->gateway->alias),
        'cancelledCallbackURL' => route(gatewayRedirectUrl()),
        'mode' => '0011',
        'amount' => $amount,
        'currency' => 'BDT',
        'intent' => 'sale',
        'merchantInvoiceNumber' => $user->username,
        'payerReference' => $deposit->trx
        ]),
        CURLOPT_HTTPHEADER => [
        "Authorization: $token",
        "X-APP-Key: $bkash_app_key",
        "accept: application/json",
        "content-type: application/json"
        ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $reply = json_decode($response, true);
        curl_close($curl);

        if ($err) {
        $send['error'] = true;
        $send['message'] = "cURL Error #:" . $err;
        return json_encode($send);
        } else {
        $send['redirect'] = true;
        $send['redirect_url'] = $reply['bkashURL'];
        return json_encode($send); 
        }
        } catch (\Exception $e) {
            $send['error'] = true;
            $send['message'] = $e->getMessage();
            return json_encode($send);
        }
    }

    public static function getBkashToken($deposit)
    {
        session()->forget('bkash_token');
        $config = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $bkash_app_key = $config->api_key; // bKash Merchant API APP KEY
        $bkash_app_secret = $config->api_secret; // bKash Merchant API APP SECRET 
        $bkash_username = $config->username; // bKash Merchant API USERNAME
        $bkash_password = $config->password; // bKash Merchant API PASSWORD
        $bkash_base_url = ($config->access == 'LIVE') ? 'https://tokenized.pay.bka.sh/v1.2.0-beta' : 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
 

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => $bkash_base_url."/tokenized/checkout/token/grant",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'app_key' => $bkash_app_key,
            'app_secret' => $bkash_app_secret
        ]),
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "content-type: application/json",
            "password: $bkash_password",
            "username: $bkash_username"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        $reply = json_decode($response,true);
        session()->put('bkash_token', $reply['id_token']);
        }
        return response()->json(['success', true]);
    }

    public function ExecutePayment($deposit, $paymentID)
    {
        $token = session()->get('bkash_token');
        $config = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $bkash_app_key = $config->api_key; // bKash Merchant API APP KEY  
        $bkash_base_url = ($config->access == 'LIVE') ? 'https://tokenized.pay.bka.sh/v1.2.0-beta' : 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        try {
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => $bkash_base_url."/tokenized/checkout/execute",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'paymentID' => $paymentID
        ]),
        CURLOPT_HTTPHEADER => [
            "Authorization: $token",
            "X-APP-Key: $bkash_app_key",
            "accept: application/json",
            "content-type: application/json"
        ],
        ]);
        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $notify[] = ['error', $err];
            return to_route(gatewayRedirectUrl())->withNotify($err);
        } else {
        return $reply;
        }
        curl_close($url);
        } catch (\Exception $e) { 
            $message  = 'Transaction not found';
            $notify[] = ['error', $message];
            return to_route(gatewayRedirectUrl())->withNotify($e->getMessage());
        }
    } 

    public function ipn(Request $request)
    { 
        $paymentID = $_GET['paymentID'];
        $paymentStatus = $_GET['status'];
        $track = session()->get('Track');
        if (!isset($track)) {
            $message  = 'Invalid payment session';
            $notify[] = ['error', $message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        $deposit = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        if (!isset($deposit)) {
            $message  = 'Transaction not found';
            $notify[] = ['error', $message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }
        if ($paymentStatus == 'error') {
            $message  = 'Transaction failed, Ref: ' . $track;
            $notify[] = ['error', $message];
        }
           $transaction = $this->ExecutePayment($deposit, $paymentID);
        if (@$transaction['transactionStatus'] == 'Completed') {
            PaymentController::userDataUpdate($deposit);
            $message  = 'Transaction '.@$transaction['statusMessage'];
            $notify[] = ['success', $message];
            $deposit->from_api = @json_encode($transaction);
            $deposit->save();
            return to_route(gatewayRedirectUrl(true))->withNotify($notify);
        }
        else
        {
            $message  = 'Transaction Not Completed.'.@$transaction['statusMessage'];
            $notify[] = ['error', $message];
        }
        return to_route(gatewayRedirectUrl())->withNotify($notify);
    }


    public function queryPayment($deposit, $paymentID)
    {
        $token = session()->get('bkash_token');
        $config = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $bkash_app_key = $config->api_key; // bKash Merchant API APP KEY  
        $bkash_base_url = ($config->access == 'LIVE') ? 'https://tokenized.pay.bka.sh/v1.2.0-beta' : 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        try {
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => $bkash_base_url."/tokenized/checkout/payment/status",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'paymentID' => $paymentID
        ]),
        CURLOPT_HTTPHEADER => [
            "Authorization: $token",
            "X-APP-Key: $bkash_app_key",
            "accept: application/json",
            "content-type: application/json"
        ],
        ]);
        $response = curl_exec($curl);
        $reply = json_decode($response, true);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            $notify[] = ['error', $err];
            return to_route(gatewayRedirectUrl())->withNotify($err);
        } else {
        return $reply;
        }
        curl_close($url);
        } catch (\Exception $e) { 
            $message  = 'Transaction not found';
            $notify[] = ['error', $message];
            return to_route(gatewayRedirectUrl())->withNotify($e->getMessage());
        }
    }
}

