<?php

use App\Constants\Status;
use App\Lib\GoogleAuthenticator;
use App\Models\Cart;
use App\Models\Extension;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Review;
use App\Models\Referral;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use App\Lib\Captcha;
use App\Lib\ClientInfo;
use App\Lib\CurlRequest;
use App\Lib\FileManager;
use App\Notify\Notify;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Session\Session;

function systemDetails()
{
    $system['name']          = 'SMART PAY MOBILE';
    $system['version']       = '1.0';
    $system['build_version'] = '4.3.6';
    return $system;
}

function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}

function verificationCode($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = (int) ($min - 1) . '9';
    return random_int($min, $max);
}


function substrinput($tring)
{
    $length = strlen($tring);
    return substr_replace($tring, '********', 5, $length - 4);
}

function bgcolor()
{
    $general = gs();
    return "style= background-color:".$general->base_color."";
}

function gradient()
{
    $general = gs();
    return "style= background:linear-gradient(135deg,".$general->base_color.",".$general->secondary_color."); opacity: 0.0 - 1.0;";
}

function gradient2()
{
    $general = gs();
    return 'style="background: rgb(240,255,213); background: linear-gradient(90deg, rgba(240,255,213,1) 0%, rgba(255,154,230,0.17550770308123254) 49%, rgba(98,145,10,0.09147408963585435) 100%);"';
}
 
/**
* get access token from header
* */


function monnifyToken()
{
    $url = "https://monnify.com/api/v1/auth/login";
    if(env('MONIFYSTATUS') == 'TEST')
    {
        $url = "https://sandbox.monnify.com/api/v1/auth/login";
    }

    $curl = curl_init();
    $token = base64_encode(env('MONNIFYUAPIKEY').':'.env('MONNIFYSECREY'));
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic '.$token.''
      ),
    ));
    
    $response = curl_exec($curl);
    $reply = json_decode($response, true);
    curl_close($curl);
    return $reply['responseBody']['accessToken'];
}

function getBearerToken() {
$token = request()->bearerToken();
$user = User::whereApiKey($token)->whereStatus(1)->whereVendor(1)->whereApiAccess(1)->first();
// HEADER: Get the access token from the header
    if (empty($token)) {
        $data = 
        [
            'ok' => false,
            'message' => 'Please supply bearer authorization token',
        ];
    }
    if (empty($user)) {
        $data = 
        [
            'ok' => false,
            'message' => 'Invalid bearer authorization token',
        ];
    }
    if ($user) {
        $data = 
        [
            'ok' => true,
            'user' => $user,
            'message' => 'Validation Successful',
        ];
    }
    
    $token = json_encode($data);
    $token = json_decode($token);
    return $token;
}

function getNumber($length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function activeTemplate($asset = false)
{
    $general = gs();
    $template = $general->active_template;
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function activeTemplateName()
{
    $general = gs();
    $template = $general->active_template;
    return $template;
}

function loadReCaptcha()
{
    return Captcha::reCaptcha();
}

function loadCustomCaptcha($width = '100%', $height = 46, $bgColor = '#003')
{
    return Captcha::customCaptcha($width, $height, $bgColor);
}

function verifyCaptcha()
{
    return Captcha::verify();
}

function loadExtension($key)
{
    $extension = Extension::where('act', $key)->where('status', Status::ENABLE)->first();
    return $extension ? $extension->generateScript() : '';
}

function getTrx($length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getAmount($amount, $length = 2)
{
    $amount = round($amount, $length);
    return $amount + 0;
}

function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        } else {
            $printAmount = rtrim($printAmount, '0');
        }
    }
    return $printAmount;
}


function removeElement($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet)
{
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$wallet&choe=UTF-8";
}

function QR($url)
{
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$url&choe=UTF-8";
}


function keyToTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey($text)
{
    return strtolower(str_replace(' ', '_', $text));
}


function strLimit($title = null, $length = 10)
{
    return Str::limit($title, $length);
}


function getIpInfo()
{
    $ipInfo = ClientInfo::ipInfo();
    return $ipInfo;
}


