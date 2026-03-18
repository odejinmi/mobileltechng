<?php

namespace App\Http\Controllers\Gateway;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\Cart;
use App\Models\GeneralSetting;
use App\Models\AdminNotification;
use App\Models\Form;
use App\Models\Order;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\WalletService;
class PaymentController extends Controller
{
    public function deposit()
    {
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->with('method')->orderby('method_code')->get();
        $pageTitle = 'Deposit Methods';
        return view($this->activeTemplate . 'user.payment.deposit', compact('gatewayCurrency', 'pageTitle'));
    }

    public function depositInsert(Request $request)
    {

        $request->validate([
            'amount'      => 'required|numeric|gt:0',
            'method_code' => 'required',
            'currency'    => 'required',
        ]);

        $user = auth()->user();
        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('method_code', $request->method_code)->where('currency', $request->currency)->first();

        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }

        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please follow deposit limit'];
            return back()->withNotify($notify);
        }

        $charge    = $gate->fixed_charge + ($request->amount * $gate->percent_charge / 100);
        $payable   = $request->amount + $charge;
        $final_amo = $payable * $gate->rate;

        $data                  = new Deposit();
        $data->user_id         = $user->id;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount          = $request->amount;
        $data->charge          = $charge;
        $data->rate            = $gate->rate;
        $data->final_amo       = $final_amo;
        $data->type            = 'deposit';
        $data->btc_amo         = 0;
        $data->btc_wallet      = "";
        $data->trx             = getTrx();
        $data->save();
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }

    public function appDepositConfirm($hash)
    {
        try {
            $id = decrypt($hash);
        } catch (\Exception $ex) {
            return "Sorry, invalid URL.";
        }

        $data = Deposit::where('id', $id)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->firstOrFail();
        $user = User::findOrFail($data->user_id);
        auth()->login($user);
        session()->put('Track', $data->trx);
        return to_route('user.deposit.confirm');
    }

    public function depositConfirm()
    {
        $track   = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            return to_route('user.deposit.manual.confirm');
        }

        $dirName = $deposit->gateway->alias;
        $new     = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);

        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return to_route(gatewayRedirectUrl())->withNotify($notify);
        }

        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }

        $pageTitle = 'Payment Confirm';
        return view($this->activeTemplate . $data->view, compact('data', 'pageTitle', 'deposit'));
    }

    public static function userDataUpdate($deposit, $isManual = null)
    {
           $action = static::userDataDepositUpdate($deposit, $isManual = null);
    }

    public static function userDataDepositUpdate($deposit, $isManual = null)
    {
        DB::transaction(function () use ($deposit, $isManual) {
            $lockedDeposit = Deposit::query()->whereKey($deposit->id)->lockForUpdate()->first();
            if (!$lockedDeposit) {
                return;
            }

            if ($lockedDeposit->status != Status::PAYMENT_INITIATE && $lockedDeposit->status != Status::PAYMENT_PENDING) {
                return;
            }

            $lockedDeposit->status = Status::PAYMENT_SUCCESS;
            $lockedDeposit->save();

            $credit = WalletService::creditWithLock($lockedDeposit->user_id, $lockedDeposit->amount, 'main');
            $user = $credit['user'];

            if($lockedDeposit->type == 'deposit')
            {
                $transaction               = new Transaction();
                $transaction->user_id      = $lockedDeposit->user_id;
                $transaction->amount       = $lockedDeposit->amount;
                $transaction->post_balance = $credit['balance_after'];
                $transaction->charge       = $lockedDeposit->charge;
                $transaction->trx_type     = '+';
                $transaction->details      = 'Deposit Via ' . $lockedDeposit->gatewayCurrency()->name;
                $transaction->trx          = $lockedDeposit->trx;
                $transaction->remark       = 'deposit';
                $transaction->save();
    
                $general = GeneralSetting::first();
                if($general->deposit_commission == 1){
                    levelCommisionDeposit($user->id, $lockedDeposit->amount);
                }
    
                if (!$isManual) {
                    $adminNotification            = new AdminNotification();
                    $adminNotification->user_id   = $user->id;
                    $adminNotification->title     = 'Deposit successful via ' . $lockedDeposit->gatewayCurrency()->name;
                    $adminNotification->click_url = urlPath('admin.deposit.successful');
                    $adminNotification->save();
                }
    
            }
            if($lockedDeposit->type == 'invoice')
            {
                $trx =  explode("|", $lockedDeposit->trx)[0]; 
                $transaction               = new Transaction();
                $transaction->user_id      = $lockedDeposit->user_id;
                $transaction->amount       = $lockedDeposit->amount;
                $transaction->post_balance = $credit['balance_after'];
                $transaction->charge       = $lockedDeposit->charge;
                $transaction->trx_type     = '+';
                $transaction->val_1          = $trx;
                $transaction->details      = 'Invoice Payment Via ' . $lockedDeposit->gatewayCurrency()->name;
                $transaction->trx          = $lockedDeposit->trx;
                $transaction->remark       = 'invoice';
                $transaction->save();
            }
            
            notify($user, $isManual ? 'DEPOSIT_APPROVE' : 'DEPOSIT_COMPLETE', [
                'method_name'     => $lockedDeposit->gatewayCurrency()->name,
                'method_currency' => $lockedDeposit->method_currency,
                'method_amount'   => showAmount($lockedDeposit->final_amo),
                'amount'          => showAmount($lockedDeposit->amount),
                'charge'          => showAmount($lockedDeposit->charge),
                'rate'            => showAmount($lockedDeposit->rate),
                'trx'             => $lockedDeposit->trx,
                'post_balance'    => showAmount($credit['balance_after']),
            ]);
        });
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data  = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }

        if ($data->method_code > 999) {

            $pageTitle = 'Deposit Confirm';
            $method    = $data->gatewayCurrency();
            $form = Form::whereid($method->form_id)->first();
            $gateway   = $method->method;
            $formData        = $gateway->form->form_data;

            return view($this->activeTemplate . 'user.payment.manual', compact('formData','data', 'pageTitle', 'method', 'gateway'));
        }

        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data  = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        if (!$data) {
            return to_route(gatewayRedirectUrl());
        }

        $gatewayCurrency = $data->gatewayCurrency();
        $gateway         = $gatewayCurrency->method;
        $formData        = $gateway->form->form_data;

        $formProcessor  = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);

        $data->detail = $userData;
        $data->status = Status::PAYMENT_PENDING;
        $data->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $data->user->id;
        $adminNotification->title     = 'Deposit request from ' . $data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details', $data->id);
        $adminNotification->save();

        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name'     => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount'   => showAmount($data->final_amo),
            'amount'          => showAmount($data->amount),
            'charge'          => showAmount($data->charge),
            'rate'            => showAmount($data->rate),
            'trx'             => $data->trx,
        ]);

        $notify[] = ['success', 'You have deposit request has been taken'];
        return to_route('user.deposit.history')->withNotify($notify);
    }
}
