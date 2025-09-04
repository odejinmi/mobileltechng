<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Order; 
use App\Models\Event; 
use App\Models\Cart; 
use App\Models\Ticket; 
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
class EventController extends Controller
{

 
    public function __construct()
    {
        $this->middleware('event.status');
        $this->middleware('kyc.status');
        $this->activeTemplate = activeTemplate();
    }
 
    
    public function event(Request $request)
    {
        $pageTitle       = 'Event Service';
        $user = auth()->user();
        return view($this->activeTemplate . 'user.bills.event.index', compact('pageTitle'));
    }

    public function events(Request $request)
    {
        $encryption = hash_hmac('SHA512', 'Welcome to Tutorialspoint', 'any_secretkey');
        $pageTitle = 'Event Ticket';
        $events =  Event::whereStatus(1)->paginate(10);
        $networks = json_decode(file_get_contents(resource_path('views/partials/betting.json')), true);
        return view($this->activeTemplate . 'user.bills.event.events', compact('pageTitle','networks','events'));
    }

    public function eventDetails($id)
    {
        $pageTitle = 'Event';
        $now = Carbon::now();
        $event =  Event::whereStatus(1)->whereId(decrypt($id))->with('type')->firstOrFail();
        $related =  Event::whereStatus(1)->whereCityId($event->city_id)->orWhere('event_type',$event->event_type)->take(3)->get();
        return view($this->activeTemplate . 'user.bills.event.view', compact('pageTitle','event','related','now'));
    }

    public function eventBuy($id)
    {
        $pageTitle = 'Buy Event Ticket';
        $now = Carbon::now();
        $event =  Event::whereStatus(1)->whereId(decrypt($id))->with('type')->firstOrFail();
        if($now > $event->end_date)
        {
            $notify[] = ['error', 'This event has ended'];
            return back()->withNotify($notify);
        }
        return view($this->activeTemplate . 'user.bills.event.buy', compact('pageTitle','event','now'));
    }

    public function addToCart(Request $request)
    {
          
        $event = Event::findOrFail($request->event);
        $ticket = [];
        foreach($event->tickets as $data)
        {
            if($data->trx == $request->ticket_id)
            {
                $ticket = $data;
            }
        }
        if(empty($ticket))
        {
            return response()->json(['error' => 'Sorry, Ticket not found']);  
        }
        $user_id = auth()->user()->id??null;
        if($request->quantity > $ticket->limit)
        {
            return response()->json(['error' => 'Sorry, You have exceeded the number of allowed ticket per purchase']);  
        }
        
        $s_id = session()->get('session_id');

        if ($s_id == null) {
            session()->put('session_id', uniqid());
            $s_id = session()->get('session_id');
        }
        
        if($user_id != null){
            $cart = Cart::where('user_id', $user_id)->where('event_id', $request->event)->where('ticket_id', $ticket->trx)->first();
        }else{
            $cart = Cart::where('session_id', $s_id)->where('event_id', $request->event)->where('ticket_id', $ticket->trx)->first();
        }

        //Check Stock Status
        $bought_ticket = Ticket::where('ticket_id', $ticket->trx)->where('event_id', $request->event_id)->count();
        $stock_qty = $ticket->available - $bought_ticket;
        
            if($stock_qty < $request->quantity){
                return response()->json(['error' => 'Ticket quantity exceeds available tickets']);
            }

        if($cart) {
            if($request->quantity == 0)
            {
                $cart->delete();  
                return response()->json(['success' => 'Ticket Set to Zero']);

            }
            $cart->quantity  = $request->quantity;
            if(isset($bought_ticket) && $cart->quantity > $stock_qty){
                return response()->json(['error' => 'Sorry, You have already added maximum amount of ticket']);
            } 
            $cart->save();
        }else {
            $cart = new Cart();
            $cart->user_id    = auth()->user()->id??null;
            $cart->session_id = $s_id;
            $cart->event_id = $request->event;
            $cart->price = $ticket->price;
            $cart->ticket_id = $request->ticket_id;
            $cart->quantity   = $request->quantity;
            $cart->save();
        }

        return response()->json(['success' => 'Ticket Added to Cart']);

    }

    public function removeCartItem($id){

        $cart_item = Cart::findorFail($id);
        $cart_item->delete();
        return response()->json(['success' => 'Item Deleted Successfully']);
    }
    public function getCart()
    {
        $subtotal = 0;
        $user_id    = auth()->user()->id??null;

        if($user_id != null){
            $total_cart = Cart::where('user_id', $user_id)
            ->with(['event'])
            ->orderBy('id', 'desc')
            ->get();

            if($total_cart->count() > 3){
                $latest = $total_cart->sortByDesc('id')->take(1000000000000);
            }else{
                $latest = $total_cart;
            }

        }else{
            $s_id  = session()->get('session_id');
            $total_cart = Cart::where('session_id', $s_id)
            ->with(['event']) 
            ->orderBy('id', 'desc')
            ->get();

            if($total_cart->count() >3){
                $latest = $total_cart->sortByDesc('id')->take(1000000000000);
            }else{
                $latest = $total_cart;
            }
        }

        if($total_cart->count() > 0){

            foreach($total_cart as $tc){
                $subtotal += $tc->price * $tc->quantity;
            }
        }

        $more           = $total_cart->count() - count($latest);
        $emptyMessage  = 'No item in your cart';
        $coupon         = null;

        if(session()->has('coupon')){
           $coupon = session('coupon');
        }

        return view(activeTemplate() . 'partials.cart_items', ['data' => $latest, 'subtotal' => $subtotal, 'emptyMessage'=>$emptyMessage, 'more'=>$more, 'coupon'=>$coupon]);
    }
 