function osBrowser()
{
    $osBrowser = ClientInfo::osBrowser();
    return $osBrowser;
}


function getTemplates()
{
    return null;
}


function getPageSections($arr = false)
{
    $jsonUrl = resource_path('mobileapp/') . str_replace('.', '/', activeTemplate()) . 'sections.json';
    $sections = json_decode(file_get_contents($jsonUrl));
    if ($arr) {
        $sections = json_decode(file_get_contents($jsonUrl), true);
        ksort($sections);
    }
    return $sections;
}


//moveable
function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $image = Image::make($file);
    if ($size) {
        $size = explode('x', strtolower($size));
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if ($thumb) {
        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }

    return $filename;
}

function uploadFile($file, $location, $size = null, $old = null){
    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $file->move($location,$filename);
    return $filename;
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function getImage($image, $size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return 'https://ltechng.co/'.$image;// route('placeholder.image', $size);
    }
    return asset('assets/images/default.png');
    
}


function inputTitle($text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}

function notify($user, $templateName, $shortCodes = null, $sendVia = null, $smstype = "bc", $createLog = true)
{
    $general = gs();
    $globalShortCodes = [
        'site_name' => $general->site_name,
        'site_currency' => $general->cur_text,
        'currency_symbol' => $general->cur_sym,
    ];

    if (gettype($user) == 'array') {
        $user = (object) $user;
    }

    $shortCodes = array_merge($shortCodes ?? [], $globalShortCodes);

    $notify = new Notify($sendVia);
    $notify->templateName = $templateName;
    $notify->shortCodes = $shortCodes;
    $notify->user = $user;
    $notify->smstype = $smstype;
    $notify->createLog = $createLog;
    $notify->userColumn = @isset($user->id) ? $user->getForeignKey() : 'user_id';;
    $notify->send();
}

function getPaginate($paginate = 20)
{
    return $paginate;
}

function paginateLinks($data)
{
    return $data->appends(request()->all())->links();
}

function SubmenuActive($action)
{
    if ($action = false) return 'side-menu--open';
     elseif ($action = true) return request()->routeIs($routeName);
}

function emptyData()
{
    return '<div class="alert customize-alert alert-dismissible text-danger border border-danger fade show remove-close-icon" role="alert">
            <div class="d-flex align-items-center font-medium me-3 me-md-0" >
            <i class="ti ti-info-circle fs-5 me-2 flex-shrink-0 text-danger"></i>
                Data Not Found
            </div>
            </div>';
}

function emptyData2()
{
    return '<center><div class="col-md-6">
    <div class="scard">
      <div class="card-body text-center">
        <img src="'.asset('assets/assets/dist/images/backgrounds/empty-shopping-bag.gif').'" alt="" class="img-fluid mb-4" width="200">
        <h5 class="fw-semibold fs-5 mb-2">Oops, Your data is empty!</h5>
        <p class="mb-3">You dont seem to have any data for this request at the moment. Please check back later.</p>
      </div>
    </div>
  </div></center>';
}

function alert($status,$message)
{
    return '
    <div class="alert customize-alert alert-dismissible text-'.$status.' border border-'.$status.' fade show remove-close-icon" role="alert" >
        <div class="d-flex align-items-center font-medium me-3 me-md-0">
        <i class="ti ti-info-circle fs-5 me-2 flex-shrink-0 text-'.$status.'"></i>
        '.$message.'
        </div>
    </div>';
}

function menuActive($routeName, $type = null, $param = null)
{
    if ($type == 3) $class = 'side-menu--open';
    elseif ($type == 2) $class = 'x-show x-collapse';
    else $class = 'active';

    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) return $class;
        }
    } elseif (request()->routeIs($routeName)) {
        if ($param) {
            $routeParam = array_values(@request()->route()->parameters ?? []);
            if (strtolower(@$routeParam[0]) == strtolower($param)) return $class;
            else return;
        }
        return $class;
    }
}

function fileUploader($file, $location, $size = null, $old = null, $thumb = null)
{
    $fileManager = new FileManager($file);
    $fileManager->path = $location;
    $fileManager->size = $size;
    $fileManager->old = $old;
    $fileManager->thumb = $thumb;
    $fileManager->upload();
    return $fileManager->filename;
}

