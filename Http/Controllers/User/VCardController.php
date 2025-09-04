<?php
namespace App\Http\Controllers\User;
use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\VCardCustomers;
use App\Models\VCard;
use App\Models\Transaction;
use App\Models\VCardWithdraw;
use DB;
use validator;
use Carbon\Carbon;
use App\Models\User;
class VCardController extends Controller
{
 
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
        $this->public_key = 'BR7AVKT3ZNY25CGC7EDX4FPJHPUP9V';
        $this->api_url = 'https://strowallet.com/api';
        $this->mode = 'sandbox';
    } 
    
    public function showCreateForm()
    {
        $pageTitle = 'Virtual Card';
        $customer = VCardCustomers::where(['user_id'=>auth()->user()->id])->first();
        return view($this->activeTemplate . 'user.virtual_card.create', compact('pageTitle','customer'));
    }
    private function generateNumericID($length = 9) 
    {
        $idNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $idNumber .= random_int(0, 9);
        }
        return $idNumber;
    }
    public function savedata(Request $request)
    {
        $validatedData = $request->validate([
            'house_number' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'date_of_birth' => 'required',
            'line' => 'required|string|max:255',
            'zip_code' => 'required',
        ]);
        $house_number = $request->house_number;
        $phone_number = $request->phone_number;
        $date_of_birth = $request->date_of_birth;
        $line = $request->line;
        $zip_code = $request->zip_code;
        $id_number = $this->generateNumericID();
        $user = auth()->user();
        $curl = curl_init();
        $postData = [
            'public_key' => $this->public_key,
            'houseNumber' => $house_number,
            'firstName' => $user->firstname,
            'lastName' => $user->lastname,
            'idNumber' => $id_number,
             'customerEmail' => $user->email,
            'phoneNumber' => $phone_number,
            'dateOfBirth' => $date_of_birth,
            'idImage' => $idImage,
            'userPhoto' => $userPhoto,
            'line1' => $line,
            'state' => 'Accra',
            'zipCode' => $zip_code,
            'city' => 'Accra',
            'country' => 'Ghana',
            'idType' => 'PASSPORT'
        ];
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_url.'/bitvcard/create-user/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        if(isset($response->success) && $response->success)
        {
            $api_response = $response->response;
            $bitvcard_customer_id = isset($api_response->bitvcard_customer_id) ? $api_response->bitvcard_customer_id:'';
            $card_brand = isset($api_response->card_brand) ? $api_response->card_brand:'';
            $customer = new VCardCustomers();
            $customer->user_id = $user->id;
            $customer->house_number = $house_number;
            $customer->first_name = $user->firstname;
            $customer->last_name = $user->lastname;
            $customer->id_number = $id_number;
            $customer->customer_email = $postData['customerEmail'];
            $customer->phone_number = $phone_number;
            $customer->date_of_birth = date('Y-m-d H:i:s',strtotime($date_of_birth));
            $customer->line = $line;
            $customer->state = $postData['state'];
            $customer->zip_code = $zip_code;
            $customer->city = $postData['city'];
            $customer->country = $postData['country'];
            $customer->id_image = $postData['idImage'];
            $customer->user_photo = $postData['userPhoto'];
            $customer->id_type = $postData['idType'];
            $customer->bitvcard_customer_id = $bitvcard_customer_id;
            $customer->card_brand = $card_brand;
            $customer->save();
            $notify[] = ['success', 'Customer created!'];
            return redirect()->route('user.create.customer')->withNotify($notify);
        }
        else
        {
            $notify[] = ['error', 'Error try again!'];
            return redirect()->route('user.create.customer')->withNotify($notify);
        }
    }
    public function create_card()
    {
        $pageTitle       = ' Card';
        return view($this->activeTemplate . 'user.virtual_card.create_card', compact('pageTitle'));
    }
   public function save_card(Request $request)
{
    $validatedData = $request->validate([
        'card_holder_name' => 'required',
        'amount' => 'required',
    ]);

    $general = gs();
    if ($general->virtualcard == 0) {
        $notify[] = ['error', 'Feature is currently disabled'];
        return back()->withNotify($notify);
    }

    $user = User::find(auth()->user()->id);

    // Set static fee structure
    $conversionRate = 1720; // $1 = 1600 NGN
    $percentageFee = 0.019; // 1.9%
	$fixedFee = 3268; // 3268 NGN fixed fee

    // Convert amount from $ to NGN
    $amountInNaira = $request->amount * $conversionRate;

    // Calculate total fee
    $fee = ($percentageFee * $amountInNaira) + $fixedFee;

    // Check if the user's balance is sufficient
    if($fee > $user->balance)
    {
        $notify[] = ['error', 'Sorry, you do not have enough balance to make this request'];
        return back()->withNotify($notify);
    }

    $name_on_card = $request->card_holder_name;
    $amount = $request->amount;

    if($amountInNaira > $user->balance)
    {
        $notify[] = ['error', 'Sorry, you do not have enough balance to make this request'];
        return back()->withNotify($notify);
    }

    $customer = VCardCustomers::where(['user_id' => auth()->user()->id])->first();
    $postData = [
        'public_key' => $this->public_key,
        'name_on_card' => $name_on_card,
        'card_type' => 'visa',
        'amount' => $amount,
        'customerEmail' => $customer->customer_email,
       // 'mode' => $this->mode,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $this->api_url . '/bitvcard/create-card',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_HTTPHEADER => [
            'accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);

    if (isset($response->success) && $response->success) {
        $api_response = $response->response;
        $card = new VCard();
        $card->user_id = $user->id;
        $card->name_on_card = $api_response->name_on_card;
        $card->card_id = $api_response->card_id;
        $card->card_created_date = $api_response->card_created_date;
        $card->card_type = $api_response->card_type;
        $card->brand = $api_response->card_brand;
        $card->card_user_id = $api_response->card_user_id;
        $card->reference = $api_response->reference;
        $card->status = $api_response->card_status;
        $card->customer_id = $api_response->customer_id;
        $card->bitvcard_customer_id = $customer->bitvcard_customer_id;
        $card->amount = $amount;
        $card->save();

        // Update the user's balance and save
        $user->balance -= $fee;
        $user->save();

        // Create a transaction record
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $amountInNaira; // Total amount in NGN
        $transaction->post_balance = $user->balance;
        $transaction->charge = $fee; // Total fee in NGN
        $transaction->trx_type = '-';
        $transaction->details = 'Virtual card created';
        $transaction->trx = getTrx();
        $transaction->remark = 'Virtual card created';
        $transaction->save();

        $notify[] = ['success', 'Card Created successfully'];
        return redirect()->route('user.list.card')->withNotify($notify);
    } else {
        $notify[] = ['error', 'Error, try again!'];
        return redirect()->route('user.create.customer')->withNotify($notify);
    }
}

    public function list_cards()
    {
        $pageTitle = 'Virtual Card';
        $customer = VCardCustomers::where(['user_id'=>auth()->user()->id])->first();
        $vcards = VCard::where(['user_id'=>auth()->user()->id])->paginate(10);
        return view($this->activeTemplate . 'user.virtual_card.list_cards', compact('pageTitle','customer','vcards'));
    }
    public function view_card($id = null)
    {
        $pageTitle = 'View Card';
        $customer = VCardCustomers::where(['user_id'=>auth()->user()->id])->first();
        $vcards = VCard::where(['id'=>$id,'user_id'=>auth()->user()->id])->first();
        $this->check_withdraw_status();
        $cardDetails = $this->card_detail($vcards->card_id);
        
        //return $cardDetails;
        $vcards->card_name = $cardDetails->card_name ?? '';
        // $vcards->card_id = $cardDetails->card_id ?? '';
        $vcards->card_type = $cardDetails->card_type ?? '';
        $vcards->brand = $cardDetails->card_brand ?? '';
        $vcards->card_number = $cardDetails->card_number ?? '';
        $vcards->status = $cardDetails->card_status ?? '';
        $vcards->cvv = $cardDetails->cvv ?? '';
        $vcards->expiry_month = @date('m',strtotime($cardDetails->expiry)) ?? '';
        $vcards->expiry_year = @date('y',strtotime($cardDetails->expiry)) ?? '';
        $vcards->save();
        $cardTransactions = $this->card_transaction($vcards->card_id);
        $cardDetails = (array)$cardDetails;
        return view($this->activeTemplate . 'user.virtual_card.detail', compact('pageTitle','customer','vcards','cardDetails','cardTransactions'));
    }
    public function card_detail($card_id = null)
    {
        $postData = [
            'public_key' => $this->public_key,
            'card_id' => $card_id,
           // 'mode' => $this->mode,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_url.'/bitvcard/fetch-card-detail',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        $card_detail = isset($response->response->card_detail) ? $response->response->card_detail:'';
        return $card_detail;
    }
    public function card_transaction($card_id = null)
    {
        $postData = [
            'public_key' => $this->public_key,
            'card_id' => $card_id,
           // 'mode' => $this->mode,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_url.'/bitvcard/card-transactions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        return $response;
    }
    public function fund_card($id = null)
    {
        $pageTitle = 'Fund Card';
        $vcards = VCard::where(['id'=>$id,'user_id'=>auth()->user()->id])->first();
        return view($this->activeTemplate . 'user.virtual_card.fund_card', compact('pageTitle','vcards'));
    }
   public function post_fund_card(Request $request, $card_id = null)
{
    $validatedData = $request->validate([
        'amount' => 'required',
    ]);

    $amount = $request->amount;
    $general = gs();
    $usdrate = 1720; // Fixed conversion rate for USD to NGN
    $user = User::find(auth()->user()->id);

    // Set static fee structure
    $percentageFee = 0.019; // 1.9%
	$fixedFee = 3268; // 3268 NGN fixed fee
    // Calculate total fee in NGN
    $fee = ($percentageFee * ($amount * $usdrate)) + $fixedFee;
    // Convert amount to NGN
    $amountInNaira = $amount * $usdrate;
    // Calculate total cost (amount + fee)
    $total = $amountInNaira + $fee;

    // Check if the user's balance is sufficient
    if ($total > $user->balance) {
        $notify[] = ['error', 'Sorry, you do not have enough balance to make this request'];
        return back()->withNotify($notify);
    }

    $postData = [
        'public_key' => $this->public_key,
        'card_id' => $card_id,
        'amount' => $amount,
      //  'mode' => $this->mode,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $this->api_url . '/bitvcard/fund-card',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_HTTPHEADER => [
            'accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);
    $message = isset($response->message) ? $response->message:'';
    if (isset($response->apiresponse->status) && $response->apiresponse->status) {
        // Deduct the total amount (including fees) from the user's balance
        $user->balance -= $total;
        $user->save();

        // Create a transaction record
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $amountInNaira; // Total amount in NGN
        $transaction->post_balance = $user->balance;
        $transaction->charge = $fee; // Total fee in NGN
        $transaction->trx_type = '-';
        $transaction->details = 'Fund virtual card';
        $transaction->trx = getTrx();
        $transaction->remark = 'Fund card';
        $transaction->save();
        $notify[] = ['success', 'Card funded successfully'];
        return back()->withNotify($notify);
    } else {
        die();
        $notify[] = ['error', $message];
        return back()->withNotify($notify);
    }
}

    public function withdraw_card($id = null)
    {
        $pageTitle = 'Withdraw Card';
        $vcards = VCard::where(['id'=>$id,'user_id'=>auth()->user()->id])->first();
        return view($this->activeTemplate . 'user.virtual_card.withdraw', compact('pageTitle','vcards'));
    }
    public function post_withdraw_card(Request $request, $card_id = null)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0.01',  // Ensure 'amount' is numeric and greater than 0
        ]);
        $vcards = VCard::where(['card_id'=>$card_id,'user_id'=>auth()->user()->id])->first();
        $amount = $validatedData['amount'];
        $user = User::find(auth()->user()->id);

        $postData = [
            'public_key' => $this->public_key,
            'card_id' => $card_id,
            'amount' => $amount,
        ];
        $queryString = http_build_query($postData);
        $url = $this->api_url . '/bitvcard/card_withdraw?' . $queryString;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        if (isset($response->success) && $response->success) {
            $status = $response->response->status;
            $amount = $response->response->data->amount;
            $reference = $response->reference;

            $card_withdraw = new VCardWithdraw();
            $card_withdraw->reference = $reference;
            $card_withdraw->status = $status;
            $card_withdraw->amount = $amount;
            $card_withdraw->save();
            $notify[] = ['success', 'Card withdrawal successfully submitted'];
            return redirect()->route('user.view.card',$vcards->id)->withNotify($notify);
        } else {
            $notify[] = ['error', isset($response->message) ? $response->message : 'An error occurred'];
            return back()->withNotify($notify);
        }
    }


    private function check_withdraw_status()
    {
        $vcardwithdraw = VCardWithdraw::where(['user_id'=>auth()->user()->id])->get();
        $user = User::find(auth()->user()->id);
        if(!empty($vcardwithdraw))
        {
            foreach($vcardwithdraw as $key=>$row)
            {
                $cardwithdraw = VCardWithdraw::where(['user_id'=>auth()->user()->id,'id'=>$row->id])->first();
                $postData = [
                    'reference' => isset($row->reference) ? $row->reference:'',
                    'public_key' => $this->public_key,
                ];
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => $this->api_url.'/bitvcard/getcard_withdrawstatus',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => http_build_query($postData),
                    CURLOPT_HTTPHEADER => [
                        'accept: application/json',
                        'Content-Type: application/x-www-form-urlencoded'
                    ],
                ]);
                $response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($response);
                if(isset($response->status) && strtolower($response->status) == 'completed')
                {
                    $amount = $response->amount;
                    $fee = 0;
                    $user = User::find($row->user_id);
                    $user->balance += $amount;
                    $user->save();

                    $transaction               = new Transaction();
                    $transaction->user_id      = $user->id;
                    $transaction->amount       = $amount;
                    $transaction->post_balance = $user->balance;
                    $transaction->charge       = $fee;
                    $transaction->trx_type     = '+';
                    $transaction->details      = 'Withdraw virtual card';
                    $transaction->trx          = getTrx();
                    $transaction->remark       = 'Withdraw card';
                    $transaction->save();
                    $cardwithdraw->status = $response->status;
                    $cardwithdraw->save();
                }
            }
        }
    }
   public function freez_card($id = null)
{
    $vcards = VCard::where(['id' => $id, 'user_id' => auth()->user()->id])->first();
    $card_id = $vcards->card_id;

    $postData = [
        'action' => 'freeze',
        'card_id' => $card_id,
        'public_key' => $this->public_key,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $this->api_url.'/bitvcard/action/status',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_HTTPHEADER => [
            'accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);

    if (isset($response->status) && $response->status) {
        $notify[] = ['success', $response->message];
    } else {
        // Handle error case if status is false
        $errorMessage = isset($response->message) ? $response->message : 'An unknown error occurred';
        $notify[] = ['error', $errorMessage];
    }

    return back()->withNotify($notify);
}

    public function unfreez_card($id = null)
{
    $vcards = VCard::where(['id' => $id, 'user_id' => auth()->user()->id])->first();
    $card_id = $vcards->card_id;

    $postData = [
        'action' => 'unfreeze',
        'card_id' => $card_id,
        'public_key' => $this->public_key,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $this->api_url.'/bitvcard/action/status',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($postData),
        CURLOPT_HTTPHEADER => [
            'accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);

    if (isset($response->status) && $response->status) {
        $notify[] = ['success', $response->message];
    } else {
        // Handle error case if status is false
        $errorMessage = isset($response->message) ? $response->message : 'An unknown error occurred';
        $notify[] = ['error', $errorMessage];
    }

    return back()->withNotify($notify);

    }
}
