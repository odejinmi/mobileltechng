<?php

namespace App\Http\Controllers\Gateway\Razorpay;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;
use Razorpay\Api\Api;


class ProcessInvoiceController extends Controller
{
    /*
     * RazorPay Gateway
     */

    public static function process($deposit)
    {
        $razorAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        //  API request and response for creating an order
        $api_key = $razorAcc->key_id;
        $api_secret = $razorAcc->key_secret;

        try {
            $api = new Api($api_key, $api_secret);
            $order = $api->order->create(
                array(
                    'receipt' => $deposit->trx,
                    'amount' => round($deposit->final_amo * 100),
                    'currency' => $deposit->method_currency,
                    'payment_capture' => '0'
                )
            );
        } catch (\Exception $e) {
            $send['error'] = true;
            $send['message'] = $e->getMessage();
            return json_encode($send);
        }


        $deposit->btc_wallet = $order->id;
        $deposit->save();

        $val['key'] = $razorAcc->key_id;
        $val['amount'] = round($deposit->final_amo * 100);
        $val['currency'] = $deposit->method_currency;
        $val['order_id'] = $order['id'];
        $val['buttontext'] = "Pay with Razorpay";
        $val['name'] = explode("|", $deposit->val_1)[1];
        $val['description'] = "Payment By Razorpay";
        $val['image'] = getImage(getFilePath('logoIcon') . '/logo.png');
        $val['prefill.name'] = explode("|", $deposit->val_1)[0] . ' ' . explode("|", $deposit->val_1)[1];
        $val['prefill.email'] = explode("|", $deposit->val_1)[2];
        $val['prefill.contact'] = explode("|", $deposit->val_1)[3];
        $val['theme.color'] = "#2ecc71";
        $send['val'] = $val;

        $send['method'] = 'POST';


        $alias = $deposit->gateway->alias;

        $send['url'] = route('ipn.' . $alias);
        $send['custom'] = $deposit->trx;
        $send['checkout_js'] = "https://checkout.razorpay.com/v1/checkout.js";
        $send['view'] = '.' . $alias;

        return json_encode($send);
    }

 
}
