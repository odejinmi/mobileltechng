<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\Event;
use App\Models\GeneralSetting;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Order;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
class AdminController extends Controller
{

    public function dashboard()
    {
        $pageTitle = 'Dashboard';
        // User Info
        $widget['total_users'] = User::count();
        $widget['verified_users'] = User::where('status', Status::USER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED)->count();
        $widget['email_unverified_users'] = User::emailUnverified()->count();
        $widget['mobile_unverified_users'] = User::mobileUnverified()->count();

        $widget['insurance'] = Order::whereType('insurance')->sum('price');
        $widget['airtime'] = Order::whereType('airtime')->sum('price');
        $widget['internet'] = Order::whereType('internet')->sum('price');
        $widget['cabletv'] = Order::whereType('cabletv')->sum('price');
        $widget['electricity'] = Order::whereType('electricity')->sum('price');

        // user Browsing, Country, Operating Log
        $userLoginData = UserLogin::where('created_at', '>=', Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);

        $chart['user_browser_counter'] = $userLoginData->groupBy('browser')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_os_counter'] = $userLoginData->groupBy('os')->map(function ($item, $key) {
            return collect($item)->count();
        });
        $chart['user_country_counter'] = $userLoginData->groupBy('country')->map(function ($item, $key) {
            return collect($item)->count();
        })->sort()->reverse()->take(5);

        $trxReport['date'] = collect([]);
        $plusTrx = Transaction::where('trx_type', '+')->where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%Y-%m-%d') as date")
            ->orderBy('created_at')
            ->groupBy('date')
            ->get();

        $plusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });

        $minusTrx = Transaction::where('trx_type', '-')->where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw("SUM(amount) as amount, DATE_FORMAT(created_at,'%Y-%m-%d') as date")
            ->orderBy('created_at')
            ->groupBy('date')
            ->get();

        $minusTrx->map(function ($trxData) use ($trxReport) {
            $trxReport['date']->push($trxData->date);
        });

        $trxReport['date'] = dateSorting($trxReport['date']->unique()->toArray());

		$last30 = date('Y-m-d', strtotime('-30 days'));
		$last7 = date('Y-m-d', strtotime('-7 days'));
		$today = today();
		$dayCount = date('t', strtotime($today));
        
        // Monthly Deposit Graph
        $report['months'] = collect([]);
        $report['deposit_month_amount'] = collect([]);

        $depositsMonth = Deposit::where('created_at', '>=', Carbon::now()->subYear())
            ->where('status', Status::PAYMENT_SUCCESS)
            ->selectRaw("SUM( CASE WHEN status = " . Status::PAYMENT_SUCCESS . " THEN amount END) as depositAmount")
            ->selectRaw("DATE_FORMAT(created_at,'%M-%Y') as months")
            ->orderBy('created_at')
            ->groupBy('months')->get();

        $depositsMonth->map(function ($depositData) use ($report) {
            $report['months']->push($depositData->months);
            $report['deposit_month_amount']->push(getAmount($depositData->depositAmount));
        });
        $months = $report['months'];

        for ($i = 0; $i < $months->count(); ++$i) {
            $monthVal = Carbon::parse($months[$i]);

            if (isset($months[$i + 1])) {
                $monthValNext = Carbon::parse($months[$i + 1]);

                if ($monthValNext < $monthVal) {
                    $temp = $months[$i];
                    $months[$i] = Carbon::parse($months[$i + 1])->format('F-Y');
                    $months[$i + 1] = Carbon::parse($temp)->format('F-Y');
                } else {
                    $months[$i] = Carbon::parse($months[$i])->format('F-Y');
                }
            }
        }

        $deposits = Deposit::select('created_at')
			->where('status', 1)
			->whereYear('created_at', $today)
			->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'method_code'])
			->selectRaw("SUM(amount) as Deposit")
			->get()
			->groupBy([function ($query) {
				return $query->created_at->format('F');
			}, 'method_code']);
            
		$payouts = Withdrawal::select('created_at')
			->whereYear('created_at', $today)
			->groupBy([DB::raw("DATE_FORMAT(created_at, '%m')"), 'method_id'])
			->selectRaw("SUM(amount) as Payout")
			->get()
			->groupBy([function ($query) {
				return $query->created_at->format('F');
			}, 'method_code']);

		$data['yearLabels'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		$yearDeposit = [];
		$yearPayout = [];
		foreach ($data['yearLabels'] as $yearLabel) {
			$currentYearDeposit = 0;
			$currentYearPayout = 0;

			if (isset($deposits[$yearLabel])) {
				foreach ($deposits[$yearLabel] as $key => $deposit) {
					$currentYearDeposit += $deposit[0]->Deposit;
				}
			}
			if (isset($payouts[$yearLabel])) {
				foreach ($payouts[$yearLabel] as $key => $payout) {
						$currentYearPayout += $payout[0]->Payout;
				}
			}

			$yearDeposit[] = round($currentYearDeposit, 2);
			$yearPayout[] = round($currentYearPayout, 2);
		}

		$data['yearDeposit'] = $yearDeposit;
		$data['yearPayout'] = $yearPayout;

        $data['total_deposit_amount'] = Deposit::successful()->sum('amount');
        $data['total_deposit_pending'] = Deposit::pending()->count();
        $data['total_deposit_rejected'] = Deposit::rejected()->count();
        $data['total_deposit_charge'] = Deposit::successful()->sum('charge');

        $today = today();
        $data['top_earners'] = Transaction::select('user_id',DB::raw('sum(amount) as sums'))
            // ->whereDate('created_at', Carbon::today())
            ->whereYear('created_at', $today)
            ->orderBy('amount','DESC')
            ->take(10)
			->where('trx_type', '+')
            ->with('user')
		    ->groupBy(['user_id'])
			->get();

        $data['mall_order'] = Order::whereStatus('PENDING')->count();
        $data['mpending_order'] = Order::whereStatus('PENDING')->count();
        $data['msuccess_order'] = Order::whereStatus('SUCCESSFUL')->count();
        $data['mdeclined_order'] = Order::whereStatus('DECLINED')->count();

       
        $widget['eventpending'] = Event::whereStatus(0)->count();
        $widget['eventapproved'] = Event::whereStatus(1)->count();
        $widget['eventcancelled'] = Event::whereStatus(2)->count();

        $widget['total_deposit_amount'] = Deposit::successful()->sum('amount');
        $widget['total_deposit_pending'] = Deposit::pending()->count();
        $widget['total_deposit_rejected'] = Deposit::rejected()->count(); 


        $widget['total_debit'] = Transaction::whereTrxType('-')->sum('amount');
        $widget['total_credit'] = Transaction::whereTrxType('+')->sum('amount'); 

        $widget['pending_withdrawal'] = Withdrawal::whereStatus(2)->sum('amount'); 
        $widget['approved_withdrawal'] = Withdrawal::whereStatus(1)->sum('amount'); 
        $widget['declined_withdrawal'] = Withdrawal::whereStatus(3)->sum('amount'); 


        return view('admin.dashboard', $data, compact('pageTitle', 'widget', 'chart', 'deposits', 'report', 'depositsMonth', 'months', 'trxReport', 'plusTrx', 'minusTrx'));
    }

    public function refIndex()
    {
        $pageTitle = 'Manage Referral';
        $trans = Referral::get();
        return view('admin.refer',compact('pageTitle', 'trans'));

    }
    public function refStore(Request $request)
    {
        $this->validate($request, [
            'level*' => 'required|integer|min:1',
            'percent*' => 'required|numeric',
        ]);
        Referral::truncate();

        for ($a = 0; $a < count($request->level); $a++){
            Referral::create([
                'level' => $request->level[$a],
                'percent' => $request->percent[$a],
                'status' => 1,
            ]);
        }

        $notify[] = ['success', 'Create Successfully'];
        return back()->withNotify($notify);

    }

      public function refupdate(Request $request)
    {
        $input = $request->all();
        $general = GeneralSetting::first();
        $general->deposit_commission = $request->deposit_commission ? 1 : 0;
        $general->reg_commission = $request->reg_commission ? 1 : 0;
        $general->task_commission = $request->task_commission ? 1 : 0;
        $general->commission_type = $request->commission_type ? 1 : 0;
        $general->save();
        $notify[] = ['success', 'Referral Feature has been updated.'];
        return back()->withNotify($notify);
    }

    public function profile()
    {
        $pageTitle = 'Profile';
        $admin = auth('admin')->user();
        return view('admin.profile', compact('pageTitle', 'admin'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
        $user = auth('admin')->user();

        if ($request->hasFile('image')) {
            try {
                $old = $user->image;
                $user->image = fileUploader($request->image, getFilePath('adminProfile'), getFileSize('adminProfile'), $old);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Couldn\'t upload your image'];
                return back()->withNotify($notify);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $notify[] = ['success', 'Profile updated successfully'];
        return to_route('admin.profile')->withNotify($notify);
    }

    public function password()
    {
        $pageTitle = 'Password Setting';
        $admin = auth('admin')->user();
        return view('admin.password', compact('pageTitle', 'admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = auth('admin')->user();

        if (!Hash::check($request->old_password, $user->password)) {
            $notify[] = ['error', 'Password doesn\'t match!!'];
            return back()->withNotify($notify);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        $notify[] = ['success', 'Password changed successfully.'];
        return to_route('admin.password')->withNotify($notify);
    } 


    public function notifications()
    {
        $notifications = AdminNotification::orderBy('id', 'desc')->with('user')->paginate(getPaginate());
        $pageTitle = 'Notifications';
        return view('admin.notifications', compact('pageTitle', 'notifications'));
    }

    public function notificationRead($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->is_read = Status::YES;
        $notification->save();
        $url = $notification->click_url;

        if ($url == '#') {
            $url = url()->previous();
        }

        return redirect($url);
    }
 
    public function readAll()
    {
        AdminNotification::where('is_read', Status::NO)->update([
            'is_read' => Status::YES,
        ]);
        $notify[] = ['success', 'Notifications read successfully'];
        return back()->withNotify($notify);
    }

    public function downloadAttachment($fileHash)
    {
        $filePath = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general = gs();
        $title = slug($general->site_name) . '- attachments.' . $extension;
        $mimetype = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }
}