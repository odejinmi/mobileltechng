<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

//Cron Controller
Route::get('cron', 'CronController@placeOrderToApi')->name('cron');
// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('/new', 'openSupportTicket')->name('open');
    Route::post('/create', 'storeSupportTicket')->name('store');
    Route::get('/view/{ticket}', 'viewTicket')->name('view');
    Route::post('/reply/{ticket}', 'replyTicket')->name('reply');
    Route::post('/close/{ticket}', 'closeTicket')->name('close');
    Route::get('/download/{ticket}', 'ticketDownload')->name('download');
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');
 
 

Route::controller('SiteController')->group(function () { 
    Route::get('/', 'index')->name('home'); 
    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');

});