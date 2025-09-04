<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LanguageMiddleware::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'adminPermission'  => \App\Http\Middleware\AdminPermissionMiddleware::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.api' => \App\Http\Middleware\AuthenticateApi::class,
        'checkStatusApi' => \App\Http\Middleware\CheckStatusApi::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'admin' => \App\Http\Middleware\RedirectIfNotAdmin::class,
        'admin.guest' => \App\Http\Middleware\RedirectIfAdmin::class,
        'registration.status' => \App\Http\Middleware\AllowRegistration::class,
        'vendor.account' => \App\Http\Middleware\AllowVendor::class,
        'storefront.status' => \App\Http\Middleware\AllowStorefront::class,
        'utilityglobal.status' => \App\Http\Middleware\AllowUtilityGlobal::class,
        'utilitylocal.status' => \App\Http\Middleware\AllowUtilityLocal::class,
        'betting.status' => \App\Http\Middleware\AllowBetting::class,
        'event.status' => \App\Http\Middleware\AllowEvent::class,
        'loan.status' => \App\Http\Middleware\AllowLoan::class,
        'airtime.status' => \App\Http\Middleware\AllowAirtime::class,
        'internet.status' => \App\Http\Middleware\AllowInternet::class,
        'internetsme.status' => \App\Http\Middleware\AllowInternetSme::class,
        'cabletv.status' => \App\Http\Middleware\AllowCabletv::class,
        'insurance.status' => \App\Http\Middleware\AllowInsurance::class,
        'virtualcard.status' => \App\Http\Middleware\AllowVirtualCard::class,
        'crypto.status' => \App\Http\Middleware\AllowCrypto::class,
        'check.status' => \App\Http\Middleware\CheckStatus::class,
        'kyc.status' => \App\Http\Middleware\KycStatus::class,
        'voucher.status' => \App\Http\Middleware\AllowVoucher::class,
        'savings.status' => \App\Http\Middleware\AllowSavings::class,
        'buy_crypto.status' => \App\Http\Middleware\AllowBuyCrypto::class,
        'escrow.status' => \App\Http\Middleware\AllowEscrow::class,
        'sell_crypto.status' => \App\Http\Middleware\AllowSellCrypto::class,
        'swap_crypto.status' => \App\Http\Middleware\AllowSwapCrypto::class,
        'crypto_wallet.status' => \App\Http\Middleware\AllowCryptoWallet::class,
        'buy_giftcard.status' => \App\Http\Middleware\AllowBuyGiftcard::class,
        'giftauto.status' => \App\Http\Middleware\AllowAutoGiftcard::class,
        'sell_giftcard.status' => \App\Http\Middleware\AllowSellGiftcard::class,
        
        'demo' => \App\Http\Middleware\Demo::class,
        'registration.complete' => \App\Http\Middleware\RegistrationStep::class,
        'maintenance' => \App\Http\Middleware\MaintenanceMode::class,
    ];
}
