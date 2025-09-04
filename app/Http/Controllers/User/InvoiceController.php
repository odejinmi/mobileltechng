<?php

namespace App\Http\Controllers\User;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Invoice; 
use App\Models\GeneralSetting; 
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class InvoiceController extends Controller
{ 
 
    public function __construct()
    {
        // $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }

    public function invoice_pay($id)
    { 
        $pageTitle = 'Pay Invoice';
        $invoice = Invoice::whereTrx($id)->whereStatus(1)->firstOrFail();
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) { 
        $gate->where('status', Status::ENABLE);
        })->with('method')->orderby('method_code')->get();
        return view($this->activeTemplate . 'invoice', compact('pageTitle', 'invoice','gatewayCurrency'));
    }
    public function invoice_pay_submit(Request $request, $id)
    {

       $gateway =  json_decode($request->methodId);
       //return $gate['id'];
        $request->validate([ 
            'methodId' => 'required',
            'firstname'    => 'required',
            'lastname'    => 'required',
            'email'    => 'required',
            'phone'    => 'required',
        ]);

        $invoice = Invoice::whereTrx($id)->whereStatus(1)->firstOrFail();
        $gate = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->where('method_code', $gateway->method_code)->where('currency', $gateway->currency)->first();
        ///return $gate;

        if (!$gate) {
            $notify[] = ['error', 'Invalid gateway'];
            return back()->withNotify($notify);
        }
 

        $charge    = $gate->fixed_charge + ($invoice->amount * $gate->percent_charge / 100);
        $payable   = $invoice->amount + $charge;
        $final_amo = $payable * $gate->rate;
        $code = getTrx();
        $data                  = new Deposit();
        $data->user_id         = $invoice->user_id;
        $data->method_code     = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->amount          = $invoice->amount;
        $data->val_1          = $request->firstname.'|'.$request->lastname.'|'.$request->email.'|'.$request->phone;
        $data->charge          = $charge;
        $data->rate            = $gate->rate;
        $data->final_amo       = $final_amo;
        $data->type            = 'invoice';
        $data->btc_amo         = 0;
        $data->btc_wallet      = "";
        $data->trx             = $id.'|'.$code;
        $data->save();
        session()->put('Track', $data->trx);
        return to_route('invoice.confirm');
    }

    public function invoiceConfirm()
    {
        $track   = session()->get('Track');
        //return $track;
        $trx = explode("|", $track)[1];
        $deposit = Deposit::where('trx', $track)->where('status', Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();
        if ($deposit->method_code >= 1000) {

            $notify[] = ['error', 'Sorry, you cant pay invoice with this payment method'];
            return to_route('home')->withNotify($notify);
            // return to_route('user.deposit.manual.confirm');
        }
        
        $dirName = $deposit->gateway->alias;
        $new     = 'App\Http\Controllers\\Gateway\\' . $dirName . '\\ProcessInvoiceController';
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
        return view($this->activeTemplate . 'user.vendor.invoice.payment'.$data->view, compact('data', 'pageTitle', 'deposit'));
    }


    public function index(Request $request)
    {
        $pageTitle       = 'Payment Link';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.vendor.invoice.index', compact('pageTitle', 'user'));
    }

    public function create(Request $request)
    {
        $pageTitle = 'Create New Invoice';
        return view($this->activeTemplate . 'user.vendor.invoice.create', compact('pageTitle'));
    }
    
    public function create_link(Request $request)
    {    
            $user = auth()->user();
            $order               = new Invoice();
            $order->user_id      = $user->id;
            $order->amount       =  $request->amount;
            $order->purpose      =  $request->purpose;
            $order->status       = $request->status ? Status::ENABLE : Status::DISABLE;
            $order->is_test         = $request->istest ? Status::ENABLE : Status::DISABLE;
            $order->trx          = getTrx();
            $order->save();
            $notify[] = ['success', 'You have created payment link successfuly.'];
            return back()->withNotify($notify);        
    }
    public function edit($id)
    {
        $pageTitle       = 'Edit Invoice';
        $user = auth()->user();
        $invoice = Invoice::whereUserId($user->id)->whereTrx($id)->firstOrFail();
        return view($this->activeTemplate . 'user.vendor.invoice.edit', compact('pageTitle', 'invoice'));
    } 
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $invoice = Invoice::whereUserId($user->id)->whereTrx($id)->firstOrFail();
        $invoice->amount       =  $request->amount;
        $invoice->purpose      =  $request->purpose;
        $invoice->status       = $request->status ? Status::ENABLE : Status::DISABLE;
        $invoice->save();
        $notify[] = ['success', 'You have created payment link successfuly.'];
        return back()->withNotify($notify);   
    } 

 
    public function history(Request $request)
    {
        $pageTitle       = 'Invoice Log';
        $user = auth()->user();
        $log = Invoice::whereUserId($user->id)->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.vendor.invoice.invoice_log', compact('pageTitle', 'log'));
    }

    public function invoice($id)
    {
        $pageTitle       = 'Invoice Payment Log';
        $user = auth()->user();
        $invoice = Invoice::whereUserId($user->id)->whereTrx($id)->firstOrFail();
        $log = Transaction::whereUserId($user->id)->where('val_1',$id)->paginate(getPaginate());
        $invoicetotal = Transaction::whereUserId($user->id)->where('val_1',$id)->sum('amount');
        return view($this->activeTemplate . 'user.vendor.invoice.invoice_payment_log', compact('pageTitle', 'log', 'invoice','invoicetotal'));
    } 

    public function invoicesubmit(Request $request)
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
    
}
