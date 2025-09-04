<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TerminalFee;
use App\Models\Terminal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TerminalController extends Controller
{

    public function index()
    {
        $pageTitle = 'Manage Terminals';
        $allTerminals = Terminal::with('user')->searchable(['terminal_sn'])->paginate(getPaginate());
        $users = User::whereVendor(1)->get();
        return view('admin.terminals.index', compact('pageTitle', 'allTerminals','users'));
    }
    public function mapPost(Request $request)
    {

        $request->validate([
            'serialnumber'    => 'required|unique:terminals,terminal_sn,' . $request->serialnumber, 
            'user'            => 'required', 
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wirelesspay.ng/api/v1/user/pos/mpos/assign-terminal',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "serial_number":"'.$request->serialnumber.'",
            "label":"'.gs()->site_name.'"
        }',
        CURLOPT_HTTPHEADER => array(
            'api-key: '.env('WIRELESSAPIKEY'),
            'Content-Type: application/json'
        ),
        )); 

        $response = curl_exec($curl);
        curl_close($curl);
        $reply = json_decode($response, true);
        if(!isset($reply['status']))
        {
            $notify[] = ['error', 'Error Assigning Terminal. Please check network'];
            return back()->withNotify($notify); 
        }
        if(!isset($reply['terminal_id']))
        {
            $notify[] = ['error', @$reply['error'].@$reply['message']];
            return back()->withNotify($notify); 
        }
       
        if($reply['status'] == 'success')
        {
            $terminal   = new Terminal();
            $terminal->terminal_id        = $reply['terminal_id'];
            $terminal->terminal_sn    = $request->serialnumber;
            $terminal->user_id       = $request->user; 
            $terminal->save(); 
            $notify[] = ['success', @$reply['message']];
            return back()->withNotify($notify); 
        }
        $notify[] = ['error', 'Error Assigning Terminal'];
        return back()->withNotify($notify); 
    }
    
    
    public function unmapPost(Request $request, $id)
    {

        $request->validate([
            'user'            => 'required', 
        ]);
        $terminal   = Terminal::whereTerminalId($id)->firstOrFail();
        $terminal->user_id       = $request->user; 
        $terminal->save();
        $notify[] = ['success', 'Terminal Unmapped Successfully'];
        return back()->withNotify($notify);
    }

    public function TerminalFee()
    {
        $pageTitle = 'Manage Terminals';
        $allfees = TerminalFee::paginate(getPaginate());
        return view('admin.terminals.fee', compact('pageTitle', 'allfees'));
    }

    public function TerminalFeePost(Request $request)
    {

        $request->validate([
            'from'    => 'required',
            'to'    => 'required', 
            'fee'    => 'required',
            'cap'    => 'required', 
        ]);
 
        $terminal   = new TerminalFee();
        $terminal->from        = $request->from;;
        $terminal->to    = $request->to;
        $terminal->fee       = $request->fee; 
        $terminal->cap       = $request->cap; 
        $terminal->save(); 
        $notify[] = ['success', 'Transaction Fee Added Successfully'];
        return back()->withNotify($notify);  
    }
    public function TerminalFeeUpdate(Request $request, $id)
    {

        $request->validate([
            'from'    => 'required',
            'to'    => 'required', 
            'fee'    => 'required',
            'cap'    => 'required', 
        ]);
 
        $terminal   = TerminalFee::whereId($id)->firstOrFail();
        $terminal->from        = $request->from;;
        $terminal->to    = $request->to;
        $terminal->fee       = $request->fee; 
        $terminal->cap       = $request->cap; 
        $terminal->save(); 
        $notify[] = ['success', 'Transaction Fee Updated'];
        return back()->withNotify($notify);  
    }
 
 
}
