<?php

namespace App\Http\Controllers\Gateway\StripeV3;

use App\Constants\Status;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProcessInvoiceController extends Controller
{

    public static function process($deposit)
    {
        $StripeAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $alias = $deposit->gateway->alias;
        $general = gs();
        \Stripe\Stripe::setApiKey("$StripeAcc->secret_key");
        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'name' => $general->site_name,
                    'description' => 'Deposit  with Stripe',
                    'images' => [asset('assets/images/logoIcon/logo.png')],
                    'amount' => round($deposit->final_amo, 2) * 100,
                    'currency' => "$deposit->method_currency",
                    'quantity' => 1,
                ]],
                'cancel_url' => route(gatewayRedirectUrl()),
                'success_url' => route(gatewayRedirectUrl(true)),
            ]);
        } catch (\Exception $e) {
            $send['error'] = true;
            $send['message'] = $e->getMessage();
            return json_encode($send);
        }

        $alias = $deposit->gateway->alias;
        $send['view'] = '.'.$alias;
        $send['session'] = $session;
        $send['StripeJSAcc'] = $StripeAcc;
        $deposit->btc_wallet = json_decode(json_encode($session))->id;
        $deposit->save();
        return json_encode($send);
    }

 
}