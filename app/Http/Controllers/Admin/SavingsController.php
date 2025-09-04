<?php

namespace App\Http\Controllers\Admin;

use App\Lib\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\Installment;
use App\Models\Fdr;
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
        $this->middleware('savings.status');
    }

    public function log()
    {
        $pageTitle = 'All Savings Plan';
        $saved = Savings::searchable(['reference'])->with('user')->paginate(10);
        $emptyMessage = "Data Not Found";

        return view('admin.savings.log', compact('pageTitle','saved','emptyMessage'));
    }



    public function view($id)
    {

        $saved = Savings::whereReference($id)->first();
         if (!$saved) {
            $notify[] = ['error', 'Invalid Savings Request.'];
            return back()->withNotify($notify);
        }


        $pageTitle = 'Savings Log';


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

            $pay = SavingPay::whereSavingId($id)->get();
            $sum = SavingPay::whereSavingId($id)->sum('amount');
            //$data['count'] = SavingPay::whereSavingId($id)->count();
            $fdr          = Fdr::where('user_id', auth()->id())->where('fdr_number', $id)->firstOrFail();
            $installments = $fdr->installments()->paginate(getPaginate());
            $pageTitle    = 'Fixed Deposit Installments';
            $data['jan'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $jan)->sum('amount');
            $data['feb'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $feb)->sum('amount');
            $data['mar'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $mar)->sum('amount');
            $data['apr'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $apr)->sum('amount');
            $data['may'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $may)->sum('amount');
            $data['jun'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $jun)->sum('amount');
            $data['jul'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $jul)->sum('amount');
            $data['aug'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $aug)->sum('amount');
            $data['sep'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $sep)->sum('amount');
            $data['oct'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $oct)->sum('amount');
            $data['nov'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $nov)->sum('amount');
            $data['dec'] = Installment::whereStatus(1)->whereYear('installment_date', $year)->whereInstallmentableId($fdr->id)->whereMonth('installment_date', $dec)->sum('amount');
            return view('admin.savings.fixed', $data, compact('pageTitle', 'installments', 'fdr','pay','sum','saved'));
        }


        $data['jan'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $jan)->sum('amount');
        $data['feb'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $feb)->sum('amount');
        $data['mar'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $mar)->sum('amount');
        $data['apr'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $apr)->sum('amount');
        $data['may'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $may)->sum('amount');
        $data['jun'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $jun)->sum('amount');
        $data['jul'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $jul)->sum('amount');
        $data['aug'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $aug)->sum('amount');
        $data['sep'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $sep)->sum('amount');
        $data['oct'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $oct)->sum('amount');
        $data['nov'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $nov)->sum('amount');
        $data['dec'] = SavingPay::whereStatus(1)->whereYear('created_at', $year)->whereSavingId($id)->whereMonth('created_at', $dec)->sum('amount');


        $pay = SavingPay::whereSavingId($id)->get();
        $sum = SavingPay::whereSavingId($id)->sum('amount');
        $data['count'] = SavingPay::whereSavingId($id)->count();
        return view('admin.savings.view',$data, compact('pageTitle','saved','pay','sum'));
    }
 
}
