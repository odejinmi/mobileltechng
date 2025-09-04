<?php

namespace App\Http\Controllers\Gateway\Payeer;

use App\Constants\Status;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class ProcessInvoiceController extends Controller
{
    /*
     * Payeer Gateway
     */

    public static function process($deposit)
    {
        $payeerAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        $basic = gs();
        $val['m_shop'] = trim($payeerAcc->merchant_id);
        $val['m_orderid'] = $deposit->trx;
        $val['m_amount'] = number_format($deposit->final_amo, 2, '.', '');
        $val['m_curr'] = $deposit->method_currency;
        $val['m_desc'] = base64_encode("Pay To $basic->site_name");
        $arHash = [$val['m_shop'], $val['m_orderid'], $val['m_amount'], $val['m_curr'], $val['m_desc']];
        $arHash[] = $payeerAcc->secret_key;
        $val['m_sign'] = strtoupper(hash('sha256', implode(":", $arHash)));
        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'get';
        $send['url'] = 'https://payeer.com/merchant';

        return json_encode($send);
    }

 
}
