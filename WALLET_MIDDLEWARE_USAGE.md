# Wallet Balance Middleware Usage

## Overview
The `CheckWalletBalance` middleware validates if a user has sufficient balance before processing requests that involve wallet debits.

## Registration
The middleware is registered in `app/Http/Kernel.php` as `wallet.balance`.

## Usage in Routes

### Basic Usage (Main Balance)
```php
Route::post('/purchase', 'PurchaseController@process')
    ->middleware('auth', 'wallet.balance');
```

### Specific Wallet Types
```php
// Check referral balance
Route::post('/referral-purchase', 'ReferralController@process')
    ->middleware('auth', 'wallet.balance:ref');

// Check bonus balance
Route::post('/bonus-purchase', 'BonusController@process')
    ->middleware('auth', 'wallet.balance:bonus');
```

## Controller Implementation

### Example Controller Method
```php
public function processPurchase(Request $request)
{
    $user = auth()->user();
    $amount = $request->input('amount');
    $walletType = $request->input('wallet_type', 'balance'); // Set by middleware
    
    // Perform the actual debit using WalletService
    $success = WalletService::debitAccount($user, $amount, $walletType);
    
    if (!$success) {
        return response()->json([
            'ok' => false,
            'status' => 'danger',
            'message' => 'Transaction failed'
        ], 400);
    }
    
    // Continue with your business logic
    return response()->json([
        'ok' => true,
        'status' => 'success',
        'message' => 'Purchase successful'
    ]);
}
```

## Request Requirements

The middleware expects:
- `amount` field in the request (must be numeric and > 0)
- User must be authenticated

## Response Format

### Success (Balance Sufficient)
- Request continues to the controller
- `wallet_type` is added to the request for controller use

### Error Responses

**Insufficient Balance:**
```json
{
    "ok": false,
    "status": "danger",
    "message": "Insufficient wallet balance"
}
```

**Invalid Amount:**
```json
{
    "ok": false,
    "status": "danger",
    "message": "Invalid amount"
}
```

**Unauthorized:**
```json
{
    "ok": false,
    "status": "danger",
    "message": "Unauthorized"
}
```

## WalletService Methods

The `WalletService` class provides these methods:

```php
// Debit from wallet
WalletService::debitAccount($user, $amount, $wallet);

// Credit to wallet
WalletService::creditAccount($user, $amount, $wallet);

// Get wallet balance
WalletService::getBalance($user, $wallet);

// Available wallet types: 'balance', 'ref', 'bonus'
```

## Migration from BonusService

Replace calls to:
```php
BonusService::debitaccount($user, $amount, $wallet);
```

With:
```php
// In routes: add middleware('wallet.balance:' . $wallet)
// In controllers: WalletService::debitAccount($user, $amount, $wallet);
```
