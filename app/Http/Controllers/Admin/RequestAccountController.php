<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestPaymentAccount;
use App\Models\Transaction;
use App\Models\User;
use App\Models\RequestPayment;
use Illuminate\Http\Request;

class RequestAccountController extends Controller {
    public function index(Request $request) {
        $pageTitle = 'All Account';
        $accounts = RequestPaymentAccount::latest()->searchable(['name'])->paginate(getPaginate());
        return view('admin.paymentaccount.index', compact('pageTitle', 'accounts'));
    }

    public function store(Request $request, $id = 0) {
        $request->validate([
            'name' => 'required|max:255',
            'details' => 'required|max:255',
            'currency' => 'required|max:4',
            'rate' => 'required|max:15',
            'fee' => 'required|numeric|max:100',
        ]);

        if ($id) {
            $category = RequestPaymentAccount::findOrFail($id);
            $message = 'Account updated successfully';
        } else {
            $category = new RequestPaymentAccount();
            $message = 'Account added successfully';
        }

        $category->name = $request->name;
        $category->fee = $request->fee;
        $category->details = $request->details;
        $category->currency = $request->currency;
        $category->rate = $request->rate;
        $category->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return RequestPaymentAccount::changeStatus($id);
    }

    public function delete($id) {
     $category = RequestPaymentAccount::whereId($id)->firstOrFail();
     $category->delete();
     $notify[] = ['success', 'Account Deleted Successfuly'];
     return back()->withNotify($notify);
    }

    public function request($id)
    {
        $pageTitle = 'Payment Log';
        $log = RequestPayment::latest()->searchable(['trx', 'user:username'])->whereStatus($id)->with('account')->paginate(10);
        return view('admin.paymentaccount.history', compact('pageTitle', 'log'));
    }

    public function approve($id)
    {
        $pageTitle = 'Payment Log';
        $log = RequestPayment::latest()->whereStatus(2)->whereTrx($id)->with('account')->firstOrFail();
        $log->status = 1;
        $log->save();

        $user = User::whereId($log->user_id)->firstOrFail();
        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $log->pay;
        $transaction->post_balance = $user->balance;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Account credited for payment remittance from '.$log->account->log;
        $transaction->trx          = $log->trx;
        $transaction->remark       = 'Payment Remittance';
        $transaction->save(); 

        //Create Credit Transaction
        $user->balance += $log->pay;
        $user->save(); 

        $notify[] = ['success', 'Payment Approved Successfuly'];
        return back()->withNotify($notify);
    }
    public function decline($id)
    {
        $pageTitle = 'Payment Log';
        $log = RequestPayment::latest()->whereStatus(2)->whereTrx($id)->firstOrFail();
        $log->status = 4;
        $log->save();
        $notify[] = ['success', 'Payment Declined Successfuly'];
        return back()->withNotify($notify);
    }

     
}
