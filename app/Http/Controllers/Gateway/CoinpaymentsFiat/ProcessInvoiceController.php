<?php

namespace App\Http\Controllers\Gateway\CoinpaymentsFiat;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class ProcessInvoiceController extends Controller
{
    /*
     * CoinPaymentHosted Gateway
     */

    public static function process($deposit)
    {
        $basic =  gs();
        $coinpayAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $val['merchant'] = $coinpayAcc->merchant_id;
        $val['item_name'] = 'Payment to ' . $basic->site_name;
        $val['currency'] = $deposit->method_currency;
        $val['currency_code'] = "$deposit->method_currency";
        $val['amountf'] = round($deposit->final_amo, 2);
        $val['ipn_url'] =  route('ipn.' . $deposit->gateway->alias);
        $val['custom'] = "$deposit->trx";
        $val['amount'] = round($deposit->final_amo, 2);
        $val['return'] = route(gatewayRedirectUrl(true));
        $val['cancel_return'] = route(gatewayRedirectUrl());
        $val['notify_url'] = route('ipn.' . $deposit->gateway->alias);
        $val['success_url'] = route(gatewayRedirectUrl(true));
        $val['cancel_url'] = route(gatewayRedirectUrl());
        $val['custom'] = $deposit->trx;
        $val['cmd'] = '_pay_simple';
        $val['want_shipping'] = 0;
        $send['val'] = $val;

        $alias = $deposit->gateway->alias;
        $send['view'] = '.redirect';
        // $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        $send['url'] = 'https://www.coinpayments.net/index.php';

        return json_encode($send);
    }

    
}
