<?php

namespace App\Http\Controllers\Gateway\Paytm;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Gateway\Paytm\PayTM;
use App\Models\Deposit;

class ProcessInvoiceController extends Controller
{
    /*
     * PayTM Gateway
     */

    public static function process($deposit)
    {
        $PayTmAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);


        $alias = $deposit->gateway->alias;

        $val['MID'] = trim($PayTmAcc->MID);
        $val['WEBSITE'] = trim($PayTmAcc->WEBSITE);
        $val['CHANNEL_ID'] = trim($PayTmAcc->CHANNEL_ID);
        $val['INDUSTRY_TYPE_ID'] = trim($PayTmAcc->INDUSTRY_TYPE_ID);

        try {
            $checkSumHash = (new PayTM())->getChecksumFromArray($val, $PayTmAcc->merchant_key);
        } catch (\Exception $e) {
            $send['error'] = true;
            $send['message'] = $e->getMessage();
            return json_encode($send);
        }

        $val['ORDER_ID'] = $deposit->trx;
        $val['TXN_AMOUNT'] = round($deposit->final_amo, 2);
        $val['CUST_ID'] = $deposit->user_id;
        $val['CALLBACK_URL'] = route('ipn.' . $alias);
        $val['CHECKSUMHASH'] = $checkSumHash;

        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        $send['url'] = $PayTmAcc->transaction_url . "?orderid=" . $deposit->trx;

        return json_encode($send);
    }
     
}