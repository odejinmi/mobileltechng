<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Savings;
use App\Models\SavingPay;
use App\Models\User;
use App\Models\Terminal;
use App\Models\TerminalFee;
use App\Models\CronJob;
use App\Models\CronJobLog;
use App\Models\Cryptowallet;
use App\Models\Cryptocurrency;
use App\Models\Fdr;
use App\Models\Admin;
use App\Models\Installment;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ApiController extends Controller
{

    public function wirelessxnomba(){

        try{
            $json = file_get_contents('php://input');
            $input = json_decode($json, true); 
            $action = isset($input['action_type']) ? $input['action_type'] : $input['event_type'];
            \Log::info('WIRELESS XNOMBA API'. __LINE__ .': '.json_encode($input) ."\n");
            if ($action == 'pre-balance-check-auth') {
                return $this->wirelessXnombaBalance($input);
            }
            if ($action == 'pre-payout-auth') {
                return $this->wirelessXnombaPayout($input);
            }
            if ($action == 'payment_success') {
                return $this->wirelessXnombaWebhook($input);
            }
        }catch(\Exception $ex){
                \Log::error('WIRELESS XNOMBA API ERROR ON LINE '. __LINE__ .': '.$ex->getMessage() ."\n");
                return response(['error'=>$ex->getMessage()], 400);  
        } 

    }

    public function wirelessXnombaBalance($input = false){

        try{
            $json = file_get_contents('php://input');
            $input = json_decode($json, true); 
            $terminalId = $input['data']['terminal']['terminalId'];
            $terminalPin = $input['data']['terminal']['pin'];
            $action = $input['action_type'];
            $terminal = Terminal::whereTerminalId($terminalId)->first();

            \Log::info('WIRELESS XNOMBA BALANCE API'. __LINE__ .': '.json_encode($input) ."\n");
            

            if(!$terminal)
            {
                //04 - ACCOUNT_NOT_FOUND
                $data['transaction'] = [
                    'shouldActionProceed' => false,
                    'reasonCode' => '04',
                    'message'=>'Terminal Not Found'
                ];
                return response(['data'=>$data], 400);  
            } 
            $user = User::whereId($terminal->user_id)->first();
            if(!$user)
            {
                //04 - ACCOUNT_NOT_FOUND
                $data['transaction'] = [
                    'shouldActionProceed' => false,
                    'reasonCode' => '04',
                    'message'=>'There Is No User Assigned To This Terminal'
                ];
                return response(['data'=>$data], 400);  
            } 

            if (!Hash::check($terminalPin, $user->terminal_pin)) {
                //05 - INVALID_PIN 
               return response(['message'=>'Invalid authentication','status'=>'INVALID_PIN'], 400); 
            }  

            if($user->status != 1)
            {
                //02 - BLACKLISTED
                $data['user'] = [
                    'shouldActionProceed' => false,
                    'reasonCode' => '02'
                ];
                return response(['message'=>'Account Blacklisted','data'=>$data], 400);  
            } 

            //CHECK BALANCE FUNCTION ON XNOMBA
                $data['user'] = [
                    'balance' => bcdiv($user->balance,1,2),
                    'currency' => 'NGN'
                ]; 
                return response(['data'=>$data], 200);                        

        }
        //RETURN ERROR FROM FUNCTION IF ANY
        catch(\Exception $ex){
            \Log::error('WIRELESS XNOMBA BALANCE API ERROR ON LINE '. __LINE__ .': '.$ex->getMessage() ."\n");
            return response(['error'=>$ex->getMessage()], 400);  

        } 

    }

    public function wirelessXnombaPayout($input = false){

        try{
            $json = file_get_contents('php://input');
            $input = json_decode($json, true); 
            $terminalId = $input['data']['terminal']['terminalId'];
            $rrn = $input['data']['transaction']['rrn'];
            // $terminalSn = $input['data']['terminal']['serialNo'];
            $terminalPin = $input['data']['terminal']['pin'];
            $terminal = Terminal::whereTerminalId($terminalId)->first();

            \Log::info('WIRELESS XNOMBA PAYOUT API'. __LINE__ .': '.json_encode($input) ."\n");
            

            if(!$terminal)
            {
                //04 - ACCOUNT_NOT_FOUND
                $data['transaction'] = [
                    'shouldActionProceed' => false,
                    'reasonCode' => '04',
                    'message'=>'Terminal Not Found'
                ];
                return response(['data'=>$data], 400);  
            } 
            $user = User::whereId($terminal->user_id)->first();
            if(!$user)
            {
                //04 - ACCOUNT_NOT_FOUND
                $data['transaction'] = [
                    'shouldActionProceed' => false,
                    'reasonCode' => '04',
                    'message'=>'There Is No User Assigned To This Terminal'
                ];
                return response(['data'=>$data], 400);  
            } 
            //PROCEED WITH PAYOUT FUNCTION 
                
                if (!Hash::check($terminalPin, $user->terminal_pin)) {
                        //05 - INVALID_PIN
                        $data['transaction'] = [
                        'shouldActionProceed' => false,
                        'reasonCode' => '05',
                        'message'=>'Invalid PIN',
                    ];
                    return response(['data'=>$data], 400); 
                } 
                    
                   $exist = Transaction::whereUserId($user->id)->whereTrx($rrn)->first();
                    if($exist)
                    {
                         //01 - DUPLICATE TRANSACTION
                         $data['transaction'] = [
                            'shouldActionProceed' => false,
                            'reasonCode' => '01',
                            'message'=>'Duplicate Transaction',
                        ];
                        return response(['data'=>$data], 400); 

                    }
                $amount = $input['data']['transaction']['amount'];
                $actionType = $input['data']['transaction']['type'];
                
                    //07 - INSUFFICIENT_BALANCE
                    if($user->balance < $amount)
                    {
                        $data['transaction'] = [
                            'shouldActionProceed' => false,
                            'reasonCode' => '07',
                            'message' => 'Insufficient '.gs()->site_name.' Account Balance'
                        ];
                        $code = 400;
                    }

                    //02 - BLACKLISTED
                    if($user->status != 1)
                    {
                        $data['transaction'] = [
                            'shouldActionProceed' => false,
                            'reasonCode' => '02',
                            'message' => gs()->site_name.' Account Blacklisted'
                        ];
                        $code = 400;
                    }

                    //00 - SUCCESS
                    if($user->status != 0 && $user->balance >= $amount)
                    {
                        $fee = env('POSCOMMISION');
                        //$commission = (@$amount / 100) * @$fee;
                        $commission = $fee;
                        $debit = $amount - $commission; 
                        
                        $data['transaction'] = [
                            'shouldActionProceed' => true,
                            'reasonCode' => '00',
                            'message' => gs()->site_name.' Transaction Successful'
                        ];  
                        $user->balance -= $debit;
                        $user->save();

                        $transaction               = new Transaction();
                        $transaction->user_id      = $user->id;
                        $transaction->amount       = round($amount);
                        $transaction->val_1        = json_encode($input);
                        $transaction->post_balance = $user->balance;
                        $transaction->charge       = round($commission);
                        $transaction->trx_type     = '-';
                        $transaction->details      = 'Wallet Debit Via POS For '.strToUpper($actionType);
                        $transaction->trx          = $rrn;
                        $transaction->remark       = 'POS';
                        $transaction->save();
                        $code = 200;
                    }
 
            return response(['data'=>$data], $code);                        
            // END PAYOUT FUNCTION

        }
        //RETURN ERROR FROM FUNCTION IF ANY
        catch(\Exception $ex){
            \Log::error('WIRELESS XNOMBA API ERROR ON LINE '. __LINE__ .': '.$ex->getMessage() ."\n");
            return response(['error'=>$ex->getMessage()], 400);  

        } 

    }

    public function wirelessXnombaWebhook($input = false){

        try{
            $json = file_get_contents('php://input');
            $input = json_decode($json, true); 
            $terminalId = $input['data']['terminal']['terminalId'];
             $rrn = $input['data']['transaction']['rrn'];
            \Log::info('WIRELESS XNOMBA WEBHOOK API'. __LINE__ .': '.json_encode($input) ."\n");
            $terminal = Terminal::whereTerminalId($terminalId)->first();            
            if(!$terminal)
            {
                //04 - ACCOUNT_NOT_FOUND
                $data['transaction'] = [
                    'shouldActionProceed' => false,
                    'reasonCode' => '04',
                    'message'=>'Terminal Not Found'
                ];
                return response(['data'=>$data], 400);  
            } 
            $user = User::whereId($terminal->user_id)->first();
            if(!$user)
            {
                //04 - ACCOUNT_NOT_FOUND
                $data['transaction'] = [
                    'shouldActionProceed' => false,
                    'reasonCode' => '04',
                    'message'=>'There Is No User Assigned To This Terminal'
                ];
                return response(['data'=>$data], 400);  
            } 

                //PROCEED WITH WEBHOOK FUNCTION  

                   $exist = Transaction::whereUserId($user->id)->whereTrx($rrn)->first();
                    if($exist)
                    {
                         //01 - DUPLICATE TRANSACTION
                         $data['transaction'] = [
                            'shouldActionProceed' => false,
                            'reasonCode' => '01',
                            'message'=>'Duplicate Transaction',
                        ];
                        return response(['data'=>$data], 400); 

                    }

                    $amount = $input['data']['transaction']['transactionAmount'];
                    $fee = $input['data']['transaction']['fee'];
                    $actionType = $input['data']['transaction']['type']; 

                    //00 - CREDIT
                    if($actionType == 'withdrawal' || $actionType == 'purchase')
                    {
                         $data['transaction'] = [
                            'shouldActionProceed' => true,
                            'reasonCode' => '00',
                            'message' => gs()->site_name.' Transaction Successful'
                        ];  
                        
                        $fee  = TerminalFee::where('from', '<=', $amount)->where('to', '>=', $amount)->first();
                        $trxfee = 0;
                        if ($fee) {
                            $trxfee = $amount * $fee->fee / 100;
                            if($trxfee > $fee->cap)
                            {
                                $trxfee = $fee->cap;
                            }
                        }

                        $pay = $amount - $trxfee;
                        $user->balance += $pay;
                        $user->save();

                        $transaction               = new Transaction();
                        $transaction->user_id      = $user->id;
                        $transaction->amount       = round($pay);
                        $transaction->val_1        = json_encode($input);
                        $transaction->post_balance = $user->balance;
                        $transaction->charge       = round($trxfee);
                        $transaction->trx_type     = '+';
                        $transaction->details      = 'Wallet Credit Via POS For '.strToUpper($actionType);
                        $transaction->trx          = $rrn;
                        $transaction->remark       = 'POS';
                        $transaction->save();
                        $code = 200;
                    }
 
                    return response(['data'=>$data], $code);                        
                    // END PAYOUT FUNCTION

        }
        //RETURN ERROR FROM FUNCTION IF ANY
        catch(\Exception $ex){
            \Log::error('WIRELESS XNOMBA WEBHOOK API ERROR ON LINE '. __LINE__ .': '.$ex->getMessage() ."\n");
            return response(['error'=>$ex->getMessage()], 400);  

        } 

    }



    public function strowalletwebhook(Request $request)
	{
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        if(!isset($input['sessionId']) || !isset($input['sourceAccountNumber'])) {
			return response()->json(["error" => "Invalid Input"]);
		}
        $fee = env('DEDICATEDACCOUNTFEE');
        $nuban = User::whereNubanRef($input['accountNumber'])->firstOrFail();
        $exist = Transaction::whereUserId($nuban->id)->whereTrx($input['sessionId'])->first();
        if($exist)
        {
            return response()->json(["error" => "Duplicate Transaction"]);
        }
        
        $commission = (@$input['transactionAmount'] / 100) * @$fee;
        $credit = $input['transactionAmount'] - $commission;
        $nuban->balance += $credit; // $input['transactionAmount'];
        $nuban->save();
        $nuban = User::whereNubanRef($input['accountNumber'])->firstOrFail();
        
        $transaction               = new Transaction();
        $transaction->user_id      = $nuban->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $nuban->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via dedicated account number';
        $transaction->trx          = $input['sessionId'];
        $transaction->remark       = 'Funding via dedicated account number';
        $transaction->save();
        return response()->json(["success" => "Wallet Updated"]);

	} 

    public function paylonywebhook(Request $request)
	{
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        if(!isset($input['reference']) || !isset($input['customer_reference'])) {
			return response()->json(["error" => "Invalid Input"]);
		}
        $fee = env('DEDICATEDACCOUNTFEE');
        $nuban = User::whereNubanRef($input['customer_reference'])->firstOrFail();
        
        $exist = Transaction::whereUserId($nuban->id)->whereTrx($input['trx'])->first();
        if($exist)
        {
            return response()->json(["error" => "Duplicate Transaction"]);
        }
        
        if($input['type'] == 'reserved_account')
        { 
        //VALIDATE TRANSACTIONS
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.paylony.com/api/v1/transaction_verify/'.$input['trx'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS =>'',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.env('PAYLONYSK')
        ),
        ));
        $response = curl_exec($curl);
        $reply = json_decode($response,true);
        curl_close($curl);
        if(!isset($reply['data']['status']))
        {
            return response()->json(["error" => "OOPS!".json_encode($reply['message'])]); 
        }
        if($reply['data']['status'] != 'success')
        {
            return response()->json(["error" => "OOPS!!".json_encode($reply['message'])]); 
        }
        
        // END VALIDATE TRANSACTION
        $nuban = User::whereNubanRef($input['customer_reference'])->firstOrFail();
        $accountnumber = json_decode($nuban->nuban)->account_number;
        if($accountnumber != $input['receiving_account'])
        {
            return response()->json(["error" => "OOPS!! Intruition detected"]); 
        }
        $commission = (@$input['amount'] / 100) * @$fee;
        $credit = $input['amount'] - $commission;
        $nuban->balance += $credit; // $input['transactionAmount'];
        $nuban->save();
        
        $transaction               = new Transaction();
        $transaction->user_id      = $nuban->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $nuban->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via dedicated account number';
        $transaction->trx          = $input['trx'];
        $transaction->val_1          = json_encode($input);
        $transaction->remark       = 'Funding via dedicated account number';
        $transaction->save();
        return response()->json(["success" => "Wallet Updated"]); 
        }
        return response()->json(["error" => "TRX Not Dedicated Account Number Funding"]); 


	} 

    public function monnifywebhook()
    {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $account_ref = $input['eventData']['product']['reference'];
        $transaction_type = $input['eventData']['product']['type'];
        $transaction_ref = $input['eventData']['transactionReference'];
        $payment_ref = $input['eventData']['paymentReference'];
        $payment_from = $input['eventData']['paymentSourceInformation'];
        $amount = $input['eventData']['amountPaid'];
        $transaction = Transaction::whereTrx($transaction_ref)->first();
        $fee = env('DEDICATEDACCOUNTFEE');

        if($transaction)
        {
            return 'Transaction already processed';
        }
        $user = User::whereAccountRef($account_ref)->firstOrFail();
        $user->balance += $amount;
        $user->save();
        $user = User::whereAccountRef($account_ref)->firstOrFail();

        $commission = (@$amount / 100) * @$fee;
        $credit = $amount - $commission;
        
        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $user->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via dedicated account number';
        $transaction->trx          = $transaction_ref;
        $transaction->remark       = 'Funding via dedicated account number';
        $transaction->save(); 
        return 'Transaction Successful';
    }  

    public function vpaywebhook()
    {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true); 
        $transaction_type = 'NUBAN';
        $transaction_ref = $input['reference'];
        $session_id = $input['session_id'];
        $account_number = $input['account_number'];
        $amount = $input['amount'];
        $timestamp = $input['timestamp'];
        $originator_account_name = $input['originator_account_name'];
        $originator_account_number = $input['originator_account_number'];
        $originator_bank = $input['originator_bank'];
        $transaction = Transaction::whereTrx($transaction_ref)->first();
        if($transaction)
        {
            return response(['Message'=>'Transaction already processed'], 400);
        }
        $customer = Customer::whereAccountNumber($account_number)->first();
        if(!$customer)
        {
            return response(['Message'=>'Customer NUBAN Not Found'], 400);
        }
        $user = User::whereId($customer->user_id)->first();
        if(!$user)
        {
            return response(['Message'=>'Merchant Account Not Found'], 400);
        }
        
        $fee = env('VPAY_ACCOUNT_FEE');
        $commission = (@$amount / 100) * @$fee;
        $credit = $amount - $commission;
        $user->balance += $credit;
        $user->save();
        
        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = round($credit);
        $transaction->val_1        = json_encode($input);
        $transaction->post_balance = $user->balance;
        $transaction->charge       = round($commission);
        $transaction->trx_type     = '+';
        $transaction->details      = 'Wallet funding via API using virtual account number';
        $transaction->trx          = $transaction_ref;
        $transaction->remark       = 'Funding via dedicated virtual account number';
        $transaction->save(); 
        //SEND WEBHOOK NOTIFICATION START;
            $url = $user->webhook_url;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            $headers = array(
                "Authorization: Token ".$user->api_key."",
                "Content-Type: application/json",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $code = getTrx();
            $data = <<<DATA
            {
                "amount_requested": "$amount",
                "transaction_fee": "$commission",
                "amount_credited": "$credit",
                "transaction_ref": "$transaction_ref",
                "credit_account_number": "$account_number",
                "originator_account_name": "$originator_account_name",
                "originator_account_number": "$originator_account_number",
                "originator_bank": "$originator_bank",
                "transaction_date": "$timestamp"
            }
            DATA;
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            curl_close($curl);
            //var_dump($resp);
        //END SEND WEBHOOK NOTIFCATION
        return response(['Message'=>'Merchant Account Funded Successfuly'], 200);
    }  


    public function savings(){

        try{
        $general = GeneralSetting::first();
        $target = Savings::where('status', 1)->where('mature', '<=', Carbon::now())->get();
        $recurrent = Savings::where('status', 1)->where('next_recurrent', '<=', Carbon::now())->get();
        //return $recurrent;
        foreach($target as $data)
        {
        $user = User::where('id', $data->user_id)->first();
        $user->balance += $data->balance ? $data->balance : 0;
        $user->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount =  $data->balance ? $data->balance : 0;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '+';
        $transaction->remark = 'savings';
        $transaction->details = 'Savings Credited To Wallet On Due Date';
        $transaction->trx = getTrx();
        $transaction->save();

        $data->status = 0;
        $data->balance = 0;
        $data->save();
        }

        foreach($recurrent as $recdata)
        {
        //return $recdata;

        $user = User::where('id', $recdata->user_id)->first();
        if($recdata->recurrent > $recdata->recurrent_count)
        {

             if($user->balance >= $recdata->amount)
             {
             $user->balance -= $recdata->amount;
             $user->save();

             $recdata->balance += $recdata->amount;
             $recdata->recurrent_count += 1;
             $recdata->next_recurrent = Carbon::parse(Carbon::now())->addDays($recdata->cycle);
             $recdata->save();

             $code = getTrx();
             $pay = new SavingPay();
             $pay->user_id = $user->id;
             $pay->saving_id = $recdata->reference;
             $pay->plan_id = $recdata->type;
             $pay->amount =  $recdata->amount;
             $pay->balance = $recdata->balance;
             $pay->trx = $code;
             $pay->status = 1;
             $pay->save();

             $transaction = new Transaction();
             $transaction->user_id = $user->id;
             $transaction->amount = $recdata->amount;
             $transaction->post_balance = $user->balance;
             $transaction->charge = 0;
             $transaction->trx_type = '-';
             $transaction->remark = 'savings';
             $transaction->details = 'Fund Debited From Wallet To Service Recurrent Savings';
             $transaction->trx = $code;
             $transaction->save();

             }

        }
             if($recdata->recurrent <= $recdata->recurrent_count)
             {
             $user->balance += $recdata->balance;
             $user->save();

             $recdata->status = 0;
             $recdata->balance = 0;
             $recdata->save();
             }


        }

    }
    catch(\Exception $ex){
        $admin = Admin::first();
        sendGeneralEmail($admin->email, $ex->getMessage(), $ex->getMessage(), '');
        \Log::error('CronController -> investment() line '. __LINE__ .': '.$ex->getMessage() ."\n");
    }
    return 'Savings Cron Successful';

     return 'Savings Cron Successful';

}


    public function fixed()
    {
        try {
            $allFdr = Fdr::running()->whereDate('next_installment_date', '<=', now()->format('y-m-d'))->with('user:id,username,balance')->get();

            foreach ($allFdr as $fdr) {
                self::payFdrInstallment($fdr);
            }
            return 'Fixed Cron Successful';

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public static function payFdrInstallment($fdr)
    {
        $amount                     = $fdr->per_installment;
        $user                       = $fdr->user;
        $fdr->next_installment_date = $fdr->next_installment_date->addDays($fdr->installment_interval);
        $fdr->profit += $amount;
        $fdr->save();

        $user->balance += $amount;
        $user->save();

        $installment                   = new Installment();
        $installment->installment_date = $fdr->next_installment_date->subDays($fdr->installment_interval);
        $installment->given_at         = now();
        $installment->user_id         = $user->id;
        $installment->amount         = $amount;
        $fdr->installments()->save($installment);

        $transaction               = new Transaction();
        $transaction->user_id      = $user->id;
        $transaction->amount       = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Fixed Deposit Interest Received';
        $transaction->remark       = 'fixed_deposit_interest';
        $transaction->trx          = $fdr->fdr_number;
        $transaction->save();
    }

      

    public function cryptoWallet(Request $request)
    {

        $input = $request->all();
        $u = Cryptowallet::where('address', $input['address'])->first();
        $currency = Cryptocurrency::whereSymbol($input['coin_short_name'])->first();
        $amount = $input['amount'];

        $baseurl = "https://coinremitter.com/api/v3/get-coin-rate";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $baseurl,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));
		$response = curl_exec($curl);
		$reply = json_decode($response,true);
		curl_close($curl);
		$rate = $reply['data'][$currency->symbol]['price'];
        $usd = $rate * $amount;



        if ($u) {
            $receive = Cryptotrx::where('trxid', $input['id'])->whereType('receive')->first();
            //$send = Cryptotrx::where('trxid', $input['id'])->whereType('send')->first();

            if($input['type'] == 'receive')
        {
            if(!$receive)
            {
            $u->balance += $amount;
            $u->save();

            $w['user_id'] = $u->user_id;
            $w['coin_id'] = $u->coin_id;
            $w['amount'] = $input['amount'];
            $w['usd'] = $usd;
            $w['address'] = $input['address'];
            $w['type'] = $input['type'];
            $w['trxid'] = $input['id'];
            $w['hash'] = $input['txid'];
            $w['explorer_url'] = $input['explorer_url'];
            $w['wallet_id'] = $input['wallet_id'];
            $w['status'] = 1;
            $result = Cryptotrx::create($w);
            }

         }
            return response(['Message'=>'Wallet Credited'], 200);
        }
        elseif(!$u){
            return response(['Message'=>'Wallet Not Found'], 200);
        }
        else{
            return response(['Message'=>'Transaction Not Found'], 200);
        }
    }



    public function cryptoWallets(Request $request)
    {
        $input = $request->all();
        $u = User::where('eth_wallet_address', $input['address'])->first();
       // $currency = Currency::whereSymbol($input['coin_short_name'])->first();
        $amount = $input['amount'];
        if ($u) {
           
            if($input['type'] == 'receive')
        {
            if(!$receive)
            {
            $u->eth_balance += $amount;
            $u->save();
            }

         }

         return response(['Message'=>'Wallet Credited'], 200);


        }
        elseif(!$us){
            return response(['Message'=>'Wallet Not Found'], 200);
        }
        else{
            return response(['Message'=>'Transaction Not Found'], 200);
        }
    }



 

	 
}