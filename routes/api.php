<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('v1', 'ApiController@process')->name('api.v1');
Route::post('/verify/voucher', 'SiteController@verifypinPost')->name('api.verifyvoucher');
Route::any('/strowallet/webhook', 'ApiController@strowalletwebhook')->name('api.nuban.strowalletwebhook');
Route::any('/paylony/webhook', 'ApiController@paylonywebhook')->name('api.nuban.paylonywebhook');
Route::any('/monnify/webhook', 'ApiController@monnifywebhook')->name('api.nuban.monnifywebhook');
Route::any('/vpay/webhook', 'ApiController@vpaywebhook');
Route::any('/savings/cronjob', 'ApiController@savings')->name('api.savings');
Route::any('/fixed/cronjob', 'ApiController@fixed')->name('api.fixed');
Route::any('/crypto/wallet', 'ApiController@cryptoWallet');
Route::any('/wireless/xnomba', 'ApiController@wirelessxnomba');
Route::any('/wireless/xnomba/balance', 'ApiController@wirelessXnombaBalance');
Route::any('/wireless/xnomba/transfer', 'ApiController@wirelessXnombaPayout'); 