<?php

namespace App\Http\Controllers\Gateway\Skrill;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Deposit;

class ProcessInvoiceController extends Controller
{

    /*
     * Skrill Gateway
     */
    public static function process($deposit)
    {
        $basic     = gs();
        $skrillAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        $val['pay_to_email']   = trim($skrillAcc->pay_to_email);
        $val['transaction_id'] = "$deposit->trx";

        $val['return_url']          = route(gatewayRedirectUrl(true));
        $val['return_url_text']     = "Return $basic->site_name";
        $val['cancel_url']          = route(gatewayRedirectUrl());
        $val['status_url']          = route('ipn.' . $deposit->gateway->alias);
        $val['language']            = 'EN';
        $val['amount']              = round($deposit->final_amo, 2);
        $val['currency']            = "$deposit->method_currency";
        $val['detail1_description'] = "$basic->site_name";
        $val['detail1_text']        = "Pay To $basic->site_name";
        $val['logo_url']            = asset('assets/images/logoIcon/logo.png');

        $send['val']    = $val;
        $alias = $deposit->gateway->alias;
        $send['view'] = '.'.$alias;
        $send['method'] = 'post';
        $send['url']    = 'https://www.moneybookers.com/app/payment.pl';
        return json_encode($send);
    }
 
}
