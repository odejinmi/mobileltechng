<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->group(function () {

    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->name('logout');
        Route::get('auth/google', 'redirectToGoogle')->name('google.login');
        Route::get('auth/google/callback', 'handleGoogleCallback');
    });

    Route::controller('RegisterController')->group(function () {
        Route::get('register/{ref?}', 'showRegistrationForm')->name('register');
        Route::post('register', 'register')->middleware('registration.status');
        Route::post('check-mail', 'checkUser')->name('checkUser');
    });

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });
    Route::controller('ResetPasswordController')->group(function () {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });
});

Route::namespace('User')->controller('InvoiceController')->prefix('invoice')->group(function () {
    Route::get('/pay/{id}', 'invoice_pay');
    Route::post('/pay/{id}', 'invoice_pay_submit');
    Route::get('/confirm', 'invoiceConfirm')->name('invoice.confirm');
    Route::get('/request/account', 'request_account')->name('request_account');
});


Route::namespace('User')->controller('QrController')->group(function () {
    Route::get('/qr/{id?}', 'index')->name('qr');
    Route::post('/qr/{id}', 'receivepayment');
});


Route::middleware('auth')->name('user.')->group(function () {
    //authorization
    Route::namespace('User')->controller('AuthorizationController')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['check.status'])->namespace('User')->group(function () {
        Route::get('user-data', 'UserController@userData')->name('data');
        Route::post('user-data-submit', 'UserController@userDataSubmit')->name('data.submit');
        Route::get('contact', 'UserController@contact')->name('contact');

        Route::middleware('registration.complete')->group(function () {



            Route::controller('UserController')->group(function () {

                Route::get('api/key', 'apikey')->name('api.key');
                Route::get('api/key/generate', 'apikeyGenerate')->name('api.key.generate');
                Route::post('api/webhook', 'apiWebhook')->name('api.webhook');

                Route::get('dashboard', 'home')->name('home');
                Route::post('trxpass', 'trxpass')->name('trxpass');
                Route::get('login_earn', 'login_earn')->name('login_earn');

                Route::any('generatenuban', 'generatenuban')->name('generate.nuban');
                Route::any('qrcode', 'qrcode')->name('qr.index');
                Route::get('kyc', 'kyc')->name('kyc.index');
                Route::post('kyc', 'kycpost');

                //P2P
                Route::get('p2p/log', 'p2plog')->name('p2p.history');
                Route::get('p2p/transfer', 'p2p')->name('p2p');
                Route::post('p2p/transfer', 'p2ppost');

                // Withdraw
                Route::get('/withdraw', 'withdrawMoney')->name('withdraw');
                Route::post('/withdraw', 'withdrawStore')->name('withdraw.money');
                Route::get('/withdraw/preview', 'withdrawPreview')->name('withdraw.preview');
                Route::post('/withdraw/preview', 'withdrawSubmit')->name('withdraw.submit');
                Route::get('/withdraw/history', 'withdrawLog')->name('withdraw.history');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                Route::get('transactions', 'transactions')->name('transactions');
                Route::get('transactions/pos', 'Postransactions')->name('pos.transactions');

                Route::get('attachment-download/{fil_hash}', 'attachmentDownload')->name('attachment.download');

            });

            Route::controller('InvoiceController')->prefix('invoice')->group(function () {
                Route::get('invoice/{id}', 'invoice')->name('invoice');
                Route::post('invoice/{id}', 'invoicesubmit');
            });


            Route::controller('GiftcardAutoController')->prefix('giftcard')->group(function () {
                Route::get('digital', 'index')->name('giftcard.digital.index');
                Route::get('shop', 'shop')->name('giftcard.digital.shop');
                Route::get('digital/history', 'giftcardHistory')->name('giftcard.digital.history');
                Route::get('digital/details/{id}', 'giftcardDetails')->name('giftcard.details');
                Route::get('digital/redeem/code/{id}', 'giftcardRedeemCode')->name('giftcard.redeem');

                Route::get('/giftcard/getToken', 'authenticate')->name('giftcard.authenticate');
                Route::get('/buy/giftcard', 'buygiftcard')->name('buy.giftcard');
                Route::get('/fetch/giftcard', 'fecthgiftcards')->name('fecthgiftcards');
                Route::get('/get/giftcard', 'giftcardbyid')->name('giftcardbyid');
                Route::get('/digital/shop', 'shop')->name('shop');
                Route::get('/digital/details', 'giftcard')->name('giftcard');
                Route::post('/digital/buy/{id}', 'giftcardBuy')->name('giftcard.auto.buy');
            });



            //REQUEST PAYMENT ACCOUNT
            Route::controller('RequestAccountController')->prefix('request/account')->group(function () {
                Route::get('/', 'index')->name('requestaccount.index');
                Route::get('/create', 'create')->name('requestaccount.create');
                Route::post('/create', 'createRequest');
                Route::get('/confirm/{id}', 'confirm')->name('requestaccount.confirm');
                Route::post('/confirm/{id}', 'confirmPost');
                Route::get('/cancel/{id}', 'cancel')->name('requestaccount.cancel');
                Route::get('/history', 'history')->name('requestaccount.history');
            });

            //LOAN
            Route::middleware('loan.status')->controller('LoanController')->name('loan.')->prefix('loan')->group(function () {
                Route::get('plans', 'plans')->name('plans');
                Route::post('apply', 'applyLoan')->name('apply');
                Route::get('list', 'list')->name('list');
                Route::get('instalment/logs/{loan_number}', 'installments')->name('instalment.logs');
                Route::get('loan/preview', 'loanPreview')->name('loan.preview');
            });


            //Giftcards
            Route::controller('GiftcardController')->prefix('giftcard')->group(function () {
            Route::get('/index', 'index')->name('tradegift');
            Route::get('/sell-giftcard', 'sellgift')->name('sellgift');
            Route::get('/sell-gift-card/{id}', 'selectgiftcard')->name('selectgiftcardsell');
            Route::post('/sell-gift-card/{id}', 'sellcard')->name('sellcard');
            Route::get('/sell/giftcard-log', 'sellcardlog')->name('sellcardlog');

            Route::get('/buy-giftcard', 'buygift')->name('buygift');
            Route::get('/buy-gift-card/{id}', 'selectgiftcard')->name('selectgiftcardbuy');
            Route::post('/buy-gift-card/{id}', 'buycard');
            Route::get('/buy/giftcard-log', 'buycardlog')->name('buycardlog');

            Route::get('/trade/giftcard-log', 'giftcardlog')->name('giftcard.log');

            });

                            //Buy Crypto
                            Route::controller('BuyCryptoController')->prefix('buy/asset')->name('crypto.')->group(function () {
                                Route::get('/', 'index')->name('buy.index');
                                Route::get('request', 'buy')->name('buy');
                                Route::post('request', 'buy')->name('buy.request');
                                Route::post('coin/details', 'coindetails')->name('buy.coin.details');
                                Route::post('coin/buy', 'buyProcess')->name('buy.coin');
                                Route::get('log', 'log')->name('buy.log');
                                Route::post('buy/verify/manual', 'buyConfirmManual')->name('buy.confirm.manual');

                            });

                            //Sell Crypto
                            Route::controller('SellCryptoController')->prefix('sell/asset')->name('crypto.')->group(function () {
                                Route::get('/', 'index')->name('sell.index');
                                Route::get('request', 'sell')->name('sell');
                                Route::post('coin/details', 'coindetails')->name('sell.coin.details');
                                Route::post('request', 'sell')->name('sell.request');
                                Route::post('coin/sell', 'sellProcess')->name('sell.coin');
                                Route::post('sell/verify', 'sellConfirm')->name('sell.confirm');
                                Route::post('sell/verify/manual', 'sellConfirmManual')->name('sell.confirm.manual');
                                Route::get('log', 'log')->name('sell.log');
                            });


            //Bank Transfer
            Route::controller('BankTransferController')->group(function () {
                Route::get('bank/transfer', 'index')->name('bank.transfer');
                Route::get('bank/transfer/new', 'start')->name('bank.transfer.start');
                Route::post('bank/validate/strowallet', 'validatebankstrowallet')->name('bank.validate.strowallet');
                Route::post('bank/transfer/strowallet', 'banktransferStrowallet')->name('bank.transfer.strowallet');
                Route::post('bank/validate/monnify', 'validatebankmonnify')->name('bank.validate.monnify');
                Route::post('bank/transfer/monnify', 'banktransfernubanMonnify')->name('bank.transfer.monnify');
                Route::get('bank/transfer/log', 'history')->name('bank.transfer.history');
            });


               // Crypto Wallet
               Route::controller('CryptoController')->prefix('crypto')->group(function () {
                Route::get('/crypto/currencies','currencies')->name('crypto.index');
                Route::get('/assets/rates','rates')->name('crypto.rates');
                Route::get('/crypto/wallet/{id}','index')->name('crypto.wallet');
                Route::get('/crypto/wallet/transactions/{id}', 'transactions')->name('crypto.wallet.trx');
                Route::post('/crypto/wallet/validate/{id}', 'validatewallet')->name('crypto.wallet.validate');
                Route::post('/crypto/wallet/exchange/{id}', 'exchange')->name('crypto.exchange');
                Route::post('/crypto/wallet/send/{id}', 'send')->name('crypto.send');
                Route::post('/crypto/wallet/swap/{id}', 'swap')->name('crypto.swap');
                Route::post('/crypto/wallet/sellall/{id}', 'sellall')->name('crypto.sellall');
                Route::get('trade/assets', 'CryptoTrade')->name('crypto.trade.index');

                });

                Route::controller('VoucherController')->prefix('voucher')->group(function () {
                    Route::get('/', 'index')->name('voucher.index');
                    Route::get('/create', 'create')->name('voucher.create');
                    Route::post('/create', 'create_voucher');
                    Route::post('/redeem', 'redeem')->name('voucher.redeem');
                    Route::get('history', 'history')->name('voucher.history');
                });



                Route::middleware('vendor.account')->group(function () {

                    Route::controller('SavingsController')->prefix('savings')->group(function () {
                    Route::get('/', 'index')->name('savings.index');
                    Route::get('/request/savings', 'requestsavings')->name('savings.start.new');
                    Route::post('/request/savings', 'requestsubmit');
                    Route::get('/my-savings', 'mysavings')->name('savings.history');
                    Route::get('/savings/{id}', 'viewsaved')->name('viewsaved');
                    Route::post('/savings/{id}', 'savenow')->name('save.pay');
                    Route::post('/savings/close/{id}', 'saveclose')->name('save.close');
                    });

                    Route::controller('InvoiceController')->prefix('invoice')->group(function () {
                        Route::get('/', 'index')->name('invoice.index');
                        Route::get('/create', 'create')->name('invoice.create');
                        Route::post('/create', 'create_link');
                        Route::get('/edit/{id}', 'edit')->name('invoice.edit');
                        Route::post('/edit/{id}', 'update');
                        Route::get('history', 'history')->name('invoice.history');
                        Route::get('invoice/{id}', 'invoice')->name('invoice');
                    });

                    Route::controller('StorefrontController')->prefix('storefront')->group(function () {
                        Route::get('/', 'index')->name('storefront.index');
                        Route::get('/create', 'create')->name('storefront.create');
                        Route::post('/create', 'create_store');
                        Route::get('history', 'history')->name('storefront.history');
                        Route::get('/edit/{id}', 'edit')->name('storefront.edit');
                        Route::post('/edit/{id}', 'update');
                        Route::get('/products/{id}', 'products')->name('storefront.products');
                        Route::post('/products/{id}', 'productsAdd');
                        Route::post('/product/{id}', 'productUpdate')->name('storefront.product');
                        Route::get('storefront/{id}', 'storefront')->name('storefront');
                        Route::post('product/buy/{id}', 'productBuy')->name('product.buy');
                        Route::get('purchase/order', 'Myorder')->name('storefront.purchase.order');
                        Route::get('order/status/{id}', 'orderStatus')->name('storefront.order.status');
                    });

                    Route::controller('VirtualCardController')->prefix('virtualcard')->group(function () {
                        Route::get('/request', 'index')->name('virtualcard.index');
                        Route::post('/request', 'Request_virtualCard');
                        Route::get('history', 'history')->name('virtualcard.history');
                        Route::get('details/{id}', 'details')->name('virtualcard.details');
                        Route::get('status/block/{id}', 'block')->name('virtualcard.status.block');
                        //Route::get('status/activate/{id}', 'activate')->name('virtualcard.status.activate');
                        //Route::get('status/deactivate/{id}', 'deactivate')->name('virtualcard.status.deactivate');
                        Route::post('status/password/{id}', 'password')->name('virtualcard.status.password');
                        Route::post('fund/balance/{id}', 'fundbalance')->name('virtualcard.fund.balance');
                    });


                    Route::controller('VCardController')->group(function () {
                        Route::get('create/customer', 'showCreateForm')->name('create.customer');
                        Route::post('create/customer/add', 'savedata')->name('create.customer.add');
                        Route::get('create/card', 'create_card')->name('create.card');
                        Route::post('create/card/add', 'save_card')->name('create.card.add');
                        Route::get('list/card', 'list_cards')->name('list.card');
                        Route::get('view/card/{id}', 'view_card')->name('view.card');
                        Route::get('fund/card/{id}', 'fund_card')->name('fund.card');
                        Route::post('post_fund/card/{id}', 'post_fund_card')->name('post_fund.card');
                        Route::get('withdraw/card/{id}', 'withdraw_card')->name('withdraw.card');
                        Route::post('post_withdraw/card/{id}', 'post_withdraw_card')->name('post_withdraw.card');
                        Route::get('freez/card/{id}', 'freez_card')->name('freez.card');
                        Route::get('unfreez/card/{id}', 'unfreez_card')->name('unfreez.card');
                    });

                });


            Route::controller('EventController')->prefix('event')->group(function () {
                Route::get('/', 'event')->name('event.index');
                Route::get('events', 'events')->name('event.list');
                Route::get('view/{id}', 'eventDetails')->name('event.view');
                Route::get('buy/ticket/{id}', 'eventBuy')->name('event.ticket.buy');
                Route::get('buy/ticket/pay/{id}', 'buyTicket')->name('event.ticket.buy.proceed');
                Route::get('tickets/{id}', 'Tickets')->name('event.tickets');


                Route::post('add-to-cart/', 'addToCart')->name('event.add-to-cart');
                Route::get('cart/cart-data/', 'getCart')->name('event.get-cart-data');
                Route::get('cart/cart-data2/', 'getCart2')->name('event.get-cart-data2');
                Route::get('get_cart-total/', 'getCartTotal')->name('event.get-cart-total');
                Route::post('remove_cart_item/{id}', 'removeCartItem')->name('event.remove-cart-item');

                Route::get('history', 'history')->name('event.history');
             });

            Route::controller('BettingController')->prefix('betting')->group(function () {
                    Route::get('/', 'betting')->name('betting.index');
                    Route::get('fund/wallet', 'fund_wallet')->name('fund.betting.wallet');
                    Route::post('verify/merchant', 'verify_merchant')->name('betting.wallet.verify');
                    Route::post('fund/wallet', 'fund_wallet_post')->name('fund.betting.wallet');
                    Route::get('history', 'history')->name('betting.history');
            });

            Route::controller('AirtimeController')->prefix('airtime')->group(function () {
                Route::get('/', 'airtime')->name('airtime.index');
                Route::get('buy/airtime', 'buy_airtime')->name('buy.airtime');
                Route::post('buy/airtime', 'buy_airtime_post')->name('buy.airtime');
                Route::get('airtime_operators', 'airtime_operators')->name('airtime.operators');

                Route::get('/airtime/local', 'airtimelocal')->name('airtime.indexlocal');
                Route::get('buy/airtime/local', 'buy_airtime_local')->name('buy.airtime.local');
                Route::post('buy/airtime/local/post', 'buy_airtime_post_local')->name('buy.airtime.local.post');

                Route::get('history', 'history')->name('airtime.history');
                Route::get('to_cash', 'to_cash')->name('airtime.tocash');
                Route::get('to_cash/request', 'to_cash_request')->name('airtime.tocash.request');
                Route::post('to_cash/request', 'to_cash_request_post');
                Route::get('to_cash/history', 'to_cash_history')->name('airtime.tocash.history');
                Route::post('to_cash/request/fee', 'to_cash_request_fee')->name('airtime.tocash.fee');
            });


            Route::controller('InternetController')->prefix('internet')->group(function () {
                Route::get('/', 'internet')->name('internet.index');
                Route::get('buy/internet', 'buy_internet')->name('buy.internet');
                Route::post('buy/internet', 'buy_internet_post')->name('buy.internet');
                Route::get('internet_operators', 'internet_operators')->name('internet.operators');
                Route::post('internet_operator_id', 'operatorsInternetdetails')->name('internet.operatorsInternetdetails');
                Route::get('history', 'history')->name('internet.history');
            });

            Route::controller('InternetSmeController')->prefix('internet/sme')->group(function () {
                Route::get('/', 'internet')->name('internet_sme.index');
                Route::get('buy/internet', 'buy_internet')->name('buy.internet_sme');
                Route::post('buy/internet/n3tdata', 'buy_internet_post_n3tdata')->name('buy.internet_sme_n3tdata');
                Route::post('buy/internet/gsubz', 'buy_internet_post_gsubz')->name('buy.internet_sme_gsubz');
                Route::post('internet_operator_id/natkemlinks', 'operatorsInternetdetailsNATKEMLINKS')->name('internet_sme.operatorsInternetdetailsNATKEMLINKS');
                Route::post('buy/internet/natkemlinks', 'buy_internet_sme_natkemlinks')->name('buy.internet_sme_natkemlinks');
                Route::post('buy/internet/techhub', 'buy_internet_sme_techhub')->name('buy.internet_sme_techhub');
                Route::get('internet_operators', 'internet_operators')->name('internet_sme.operators');
                Route::post('internet_operator_id/n3tdata', 'operatorsInternetdetailsN3TDATA')->name('internet_sme.operatorsInternetdetailsN3TDATA');
                Route::post('internet_operator_id/gsubz', 'operatorsInternetdetailsGSUBZ')->name('internet_sme.operatorsInternetdetailsGSUBZ');
                Route::post('internet_operator_id/techhub', 'operatorsInternetdetailsTECHHUB')->name('internet_sme.operatorsInternetdetailsTECHHUB');
                Route::get('history', 'history')->name('internet_sme.history');
            });

            Route::controller('UtilityController')->prefix('utility')->group(function () {
                Route::get('/', 'utility')->name('utility.index');
                Route::get('buy/utility', 'buy_utility')->name('buy.utility');
                Route::post('buy/utility', 'buy_utility_post')->name('buy.utility');
                Route::get('utility_operators', 'utility_operators')->name('utility.operators');
                Route::post('utility_operator_id', 'operatorsUtilitydetails')->name('utility.operatorsUtilitydetails');
                Route::get('history', 'history')->name('utility.history');
            });



            Route::controller('UtilityLocalController')->prefix('utility/local')->group(function () {
                Route::get('/', 'utility')->name('utility.local.index');
                Route::get('buy/utility', 'buy_utility')->name('buy.local.utility');
                Route::post('buy/utility', 'buy_utility_post')->name('buy.local.utility');
                Route::get('verify/utility', 'verify_utility')->name('local.utility.verify');
                Route::get('history', 'history')->name('utility.local.history');
            });


            Route::controller('CabletvController')->prefix('cabletv')->group(function () {
                Route::get('/', 'cabletv')->name('cabletv.index');
                Route::get('buy/cabletv', 'buy_cabletv')->name('buy.cabletv');
                Route::post('buy/cabletv', 'buy_cabletv_post')->name('buy.cabletv');
                Route::get('cabletv_operators', 'cabletv_operators')->name('cabletv.operators');
                Route::get('cabletv_verify', 'cabletv_verify')->name('cabletv.verifydecoder');
                Route::post('cabletv_operator_id', 'operatorsUtilitydetails')->name('cabletv.operatorsUtilitydetails');
                Route::get('history', 'history')->name('cabletv.history');
            });


            Route::controller('InsuranceController')->prefix('insurance')->group(function () {
                Route::get('/', 'insurance')->name('insurance.index');
                Route::get('buy/insurance', 'buy_insurance')->name('buy.insurance');
                Route::post('buy/insurance', 'buy_insurance_post')->name('buy.insurance');
                Route::get('insurance_operators', 'insurance_operators')->name('insurance.operators');
                Route::post('buy/insurance/motor', 'buy_insurance_post_motor')->name('buy.insurance.motor');
                Route::post('buy/insurance/personal', 'buy_insurance_post_personal')->name('buy.insurance.personal');
                Route::get('history', 'history')->name('insurance.history');
            });


            //Profile setting
            Route::controller('ProfileController')->group(function () {
                Route::get('downlines', 'downlines')->name('downlines');
                Route::get('setting', 'profile')->name('profile.setting');
                Route::get('profile-update', 'profileChange')->name('change.profile');
                Route::post('profile-update', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
                Route::get('change-trxpassword', 'TrxPassword')->name('change.trxpassword');
                Route::post('change-trxpassword', 'submitTrxPassword')->name('change.trxpassword');
                Route::get('change-terminalpassword', 'TerminalPassword')->name('change.terminalpassword');
                Route::post('change-terminalpassword', 'submitTerminalPassword')->name('change.terminalpassword');
                Route::post('deactivate-account', 'deactivate')->name('account.deactivate');
            });
        });
    });
    // Payment
    Route::controller('Gateway\PaymentController')->prefix('deposit')->name('deposit.')->group(function () {
        Route::get('checkout', 'checkout')->name('checkout');
        Route::post('checkout', 'checkoutProcess')->name('checkout');
        Route::any('/', 'deposit')->name('index');
        Route::post('insert', 'depositInsert')->name('insert');
        Route::get('confirm', 'depositConfirm')->name('confirm');
        Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
        Route::post('manual', 'manualDepositUpdate')->name('manual.update');
    });
});


?>
