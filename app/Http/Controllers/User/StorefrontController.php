<?php

namespace App\Http\Controllers\User;
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
        $this->middleware('kyc.status');
        $this->middleware('storefront.status');
        $this->activeTemplate = activeTemplate();
    }

     
    public function index(Request $request)
    {
        $pageTitle       = 'Storefront Link';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.vendor.storefront.index', compact('pageTitle', 'user'));
    }

    public function create(Request $request)
    {
        $pageTitle = 'Create New Invoice';
        return view($this->activeTemplate . 'user.vendor.storefront.create', compact('pageTitle'));
    }
    
    public function create_store(Request $request)
    {    
        $request->validate([
            'name' => 'sometimes|string',
            'description'  => 'sometimes|string',
            'logo' => [ 'required',  'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],

            'header' => ['required', 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ], [
            'name.required' => 'Please enter storefront name',
            'description.required'  => 'Please enter storefront description',
        ]);

        $filename = '';
        $path = imagePath()['storefront_logo']['path'];
        $size = imagePath()['storefront_logo']['size'];
        if ($request->hasFile('logo')) {
            try {
                $logo = uploadImage($request->logo, $path, $size);
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
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Header could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }


            $user = auth()->user();
            $order               = new Storefront();
            $order->user_id      = $user->id;
            $order->name       =  $request->name;
            $order->details      =  $request->details;
            $order->status       = 2;
            $order->logo         = $logo;
            $order->header         = $header;
            $order->trx          = getTrx();
            $order->save();

            // Send Mail
				 notify($user, 'USER_MESSAGE', [
					'message' => 'You have successfuly created your storefront. Please login to account to check status',
					'subject' => 'Storefront Creation'
				]);

            $notify[] = ['success', 'You have created your storefront successfuly.'];
            return redirect()->route('user.storefront.history')->withNotify($notify);       
    }
    public function edit($id)
    {
        $pageTitle       = 'Manage Storefront';
        $user = auth()->user();
        $storefront = Storefront::whereUserId($user->id)->whereTrx($id)->firstOrFail();
        if($storefront->status == 2)
        {
            $notify[] = ['error', 'Please wait while your storefront request is approved by the admin'];
            return back()->withNotify($notify);
        }
        $products = Product::whereStoreId($storefront->id)->whereStatus(1)->count();
        $order = Order::whereType('storefront')->whereStoreId($storefront->id)->Where('vendor_id',$user->id)->searchable(['trx'])->paginate(getPaginate());
        $sales = Order::whereType('storefront')->whereStoreId($storefront->id)->whereVendorId($user->id)->whereStatus(1)->sum('price');
        return view($this->activeTemplate . 'user.vendor.storefront.storefront_manage', compact('pageTitle', 'storefront','products','sales','order'));
    } 
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $storefront = Storefront::whereUserId($user->id)->whereTrx($id)->firstOrFail(); 

        $storefront->name       =  $request->name;
        $storefront->details      =  $request->details;
        $storefront->status               = $request->status ? Status::ENABLE : Status::DISABLE;
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

 
    public function history(Request $request)
    {
        $pageTitle       = 'Manage Storefront';
        $user = auth()->user();
        $log = Storefront::whereUserId($user->id)->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.vendor.storefront.storefront_log', compact('pageTitle', 'log'));
    }

    public function products($id)
    {
        $pageTitle       = 'Manage Products';
        $user = auth()->user();
        $storefront = Storefront::whereUserId($user->id)->whereTrx($id)->firstOrFail();
        $products = Product::where('store_id',$storefront->id)->searchable(['name'])->paginate(getPaginate());
        return view($this->activeTemplate . 'user.vendor.storefront.products', compact('pageTitle', 'products', 'storefront'));
    } 

    public function productsAdd(Request $request, $id)
    {    
        $request->validate([
            'name' => 'required|string',
            'details'  => 'required|string',
            'price'  => 'required|string',
            'delivery'  => 'required',
            'logo' => [ 'required',  'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],

        ], [
            'name.required' => 'Please enter storefront name',
            'details.required'  => 'Please enter product description',
        ]);

        $filename = '';
        $path = imagePath()['storefront_product']['path'];
        $size = imagePath()['storefront_product']['size'];
        if ($request->hasFile('logo')) {
            try {
                $logo = uploadImage($request->logo, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Logo could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
            $user = auth()->user();
            $storefront = Storefront::whereUserId($user->id)->whereTrx($id)->firstOrFail();
            $user = auth()->user();
            $product               = new Product();
            $product->store_id      = $storefront->id;
            $product->name       =  $request->name;
            $product->details      =  $request->details;
            $product->status       = 1;
            $product->image         = $logo;
            $product->amount         = $request->price;
            $product->delivery         = $request->delivery;
            $product->trx          = getTrx();
            $product->save();
            $notify[] = ['success', 'You have created your storefront product successfuly.'];
            return back()->withNotify($notify);
    }

    public function productUpdate(Request $request, $id)
    {    
        $request->validate([
            'name' => 'required|string',
            'details'  => 'required|string',
            'price'  => 'required|string',
            'product'  => 'required|string',
            'delivery'  => 'required|string',
            'logo' => [ 'sometimes',  'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'image2' => [ 'sometimes',  'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],

        ], [
            'name.required' => 'Please enter storefront name',
            'details.required'  => 'Please enter product description',
        ]);

        $filename = '';
        $path = imagePath()['storefront_product']['path'];
        $size = imagePath()['storefront_product']['size'];
        
            $user = auth()->user();
            $storefront = Storefront::whereUserId($user->id)->whereTrx($id)->firstOrFail();

            $user = auth()->user();
            $product               = Product::whereId($request->product)->firstOrFail();
            $product->store_id      = $storefront->id;
            $product->name       =  $request->name;
            $product->details      =  $request->details;
            $product->status       = 1;
            if ($request->hasFile('logo')) {
                try {
                    $logo = uploadImage($request->logo, $path, $size);
                    $product->image         = $logo;
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Product First Image2 could not be uploaded.'];
                    return back()->withNotify($notify);
                }
            }

            if ($request->hasFile('image2')) {
                try {
                    $logo = uploadImage($request->image2, $path, $size);
                    $product->image_2         = $logo;
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Second Image could not be uploaded.'];
                    return back()->withNotify($notify);
                }
            }
            $product->amount         = $request->price;
            $product->delivery         = $request->delivery;
            $product->status               = $request->status ? Status::ENABLE : Status::DISABLE;

            $product->save();
            $notify[] = ['success', 'You have update your storefront product successfuly.'];
            return back()->withNotify($notify);
    }


    public function productBuy(Request $request, $id)
    {    
        $request->validate([
            'quantity' => 'required',
        ], [
            'quantity.required' => 'Please specify order quantity',
        ]);

        $user = auth()->user();
        $product = Product::where('trx',$id)->firstOrFail();
        $storefront = Storefront::whereId($product->store_id)->firstOrFail();
        $total = $product->amount * $request->quantity;
        if($user->balance < $total)
        {
            $notify[] = ['error', 'You dont have enough balance to purchase this item.'];
            return back()->withNotify($notify);
        }
        $balance = $user->balance;
        $user->balance -= $total;
        $user->save();

        $general = gs();
        $fee = ($total*$general->store_front_fee)/100;
        $payment = $total - $fee;

        $vendor = User::whereId($storefront->user_id)->firstOrFail();
        $vendor->balance += $payment;
        $vendor->save();


        $transaction               = new Transaction();
        $transaction->user_id      = $vendor->id;
        $transaction->amount       = $payment;
        $transaction->post_balance = $vendor->balance;
        $transaction->charge       = $fee;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Received payment for storefront purchase';
        $transaction->trx          = getTrx();
        $transaction->remark       = 'storefront';
        $transaction->save();

        $code = getTrx();
        $user = auth()->user();
        $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'storefront';
            $order->vendor_id   = $storefront->user_id;
            $order->store_id   = $storefront->id;
            $order->product_id   = $product->id;
            $order->product_name = @$product->name;
            $order->quantity     = $request->quantity;
            $order->price        = $total; 
            $order->payment      = @$total;
            $order->trx          = $code;
            $order->source       = 'main';
            $order->balance_before  = $balance;
            $order->balance_after   = $user->balance;
            $order->transaction_id  = $code;
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $payment;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchased product from storefront';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'storefront';
            $transaction->save();

        $notify[] = ['success', 'You order has been received.'];
        return redirect()->route('user.storefront.purchase.order')->withNotify($notify); 
    }


    public function Myorder()
    {
        $pageTitle       = 'Manage Orders';
        $user = auth()->user();
        $order = Order::whereType('storefront')->whereUserId($user->id)->orWhere('vendor_id',$user->id)->searchable(['trx'])->paginate(getPaginate());
        $approved = Order::whereType('storefront')->whereUserId($user->id)->whereStatus('deliver')->count();
        $pending = Order::whereType('storefront')->whereUserId($user->id)->whereStatus('pending')->count();
        $declined = Order::whereType('storefront')->whereUserId($user->id)->whereStatus('decline')->count();
        return view($this->activeTemplate . 'user.vendor.storefront.order', compact('pageTitle', 'order','pending','approved','declined'));
    } 

    public function orderStatus(Request $request, $id)
    {
        $pageTitle       = 'Manage Storefront';
        $user = auth()->user();
        $order = Order::whereTrx($id)->firstOrFail();
        $storefront = Storefront::whereId($order->store_id)->whereUserId($user->id)->firstOrFail();
        $order->status = $request->status;
        $order->save();
       
        $notify[] = ['status', 'Order Status Updated Successfully'];
        return back()->withNotify($notify);
    } 

     
 
}