    public function getCartTotal()
    {
        $subtotal = 0;
        $user_id    = auth()->user()->id??null;
        if($user_id != null){
            $total_cart = Cart::where('user_id', $user_id)
            ->with(['event']) 
            ->get();

        }else{
            $s_id       = session()->get('session_id');
            $total_cart = Cart::where('session_id', $s_id)
            ->with(['event']) 
            ->get();
        }
        return $total_cart->count();
    } 


    public function buyTicket($id)
    {
        $pageTitle = 'Buy Event Ticket';
        $now = Carbon::now();
        $event =  Event::whereStatus(1)->whereId(decrypt($id))->with('type')->firstOrFail();
        if($now > $event->end_date)
        {
            $notify[] = ['error', 'This event has ended'];
            return back()->withNotify($notify);
        }
        $subtotal = 0;
        $user_id    = auth()->user()->id??null;

        if($user_id != null){
            $total_cart = Cart::where('user_id', $user_id)
            ->with(['event'])
            ->orderBy('id', 'desc')
            ->get();

            if($total_cart->count() > 3){
                $latest = $total_cart->sortByDesc('id')->take(1000000000000);
            }else{
                $latest = $total_cart;
            }

        }else{
            $s_id  = session()->get('session_id');
            $total_cart = Cart::where('session_id', $s_id)
            ->with(['event']) 
            ->orderBy('id', 'desc')
            ->get();

            if($total_cart->count() >3){
                $latest = $total_cart->sortByDesc('id')->take(1000000000000);
            }else{
                $latest = $total_cart;
            }
        }

        if($total_cart->count() < 1)
        {
            $notify[] = ['error', 'You dont have any event ticket in cart'];
            return back()->withNotify($notify);
        }

        $count = $total_cart->count();
        if($total_cart->count() > 0){

            foreach($total_cart as $tc){
                $subtotal += $tc->price * $tc->quantity;
            }
        }
        
        $user    = auth()->user();
        $balance = $user->balance;
        if($user->balance >= $subtotal)
        {
            $user->balance -= $subtotal;
            $user->save();
            $code = getTrx();
            foreach($total_cart as $event)
            {
            
            $qty = $event->quantity;
                for ($i = 0; $i < $qty; $i++)
                {
            
            $ticket = new Ticket();
            $ticket->name = $user->fullname; 
            $ticket->email = $user->email; 
            $ticket->phone = $user->mobile; 
            $ticket->trx_id = $code; 
            $ticket->event_id = $event->event_id;   
            $ticket->ticket_id = $event->ticket_id;   
            $ticket->code = getTrx();   
            $ticket->status = 1;
            $ticket->save();
                // code to repeat here
                }
            } 
            foreach($total_cart as $tc){
                $tc->delete();
            }

            $user    = auth()->user();
            $event =  Event::whereStatus(1)->whereId(decrypt($id))->with('type')->firstOrFail();

            $order               = new Order();
            $order->user_id      = $user->id;
            $order->type         =  'event';
            $order->status         =  'success';
            $order->product_id   = $event->id;
            $order->product_name = $event->title;
            $order->quantity     = $count;
            $order->price        = $subtotal; 
            $order->payment      = $subtotal;
            $order->trx          = $code;
            $order->source       = 'main';
            $order->balance_before  = $balance;
            $order->balance_after   = $user->balance;
            $order->transaction_id  = getTrx();
            $order->save();

            $transaction               = new Transaction();
            $transaction->user_id      = $order->user_id;
            $transaction->amount       = $subtotal;
            $transaction->post_balance = $order->balance_after;
            $transaction->charge       = 0;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Purchased event ticket';
            $transaction->trx          = $order->trx;
            $transaction->remark       = 'event';
            $transaction->save();

            $notify[] = ['success', 'You event ticket has been purchased.'];
            return redirect()->route('user.event.history')->withNotify($notify); 


        }
        
        else
        {
            $notify[] = ['error', 'Insufficient Wallet Balance'];
            return back()->withNotify($notify);
        }
    }
  
    public function history(Request $request)
    {
        $pageTitle       = 'Event Ticket Log';
        $user = auth()->user();
        $log = Order::whereUserId($user->id)->whereType('event')->searchable(['trx'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.bills.event.event_log', compact('pageTitle', 'log'));
    }

    public function Tickets($id)
    {
        $now = Carbon::now();
        $user = auth()->user();
        $tickets = Ticket::where('trx_id', $id)->where('email', $user->email)->with('event','order')->where('status', 1)->get();
        $emptyMessage = "No data found";
        $pageTitle = "Print Ticket";
        if(count($tickets) > 0)
        {
            $ticket = Ticket::where('trx_id', $id)->with('event','order')->where('status', 1)->first();
            $event = $ticket->event;
            return view($this->activeTemplate . 'user.bills.event.ticket',compact('pageTitle','tickets','emptyMessage','event','now'));
        }
         
        else
        {
            $notify[] = ['error', 'Sorry, No ticket found for this order'];
            return back()->withNotify($notify);
        }

   
    }


    
}
