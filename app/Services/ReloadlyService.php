<?php
// app/Services/ReloadlyService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ReloadlyService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $token;
    protected $mode;

    public function __construct()
    {
        $this->mode = config('services.reloadly.mode', 'sandbox');
        $this->baseUrl = $this->mode === 'live'
            ? 'https://topups.reloadly.com'
            : 'https://topups-sandbox.reloadly.com';

        $this->clientId = config('services.reloadly.client_id');
        $this->clientSecret = config('services.reloadly.client_secret');
    }

    public function getToken()
    {
        return Cache::remember('reloadly_token', 3500, function () {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/com.reloadly.topups-v1+json'
            ])->post('https://auth.reloadly.com/oauth/token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'client_credentials',
                'audience' => $this->baseUrl
            ]);

            if (!$response->successful()) {
                Log::error('Failed to get Reloadly token', [
                    'status' => $response->status(),
                    'response' => $response->json()
                ]);
                throw new \Exception('Failed to authenticate with payment provider');
            }

            return $response->json()['access_token'];
        });
    }

    public function getOperators($countryCode)
    {
        return $this->makeRequest('GET', "/operators/countries/{$countryCode}", [
            'includeData' => 'false',
            'includeBundles' => 'false'
        ]);
    }

    public function getOperatorDetails($operatorId)
    {
        return $this->makeRequest('GET', "/operators/{$operatorId}");
    }

    public function purchaseAirtime($data)
    {
        return $this->makeRequest('POST', '/topups', $data);
    }

    protected function makeRequest($method, $endpoint, $params = [])
    {
        $url = $this->baseUrl . $endpoint;
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->withHeaders([
                'Accept' => 'application/com.reloadly.topups-v1+json',
                'Content-Type' => 'application/json'
            ])
            ->timeout(30)
            ->retry(3, 100)
            ->{$method}($url, $method === 'GET' ? $params : []);

        if (!$response->successful()) {
            Log::error('Reloadly API error', [
                'url' => $url,
                'status' => $response->status(),
                'response' => $response->json()
            ]);
            throw new \Exception('Failed to process request with payment provider');
        }

        return $response->json();
    }
}
