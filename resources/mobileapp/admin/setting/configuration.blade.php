@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12">
            <div class="card">
                <form action="" method="post">
                    @csrf
                    <div class="card-body">
                        <ul class="list-group">
                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('User Registration')</p>
                                    <p class="mb-0">
                                        <small>@lang('If you disable this module, no one can register on this system')</small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input" @if ($general->registration) checked @endif name="registration"
                                         id="registration" /> 
                                    </div> 
                                </div>
                            </li>
                            <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Dedicated Account Number Provider')</p>
                                <p class="mb-0">
                                    <small>@lang('Please select NUBAN Account Number provider for this system')</small>
                                </p>
                            </div>
                            <div class="form-group">
                                    <select class="form-control" name="nuban_provider"
                                     id="nuban_provider">
                                     <option selected disabled>Select Provider</option>
                                     <option  @if ($general->nuban_provider == 'MONNIFY') selected @endif >MONNIFY</option> 
                                     <option  @if ($general->nuban_provider == 'STROWALLET') selected @endif>STROWALLET</option>
                                     <option  @if ($general->nuban_provider == 'PAYLONY') selected @endif>PAYLONY</option>
                                    </select>
                            </div>
                        </li>
                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Bank Transfer Service Provider')</p>
                                <p class="mb-0">
                                    <small>@lang('Please select Bank Transfer Service provider for this system')</small>
                                </p>
                            </div>
                            <div class="form-group">
                                    <select class="form-control" name="transfer_provider"
                                     id="transfer_provider">
                                     <option selected disabled>Select Provider</option>
                                     <option  @if ($general->transfer_provider == 'MONNIFY') selected @endif >MONNIFY</option> 
                                     <option  @if ($general->transfer_provider == 'STROWALLET') selected @endif>STROWALLET</option>
                                     <option  @if ($general->transfer_provider == 'PAYLONY') selected @endif>PAYLONY</option>
                                    </select>
                            </div>
                        </li>
                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Invoice Payment')</p>
                                <p class="mb-0">
                                    <small>@lang('By enabling') <span class="fw-bold">@lang('Invoice & Payment Link Payment')</span>
                                        @lang('the system will enable visitor to create and pay invoice from your website.')</small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" @if ($general->invoice) checked @endif name="invoice"
                                 id="invoice" /> 
                            </div>   
                            </div> 
                            </li> 


                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Request Payment')</p>
                                <p class="mb-0">
                                    <small>@lang('By enabling') <span class="fw-bold">@lang('Request Payment')</span>
                                        @lang('the system will enable visitor to request payment account details to receive funds from which you will remove percentage fee and remit balance to customer wallet.')</small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" @if ($general->request_account) checked @endif name="request_account"
                                 id="request_account" /> 
                            </div>   
                            </div> 
                            </li> 

                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Loan Facility')</p>
                                <p class="mb-0">
                                    <small>@lang('By enabling') <span class="fw-bold">@lang('Loan Facility')</span>
                                        @lang('the system will enable visitor to request for loan on your platform.')</small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" @if ($general->loan) checked @endif name="loan"
                                 id="loan" /> 
                            </div>   
                            </div> 
                            </li> 


                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Voucher Feature')</p>
                                <p class="mb-0">
                                    <small>@lang('By enabling') <span class="fw-bold">@lang('voucher feature')</span>
                                        @lang('the system will enable visitor to create voucher code and redeem voucher code from your website.')</small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" @if ($general->voucher) checked @endif name="voucher"
                                 id="voucher" /> 
                            </div>   
                            </div> 
                            </li> 

                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Savings Feature')</p>
                                <p class="mb-0">
                                    <small>@lang('By enabling') <span class="fw-bold">@lang('savings feature')</span>
                                        @lang('the system will enable visitor to create savings plan from your website.')</small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" @if ($general->savings) checked @endif name="savings"
                                 id="savings" /> 
                            </div>   
                            </div> 
                            </li> 

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Storefront')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Storefront')</span>
                                            @lang('the system will enable visitor to create and shop on Storefront from your system.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
        
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->store_front) checked @endif name="store_front" id="store_front" /> 
                                </div>   
                                </div>
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Storefront Fee') (PERCENTAGE %)
                                    </p>
                                    <p class="mb-0">
                                        <small><span class="fw-bold">
                                            @lang('This is the transaction fee to be debited from amount when payment is made for order')     
                                        </span>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">
                                        <input class="form-control" name="store_front_fee" id="store_front_fee" value="{{$general->store_front_fee}}" />  
                                </div>  
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('QR Payment')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('QR Payment')</span>
                                            @lang('the system will enable visitor to scan qr code and make payment using generated account number on your system.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
        
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->qr) checked @endif name="qr" id="qr" /> 
                                </div>   
                                </div>
                            </li>


                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('API Crypto Trade')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('API Crypto Wallet')</span>
                                            @lang('the system will enable visitor to buy Crypto assets on your website from your third party API service provider .')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->crypto_auto) checked @endif name="crypto_auto"
                                     id="crypto_auto" /> 
                                </div>   
                                </div>  
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Crypto Wallet')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Crypto Wallet')</span>
                                            @lang('the system will enable visitor to own Crypto Wallet on your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->crypto) checked @endif name="crypto"
                                     id="crypto" /> 
                                </div>   
                                </div>  
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Buy Crypto')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Buy Crypto')</span>
                                            @lang('the system will enable visitor to buy crypto from your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->buy_crypto) checked @endif name="buy_crypto"
                                     id="buy_crypto" /> 
                                </div>   
                                </div> 
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Sell Crypto')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Sell Crypto')</span>
                                            @lang('the system will enable visitor to sell crypto from your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->sell_crypto) checked @endif name="sell_crypto"
                                     id="sell_crypto" /> 
                                </div>   
                                </div> 
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Swap Crypto')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Swap Crypto')</span>
                                            @lang('the system will enable visitor to swap crypto from your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->swap_crypto) checked @endif name="swap_crypto"
                                     id="swap_crypto" /> 
                                </div>   
                                </div> 
                            </li>


                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Buy Automated Giftcard')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Automated  Giftcard')</span>
                                            @lang('the system will enable visitor to buy API controlled giftcard by reloadly.com from your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->giftcard_auto) checked @endif name="giftcard_auto"
                                     id="giftcard_auto" /> 
                                </div>   
                                </div> 
                            </li>
                            
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Buy Giftcard')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Buy Giftcard')</span>
                                            @lang('the system will enable visitor to buy giftcard from your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->buy_giftcard) checked @endif name="buy_giftcard"
                                     id="buy_giftcard" /> 
                                </div>   
                                </div> 
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Sell Giftcard')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Sell Giftcard')</span>
                                            @lang('the system will enable visitor to sell giftcard from your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->sell_giftcard) checked @endif name="sell_giftcard"
                                     id="sell_giftcard" /> 
                                </div>   
                                </div> 
                            </li>
                            
        

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Virtual Card')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Virtual Card')</span>
                                            @lang('the system will enable visitor to own Virtual Card on your website.')</small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->virtualcard) checked @endif name="virtualcard"
                                     id="virtualcard" /> 
                                </div>   
                                </div>  
                            </li>


                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Virtual Card Fee Type')</p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    @lang('This is the fee type your customer will be charged for requesting Virtual Card From Your Platform')     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="virtualcard_fee_type" id="virtualcard_fee_type"> 
                             <option selected disabled>Select A Fee Type</option>
                             <option @if($general->virtualcard_fee_type == 'PERCENT') selected @endif>PERCENT</option>
                             <option @if($general->virtualcard_fee_type == 'FIXED') selected @endif>FIXED</option>
                             <option @if($general->virtualcard_fee_type == 'BOTH') selected @endif>BOTH</option>
                           </select>
                        </div>   
                        </div>  
                    </li>
                  

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Virtual Card Request Fee (PERCENT)')
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    @lang('This is the fee your customer will be charged for requesting Virtual Card From Your Platform')     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_fee_percent" id="virtualcard_fee_percent" value="{{$general->virtualcard_fee_percent}}" />  
                        </div>  
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Virtual Card Request Fee (FLAT)')
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    @lang('This is the fee your customer will be charged for requesting Virtual Card From Your Platform')     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_fee_flat" id="virtualcard_fee_flat" value="{{$general->virtualcard_fee_flat}}" />  
                        </div>  
                    </li>
                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Virtual Card Transaction Fee')
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    @lang('This is the fee your customer will be charged For Funding Virtual Card On Your Platform')     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_request_fee" id="virtualcard_request_fee" value="{{$general->virtualcard_request_fee}}" />  
                        </div>  
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Virtual Card USD Rate') (USD - {{$general->cur_text}} {{$general->cur_sym}} )
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    @lang('This is the USD rate your customer will be charged with when Funding A USD Virtual Card On Your Platform')     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_usd_rate" id="virtualcard_usd_rate" value="{{$general->virtualcard_usd_rate}}" />  
                        </div>  
                    </li>


                        <li
                        class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Airtime International Vending')</p>
                            <p class="mb-0">
                                <small>@lang('By enabling') <span class="fw-bold">@lang('Airtime International Vending')</span>
                                    @lang('the system will enable visitor to purchase international airtime from your website.')</small>
                            </p>
                        </div>
                        <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->airtime) checked @endif name="airtime"
                             id="airtime" /> 
                        </div>   
                        </div>
                    </li>

                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('Airtime To Cash')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('Airtime To Cash')</span>
                                @lang('the system will enable visitor to exchange airtime for cash your website.')</small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" @if ($general->airtime2cash) checked @endif name="airtime2cash"
                         id="airtime2cash" /> 
                    </div>   
                    </div>
                </li>
                 
                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('Betting Wallet Funding')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('Betting Wallet Funding')</span>
                                @lang('the system will enable visitor to fund betting wallet from your website.')</small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" @if ($general->betting) checked @endif name="betting"
                         id="betting" /> 
                    </div>   
                    </div>
                </li>

                <li
                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                <div>
                    <p class="fw-bold mb-0">@lang('Event Ticket Vending')</p>
                    <p class="mb-0">
                        <small>@lang('By enabling') <span class="fw-bold">@lang('Event Ticket Vending')</span>
                            @lang('the system will enable visitor to buy selected event tickets from your website.')</small>
                    </p>
                </div>
                <div class="form-group">

                <div class="form-check form-switch form-check-success">
                    <input type="checkbox" class="form-check-input" @if ($general->event) checked @endif name="event"
                     id="event" /> 
                </div>   
                </div>
            </li>


            <li
            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
            <div>
                <p class="fw-bold mb-0">@lang('Escrow Service')</p>
                <p class="mb-0">
                    <small>@lang('By enabling') <span class="fw-bold">@lang('Escrow Service')</span>
                        @lang('the system will enable visitor to engage in escrow services on your website.')</small>
                </p>
            </div>
            <div class="form-group">

            <div class="form-check form-switch form-check-success">
                <input type="checkbox" class="form-check-input" @if ($general->escrow) checked @endif name="escrow"
                 id="escrow" /> 
            </div>   
            </div>
        </li>

       


                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('Airtime Local Vending')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('Airtime Local Vending')</span>
                                @lang('the system will enable visitor to purchase local airtime from your website.')</small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" @if ($general->airtimelocal) checked @endif name="airtimelocal"
                         id="airtimelocal" /> 
                    </div>   
                    </div>
                </li>

                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('Internet Vending')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('Internet Vending')</span>
                                @lang('the system will enable visitor to purchase internet from your website.')</small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" @if ($general->internet) checked @endif name="internet"
                         id="internet" /> 
                    </div>   
                    </div> 
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('SME Data / Data Gifting')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('SME Data / Data Gifting')</span>
                                @lang('the system will enable visitor to purchase SME data bundle from your website.')</small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" @if ($general->internetsme) checked @endif name="internetsme"
                         id="internetsme" /> 
                    </div>   
                    </div>  
                    </li>


                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('SME Data / Data Gifting Provider')</p>
                            <p class="mb-0">
                                <small>@lang('By changin') <span class="fw-bold">@lang('SME Data / Data Gifting Provider')</span>
                                    @lang('the system will route SME data purchase via the selected service provider.')</small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="internetsme_provider"
                             id="internetsme_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option @if($general->internetsme_provider == 'VTPASS') selected @endif disabled>VTPASS</option>
                             <option @if($general->internetsme_provider == 'N3TDATA') selected @endif>N3TDATA</option>
                             <option @if($general->internetsme_provider == 'GTIDINGSDATA') selected @endif>GTIDINGSDATA</option>
                             <option @if($general->internetsme_provider == 'GSUBZ') selected @endif>GSUBZ</option>
                           </select>
                        </div>   
                        </div>  
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('API Internet Data Vending Provider')</p>
                            <p class="mb-0">
                                <small>@lang('By changing') <span class="fw-bold">@lang('API Internet Data Provider')</span>
                                    @lang('the system will route API data vending via the selected service provider.')</small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="internet_api_sme_provider"
                             id="internet_api_sme_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option @if($general->internet_api_sme_provider == 'SIMHOSTING') selected @endif value="SIMHOSTING">SIM HOSTING</option>
                             <option @if($general->internet_api_sme_provider == 'N3TDATA') selected @endif>N3TDATA</option>
                             <option @if($general->internet_api_sme_provider == 'GSUBZ') selected @endif>GSUBZ</option>
                           </select>
                        </div>   
                        </div>  
                    </li>



                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Local Airtime Provider')</p>
                            <p class="mb-0">
                                <small>@lang('By changin') <span class="fw-bold">@lang('Local Airtime Provider')</span>
                                    @lang('the system will route Local Airtime purchase via the selected service provider.')</small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="airtime_provider"
                             id="airtime_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option @if($general->airtime_provider == 'VTPASS') selected @endif>VTPASS</option>
                             <option @if($general->airtime_provider == 'N3TDATA') selected @endif>N3TDATA</option>
                             <option @if($general->airtime_provider == 'GSUBZ')  @endif disabled>NEW API COMING SOON</option>
                           </select>
                        </div>   
                        </div>  
                    </li>


                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('Cable TV Vending')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('Cable TV Vending')</span>
                                @lang('the system will enable visitor to purchase internet from your website.')</small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" @if ($general->cabletv) checked @endif name="cabletv"
                         id="cabletv" /> 
                    </div>   
                    </div> 
                    </li> 
                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('Insurance Bills Payment')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('Insurance Bills Payment')</span>
                                @lang('the system will enable visitor to pay automobile and car insurance bills from your website.')</small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" @if ($general->insurance) checked @endif name="insurance"
                         id="insurance" /> 
                    </div>   
                    </div> 
                    </li> 

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Cable TV Provider')</p>
                            <p class="mb-0">
                                <small>@lang('By changing') <span class="fw-bold">@lang('Cable TV Provider')</span>
                                    @lang('the system will route Cable TV purchase via the selected service provider.')</small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="cabletv_provider"
                             id="cabletv_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option @if($general->cabletv_provider == 'VTPASS') selected @endif>VTPASS</option>
                             <option @if($general->cabletv_provider == 'N3TDATA') selected @endif>N3TDATA</option>
                             <option @if($general->cabletv_provider == 'GSUBZ')  @endif disabled>NEW API COMING SOON</option>
                           </select>
                        </div>   
                        </div>  
                    </li>
                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0">@lang('Local Utility Bills')</p>
                        <p class="mb-0">
                            <small>@lang('By enabling') <span class="fw-bold">@lang('Local Utility Bill')</span>
                                @lang('the system will enable visitor to pay local utility bill from your website.')</small>
                        </p>
                    </div>
                        <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->utilitylocal) checked @endif name="utilitylocal"
                            id="utilitylocal" /> 
                        </div>   
                        </div> 
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('Global Utility Bills')</p>
                            <p class="mb-0">
                                <small>@lang('By enabling') <span class="fw-bold">@lang('Global Utility Bill')</span>
                                    @lang('the system will enable visitor to pay local global bill from your website.')</small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->utilityglobal) checked @endif name="utilityglobal"
                             id="utilityglobal" /> 
                        </div>   
                        </div> 
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0">@lang('P2P Transfer')</p>
                            <p class="mb-0">
                                <small>@lang('By enabling') <span class="fw-bold">@lang('P2P Transfer')</span>
                                    @lang('the system will enable visitor to transfer fund internaly on your website.')</small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->utilityglobal) checked @endif name="p2p"
                             id="p2p" /> 
                        </div>   
                        </div> 
                    </li>
                       

                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Daily Login Bonus')</p>
                                <p class="mb-0">
                                    <small>@lang('By enabling') <span class="fw-bold">@lang('Daily Login')</span>
                                        @lang('the system will credit visitor daily for visiting the site.')</small>
                                </p>
                            </div>
                            <div class="form-group">

                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->login_bonus) checked @endif name="login_bonus"
                                     id="login_bonus" /> 
                                </div>     
                            </div>
                        </li>

                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Daily Login Eaning')</p>
                                <p class="mb-0">
                                    <small>@lang('Enter Amount for') <span class="fw-bold">@lang('Daily Login Bonus')</span>
                                        @lang('the system will credit visitor daily this amount for visiting the site.')</small>
                                </p>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{$general->login_earn}}" name="login_earn"
                                    @if($general->login_earn) checked @endif>
                            </div>
                        </li>

                       

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Force SSL')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling') <span class="fw-bold">@lang('Force SSL (Secure Sockets Layer)')</span>
                                            @lang('the system will force a visitor that he/she must have to visit in secure mode. Otherwise, the site will be loaded in secure mode.')</small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->force_ssl) checked @endif name="force_ssl"
                             id="force_ssl" /> 
                        </div>     
                                </div>
                            </li>
                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Agree Policy')</p>
                                    <p class="mb-0">
                                        <small>@lang('If you enable this module, that means a user must have to agree with your system\'s') <a
                                                href="{{ route('admin.frontend.sections', 'policy_pages') }}">@lang('policies')</a>
                                            @lang('during registration.')</small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->agree) checked @endif name="agree"
                             id="agree" /> 
                        </div>      
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Force Secure Password')</p>
                                    <p class="mb-0">
                                        <small>@lang('By enabling this module, a user must set a secure password while signing up or changing the password.')</small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->secure_password) checked @endif name="secure_password"
                             id="secure_password" /> 
                        </div>       
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Email Verification')</p>
                                    <p class="mb-0">
                                        <small>
                                            @lang('If you enable') <span class="fw-bold">@lang('Email Verification')</span>,
                                            @lang('users have to verify their email to access the dashboard. A 6-digit verification code will be sent to their email to be verified.')
                                            <br>
                                            <span class="fw-bold"><i>@lang('Note'):</i></span> <i>@lang('Make sure that the')
                                                <span class="fw-bold">@lang('Email Notification') </span> @lang('module is enabled')</i>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->ev) checked @endif name="ev"
                             id="ev" /> 
                        </div>       
 
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Email Notification')</p>
                                    <p class="mb-0">
                                        <small>@lang('If you enable this module, the system will send emails to users where needed. Otherwise, no email will be sent.') <code>@lang('So be sure before disabling this module that, the system doesn\'t need to send any emails.')</code></small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->en) checked @endif name="en"
                             id="en" /> 
                        </div>        
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Mobile Verification')</p>
                                    <p class="mb-0">
                                        <small>
                                            @lang('If you enable') <span class="fw-bold">@lang('Mobile Verification')</span>,
                                            @lang('users have to verify their mobile to access the dashboard. A 6-digit verification code will be sent to their mobile to be verified.')
                                            <br>
                                            <span class="fw-bold"><i>@lang('Note'):</i></span> <i>@lang('Make sure that the')
                                                <span class="fw-bold">@lang('SMS Notification') </span> @lang('module is enabled')</i>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->sv) checked @endif name="sv"
                             id="sv" /> 
                        </div>         
                                </div>
                            </li>


                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('SMS Notification')</p>
                                    <p class="mb-0">
                                        <small>@lang('If you enable this module, the system will send SMS to users where needed. Otherwise, no SMS will be sent.') <code>@lang('So be sure before disabling this module that, the system doesn\'t need to send any SMS.')</code></small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if ($general->sn) checked @endif name="sn"
                             id="sn" /> 
                        </div>         
 
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0">@lang('Language')</p>
                                    <p class="mb-0">
                                        <small>@lang('If you disable this module, that means no one can change the language')</small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input" @if ($general->ln) checked @endif name="ln"
                                         id="ln" /> 
                                    </div>         
  
                                </div>
                            </li>
                            <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Welcome Bonus Status')</p>
                                <p class="mb-0">
                                    <small>@lang('By enabling') <span class="fw-bold">@lang('Welcome Bonus Status')</span>
                                        @lang('the system will allow newly registered user earn welcome bonus daily for registring the site.')</small>
                                </p>
                            </div>
                            <div class="form-group">

                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" @if ($general->welcome_bonus) checked @endif name="welcome_bonus"
                                     id="welcome_bonus" /> 
                                </div>  
                            </div>
                        </li>

                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0">@lang('Welcome Bonus')</p>
                                <p class="mb-0">
                                    <small>@lang('Enter Amount for') <span class="fw-bold">@lang('Welcome Bonus')</span>
                                        @lang('the system will credit new user this amount for registring on the site.')</small>
                                </p>
                            </div>
                            <div class="form-group">
                                
                                <input type="number" class="form-control" value="{{$general->welcome_bonus_amount}}" name="welcome_bonus_amount"
                                    @if($general->welcome_bonus_amount) checked @endif>
                            </div>
                        </li>


                        </ul>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    
@endpush