function fileManager()
{
    return new FileManager();
}

function getFilePath($key)
{
    return fileManager()->$key()->path;
}

function getFileSize($key)
{
    return fileManager()->$key()->size;
}

function getFileExt($key)
{
    return fileManager()->$key()->extensions;
}
function createBadge($type, $text)
{
    return "<span class='badge text-white bg-$type'>" . trans($text) . '</span>';
}
function getFormData($formData)
{
    return json_encode([
        'type'        => $formData->type,
        'is_required' => $formData->is_required,
        'label'       => $formData->name,
        'extensions'  => explode(',', $formData->extensions) ?? 'null',
        'options'     => $formData->options,
        'old_id'      => '',
    ]);
}

function imagePath()
{

    $data['event'] = [
        'path' => 'assets/images/event',
        'size' => '992x740'
    ];
    $data['city'] = [
        'path' => 'assets/images/city',
        'size' => '768x550'
    ];
    
    $data['kyc'] = [
        'path' => 'assets/images/kyc',
    ];

    $data['proof'] = [
        'path' => 'assets/images/proof',
    ];

    $data['trade'] = [
        'path' => 'assets/images/trade',
    ];

    $data['coin'] = [
        'path' => 'assets/images/coins',
    ];

    $data['gateway'] = [
        'path' => 'assets/images/gateway',
        'size' => '800x800',
    ];
    $data['verify'] = [
        'withdraw'=>[
            'path'=>'assets/images/verify/withdraw'
        ],
        'deposit'=>[
            'path'=>'assets/images/verify/deposit'
        ]
    ];
    $data['image'] = [
        'default' => 'assets/images/default.png',
    ];
    $data['withdraw'] = [
        'method' => [
            'path' => 'assets/images/withdraw/method',
            'size' => '800x800',
        ]
    ];
    $data['ticket'] = [
        'path' => 'assets/support',
    ];
    $data['language'] = [
        'path' => 'assets/images/lang',
        'size' => '64x64'
    ];
    $data['logoIcon'] = [
        'path' => 'assets/images/logoIcon',
    ];
    $data['favicon'] = [
        'size' => '128x128',
    ];
    $data['extensions'] = [
        'path' => 'assets/images/extensions',
        'size' => '36x36',
    ];
    $data['seo'] = [
        'path' => 'assets/images/seo',
        'size' => '600x315'
    ];
    $data['storefront_header'] = [
            'path' => 'assets/images/storefront/header',
            'size' => '600x315'
    ];
    $data['storefront_logo'] = [
            'path' => 'assets/images/storefront/logo',
            'size' => '128x128',
    ];
    $data['storefront_product'] = [
            'path' => 'assets/images/storefront/products',
            'size' => '800x800',
    ];
    return $data;
}

function DTnow()
{
    return Carbon::now();
}


function showDate($date, $format = 'M-d-Y')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

