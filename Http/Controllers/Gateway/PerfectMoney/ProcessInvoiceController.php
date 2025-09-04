<?php

namespace App\Http\Controllers\Gateway\PerfectMoney;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Controller;

class ProcessInvoiceController extends Controller
{

    /*
     * Perfect Money Gateway
     */
    public static function process($deposit)
    {
        $basic = gs();

        $gateway_currency = $deposit->gatewayCurrency();

        $perfectAcc = json_decode($gateway_currency->gateway_parameter);

        $val['PAYEE_ACCOUNT'] = trim($perfectAcc->wallet_id);
        $val['PAYEE_NAME'] = $basic->site_name;
        $val['PAYMENT_ID'] = "$deposit->trx";
        $val['PAYMENT_AMOUNT'] = round($deposit->final_amo, 2);
        $val['PAYMENT_UNITS'] = "$deposit->method_currency";

        $val['STATUS_URL'] = route('ipn.' . $deposit->gateway->alias);
        $val['PAYMENT_URL'] = route(gatewayRedirectUrl(true));
        $val['PAYMENT_URL_METHOD'] = 'POST';
        $val['NOPAYMENT_URL'] = route(gatewayRedirectUrl());
        $val['NOPAYMENT_URL_METHOD'] = 'POST';
        $val['SUGGESTED_MEMO'] =  explode("|", $deposit->val_1)[1];
        $val['BAGGAGE_FIELDS'] = 'IDENT';


        $send['val'] = $val;
        $send['view'] = '';
        $send['method'] = 'post';
        $send['url'] = 'https://perfectmoney.is/api/step1.asp';

        return json_encode($send);
    }
    
}