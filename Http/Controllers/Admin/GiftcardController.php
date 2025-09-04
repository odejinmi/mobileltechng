<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin;  
use App\Models\Giftcardsale;
use App\Models\User;
use App\Models\Giftcard;
use App\Models\Giftcardtype;
use Illuminate\Http\Request;
use Auth;
use App\GeneralSettings;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use File;
use Image;
class GiftcardController extends Controller
{
	
    public function giftcardlog(Request $request, $id)
    {
        $type = $request->type;
        if($id == 0)
        {
          $status = "Pending ".$type;
        }
        if($id == 1)
        {
          $status = "Approved ".$type;
        }
        if($id == 2)
        {
          $status = "Declined ".$type;
        }
        $data['exchange'] = Giftcardsale::where('status', '=',$id)->with('user')->latest()->get();
        $data['pageTitle'] = $status.' Giftcard Log';
        return view('admin.giftcard.giftcard-log', $data);
	}

 
    public function cardinfo($id)
    {
        $get = Giftcardsale::where('id',$id)->first();
        if($get)
        {
            $data['exchange'] = $get;
            $data['pageTitle'] = ' Giftcard Trade Details';
            return view('admin.giftcard.giftcard-info', $data);
        }
        abort(404);
	}

	  public function approvegift(Request $request, $id)
    {
        $data = Giftcardsale::whereStatus(0)->find($id);
        // return $data->amount*$data->rate;
        if(!empty($request))
        { 
            $data->code= $request->pin;
            if($request->hasFile('front'))
            {
             $this->validate($request,
            [
            'front' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
                $data->image = uniqid().'.jpg';
                $request->front->move('giftcards',$data->image);
            }
            if($request->hasFile('back'))
            {
             $this->validate($request,
            [
            'back' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
                $data->image2 = uniqid().'.jpg';
                $request->back->move('giftcards',$data->image2);
            }
        }
        $data->status= 1;
        $data->save();
        $pay = $data->amount*$data->rate;
        $user = User::whereId($data->user_id)->first();
        if($data->trx_type == 'sell')
        {
            $user->balance += $pay;
            $user->save();
        }
 
        $notify[] = ['success', 'Gift Card Trade Approved Successfully !!'];
        return back()->withNotify($notify); 
	}

	  public function rejectgift(Request $request, $id)
    {
        $data = Giftcardsale::whereStatus(0)->find($id);
        $data->status= 2;
        $data->save();

        if($data->trx_type == 'buy')
        {
            if(!empty($request->refund))
            { 
                if($request->refund == 'on')
                {
                    $user = User::whereId($data->user_id)->first();
                    $user->balance += $data->amount;
                    $user->save();
                }
            }
        }
         

        $notify[] = ['success', 'Gift Card Trade Declined Successfully !!'];
        return back()->withNotify($notify); 
	}

    public function giftcardindex()
    {
        $data['pageTitle'] = 'Manage Giftcard';
        $data['currency'] = Giftcard::orderBy('name','asc')->get();
        return view('admin.giftcard.index', $data);
    }


    public function createcard($id)
    {
        $data['pageTitle'] = "Create Giftcard";
        return view('admin.giftcard.edit', $data);
    }

 
    public function editcardType($id)
    {
        $data['pageTitle'] = 'Manage Giftcard Type';
        $data['currency'] = Giftcardtype::whereCardId($id)->orderBy('name','asc')->get();
        $data['giftcard'] = Giftcard::whereId($id)->orderBy('name','asc')->firstOrFail();
        return view('admin.giftcard.type', $data);
    }
 

    public function delete($id)
    {
        $data = Giftcard::find($id);
        $data->delete();  
        $notify[] = ['success', 'Gift Card Deleted Successfully !!'];
        return back()->withNotify($notify); 
	}
	 public function deletetype($id)
    {
        $data = Giftcardtype::find($id);
        $data->delete();  
        $notify[] = ['success', 'Gift Card Type Deleted Successfully !!'];
        return back()->withNotify($notify); 
	}
 
    public function activate($id)
    {
        $data = Giftcard::find($id);
        $data->status= 1;
        $data->save();

        $notify[] = ['success', 'Gift Card Activated Successfully !!'];
        return back()->withNotify($notify); 
	}
  
    public function deactivate($id)
    {
        $data = Giftcard::find($id);
        $data->status= 0;
        $data->save();

        $notify[] = ['success', 'Gift Card Deactivated Successfully !!'];
        return back()->withNotify($notify); 
	}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


            $image = uniqid().'.jpg';
             Giftcard::create([
                    'image' => $image,
                    'name' => $request->name,

                ]);

        $request->photo->move('assets/images/giftcards',$image);

        $notify[] = ['success', 'Gift Card Created Successfully !!'];
        return back()->withNotify($notify); 
    }

    

     public function storetype(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'sell_rate' => 'required',
            'buy_rate' => 'required',
        ]);


             Giftcardtype::create([
                    'buy_rate' => $request->buy_rate,
                    'sell_rate' => $request->sell_rate,
                    'currency' => $request->currency,
                    'card_id' => $id,
                    'name' => $request->name,

                ]);

                $notify[] = ['success', 'Gift Card Type Created Successfully !!'];
                return back()->withNotify($notify); 


    }
 
    public function activatetype($id)
    {
        $data = Giftcardtype::find($id);
        $data->status= 1;
        $data->save();

        $notify[] = ['success', 'Gift Card Activated Successfully !!'];
        return back()->withNotify($notify); 
	}

    public function deactivatetype($id)
    {
        $data = Giftcardtype::find($id);
        $data->status= 0;
        $data->save();

        
        $notify[] = ['success', 'Giftcard Deactivated Successfully'];
        return back()->withNotify($notify);
	}

    public function editPage($id)
    {
        $data['giftcard'] = Giftcard::find($id);
        $data['pageTitle'] = "Manage Giftcard";
        return view('admin.giftcard.edit', $data);
    }


    public function edittype($id)
    {
         $data['giftcardtype'] = Giftcardtype::whereCard_id($id)->get();

        $data['giftcard'] = Giftcard::whereId($id)->first();

        $data['pageTitle'] = "Manage Giftcard";
        return view('admin.giftcard.edit-type', $data);
    }


    public function edittype2($id)
    {
        $data['giftcardtype'] = Giftcardtype::whereId($id)->first();
        $giftcard = Giftcardtype::whereId($id)->first();
        $data['giftcard'] = Giftcard::whereId($giftcard->card_id)->first();
        $data['pageTitle'] = "Manage Giftcardtype";
        return view('admin.giftcard.edit-type2', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function postcard(Request $request )
    {

        $request->validate([
            'name' => 'required',
        ]);

        $data = Giftcard::find($request->id);
        $data['name'] = $request->name ;
         if($request->hasFile('photo'))
            {
                $data['image'] = uniqid().'.jpg';
                $request->photo->move('giftcards',$data['image']);
            } 
        $data->save();

        $notify[] = ['success', 'Giftcard Updated Successfully'];
        return back()->withNotify($notify);
    }


    public function addcardType(Request $request, $id )
    {
        $request->validate([
            'name' => 'required',
            'currency' => 'required',
            'sell_rate' => 'required',
            'buy_rate' => 'required',
        ]);
        $data = new Giftcardtype;
        $data->name = $request->name ;
        $data->sell_rate = $request->sell_rate ;
        $data->buy_rate = $request->buy_rate ;
        $data->currency = $request->currency ;
        $data->card_id = $id ;
        $data->save();

        $notify[] = ['success', 'Giftcard Type Created Successfully'];
        return back()->withNotify($notify);    
    } 

    public function updatecardType(Request $request, $id )
    {
        $request->validate([
            'name' => 'required',
            'currency' => 'required',
            'sell_rate' => 'required',
            'buy_rate' => 'required',
        ]);
        $data = Giftcardtype::whereId($id)->first();
        $data->name = $request->name ;
        $data->sell_rate = $request->sell_rate ;
        $data->buy_rate = $request->buy_rate ;
        $data->currency = $request->currency ;
        $data->save();
        $notify[] = ['success', 'Giftcard Type Updated Successfully'];
        return back()->withNotify($notify);  
    
    }

 
}
