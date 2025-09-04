<?php

namespace App\Http\Controllers\Gateway\StripeJs;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;


class ProcessInvoiceController extends Controller
{

    public static function process($deposit)
    {
        $StripeJSAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $val['key'] = $StripeJSAcc->publishable_key;
        $val['name'] = explode("|", $deposit->val_1)[1];
        $val['description'] = "Payment with Stripe";
        $val['amount'] = $deposit->final_amo * 100;
        $val['currency'] = $deposit->method_currency;
        $send['val'] = $val;


        $alias = $deposit->gateway->alias;

        $send['src'] = "https://checkout.stripe.com/checkout.js";
        $send['view'] = 'user.payment.' . $alias;
        $send['method'] = 'post';
        $send['url'] = route('ipn.' . $deposit->gateway->alias);
        return json_encode($send);
    }
 
}