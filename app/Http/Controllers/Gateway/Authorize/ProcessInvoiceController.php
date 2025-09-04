<?php

namespace App\Http\Controllers\Gateway\Authorize;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use net\authorize\api\constants\ANetEnvironment;
use net\authorize\api\contract\v1\CreateTransactionRequest;
use net\authorize\api\contract\v1\CreditCardType;
use net\authorize\api\contract\v1\MerchantAuthenticationType;
use net\authorize\api\contract\v1\PaymentType;
use net\authorize\api\contract\v1\TransactionRequestType;
use net\authorize\api\controller\CreateTransactionController;

class ProcessInvoiceController extends Controller
{

    public static function process($deposit)
    {

        $trx2 =  explode("|", $deposit->trx)[1];
        $alias          = $deposit->gateway->alias;
        $send['track']  = $trx2;
        $send['view']   = 'user.payment.' . $alias;
        $send['method'] = 'post';
        $send['url']    = route('ipn.' . $alias);
        return json_encode($send);
    }

     
}
