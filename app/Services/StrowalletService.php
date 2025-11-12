<?php
// app/Services/StrowalletService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StrowalletService
{
    protected $config;
    protected $baseUrl;

    public function __construct()
    {
        $this->config = config('services.strowallet');
        $this->baseUrl = rtrim($this->config['endpoint'], '/');
    }

    /**
     * Get the path to the CA certificate bundle or disable verification if not available
     * 
     * @return string|bool
     */
    protected function getCaBundlePath()
    {
        $cacertPath = storage_path('app/cacert.pem');
        
        try {
            // Try to download the CA cert if it doesn't exist
            if (!file_exists($cacertPath)) {
                $context = stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ]
                ]);
                
                $caBundle = file_get_contents('https://curl.haxx.se/ca/cacert.pem', false, $context);
                if ($caBundle !== false) {
                    file_put_contents($cacertPath, $caBundle);
                    return $cacertPath;
                }
            } else {
                // Verify the existing cert is readable
                if (is_readable($cacertPath)) {
                    return $cacertPath;
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to setup CA bundle: ' . $e->getMessage());
        }
        
        // Fallback: disable SSL verification
        return false;
    }

    public function getBanks()
    {
        try {
            $httpClient = Http::withHeaders([
                'Content-Type' => 'application/json',
            ]);

            // Only set verify if we have a valid CA bundle
            $caBundlePath = $this->getCaBundlePath();
            if ($caBundlePath !== false) {
                $httpClient->withOptions(['verify' => $caBundlePath]);
            } else {
                $httpClient->withOptions(['verify' => false]);
                Log::warning('SSL verification disabled. Using unverified HTTPS connection.');
            }

            $response = $httpClient->timeout($this->config['timeout'])
                ->get($this->baseUrl . '/banks/lists', [
                    'public_key' => $this->config['key']
                ]);

            if (!$response->successful() || !isset($response->json()['data']['bank_list'])) {
                Log::error('Failed to fetch banks', ['response' => $response->body()]);
                throw new \Exception('Failed to fetch bank list: ' . ($response->json()['message'] ?? 'Unknown error'));
            }

            return $response->json()['data']['bank_list'];
        } catch (\Exception $e) {
            Log::error('Error in getBanks: ' . $e->getMessage());
            throw new \Exception('Unable to fetch bank list. Please try again later.');
        }
    }

    public function validateAccount($bankCode, $accountNumber)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->timeout($this->config['timeout'])
        ->get($this->baseUrl . '/banks/get-customer-name', [
            'public_key' => $this->config['key'],
            'bank_code' => $bankCode,
            'account_number' => $accountNumber
        ]);

        $data = $response->json();
        Log::error('Account validation result', ['response' => $response->body()]);
        if (!isset($data['data']['account_name'])) {
            Log::error('Account validation failed', ['response' => $response->body()]);
            throw new \Exception($data['message'] ?? 'Account validation failed');
        }

        return [
            'account_name' => $data['data']['account_name'],
            'session_id' => $data['data']['sessionId'] ?? null
        ];
    }

    public function transferFunds($bankCode, $accountNumber, $amount, $narration, $sessionId)
    {
        try {
            $httpClient = Http::withHeaders([
                'Content-Type' => 'application/json',
            ]);

            // Set SSL verification based on CA bundle availability
            $caBundlePath = $this->getCaBundlePath();
            if ($caBundlePath !== false) {
                $httpClient->withOptions(['verify' => $caBundlePath]);
            } else {
                $httpClient->withOptions(['verify' => false]);
                Log::warning('SSL verification disabled for fund transfer. Using unverified HTTPS connection.');
            }

            $response = $httpClient->timeout($this->config['timeout'])
                ->post($this->baseUrl . '/banks/request', [
                    'public_key' => $this->config['key'],
                    'bank_code' => $bankCode,
                    'amount' => $amount,
                    'narration' => $narration,
                    'name_enquiry_reference' => $sessionId,
                    'account_number' => $accountNumber
                ]);

            $data = $response->json();

            if (!isset($data['success']) || $data['success'] !== true) {
                Log::error('Transfer failed', ['response' => $response->body()]);
                throw new \Exception($data['message'] ?? 'Transfer failed');
            }

            return $data;
        } catch (\Exception $e) {
            Log::error('Error in transferFunds: ' . $e->getMessage());
            throw new \Exception('Unable to process transfer. Please try again later.');
        }
    }
}
