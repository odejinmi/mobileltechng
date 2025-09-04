<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Auth')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });

    // Admin Password Reset
    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('reset');
        Route::post('reset', 'sendResetCodeEmail');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });

    Route::controller('ResetPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset/{token}', 'showResetForm')->name('reset.form');
        Route::post('reset/change', 'reset')->name('change');
    });
});

 

Route::middleware(['admin','adminPermission'])->group(function () {
    Route::controller('AdminController')->group(function () {
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('profile', 'profile')->name('profile');
        Route::post('profile', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password', 'passwordUpdate')->name('password.update');

        Route::get('top/sold', 'AdminController@topSold')->name('top.sold');
        Route::get('today/sale', 'AdminController@todaySale')->name('today.sale');
        
        //refer
        Route::get('/referral', 'refIndex')->name('referral.index');
        Route::post('/referral', 'refStore')->name('store.refer');
        Route::post('/referral/feature', 'refupdate')->name('store.feature');
  

        //Notification
        Route::get('notifications', 'notifications')->name('notifications');
        Route::get('notification/read/{id}', 'notificationRead')->name('notification.read');
        Route::get('notifications/read-all', 'readAll')->name('notifications.readAll');
 
        Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');
    });


         //============FDR Plan================//
         Route::name('plans.fdr.')->prefix('fdr')->controller('FdrPlanController')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::post('store/{id?}', 'store')->name('save');
            Route::post('status/{id}', 'changeStatus')->name('status');
        });

     
     // WITHDRAW SYSTEM
    Route::controller('WithdrawalController')->name('withdraw.')->prefix('withdraw')->group(function () {

        Route::get('pending', 'pending')->name('pending');
        Route::get('approved', 'approved')->name('approved');
        Route::get('rejected', 'rejected')->name('rejected');
        Route::get('log', 'log')->name('log');
        Route::get('via/{method_id}/{type?}', 'logViaMethod')->name('method');
        Route::get('{scope}/search', 'search')->name('search');
        Route::get('date-search/{scope}', 'dateSearch')->name('dateSearch');
        Route::get('details/{id}', 'details')->name('details');
        Route::post('approve', 'approve')->name('approve');
        Route::post('reject', 'reject')->name('reject');
    });
    Route::controller('WithdrawMethodController')->name('withdraw.')->prefix('withdraw')->group(function () {

        // Withdraw Method
        Route::get('method/', 'methods')->name('method.index');
        Route::get('method/create', 'create')->name('method.create');
        Route::post('method/create', 'store')->name('method.store');
        Route::get('method/edit/{id}', 'edit')->name('method.edit');
        Route::post('method/edit/{id}', 'update')->name('method.update');
        Route::post('method/activate', 'activate')->name('method.activate');
        Route::post('method/deactivate', 'deactivate')->name('method.deactivate');
    });
 
    // Users Manager
    Route::controller('ManageUsersController')->name('users.')->prefix('users')->group(function () {
        Route::get('/', 'allUsers')->name('all');
        Route::get('/kyc/pending', 'kycpending')->name('kyc.pending');
        Route::get('/kyc/approved', 'kycapproved')->name('kyc.approved');
        Route::get('/kyc/approve/{id}', 'kycapprove')->name('kyc.approve');
        Route::get('/kyc/reject/{id}', 'kycreject')->name('kyc.reject'); 
        Route::get('card', 'card')->name('card');
        Route::get('vendor', 'activeVendor')->name('vendor');
        Route::get('active', 'activeUsers')->name('active');
        Route::get('banned', 'bannedUsers')->name('banned');
        Route::get('email-verified', 'emailVerifiedUsers')->name('email.verified');
        Route::get('email-unverified', 'emailUnverifiedUsers')->name('email.unverified');
        Route::get('mobile-unverified', 'mobileUnverifiedUsers')->name('mobile.unverified');
        Route::get('mobile-verified', 'mobileVerifiedUsers')->name('mobile.verified');
        Route::get('with-balance', 'usersWithBalance')->name('with.balance');
        Route::get('detail/{id}', 'detail')->name('detail');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('add-sub-balance/{id}', 'addSubBalance')->name('add.sub.balance');
        Route::get('send-notification/{id}', 'showNotificationSingleForm')->name('notification.single');
        Route::post('send-notification/{id}', 'sendNotificationSingle')->name('notification.single');
        Route::get('login/{id}', 'login')->name('login');
        Route::post('status/{id}', 'status')->name('status');
        Route::any('generate/nuban/{id}', 'generatenuban')->name('generate.nuban');

        //User Data
        Route::get('send-notification', 'showNotificationAllForm')->name('notification.all');
        Route::post('send-notification', 'sendNotificationAll')->name('notification.all.send');
        Route::get('notification-log/{id}', 'notificationLog')->name('notification.log');
    });

    Route::controller('StaffController')->prefix('staff')->name('staff.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('save/{id?}', 'save')->name('save');
        Route::post('switch-status/{id}', 'status')->name('status');
        Route::get('login/{id}', 'login')->name('login');
    });

    Route::controller('TerminalController')->prefix('terminal')->name('terminal.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('index', 'mapPost'); 
        Route::post('unmap/{id}', 'unmapPost')->name('unmap');
        Route::get('fee', 'TerminalFee')->name('fee');
        Route::post('fee', 'TerminalFeePost'); 
        Route::post('fee/update/{id}', 'TerminalFeeUpdate')->name('feeUpdate');
    });


    Route::controller('RolesController')->prefix('roles')->name('roles.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('save/{id?}', 'save')->name('save');
    });


    // Subscriber
    Route::controller('SubscriberController')->name('subscriber.')->prefix('subscriber')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('send-email', 'sendEmailForm')->name('send.email');
        Route::post('remove/{id}', 'remove')->name('remove');
        Route::post('send-email', 'sendEmail')->name('send.email');
    });

    // Deposit Gateway
    Route::name('gateway.')->prefix('gateway')->group(function () {

        // Automatic Gateway
        Route::controller('AutomaticGatewayController')->prefix('automatic')->name('automatic.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('edit/{alias}', 'edit')->name('edit');
            Route::post('update/{code}', 'update')->name('update');
            Route::post('remove/{id}', 'remove')->name('remove');
            Route::post('status/{id}', 'status')->name('status');
        });

        // Manual Methods
        Route::controller('ManualGatewayController')->prefix('manual')->name('manual.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('new', 'create')->name('create');
            Route::post('new', 'store')->name('store');
            Route::get('edit/{alias}', 'edit')->name('edit');
            Route::post('update/{id}', 'update')->name('update');
            Route::post('status/{id}', 'status')->name('status');
        });
    });

    // DEPOSIT SYSTEM
    Route::name('deposit.')->controller('DepositController')->prefix('deposit')->group(function () {
        Route::get('/', 'deposit')->name('list');
        Route::get('pending', 'pending')->name('pending');
        Route::get('rejected', 'rejected')->name('rejected');
        Route::get('approved', 'approved')->name('approved');
        Route::get('successful', 'successful')->name('successful');
        Route::get('initiated', 'initiated')->name('initiated');
        Route::get('details/{id}', 'details')->name('details');

        Route::post('reject', 'reject')->name('reject');
        Route::post('approve/{id}', 'approve')->name('approve');
    });


    //City
    Route::controller('CityController')->prefix('city')->name('city.')->group(function () {
    Route::get('list', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    Route::post('update', 'update')->name('update');
    });

    //Location
    Route::controller('LocationController')->prefix('location')->name('location.')->group(function () {
      Route::get('list', 'index')->name('index');
      Route::post('store', 'store')->name('store');
      Route::post('update', 'update')->name('update');
    });
       
    //Event Management
    Route::controller('EventController')->prefix('event')->name('event.')->group(function () {
    Route::get('list', 'index')->name('index');
    Route::post('store', 'store')->name('type.store');
    Route::post('update', 'update')->name('type.update');
    Route::get('search', 'search')->name('search');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('update/{id}', 'update')->name('update');
    Route::get('sales/{id}', 'SalesInfo')->name('info');
    Route::post('status/approved', 'approvedStatus')->name('status.approved');
    Route::post('status/banned', 'bannedStatus')->name('status.banned');
    Route::post('featured/list/Include', 'featuredInclude')->name('featured.include');
    Route::post('featured/list/remove', 'featuredNotInclude')->name('featured.remove');
    Route::post('status/update', 'updatestatus')->name('update.status');

    Route::get('approved/list', 'approved')->name('approved');
    Route::get('pending/list', 'pending')->name('pending');
    Route::get('cancel/list', 'cancel')->name('cancel');
    Route::get('tickets/{id}', 'tickets')->name('tickets');
    });

    //Event Type
    Route::controller('EventTypeController')->prefix('event')->name('event.')->group(function () {
        Route::get('type/list', 'index')->name('type.index');
        Route::post('type/store', 'store')->name('type.store');
        Route::post('type/update', 'update')->name('type.update');
    });

    //Manage Category
    Route::controller('CategoryController')->prefix('category')->name('category.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store/{id?}', 'store')->name('store');
        Route::post('status/{id}', 'status')->name('status');
        Route::post('delete/{id}', 'delete')->name('delete');
    });


   

    //Payment Account
    Route::controller('RequestAccountController')->prefix('payment/account')->name('paymentaccount.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store/{id?}', 'store')->name('store');
        Route::post('status/{id}', 'status')->name('status');
        Route::post('delete/{id}', 'delete')->name('delete');
        Route::get('request/{id?}', 'request')->name('request');
        Route::get('approve/{id}', 'approve')->name('approve');
        Route::get('decline/{id}', 'decline')->name('decline');
    });

    //LOAN
    Route::name('plans.loan.')->prefix('loan')->controller('LoanPlanController')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('store/{id?}', 'store')->name('save');
        Route::post('status/{id}', 'changeStatus')->name('status');
    });
    Route::name('loan.')->prefix('loan')->controller('LoanController')->group(function () {
        Route::get('all', 'index')->name('index');
        Route::get('running', 'runningLoans')->name('running');
        Route::get('pending', 'pendingLoans')->name('pending');
        Route::get('rejected', 'rejectedLoans')->name('rejected');
        Route::get('paid', 'paidLoans')->name('paid');
        Route::get('due', 'dueInstallment')->name('due');
        Route::post('approve/{id}', 'approve')->name('approve');
        Route::post('reject/{id}', 'reject')->name('reject');
        Route::get('details/{id}', 'details')->name('details');
        Route::get('installments/{id}', 'installments')->name('installments');
    });


    // Savings
    Route::controller('SavingsController')->prefix('savings')->name('savings.')->group(function () {
        Route::get('index', 'log')->name('log');
        Route::get('view/{id}', 'view')->name('view'); 
    });


    // Voucher
    Route::controller('VoucherController')->prefix('voucher')->name('voucher.')->group(function () {
        Route::get('index', 'log')->name('log');
        Route::get('create', 'create')->name('create'); 
        Route::post('create', 'createPost'); 
        Route::get('delete/{id}', 'delete')->name('delete'); 
    });


    // Report
    Route::controller('ReportController')->prefix('report')->name('report.')->group(function () {
        Route::get('transaction', 'transaction')->name('transaction');
        Route::get('login/history', 'loginHistory')->name('login.history');
        Route::get('login/ipHistory/{ip}', 'loginIpHistory')->name('login.ipHistory');
        Route::get('notification/history', 'notificationHistory')->name('notification.history');
        Route::get('email/detail/{id}', 'emailDetails')->name('email.details');
    });

    // Admin Support
    Route::controller('SupportTicketController')->name('ticket.')->prefix('ticket')->group(function () {
        Route::get('/', 'tickets')->name('index');
        Route::get('pending', 'pendingTicket')->name('pending');
        Route::get('closed', 'closedTicket')->name('closed');
        Route::get('answered', 'answeredTicket')->name('answered');
        Route::get('view/{id}', 'ticketReply')->name('view');
        Route::post('reply/{id}', 'replyTicket')->name('reply');
        Route::post('close/{id}', 'closeTicket')->name('close');
        Route::get('download/{ticket}', 'ticketDownload')->name('download');
        Route::post('delete/{id}', 'ticketDelete')->name('delete');
    });

    // Language Manager
    Route::controller('LanguageController')->prefix('language')->name('language.')->group(function () {
        Route::get('/', 'langManage')->name('manage');
        Route::post('/', 'langStore')->name('manage.store');
        Route::post('delete/{id}', 'langDelete')->name('manage.delete');
        Route::post('update/{id}', 'langUpdate')->name('manage.update');
        Route::get('edit/{id}', 'langEdit')->name('key');
        Route::post('import', 'langImport')->name('import.lang');
        Route::post('store/key/{id}', 'storeLanguageJson')->name('store.key');
        Route::post('delete/key/{id}', 'deleteLanguageJson')->name('delete.key');
        Route::post('update/key/{id}', 'updateLanguageJson')->name('update.key');
    });

    // Manual CARD Controller Starts
    Route::controller('CategoryController')->prefix('manual/giftcard')->group(function () {
        Route::get('category', 'category')->name('manual.category.index');
        Route::post('add/category', 'add')->name('add.category');
        Route::post('edit/category', 'edit')->name('edit.category');
        Route::post('featured/category', 'featured')->name('featured.category');
    });
    Route::controller('SubCategoryController')->prefix('manual/giftcard')->group(function () {
        Route::get('sub/category', 'subCategory')->name('manual.sub.category.index');
        Route::post('add/sub/category', 'add')->name('add.sub.category');
        Route::post('edit/sub/category', 'edit')->name('edit.sub.category');
    });

    Route::controller('CardController')->prefix('manual/giftcard')->group(function () {
        Route::get('all/card', 'cardAll')->name('manual.card.index');
        Route::get('pending/request', 'cardPending')->name('manual.card.pending');
        Route::get('successful/request', 'cardSuccess')->name('manual.card.success');
        Route::get('declined/request', 'cardDeclined')->name('manual.card.declined');
        Route::get('card/add/page', 'addPage')->name('card.add.page');
        Route::post('card/add', 'add')->name('card.add');
        Route::get('card/edit/{id}', 'editPage')->name('card.edit.page');
        Route::get('card/approve/{id}', 'Approve')->name('card.approve');
        Route::get('card/reject/{id}', 'Reject')->name('card.reject');
        Route::post('card/edit', 'edit')->name('card.edit');
        Route::post('card/delete', 'delete')->name('card.delete');
     });

    //BILL PAYMENT STARTS
    Route::controller('BillsController')->prefix('bills')->name('bills.')->group(function () {
        Route::get('airtime/{id?}', 'airtime')->name('airtime');
        Route::get('airtime2cash/settings/fee', 'airtime2cashFees')->name('airtime2cashFees');
        Route::post('airtime2cash/settings/add', 'airtime2cashFeesAdd')->name('airtime2cashFees.add');
        Route::post('airtime2cash/settings/update', 'airtime2cashFeesUpdate')->name('airtime2cashFees.update');
        Route::get('airtime2cash/{id?}', 'airtime2cash')->name('airtime2cash');
        Route::get('airtime/decline/{id?}', 'airtime2cash_decline')->name('airtime2cash.decline');
        Route::get('airtime/approve/{id?}', 'airtime2cash_approve')->name('airtime2cash.approve');
        Route::get('insurance/{id?}', 'insurance')->name('insurance');
        Route::get('internet/{id?}', 'internet')->name('internet');
        Route::get('cabletv/{id?}', 'cabletv')->name('cabletv');
        Route::get('utility/{id?}', 'utility')->name('utility');
        Route::get('virtualcard', 'virtualcard')->name('virtualcard');
        Route::get('virtualcard/{id?}', 'virtualcardDetails')->name('virtualcard.details');
        Route::post('virtualcard/fund/{id?}', 'virtualcardDetails')->name('virtualcard.fund.balance');
        Route::post('virtualcard/password/{id?}', 'virtualcardPassword')->name('virtualcard.status.password');
        Route::get('virtualcard/activate/{id?}', 'virtualcardActivate')->name('virtualcard.status.activate');
        Route::get('virtualcard/deactivate/{id?}', 'virtualcardDeactivate')->name('virtualcard.status.deactivate');
        Route::get('virtualcard/block/{id?}', 'virtualcardBlock')->name('virtualcard.status.block');
    });  

        
    //CRYPTO WALLET STARTS


        // Coin Controller
        Route::controller('CoinController')->name('coin.')->prefix('coin')->group(function () {
            Route::get('/currency/settings', 'index')->name('CurrencySetting');
        });
        
    Route::controller('CoinController')->prefix('crypto')->name('crypto.')->group(function () {
        Route::get('/currency', 'CoinController@index')->name('currency');
        Route::get('/currency/edit/{id}', 'edit')->name('edit');
        Route::get('/activate-coin/{id}', 'activate')->name('activatecoin');
        Route::get('/deactivate-coin/{id}', 'deactivate')->name('deactivatecoin');
        Route::post('/update-coin/{id}', 'apiupdate')->name('postcoin');
        Route::get('/delete-coin/{id}', 'delete')->name('deletecoin');
        Route::post('/add-coin', 'coinAdd')->name('addcoin');
        
        Route::get('/wallet', 'CoinController@wallet')->name('wallet');
        Route::get('/wallet/{id}', 'CoinController@viewwallet')->name('viewwallet');
        Route::get('/deactivatewallet/{id}', 'CoinController@deactivatewallet')->name('deactivatewallet');
        Route::get('/activatewallet/{id}', 'CoinController@activatewallet')->name('activatewallet');
        Route::get('/viewwallet/{id}', 'CoinController@viewwalletaddress')->name('viewwalletd');
        Route::post('/creditwallet/{id}', 'CoinController@creditwallet')->name('creditwallet');
        Route::post('/debitwallet/{id}', 'CoinController@debitwallet')->name('debitwallet');
        Route::post('/createwallet/{id}', 'CoinController@createwallet')->name('createwallet');
        Route::get('/swap', 'CoinController@swap')->name('swap');

        Route::get('/buy/coin/{id}', 'buylog')->name('assetbuytrade');
        Route::get('/sell/coin/{id}', 'selllog')->name('assetselltrade');
        Route::get('/sell/coin/approve/{id}', 'selllogApprove')->name('assetselltrade.approve');
        Route::get('/sell/coin/decline/{id}', 'selllogDecline')->name('assetselltrade.decline');
        Route::get('/buy/coin/approve/{id}', 'buylogApprove')->name('assetbuytrade.approve');
        Route::get('/buy/coin/decline/{id}', 'buylogDecline')->name('assetbuytrade.decline');
    }); 

         
    //GIFTCARD SYSTEM
    Route::controller('GiftcardController')->prefix('giftcard')->group(function () {
        Route::get('/sell/giftcard/approved/{id}', 'giftcardlog')->name('sellproex');
        Route::get('/sell/giftcard/pending/{id}', 'giftcardlog')->name('sellpenex');
        Route::get('/sell/giftcard/declined/{id}', 'giftcardlog')->name('selldecex');
        Route::get('/buy/giftcard/approved/{id}', 'giftcardlog')->name('buyproex');
        Route::get('/buy/giftcard/pending/{id}', 'giftcardlog')->name('buypenex');
        Route::get('/buy/giftcard/declined/{id}', 'giftcardlog')->name('buydecex');
        Route::get('/card-info/{id}', 'cardinfo')->name('card-info');
        Route::any('/approvegift/{id}', 'approvegift')->name('appgift');
        Route::any('/rejectgift/{id}', 'rejectgift')->name('rejgift');

        Route::get('card/settings', 'giftcardindex')->name('giftcardindex');
        Route::post('card/create', 'store')->name('storecard'); 
        Route::get('card/edit/{id}', 'editPage')->name('editcard');
        Route::post('card/edit', 'postcard')->name('postcard');
        Route::get('card/edit/type/{id}', 'editcardType')->name('editcardType');
        Route::post('card/create/type/{id}', 'addcardType')->name('storecardType');;
        Route::post('card/update/type/{id}', 'updatecardType')->name('updatecardType');

        Route::get('card/approve/{id}', 'activate')->name('activatecard');
        Route::get('card/reject/{id}', 'deactivate')->name('deactivatecard');
        Route::get('card/delete/{id}', 'delete')->name('deletecard');

        Route::get('card/approve/type/{id}', 'activatetype')->name('activatecardtype');
        Route::get('card/reject/type/{id}', 'deactivatetype')->name('deactivatecardtype');
        Route::get('card/delete/type/{id}', 'deletetype')->name('deletecardtype');

    });

    //BILL PAYMENT STARTS
    Route::controller('StorefrontController')->prefix('storefront')->group(function () {
        Route::get('storefront', 'storefront')->name('storefront.index');
        Route::get('storefront/manage/{id}', 'manage')->name('storefront.edit');
        Route::post('storefront/manage/{id}', 'update');
        Route::get('storefront/status/{id}', 'status')->name('storefront.order.status');
    });  

    Route::controller('GeneralSettingController')->group(function () {
        // General Setting
        Route::get('general-setting', 'index')->name('setting.index');
        Route::post('general-setting', 'update')->name('setting.update');

        //configuration
        Route::get('setting/system-configuration', 'systemConfiguration')->name('setting.system.configuration');
        Route::post('setting/system-configuration', 'systemConfigurationSubmit');

        // Logo-Icon
        Route::get('setting/logo-icon', 'logoIcon')->name('setting.logo.icon');
        Route::post('setting/logo-icon', 'logoIconUpdate')->name('setting.logo.icon');

        //Custom CSS
        Route::get('custom-css', 'customCss')->name('setting.custom.css');
        Route::post('custom-css', 'customCssSubmit');

        //Cookie
        Route::get('cookie', 'cookie')->name('setting.cookie');
        Route::post('cookie', 'cookieSubmit');

        //maintenance_mode
        Route::get('maintenance-mode', 'maintenanceMode')->name('maintenance.mode');
        Route::post('maintenance-mode', 'maintenanceModeSubmit');
    });

    //Notification Setting
    Route::name('setting.notification.')->controller('NotificationController')->prefix('notification')->group(function () {
        //Template Setting
        Route::get('global', 'global')->name('global');
        Route::post('global/update', 'globalUpdate')->name('global.update');
        Route::get('templates', 'templates')->name('templates');
        Route::get('template/edit/{id}', 'templateEdit')->name('template.edit');
        Route::post('template/update/{id}', 'templateUpdate')->name('template.update');

        //Email Setting
        Route::get('email/setting', 'emailSetting')->name('email');
        Route::post('email/setting', 'emailSettingUpdate');
        Route::post('email/test', 'emailTest')->name('email.test');

        //SMS Setting
        Route::get('sms/setting', 'smsSetting')->name('sms');
        Route::post('sms/setting', 'smsSettingUpdate');
        Route::post('sms/test', 'smsTest')->name('sms.test');
    });

    //Category
    Route::controller('CategoryController')->name('category.')->prefix('category')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('status/{id}', 'status')->name('status');
    });

    //Services

    Route::controller('ServiceController')->name('service.')->prefix('service')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('add', 'add')->name('add');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('store', 'store')->name('store');
        Route::post('service/store', 'apiServicesStore')->name('api.store');
        Route::post('add', 'addService')->name('add');
        Route::post('status/{id}', 'status')->name('status');
        Route::get('api-services/{id}', 'apiServices')->name('api');
    });

    //Voucher
    Route::controller('VoucherController')->name('voucher.')->prefix('voucher')->group(function () {
        Route::get('create', 'create')->name('create');
        Route::post('create', 'createVoucher')->name('create');
        Route::get('used', 'used')->name('used');
        Route::get('unused', 'unused')->name('unused'); 
        Route::get('pending', 'pending')->name('pending'); 
        Route::post('update', 'update')->name('update'); 
        Route::get('rejected', 'rejected')->name('declined'); 
    });

    //Api Settings

    Route::controller('ApiProviderController')->name('api.provider.')->prefix('api-provider')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('status/{id}', 'status')->name('status');
    });

    // Plugin
    Route::controller('ExtensionController')->name('extensions.')->prefix('extensions')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('status/{id}', 'status')->name('status');
    });

    //System Information
    Route::controller('SystemController')->name('system.')->prefix('system')->group(function () {
        Route::get('info', 'systemInfo')->name('info');
        Route::get('server-info', 'systemServerInfo')->name('server.info');
        Route::get('optimize', 'optimize')->name('optimize');
        Route::get('optimize-clear', 'optimizeClear')->name('optimize.clear');
    });

    // SEO
    Route::get('seo', 'FrontendController@seoEdit')->name('seo');

    // Frontend
    Route::name('frontend.')->prefix('frontend')->group(function () {

        Route::controller('FrontendController')->group(function () {
            Route::get('templates', 'templates')->name('templates');
            Route::post('templates', 'templatesActive')->name('templates.active');
            Route::get('frontend-sections/{key}', 'frontendSections')->name('sections');
            Route::post('frontend-content/{key}', 'frontendContent')->name('sections.content');
            Route::get('frontend-element/{key}/{id?}', 'frontendElement')->name('sections.element');
            Route::post('remove/{id}', 'remove')->name('remove');
        });

        // Page Builder
        Route::controller('PageBuilderController')->group(function () {
            Route::get('manage-pages', 'managePages')->name('manage.pages');
            Route::post('manage-pages', 'managePagesSave')->name('manage.pages.save');
            Route::post('manage-pages/update', 'managePagesUpdate')->name('manage.pages.update');
            Route::post('manage-pages/delete/{id}', 'managePagesDelete')->name('manage.pages.delete');
            Route::get('manage-section/{id}', 'manageSection')->name('manage.section');
            Route::post('manage-section/{id}', 'manageSectionUpdate')->name('manage.section.update');
        });
    });
}); 

?>