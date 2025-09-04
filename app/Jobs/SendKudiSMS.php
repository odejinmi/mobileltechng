<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendKudiSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $kudisms;
    protected $mobile;
    protected $message;
    protected $smstype;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($kudisms, $mobile, $message, $smstype)
    {
        $this->kudisms = $kudisms;
        $this->mobile = $mobile;
        $this->message = $message;
        $this->smstype = $smstype;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->smstype == "bc") {
            Log::error('Something went wrong! 12  '.$this->message. "  ". $this->smstype);
            $this->sendkudibroadcast($this->kudisms, $this->mobile, $this->message);
        }else{
            Log::error('Something went wrong! 1234  '.$this->message. "  ". $this->smstype);
// 2. Extract value after the comma
            $parts = explode(',', $this->message);
            $lastPart = trim(end($parts)); // "12345"
            $this->sendkudiwhatsapp($this->kudisms, $this->mobile, $lastPart);
            $this->sendkudiotp($this->kudisms, $this->mobile, $lastPart);
        }
    }


    public function sendkudiwhatsapp($kudisms, $mobile,$message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.kudisms.net/api/whatsapp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token='.$kudisms->api_key.
                '&recipient='.$mobile.
                '&template_code='.$kudisms->whatsapptemplatecode.
                '&parameters='.$message.
                '&button_parameters=xxxx%2Cxxxx%2Cxxx
                &header_parameters=xxxx%2Cxxxx',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd("cURL Error #:" . $err);
            echo "cURL Error #:" . $err;
            return [];
        }
        $reply = json_decode($response,true);
//        dd($reply);
        return $reply;
    }
    public function sendkudiotp($kudisms, $mobile,$message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.kudisms.net/api/otp?token=xxx&senderID=xxx&recipients=xxx&otp=xxx&appnamecode=xxx&templatecode=xxx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "token": "'. $kudisms->api_key.'",
                "senderID": "'.$kudisms->sender.'",
                "recipients": "'.$mobile.'",
                "otp": "'.$message.'",
                "appnamecode": "'.$kudisms->appnamecode.'",
                "templatecode": "'.$kudisms->smstemplatecode.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
//            dd("cURL Error #:" . $err);
            echo "cURL Error #:" . $err;
            return [];
        }
        $reply = json_decode($response,true);
//        dd($reply);
        return $reply;
    }
    public function sendkudibroadcast($kudisms, $mobile,$message)
    {
        Log::info('Sending to KudiSMS API', [
            'url' => 'https://my.kudisms.net/api/corporate',
            'data' => [
                'token' => $kudisms->api_key,
                'senderID' => $kudisms->sender,
                'recipients' => $mobile,
                'message' => $message,
                'gateway' => '2',
            ]
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.kudisms.net/api/corporate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'token' => $kudisms->api_key,
                'senderID' => $kudisms->sender,
                'recipients' => $mobile,
                'message' => $message,
                'gateway' => '2'),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);


        curl_close($curl);

        if ($err) {
            Log::error('Something went wrong!  '.$err);
            echo "cURL Error #:" . $err;
            return [];
        }
        Log::error('Something went wrong! tolu '. $response);
        $reply = json_decode($response,true);

        Log::error('Something went wrong!  '.$reply);
        return $reply;
    }
}
