<?php

namespace App\Http\Controllers\Gateway\Flutterwave;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Deposit;

class ProcessInvoiceController extends Controller
{
    /*
     * flutterwave Gateway
     */

    public static function process($deposit)
    {
        $flutterAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);

        $send['API_publicKey']  = $flutterAcc->public_key;
        $send['encryption_key'] = $flutterAcc->encryption_key; 
        $send['customer_email'] = explode("|", $deposit->val_1)[2];
        $send['amount']         = round($deposit->final_amo, 2);
        $send['customer_phone'] = explode("|", $deposit->val_1)[3];
        $send['currency']       = $deposit->method_currency;
        $send['txref']          = $deposit->trx;
        $send['notify_url']     = url('ipn/flutterwave');

        $alias        = $deposit->gateway->alias;
        $send['view'] = '.'.$alias;
        return json_encode($send);
    }
 
}