function showTime($date, $format = 'h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

function levelCommisionDeposit($id, $amount){
    $usr = $id;
    $i = 1;
    $gnl = GeneralSetting::first();

    $level = Referral::count();
    while($usr!="" || $usr!="0" || $i < $level ) {
            $downline = User::find($usr);
            $refer = User::find($downline->ref_by);

            if($refer == "") {
                break;
            }
            $comission = Referral::where('level',$i)->first();
            if($gnl->commission_type < 1)
            {
                //$com = (@$amount * @$comission->percent)/100;
                //$com = (@$comission->percent / @$amount )*100;
                $com = (@$amount / 100) * @$comission->percent; // Correct Calculation

            }
            if($gnl->commission_type > 0)
            {
             $com = @$comission->percent;
            }
            $refer->ref_balance += $com;
            $refer->save();

            $transaction = new Transaction();
            $transaction->user_id = $refer->id;
            $transaction->amount = $com;
            $transaction->charge = 0;
            $transaction->post_balance = $refer->ref_balance;
            $transaction->trx_type = '+';
            $transaction->trx = getTrx();
            $transaction->remark = 'Referral Earning';
            $transaction->details = 'Referral Earning from '.$downline->username. ' on level '.$i;
            $transaction->save();

            $usr = $refer->id;
            $i++;

            if($i > $level) {
                break;
            }
    }

    return 0;

}

function levelCommision($id, $amount = null){
    $usr = $id;
    $i = 1;
    $gnl = GeneralSetting::first();

    $level = Referral::count();
    while($usr!="" || $usr!="0" || $i < $level ) {
            $downline = User::find($usr);
            $refer = User::find($downline->ref_by);

            if($refer == "") {
                break;
            }
            $comission = Referral::where('level',$i)->first();
            if($gnl->commission_type < 1)
            {
            $com = (@$amount * @$comission->percent)/100;
            }
            if($gnl->commission_type > 0)
            {
             $com = @$comission->percent;
            }
            $refer->ref_balance += $com;
            $refer->save();

            $transaction = new Transaction();
            $transaction->user_id = $refer->id;
            $transaction->amount = $com;
            $transaction->charge = 0;
            $transaction->post_balance = $refer->ref_balance;
            $transaction->trx_type = '+';
            $transaction->trx = getTrx();
            $transaction->remark = 'Referral Earning';
            $transaction->details = 'Referral Earning from '.$downline->username. ' on level '.$i;
            $transaction->save();

            $usr = $refer->id;
            $i++;

            if($i > $level) {
                break;
            }
    }

    return 0;

}


function getTokenGiftcard()
{
    $expire = session()->get('api_token_expire');
    $token = session()->get('api_token');
    if($expire > Carbon::now() && $token != null)
    {
    return $token;
    }
    
    if(env('MODE') == "TEST")
    {
        $client_id = env('CLIENTIDTEST');
        $client_secret = env('CLIENTSECRETTEST');
        $url = "https://giftcards-sandbox.reloadly.com";
    }
    else
    {
        $client_id = env('CLIENTIDLIVE');
        $client_secret = env('CLIENTSECRETLIVE');
        $url = "https://giftcards.reloadly.com";
    }
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://auth.reloadly.com/oauth/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "client_id": "'.$client_id.'",
        "client_secret": "'.$client_secret.'",
        "grant_type": "client_credentials",
        "audience": "'.$url.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $reply = json_decode($response,true);
    if(!isset($reply['access_token']))
    {
        return false;
    }
    $token = $reply['access_token'];
    session()->put('api_token', $token);
    session()->put('api_token_expire', $expire);
    return $reply['access_token'];
}


function diffForHumans($date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}


function showDateTime($date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}


function getContent($dataKeys, $singleQuery = false, $limit = null, $orderById = false)
{
    if ($singleQuery) {
        $content = Frontend::where('data_keys', $dataKeys)->orderBy('id', 'desc')->first();
    } else {
        $article = Frontend::query();
        $article->when($limit != null, function ($q) use ($limit) {
            return $q->limit($limit);
        });
        if ($orderById) {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id')->get();
        } else {
            $content = $article->where('data_keys', $dataKeys)->orderBy('id', 'desc')->get();
        }
    }
    return $content;
}

function getN3TToken()
{
    $username = env('N3TUSERNAME');
    $password = env('N3TPASSWORD');
    $str = $username.':'.$password;
    $token = base64_encode($str);
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://n3tdata.com/api/user',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        "Authorization: Basic ".$token,
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $reply = json_decode($response,true);
    if(!isset($reply['AccessToken']))
    {
        return false;
    }
    $token = $reply['AccessToken'];
    return $reply['AccessToken'];
}

function getVPAYToken()
{
    $url = 'https://services2.vpay.africa/api/service/v1/query/merchant/login';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    $headers = array(
        "publicKey: ".env('VPAY_API_KEY')."",
        "Content-Type: application/json",
            );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $username = env('VPAY_EMAIL');
    $password = env('VPAY_PASSWORD');
    $data = <<<DATA
            {
                "username": "$username",
                "password": "$password"
            }
    DATA;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);
    //var_dump($resp);
    $reply = json_decode($resp,true); 
 
    $session = new Session();
    $tokn = $session->get('vpaytoken'); 
    if(!isset($reply['token']))
    { 
        $token['status'] = $reply['status'];
        $token['message'] = $reply['message'];
        $token['token'] = $tokn;
    }
    else{
        $session->set('vpaytoken', @$reply['token']);
        $token['token'] = $reply['token'];
        $token['status'] = $reply['status'];
        $token['message'] = $reply['message'];
    }
    return $token;
}
 

