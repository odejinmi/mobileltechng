<?php

namespace App\Http\Controllers\Gateway\Paypal;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;

class ProcessInvoiceController extends Controller
{

    public static function process($deposit)
    {
        $basic = gs();
        $paypalAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $val['cmd'] = '_xclick';
        $val['business'] = trim($paypalAcc->paypal_email);
        $val['cbt'] = $basic->site_name;
        $val['currency_code'] = "$deposit->method_currency";
        $val['quantity'] = 1;
        $val['item_name'] = "Payment To $basic->site_name Account";
        $val['custom'] = "$deposit->trx";
        $val['amount'] = round($deposit->final_amo, 2);
        $val['return'] = route(gatewayRedirectUrl(true));
        $val['cancel_return'] = route(gatewayRedirectUrl());
        $val['notify_url'] = route('ipn.' . $deposit->gateway->alias);
        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        // $send['url'] = 'https://www.sandbox.paypal.com/'; // use for sandbod text
        $send['url'] = 'https://www.paypal.com/cgi-bin/webscr';
        return json_encode($send);
    }
 
}
