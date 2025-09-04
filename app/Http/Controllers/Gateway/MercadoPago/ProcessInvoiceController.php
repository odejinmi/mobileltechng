<?php

namespace App\Http\Controllers\Gateway\MercadoPago;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Deposit;
use App\Models\Gateway;
use Illuminate\Http\Request;

class ProcessInvoiceController extends Controller
{
    public static function process($deposit)
    {
        $gatewayCurrency = $deposit->gatewayCurrency();
        $alias           = $deposit->gateway->alias;
        $gatewayAcc      = json_decode($gatewayCurrency->gateway_parameter);
        $curl            = curl_init();
        $preferenceData  = [
            'items'            => [
                [
                    'id'          => $deposit->trx,
                    'title'       => 'Deposit',
                    'description' => 'Deposit from ' . explode("|", $deposit->val_1)[0],
                    'quantity'    => 1,
                    'currency_id' => $gatewayCurrency->currency,
                    'unit_price'  => $deposit->final_amo,
                ],
            ],
            'payer'            => [
                'email' => explode("|", $deposit->val_1)[2],
            ],
            'back_urls'        => [
                'success' => route(gatewayRedirectUrl(true)),
                'pending' => '',
                'failure' => route(gatewayRedirectUrl()),
            ],
            'notification_url' => route('ipn.' . $alias),
            'auto_return'      => 'approved',
        ];
        $httpHeader = [
            "Content-Type: application/json",
        ];
        $url  = "https://api.mercadopago.com/checkout/preferences?access_token=" . $gatewayAcc->access_token;
        $opts = [
            CURLOPT_URL            => $url,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode($preferenceData, true),
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTPHEADER     => $httpHeader,
        ];
        curl_setopt_array($curl, $opts);
        $response = curl_exec($curl);
        $result   = json_decode($response, true);
        $err      = curl_error($curl);
        curl_close($curl);

        if (@$result['init_point']) {

            $send['redirect']     = true;
            $send['redirect_url'] = $result['init_point'];
        } else {
            $send['error']   = true;
            $send['message'] = 'Some problem ocurred with api.';
        }

        $send['view'] = '';
        return json_encode($send);
    }

    
}