function getToken($id)
{
    $expire = session()->get('api_token_expire');
    $token = session()->get('api_token');
    if($expire > Carbon::now() && $token != null)
    {
    return $token;
    }

    if(env('MODE') == "TEST")
    {
        $client_id = env('CLIENTIDTEST');
        $client_secret = env('CLIENTSECRETTEST');
        $url = "https://".$id."-sandbox.reloadly.com";
    }
    else
    {
        $client_id = env('CLIENTIDLIVE');
        $client_secret = env('CLIENTSECRETLIVE');
        $url = "https://".$id.".reloadly.com";
    }
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://auth.reloadly.com/oauth/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "client_id": "'.$client_id.'",
        "client_secret": "'.$client_secret.'",
        "grant_type": "client_credentials",
        "audience": "'.$url.'"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $reply = json_decode($response,true);
    if(!isset($reply['access_token']))
    {
        return false;
    }
    $token = $reply['access_token'];
    session()->put('api_token', $token);
    session()->put('api_token_expire', $expire);
    return $reply['access_token'];
}


function get_exchange_rate($currency)
{
    $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.ufitpay.com/v1/fund_virtual_card',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{ 
            "funding_currency": "'.$currency.'"
        }',
        CURLOPT_HTTPHEADER => array(
        'Api-Key: '.env('UFITPAYAPIKEY'),
        'Api-Token: '.env('UFITPAYAPITOKEN'),
        'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $reply = json_decode($response,true);
    if(!isset($reply['access_token']))
    {
        return false;
    } 
    return $reply['access_token'];
}


function gatewayRedirectUrl($type = false)
{
    if ($type) {
        return 'user.home';
    } else {
        return 'user.deposit.index';
    }
}

function verifyG2fa($user, $code, $secret = null)
{
    $authenticator = new GoogleAuthenticator();
    if (!$secret) {
        $secret = $user->tsc;
    }
    $oneCode = $authenticator->getCode($secret);
    $userCode = $code;
    if ($oneCode == $userCode) {
        $user->tv = 1;
        $user->save();
        return true;
    } else {
        return false;
    }
}


function urlPath($routeName, $routeParam = null)
{
    if ($routeParam == null) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}


function showMobileNumber($number)
{
    $length = strlen($number);
    return substr_replace($number, '***', 2, $length - 4);
}

function showEmailAddress($email)
{
    $endPosition = strpos($email, '@') - 1;
    return substr_replace($email, '***', 1, $endPosition);
}

function getRealIP()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ($ip == '::1') {
        $ip = '127.0.0.1';
    }

    return $ip;
}


function appendQuery($key, $value)
{
    return request()->fullUrlWithQuery([$key => $value]);
}

function dateSort($a, $b)
{
    return strtotime($a) - strtotime($b);
}

function dateSorting($arr)
{
    usort($arr, "dateSort");
    return $arr;
}

function gs()
{
    $general = GeneralSetting::first();
    return $general;
}

function general()
{
    $general = Cache::get('GeneralSetting');
    if (!$general) {
        $general = GeneralSetting::first();
        Cache::put('GeneralSetting', $general);
    }
    $globalShortCodes = [
        'site_name' => $general->site_name,
        'cur_text' => $general->cur_text,
        'cur_sym' => $general->cur_sym,
    ];
    return $globalShortCodes;
}

function can($code) {
    return Role::hasPermission($code);
}

function isManager() {
    return authStaff()->designation == Status::ROLE_MANAGER;
}

function authStaff() {
    return auth()->guard('branch_staff')->user();
}