<?php

namespace App\Http\Controllers\Admin;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Storefront; 
use App\Models\GeneralSetting; 
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Rules\FileTypeValidate;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use DB;
use Carbon\Carbon;
class StorefrontController extends Controller
{ 
 
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

  
    public function storefront(Request $request)
    {
        $pageTitle       = 'Manage Storefront';
        $log = Storefront::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.storefront.storefront_log', compact('pageTitle', 'log'));
    }
  
    public function manage($id)
    {
        $pageTitle       = 'Manage Storefront';
        $storefront = Storefront::whereTrx($id)->firstOrFail();
        
        $products = Product::whereStoreId($storefront->id)->whereStatus(1)->count();
        $order = Order::whereType('storefront')->whereStoreId($storefront->id)->searchable(['trx'])->paginate(getPaginate());
        $sales = Order::whereType('storefront')->whereStoreId($storefront->id)->whereStatus(1)->sum('price');
        return view('admin.storefront.storefront_manage', compact('pageTitle', 'storefront','products','sales','order'));
    } 
    public function update(Request $request, $id)
    {
        $storefront = Storefront::whereTrx($id)->firstOrFail(); 

        $storefront->name       =  $request->name;
        $storefront->details      =  $request->details;
        $storefront->status               = $request->status ? Status::ENABLE : 2;
        $storefront->save();
        $filename = '';
        $path = imagePath()['storefront_logo']['path'];
        $size = imagePath()['storefront_logo']['size'];
        if ($request->hasFile('logo')) {
            try {
                $logo = uploadImage($request->logo, $path, $size);
                $storefront->logo  = $logo;
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Logo could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $path = imagePath()['storefront_header']['path'];
        $size = imagePath()['storefront_header']['size'];
        if ($request->hasFile('header')) {
            try {
                $header = uploadImage($request->header, $path, $size);
                $storefront->header = $header;
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Header could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'You have created payment link successfuly.'];
        return back()->withNotify($notify);   
    } 

 
 
    public function status(Request $request, $id)
    {
        $pageTitle       = 'Manage Storefront';
        $order = Order::whereTrx($id)->firstOrFail();
        $storefront = Storefront::whereId($order->store_id)->firstOrFail();
        $order->status = $request->status;
        $order->save();
        $notify[] = ['status', 'Order Status Updated Successfully'];
        return back()->withNotify($notify);
    } 

     
 
}
