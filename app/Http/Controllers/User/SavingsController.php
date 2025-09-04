<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Lib\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Transaction; 
use App\Models\Installment;
use App\Models\Fdr;
use App\Models\FdrPlan;
use App\Models\SavingPay;
use App\Models\Savings;
use App\Models\Investment;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;

class SavingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('kyc.status');
        $this->middleware('savings.status');
        $this->activeTemplate = activeTemplate();
    }
 
    public function requestsavings()
    {
        $pageTitle = 'Start Saving';
        $user = Auth::user();
        $plans     = FdrPlan::active()->orderBy('interest_rate')->get();

        return view($this->activeTemplate . 'user.vendor.savings.request', compact(
            'pageTitle',
            'user',
            'plans'
        ));
    }

    public function requestsubmit(Request $request)
    {

    if($request->type == 1)
    {

        $request->validate([
            'ramount' => 'required|int|min:100',
            'cycle' => 'required|int|max:30',
        ],[
            'ramount.required'=>'Please Enter An Amount',
            'cycle.required'=>'Please Please Select Recurrent Cycle',
        ]);
        $user = Auth::user();
        if ($user->balance < $request->ramount) {
            $notify[] = ['error', 'You dont have enough balance to start this recurrent savings plan.'];
            return back()->withNotify($notify);
        }
    }
    if($request->type == 2)
    {

    $request->validate([
            'tamount' => 'required|int|min:100',
            'mature' => 'required|string',
            'reason' => 'required|string',
        ],[
            'tamount.required'=>'Please Enter Targeted Amount',
            'mature.required'=>'Please Set Maturity Date',
            'reason.required'=>'Please Specify Reason For Savings',
        ]);
    }

    if($request->type == 3)
    {

        $request->validate([
             'plan' => 'required|int',
        ],[
             'plan.required'=>'Please Please Select Plan',
        ]);
        $user = Auth::user();
        if ($user->balance < $request->famount) {
            $notify[] = ['error', 'You dont have enough balance to start this fixed savings plan.'];
            return back()->withNotify($notify);
        }
    }
   
        $user = Auth::user();

        $save = new Savings();
        $save->type = $request->type; // Plan method ID
        $save->user_id = $user->id;
        if($request->type == 1)
         {
        $user->balance -= $request->amount;
        $user->save();

        $save->balance += $request->amount;

        $save->amount = $request->ramount;
        $save->cycle = $request->cycle ?? 0;
        $save->next_recurrent = Carbon::parse(Carbon::now())->addDay($request->cycle ?? 1);
        $save->recurrent = $request->recurrent ?? $request->recurrentt;
        $save->status = 1;
        $save->reference = getTrx();

        $save->save();

        $notify[] = ['success', 'Saving Plan Created Successfully.'];
        return back()->withNotify($notify);
         }
         if($request->type == 2)
        {
        $save->amount = $request->tamount;
        $save->val_1 = $request->reason;
        $save->mature = $request->mature ?? 0;
        $save->status = 1;
        $save->reference = getTrx();

        $save->save();

        $notify[] = ['success', 'Saving Plan Created Successfully.'];
        return back()->withNotify($notify);
        }

        if($request->type == 3)
        {
            $plan = FdrPlan::whereId($request->plan)->firstOrFail();

            $rules = ['famount' => "required|numeric|min:$plan->minimum_amount|max:$plan->maximum_amount"];
            $request->validate($rules);

            if ($plan->status != Status::ENABLE) {
                $notify[] = ['error', 'This plan is currently disabled'];
                return back()->withNotify($notify);
            }
            $code = getTrx();

            $fdr                        = new Fdr();
            $fdr->user_id               = $user->id;
            $fdr->plan_id               = $plan->id;
            $fdr->fdr_number            = $code;
            $fdr->amount                = $request->famount;
            $fdr->per_installment       = getAmount($request->famount * $plan->interest_rate / 100);
            $fdr->installment_interval  = $plan->installment_interval;
            $fdr->next_installment_date = now()->addDays($plan->installment_interval);
            $fdr->locked_date           = now()->addDays($plan->locked_days);
            $fdr->save();
    
            $user->balance -= $request->famount;
            $user->save();


            $save->reference = $code;
            $save->amount = $request->famount; 
            $save->status = 1;
            $save->save();
    
            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $request->famount;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'New FDR opened';
            $transaction->remark       = "fdr_open";
            $transaction->trx          = $fdr->fdr_number;
            $transaction->save();
            $notify[] = ['success', 'New Fixed Savings Plan Started Successfuly'];
            return back()->withNotify($notify);
        }
       
    }

    public function mysavings()
    {
        $pageTitle = 'My Savings Plan';
        $user = Auth::user();
        $saved = Savings::where('user_id', $user->id)->orderBy('created_at','desc')->searchable(['reference'])->paginate(10);
        $emptyMessage = "Data Not Found";

        return view($this->activeTemplate . 'user.vendor.savings.log', compact('pageTitle','saved','emptyMessage'));
    }

    


    public function viewsaved($id)
    {

        $user = Auth::user();
        $saved = Savings::where('user_id', $user->id)->whereReference($id)->first();
         if (!$saved) {
            $notify[] = ['error', 'Invalid Savings Request.'];
            return back()->withNotify($notify);
        }


        $pageTitle = 'My Savings Log';

        
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $jan = '01';
        $feb = '02';
        $mar = '03';
        $apr = '04';
        $may = '05';
        $jun = '06';
        $jul = '07';
        $aug = '08';
        $sep = '09';
        $oct = '10';
        $nov = '11';
        $dec = '12';

        if($saved->type == 3)
        {

            $pay = SavingPay::where('user_id', $user->id)->whereSavingId($id)->get();
            $sum = SavingPay::where('user_id', $user->id)->whereSavingId($id)->sum('amount');
            //$data['count'] = SavingPay::where('user_id', $user->id)->whereSavingId($id)->count();
            $fdr          = Fdr::where('user_id', auth()->id())->where('fdr_number', $id)->firstOrFail();
            $installments = $fdr->installments()->paginate(getPaginate());
            $pageTitle    = 'FDR Installments';
            $data['jan'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $jan)->sum('amount');
            $data['feb'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $feb)->sum('amount');
            $data['mar'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $mar)->sum('amount');
            $data['apr'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $apr)->sum('amount');
            $data['may'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $may)->sum('amount');
            $data['jun'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $jun)->sum('amount');
            $data['jul'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $jul)->sum('amount');
            $data['aug'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $aug)->sum('amount');
            $data['sep'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $sep)->sum('amount');
            $data['oct'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $oct)->sum('amount');
            $data['nov'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $nov)->sum('amount');
            $data['dec'] = Installment::where('user_id', $user->id)->whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $dec)->sum('amount');
            return view($this->activeTemplate . 'user.vendor.savings.fixed', $data, compact('pageTitle', 'installments', 'fdr','pay','sum','saved'));
        }


        $data['jan'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $jan)->sum('amount');
        $data['feb'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $feb)->sum('amount');
        $data['mar'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $mar)->sum('amount');
        $data['apr'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $apr)->sum('amount');
        $data['may'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $may)->sum('amount');
        $data['jun'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $jun)->sum('amount');
        $data['jul'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $jul)->sum('amount');
        $data['aug'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $aug)->sum('amount');
        $data['sep'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $sep)->sum('amount');
        $data['oct'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $oct)->sum('amount');
        $data['nov'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $nov)->sum('amount');
        $data['dec'] = SavingPay::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $dec)->sum('amount');

        $pay = SavingPay::where('user_id', $user->id)->whereSavingId($id)->get();
        $sum = SavingPay::where('user_id', $user->id)->whereSavingId($id)->sum('amount');
        $data['count'] = SavingPay::where('user_id', $user->id)->whereSavingId($id)->count();
        return view($this->activeTemplate.'user.vendor.savings.view',$data, compact('pageTitle','saved','pay','sum'));
    }

    

    public function savenow(Request $request,$id)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);

        $user = auth()->user();
        $save = Savings::where('user_id', $user->id)->whereReference($id)->first();
        if (!$save) {
            $notify[] = ['error', 'Invalid Savings Request.'];
            return back()->withNotify($notify);
        }

        if ($save->status == 0) {
            $notify[] = ['error', 'Savings plan has already been closed'];
            return back()->withNotify($notify);
        }
 
       if($save->type == 1)
       {

       if ($request->amount < $save->amount) {
            $notify[] = ['error', 'Amount Smaller Than Recurrent Amount'];
            return back()->withNotify($notify);
        }

       } 

        if ($request->amount > $user->balance)
        {
            $notify[] = ['error', 'You do not have sufficient balance to Save On ThisPlan.'];
            return back()->withNotify($notify);
        }

         if ($user->balance >= $request->amount)
         {
            $save->balance += $request->amount;
            $save->save();
            $user->balance -= $request->amount;
            $user->save();

        $code = getTrx();
        $pay = new SavingPay();
        $pay->user_id = $user->id;
        $pay->saving_id = $save->reference;
        $pay->plan_id = $save->type;
        $pay->amount = $request->amount;
        $pay->balance = $save->balance;
        $pay->trx = $code;
        $pay->status = 1;
        $pay->save();

        $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $request->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Fund Debited From Wallet To Service Ongoing Savings';
            $transaction->trx = $code;
            $transaction->remark  = 'savings';
            $transaction->save();

        $notify[] = ['success', 'Payment Was Successful'];
        return back()->withNotify($notify);

         }
          $notify[] = ['error', 'Sorry we cant process this payment at the moment.'];
          return back()->withNotify($notify);
    }

    public function saveclose(Request $request,$id)
    {
        
        $general = GeneralSetting::first();
        $user = auth()->user();
        $save = Savings::where('user_id', $user->id)->whereReference($id)->first();
        if (!$save) {
            $notify[] = ['error', 'Invalid Savings Request.'];
            return back()->withNotify($notify);
        }

        if ($save->status == 0) {
            $notify[] = ['error', 'Savings plan has already been closed'];
            return back()->withNotify($notify);
        } 
        $sum = SavingPay::where('user_id', $user->id)->whereSavingId($id)->sum('amount');

        if ($sum < 100) {
            $notify[] = ['error', 'Amount too low to close savings'];
            return back()->withNotify($notify);
        } 

        $commission = 0;
        $get = $sum;

        if(Carbon::now() < $save->mature)
        {
            $commission = (@$sum / 100) * @env('CLOSE_SAVINGS');
            $get = $sum - $commission;
        }
         
        $user->balance += $get;
        $user->save(); 
 
        $save->status = 0;
        $save->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $get;
        $transaction->post_balance = $user->balance;
        $transaction->charge = $commission;
        $transaction->trx_type = '+';
        $transaction->details = 'Fund Credited For Closing Savings Account';
        $transaction->trx = getTrx();
        $transaction->remark  = 'savings_payout';
        $transaction->save();
        $notify[] = ['success', 'Savings plan has closed successfully'];

        //Start Send Mail
           notify($user, 'DEFAULT', [
               'subject' => 'Savings Closed',
               'message' => 'Your savings earning of '.showAmount($get).$general->cur_text.' with saving number '.$id.'. has been closed successfully and earning paid into your savings wallet.',
           ], ['email'], false);
       // End Send Email

        return back()->withNotify($notify);
    }
 
 

}
