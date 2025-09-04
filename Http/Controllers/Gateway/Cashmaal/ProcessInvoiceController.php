<?php

namespace App\Http\Controllers\Gateway\Cashmaal;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use Illuminate\Http\Request;

class ProcessInvoiceController extends Controller
{
    /*
     * Cashmaal
     */

    public static function process($deposit)
    {
        $cashmaal            = json_decode($deposit->gatewayCurrency());
        $param               = json_decode($cashmaal->gateway_parameter);
        $val['pay_method']   = " ";
        $alias = $deposit->gateway->alias;
        $val['amount']       = getAmount($deposit->final_amo);
        $val['currency']     = $cashmaal->currency;
        $val['succes_url']   = route(gatewayRedirectUrl(true));
        $val['cancel_url']   = route(gatewayRedirectUrl());
        $val['client_email'] = explode("|", $deposit->val_1)[2];
        $val['web_id']       = $param->web_id;
        $val['order_id']     = $deposit->trx;
        $val['addi_info']    = "Deposit";
        $send['url']         = 'https://www.cashmaal.com/Pay/';
        $send['method']      = 'post';
        // $send['view']     = 'user.payment.redirect';
        $send['view']        = '.redirect';
        $send['val']         = $val;
        return json_encode($send);
    }

     
}
