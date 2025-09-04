<?php

namespace App\Http\Controllers\Admin;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Voucher; 
use App\Models\GeneralSetting; 
use App\Models\AdminNotification;
use App\Models\User; 
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class VoucherController extends Controller
{ 
 
    public function __construct()
    {
        $this->middleware('voucher.status');
    }
 
    public function create(Request $request)
    {
        $pageTitle = 'Create New Voucher';
        return view('admin.voucher.create', compact('pageTitle'));
    }
    
    public function createVoucher(Request $request)
    {    
            $request->validate([ 
                'unit' => 'required',
                'amount' => 'required',
            ]);

            $total = $request->amount * $request->unit;
              

            for ($i = 0; $i < $request->unit; $i++){
            $voucher               = new Voucher();
            $voucher->user_id      = 0;
            $voucher->amount       = $request->amount;
            $voucher->code         =  getTrx();
            $voucher->status       = 1; 
            $voucher->save();
            }
  
            $notify[] = ['success', 'You have successfuly generate voucher code.'];
            return back()->withNotify($notify);        
    }

    public function log(Request $request)
    {
        $pageTitle       = 'Voucher Log';
        $log = Voucher:: searchable(['code'])->with('beneficiary')->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.voucher.log', compact('pageTitle', 'log'));
    }
 

    public function delete($id)
    {
        $voucher = Voucher::whereCode($id)->firstOrFail();
        $voucher->delete();
        $notify[] = ['success', 'You have successfuly deleted this voucher.'];
        return back()->withNotify($notify);       }
}
