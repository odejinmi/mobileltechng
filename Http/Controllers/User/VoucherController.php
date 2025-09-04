<?php

namespace App\Http\Controllers\User;
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
        $this->middleware('kyc.status');
        $this->middleware('voucher.status');
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $pageTitle       = 'Voucher';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.vendor.voucher.index', compact('pageTitle', 'user'));
    }

    public function create(Request $request)
    {
        $pageTitle = 'Create New Voucher';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.vendor.voucher.create', compact('pageTitle'));
    }
    
    public function create_voucher(Request $request)
    {    
            $request->validate([ 
                'unit' => 'required',
                'amount' => 'required',
            ]);

            $total = $request->amount * $request->unit;
            
            $int = (int)$request->amount;
            if($int < 2)
            {
               $user = auth()->user();
               $user->status = 0;
               $user->save();
               $notify[] = ['error', 'You are scammer'];
               return back()->withNotify($notify);        
            }
            
            $user = auth()->user();
            if($user->balance < $total)
            {
            $notify[] = ['error', 'Insufficient wallet balance'];
            return back()->withNotify($notify); 
            }
            $user->balance -= $total;
            $user->save();

            for ($i = 0; $i < $request->unit; $i++){
            $voucher               = new Voucher();
            $voucher->user_id      = $user->id;
            $voucher->amount       =  $request->amount;
            $voucher->code         =  getTrx();
            $voucher->status       = 1; 
            $voucher->save();
            }

            $transaction               = new Transaction();
            $transaction->user_id      = $voucher->user_id;
            $transaction->amount       = $total;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Generated voucher code';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'voucher';
            $transaction->save();

            $notify[] = ['success', 'You have successfuly generate voucher code.'];
            return back()->withNotify($notify);        
    }

    public function history(Request $request)
    {
        $pageTitle       = 'Voucher Log';
        $user = auth()->user();
        $log = Voucher::whereUserId($user->id)->orWhere('beneficiary_id',$user->id)->searchable(['code'])->with('beneficiary','user')->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.vendor.voucher.log', compact('pageTitle', 'log'));
    }

    public function redeem(Request $request)
    {    
            $request->validate([ 
                'code' => 'required',
            ]);

            $voucher = Voucher::whereCode($request->code)->first();
            if(!$voucher)
            {
            $notify[] = ['error', 'Invalid voucher code. Please check and try again'];
            return back()->withNotify($notify); 
            }
            
            if($voucher->status != 1)
            {
            $notify[] = ['error', 'This voucher has already been used'];
            return back()->withNotify($notify); 
            }
            $user = auth()->user(); 
            $user->balance += $voucher->amount;
            $user->save();

            $voucher->beneficiary_id   = $user->id;
            $voucher->status = 0;
            $voucher->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $voucher->amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = 0;
            $transaction->trx_type     = '+';
            $transaction->details      = 'redeemed voucher code';
            $transaction->trx          = getTrx();
            $transaction->remark       = 'voucher';
            $transaction->save();

            $notify[] = ['success', 'You have successfuly generate voucher code.'];
            return back()->withNotify($notify);        
    }
    
}
