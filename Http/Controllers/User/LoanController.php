<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\AdminNotification;
use App\Models\Loan;
use App\Models\LoanPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{

    public function list()
    {
        $pageTitle = 'My Loan List';
        $loans     = Loan::where('user_id', auth()->id())->searchable(['loan_number', 'plan:name'])->with(['plan', 'nextInstallment']);

        if (request()->status) {
            $loans->where('status', request()->status);
        }

        if (request()->date) {
            $date      = explode('-', request()->date);
            $startDate = Carbon::parse(trim($date[0]))->format('Y-m-d');
            $endDate = @$date[1] ? Carbon::parse(trim(@$date[1]))->format('Y-m-d') : $startDate;
            request()->merge(['start_date' => $startDate, 'end_date' => $endDate]);
            request()->validate([
                'start_date' => 'required|date_format:Y-m-d',
                'end_date'   => 'nullable|date_format:Y-m-d',
            ]);
            $loans->whereHas('nextInstallment', function ($query) use ($startDate, $endDate) {
                $query->whereDate('installment_date', '>=', $startDate)->whereDate('installment_date', '<=', $endDate);
            });
        }
        if (request()->download == 'pdf') {
            $loans = $loans->get();
            return downloadPDF($this->activeTemplate . 'pdf.loan_list', compact('pageTitle', 'loans'));
        }
        $loans = $loans->orderBy('id', 'DESC')->paginate(getPaginate());

        return view($this->activeTemplate . 'user.loan.list', compact('pageTitle', 'loans'));
    }

    public function plans()
    {
        $pageTitle = 'Loan Plans';
        $plans     = LoanPlan::active()->latest()->get();
        return view($this->activeTemplate . 'user.loan.plans', compact('pageTitle', 'plans'));
    }

    public function applyLoan(Request $request)
    {
        $plan = LoanPlan::active()->findOrFail($request->plan);
        $request->validate(['amount' => "required|numeric|min:$plan->minimum_amount|max:$plan->maximum_amount"]);
        $user            = auth()->user();
        $per_installment = $request->amount * $plan->per_installment / 100;

        $percentCharge = $plan->per_installment * $plan->percent_charge / 100;
        $charge        = $plan->fixed_charge + $percentCharge;

        $loan                         = new Loan();
        $loan->loan_number            = getTrx();
        $loan->user_id                = $user->id;
        $loan->plan_id                = $plan->id;
        $loan->amount                 = $request->amount;
        $loan->per_installment        = $per_installment;
        $loan->installment_interval   = $plan->installment_interval;
        $loan->delay_value            = $plan->delay_value;
        $loan->charge_per_installment = $charge;
        $loan->total_installment      = $plan->total_installment;
        $loan->application_form       = null;
        $loan->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = $user->id;
        $adminNotification->title     = 'New loan request';
        $adminNotification->click_url = urlPath('admin.loan.index') . '?search=' . $loan->loan_number;
        $adminNotification->save();
        return back()->with('done', 'Payment Successful');

        
    }

     
    public function installments($loanNumber)
    {
        $loan         = Loan::where('loan_number', $loanNumber)->where('user_id', auth()->id())->firstOrFail();
        $installments = $loan->installments()->paginate(getPaginate());
        $pageTitle    = 'Loan Installments';
        return view($this->activeTemplate . 'user.loan.installments', compact('pageTitle', 'installments', 'loan'));
    }
}
