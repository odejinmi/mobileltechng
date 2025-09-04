<?php

namespace App\Http\Controllers\Gateway\Instamojo;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcessInvoiceController extends Controller
{

    /*
     * Instamojo Gateway
     */
    public static function process($deposit)
    {
        $basic = gs();
        $instaMojoAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                "X-Api-Key:$instaMojoAcc->api_key",
                "X-Auth-Token:$instaMojoAcc->auth_token"
            )
        );
        $payload = array(
            'purpose' => 'Payment to ' . $basic->site_name,
            'amount' => round($deposit->final_amo, 2),
            'buyer_name' => explode("|", $deposit->val_1)[0],
            'redirect_url' => route(gatewayRedirectUrl()),
            'webhook' => route('ipn.' . $deposit->gateway->alias),
            'email' => explode("|", $deposit->val_1)[2],
            'send_email' => true,
            'allow_repeated_payments' => false
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);
        if (@$res->success) {
            if (!@$res->payment_request->id) {
                $send['error'] = true;
                $send['message'] = "Response not given from API. Please re-check the API credentials.";
            } else {
                $deposit->btc_wallet = $res->payment_request->id;
                $deposit->save();
                $send['redirect'] = true;
                $send['redirect_url'] = $res->payment_request->longurl;
            }
        } else {
            $send['error'] = true;
            $send['message'] = "Credentials mismatch. Please contact with admin";
        }
        return json_encode($send);
    }

    
}
