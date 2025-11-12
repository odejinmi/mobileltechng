<?php
// app/Services/StrowalletService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StrowalletService
{
    protected $config;
    protected $baseUrl;

    public function __construct()
    {
        $this->config = config('services.strowallet');
        $this->baseUrl = rtrim($this->config['endpoint'], '/');
    }

    public function getBanks()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->timeout($this->config['timeout'])
        ->get($this->baseUrl . '/banks/lists', [
            'public_key' => $this->config['key']
        ]);

        if (!$response->successful() || !isset($response->json()['data']['bank_list'])) {
            Log::error('Failed to fetch banks', ['response' => $response->body()]);
            throw new \Exception('Failed to fetch bank list');
        }

        return $response->json()['data']['bank_list'];
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
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->timeout($this->config['timeout'])
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
    }
}
