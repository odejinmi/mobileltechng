<?php

namespace App\Http\Controllers\Gateway\Voguepay;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Gateway\PaymentController;
use App\Lib\CurlRequest;

class ProcessInvoiceController extends Controller
{
    /*
     * Vogue Pay Gateway
     */

    public static function process($deposit)
    {
        $vogueAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $send['v_merchant_id'] = $vogueAcc->merchant_id;


        $alias = $deposit->gateway->alias;

        $send['notify_url'] = route('ipn.' . $alias);
        $send['cur'] = $deposit->method_currency;
        $send['merchant_ref'] = $deposit->trx;
        $send['memo'] = 'Payment';
        $send['store_id'] = $deposit->user_id;
        $send['custom'] = $deposit->trx;
        $send['Buy'] = round($deposit->final_amo, 2);
        $alias = $deposit->gateway->alias;
        $send['view'] = 'user.payment.' . $alias;
        return json_encode($send);
    }

     
}