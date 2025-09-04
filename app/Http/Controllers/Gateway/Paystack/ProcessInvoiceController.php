<?php

namespace App\Http\Controllers\Gateway\Paystack;

use App\Constants\Status;
use App\Models\Deposit;
use App\Models\Invoice;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class ProcessInvoiceController extends Controller
{
    /*
     * PayStack Gateway
     */

    public static function process($deposit)
    {
        $paystackAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $trx =  explode("|", $deposit->trx)[0];
        $trx2 =  explode("|", $deposit->trx)[1];
        $email =  explode("|", $deposit->val_1)[2];
        $invoice = Invoice::whereTrx($trx)->firstOrFail();
        $send['key'] = $paystackAcc->public_key;
        $send['email'] = $email;
        $send['amount'] = $deposit->final_amo * 100;
        $send['currency'] = $deposit->method_currency;
        $send['ref'] = $trx2;
        $alias = $deposit->gateway->alias;
        $send['view'] = '.'.$alias;
        return json_encode($send);
    }
 
}