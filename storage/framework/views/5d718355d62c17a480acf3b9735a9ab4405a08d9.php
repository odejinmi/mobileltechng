<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
        <div class="col-lg-12">
            <div class="card">
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <ul class="list-group">
                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('User Registration'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you disable this module, no one can register on this system'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input" <?php if($general->registration): ?> checked <?php endif; ?> name="registration"
                                         id="registration" /> 
                                    </div> 
                                </div>
                            </li>
                            <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Dedicated Account Number Provider'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('Please select NUBAN Account Number provider for this system'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
                                    <select class="form-control" name="nuban_provider"
                                     id="nuban_provider">
                                     <option selected disabled>Select Provider</option>
                                     <option  <?php if($general->nuban_provider == 'MONNIFY'): ?> selected <?php endif; ?> >MONNIFY</option> 
                                     <option  <?php if($general->nuban_provider == 'STROWALLET'): ?> selected <?php endif; ?>>STROWALLET</option>
                                     <option  <?php if($general->nuban_provider == 'PAYLONY'): ?> selected <?php endif; ?>>PAYLONY</option>
                                    </select>
                            </div>
                        </li>
                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Bank Transfer Service Provider'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('Please select Bank Transfer Service provider for this system'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
                                    <select class="form-control" name="transfer_provider"
                                     id="transfer_provider">
                                     <option selected disabled>Select Provider</option>
                                     <option  <?php if($general->transfer_provider == 'MONNIFY'): ?> selected <?php endif; ?> >MONNIFY</option> 
                                     <option  <?php if($general->transfer_provider == 'STROWALLET'): ?> selected <?php endif; ?>>STROWALLET</option>
                                     <option  <?php if($general->transfer_provider == 'PAYLONY'): ?> selected <?php endif; ?>>PAYLONY</option>
                                    </select>
                            </div>
                        </li>
                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Invoice Payment'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Invoice & Payment Link Payment'); ?></span>
                                        <?php echo app('translator')->get('the system will enable visitor to create and pay invoice from your website.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" <?php if($general->invoice): ?> checked <?php endif; ?> name="invoice"
                                 id="invoice" /> 
                            </div>   
                            </div> 
                            </li> 


                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Request Payment'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Request Payment'); ?></span>
                                        <?php echo app('translator')->get('the system will enable visitor to request payment account details to receive funds from which you will remove percentage fee and remit balance to customer wallet.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" <?php if($general->request_account): ?> checked <?php endif; ?> name="request_account"
                                 id="request_account" /> 
                            </div>   
                            </div> 
                            </li> 

                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Loan Facility'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Loan Facility'); ?></span>
                                        <?php echo app('translator')->get('the system will enable visitor to request for loan on your platform.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" <?php if($general->loan): ?> checked <?php endif; ?> name="loan"
                                 id="loan" /> 
                            </div>   
                            </div> 
                            </li> 


                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Voucher Feature'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('voucher feature'); ?></span>
                                        <?php echo app('translator')->get('the system will enable visitor to create voucher code and redeem voucher code from your website.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" <?php if($general->voucher): ?> checked <?php endif; ?> name="voucher"
                                 id="voucher" /> 
                            </div>   
                            </div> 
                            </li> 

                        <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Savings Feature'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('savings feature'); ?></span>
                                        <?php echo app('translator')->get('the system will enable visitor to create savings plan from your website.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
        
                            <div class="form-check form-switch form-check-success">
                                <input type="checkbox" class="form-check-input" <?php if($general->savings): ?> checked <?php endif; ?> name="savings"
                                 id="savings" /> 
                            </div>   
                            </div> 
                            </li> 

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Storefront'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Storefront'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to create and shop on Storefront from your system.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
        
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->store_front): ?> checked <?php endif; ?> name="store_front" id="store_front" /> 
                                </div>   
                                </div>
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Storefront Fee'); ?> (PERCENTAGE %)
                                    </p>
                                    <p class="mb-0">
                                        <small><span class="fw-bold">
                                            <?php echo app('translator')->get('This is the transaction fee to be debited from amount when payment is made for order'); ?>     
                                        </span>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">
                                        <input class="form-control" name="store_front_fee" id="store_front_fee" value="<?php echo e($general->store_front_fee); ?>" />  
                                </div>  
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('QR Payment'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('QR Payment'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to scan qr code and make payment using generated account number on your system.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
        
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->qr): ?> checked <?php endif; ?> name="qr" id="qr" /> 
                                </div>   
                                </div>
                            </li>


                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('API Crypto Trade'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('API Crypto Wallet'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to buy Crypto assets on your website from your third party API service provider .'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->crypto_auto): ?> checked <?php endif; ?> name="crypto_auto"
                                     id="crypto_auto" /> 
                                </div>   
                                </div>  
                            </li>

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Crypto Wallet'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Crypto Wallet'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to own Crypto Wallet on your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->crypto): ?> checked <?php endif; ?> name="crypto"
                                     id="crypto" /> 
                                </div>   
                                </div>  
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Buy Crypto'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Buy Crypto'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to buy crypto from your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->buy_crypto): ?> checked <?php endif; ?> name="buy_crypto"
                                     id="buy_crypto" /> 
                                </div>   
                                </div> 
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Sell Crypto'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Sell Crypto'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to sell crypto from your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->sell_crypto): ?> checked <?php endif; ?> name="sell_crypto"
                                     id="sell_crypto" /> 
                                </div>   
                                </div> 
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Swap Crypto'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Swap Crypto'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to swap crypto from your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->swap_crypto): ?> checked <?php endif; ?> name="swap_crypto"
                                     id="swap_crypto" /> 
                                </div>   
                                </div> 
                            </li>


                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Buy Automated Giftcard'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Automated  Giftcard'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to buy API controlled giftcard by reloadly.com from your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->giftcard_auto): ?> checked <?php endif; ?> name="giftcard_auto"
                                     id="giftcard_auto" /> 
                                </div>   
                                </div> 
                            </li>
                            
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Buy Giftcard'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Buy Giftcard'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to buy giftcard from your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->buy_giftcard): ?> checked <?php endif; ?> name="buy_giftcard"
                                     id="buy_giftcard" /> 
                                </div>   
                                </div> 
                            </li>
                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Sell Giftcard'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Sell Giftcard'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to sell giftcard from your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->sell_giftcard): ?> checked <?php endif; ?> name="sell_giftcard"
                                     id="sell_giftcard" /> 
                                </div>   
                                </div> 
                            </li>
                            
        

                            <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Virtual Card'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Virtual Card'); ?></span>
                                            <?php echo app('translator')->get('the system will enable visitor to own Virtual Card on your website.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
            
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->virtualcard): ?> checked <?php endif; ?> name="virtualcard"
                                     id="virtualcard" /> 
                                </div>   
                                </div>  
                            </li>


                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Virtual Card Fee Type'); ?></p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    <?php echo app('translator')->get('This is the fee type your customer will be charged for requesting Virtual Card From Your Platform'); ?>     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="virtualcard_fee_type" id="virtualcard_fee_type"> 
                             <option selected disabled>Select A Fee Type</option>
                             <option <?php if($general->virtualcard_fee_type == 'PERCENT'): ?> selected <?php endif; ?>>PERCENT</option>
                             <option <?php if($general->virtualcard_fee_type == 'FIXED'): ?> selected <?php endif; ?>>FIXED</option>
                             <option <?php if($general->virtualcard_fee_type == 'BOTH'): ?> selected <?php endif; ?>>BOTH</option>
                           </select>
                        </div>   
                        </div>  
                    </li>
                  

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Virtual Card Request Fee (PERCENT)'); ?>
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    <?php echo app('translator')->get('This is the fee your customer will be charged for requesting Virtual Card From Your Platform'); ?>     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_fee_percent" id="virtualcard_fee_percent" value="<?php echo e($general->virtualcard_fee_percent); ?>" />  
                        </div>  
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Virtual Card Request Fee (FLAT)'); ?>
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    <?php echo app('translator')->get('This is the fee your customer will be charged for requesting Virtual Card From Your Platform'); ?>     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_fee_flat" id="virtualcard_fee_flat" value="<?php echo e($general->virtualcard_fee_flat); ?>" />  
                        </div>  
                    </li>
                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Virtual Card Transaction Fee'); ?>
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    <?php echo app('translator')->get('This is the fee your customer will be charged For Funding Virtual Card On Your Platform'); ?>     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_request_fee" id="virtualcard_request_fee" value="<?php echo e($general->virtualcard_request_fee); ?>" />  
                        </div>  
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Virtual Card USD Rate'); ?> (USD - <?php echo e($general->cur_text); ?> <?php echo e($general->cur_sym); ?> )
                            </p>
                            <p class="mb-0">
                                <small><span class="fw-bold">
                                    <?php echo app('translator')->get('This is the USD rate your customer will be charged with when Funding A USD Virtual Card On Your Platform'); ?>     
                                </span>
                                </small>
                            </p>
                        </div>
                        <div class="form-group">
                                <input class="form-control" name="virtualcard_usd_rate" id="virtualcard_usd_rate" value="<?php echo e($general->virtualcard_usd_rate); ?>" />  
                        </div>  
                    </li>


                        <li
                        class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Airtime International Vending'); ?></p>
                            <p class="mb-0">
                                <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Airtime International Vending'); ?></span>
                                    <?php echo app('translator')->get('the system will enable visitor to purchase international airtime from your website.'); ?></small>
                            </p>
                        </div>
                        <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->airtime): ?> checked <?php endif; ?> name="airtime"
                             id="airtime" /> 
                        </div>   
                        </div>
                    </li>

                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Airtime To Cash'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Airtime To Cash'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to exchange airtime for cash your website.'); ?></small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" <?php if($general->airtime2cash): ?> checked <?php endif; ?> name="airtime2cash"
                         id="airtime2cash" /> 
                    </div>   
                    </div>
                </li>
                 
                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Betting Wallet Funding'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Betting Wallet Funding'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to fund betting wallet from your website.'); ?></small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" <?php if($general->betting): ?> checked <?php endif; ?> name="betting"
                         id="betting" /> 
                    </div>   
                    </div>
                </li>

                <li
                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                <div>
                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Event Ticket Vending'); ?></p>
                    <p class="mb-0">
                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Event Ticket Vending'); ?></span>
                            <?php echo app('translator')->get('the system will enable visitor to buy selected event tickets from your website.'); ?></small>
                    </p>
                </div>
                <div class="form-group">

                <div class="form-check form-switch form-check-success">
                    <input type="checkbox" class="form-check-input" <?php if($general->event): ?> checked <?php endif; ?> name="event"
                     id="event" /> 
                </div>   
                </div>
            </li>


            <li
            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
            <div>
                <p class="fw-bold mb-0"><?php echo app('translator')->get('Escrow Service'); ?></p>
                <p class="mb-0">
                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Escrow Service'); ?></span>
                        <?php echo app('translator')->get('the system will enable visitor to engage in escrow services on your website.'); ?></small>
                </p>
            </div>
            <div class="form-group">

            <div class="form-check form-switch form-check-success">
                <input type="checkbox" class="form-check-input" <?php if($general->escrow): ?> checked <?php endif; ?> name="escrow"
                 id="escrow" /> 
            </div>   
            </div>
        </li>

       


                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Airtime Local Vending'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Airtime Local Vending'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to purchase local airtime from your website.'); ?></small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" <?php if($general->airtimelocal): ?> checked <?php endif; ?> name="airtimelocal"
                         id="airtimelocal" /> 
                    </div>   
                    </div>
                </li>

                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Internet Vending'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Internet Vending'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to purchase internet from your website.'); ?></small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" <?php if($general->internet): ?> checked <?php endif; ?> name="internet"
                         id="internet" /> 
                    </div>   
                    </div> 
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('SME Data / Data Gifting'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('SME Data / Data Gifting'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to purchase SME data bundle from your website.'); ?></small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" <?php if($general->internetsme): ?> checked <?php endif; ?> name="internetsme"
                         id="internetsme" /> 
                    </div>   
                    </div>  
                    </li>


                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('SME Data / Data Gifting Provider'); ?></p>
                            <p class="mb-0">
                                <small><?php echo app('translator')->get('By changin'); ?> <span class="fw-bold"><?php echo app('translator')->get('SME Data / Data Gifting Provider'); ?></span>
                                    <?php echo app('translator')->get('the system will route SME data purchase via the selected service provider.'); ?></small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="internetsme_provider"
                             id="internetsme_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option <?php if($general->internetsme_provider == 'VTPASS'): ?> selected <?php endif; ?> disabled>VTPASS</option>
                             <option <?php if($general->internetsme_provider == 'N3TDATA'): ?> selected <?php endif; ?>>N3TDATA</option>
                             <option <?php if($general->internetsme_provider == 'GTIDINGSDATA'): ?> selected <?php endif; ?>>GTIDINGSDATA</option>
                             <option <?php if($general->internetsme_provider == 'GSUBZ'): ?> selected <?php endif; ?>>GSUBZ</option>
                           </select>
                        </div>   
                        </div>  
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('API Internet Data Vending Provider'); ?></p>
                            <p class="mb-0">
                                <small><?php echo app('translator')->get('By changing'); ?> <span class="fw-bold"><?php echo app('translator')->get('API Internet Data Provider'); ?></span>
                                    <?php echo app('translator')->get('the system will route API data vending via the selected service provider.'); ?></small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="internet_api_sme_provider"
                             id="internet_api_sme_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option <?php if($general->internet_api_sme_provider == 'SIMHOSTING'): ?> selected <?php endif; ?> value="SIMHOSTING">SIM HOSTING</option>
                             <option <?php if($general->internet_api_sme_provider == 'N3TDATA'): ?> selected <?php endif; ?>>N3TDATA</option>
                             <option <?php if($general->internet_api_sme_provider == 'GSUBZ'): ?> selected <?php endif; ?>>GSUBZ</option>
                           </select>
                        </div>   
                        </div>  
                    </li>



                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Local Airtime Provider'); ?></p>
                            <p class="mb-0">
                                <small><?php echo app('translator')->get('By changin'); ?> <span class="fw-bold"><?php echo app('translator')->get('Local Airtime Provider'); ?></span>
                                    <?php echo app('translator')->get('the system will route Local Airtime purchase via the selected service provider.'); ?></small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="airtime_provider"
                             id="airtime_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option <?php if($general->airtime_provider == 'VTPASS'): ?> selected <?php endif; ?>>VTPASS</option>
                             <option <?php if($general->airtime_provider == 'N3TDATA'): ?> selected <?php endif; ?>>N3TDATA</option>
                             <option <?php if($general->airtime_provider == 'GSUBZ'): ?>  <?php endif; ?> disabled>NEW API COMING SOON</option>
                           </select>
                        </div>   
                        </div>  
                    </li>


                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Cable TV Vending'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Cable TV Vending'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to purchase internet from your website.'); ?></small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" <?php if($general->cabletv): ?> checked <?php endif; ?> name="cabletv"
                         id="cabletv" /> 
                    </div>   
                    </div> 
                    </li> 
                    <li
                    class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Insurance Bills Payment'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Insurance Bills Payment'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to pay automobile and car insurance bills from your website.'); ?></small>
                        </p>
                    </div>
                    <div class="form-group">

                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" <?php if($general->insurance): ?> checked <?php endif; ?> name="insurance"
                         id="insurance" /> 
                    </div>   
                    </div> 
                    </li> 

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Cable TV Provider'); ?></p>
                            <p class="mb-0">
                                <small><?php echo app('translator')->get('By changing'); ?> <span class="fw-bold"><?php echo app('translator')->get('Cable TV Provider'); ?></span>
                                    <?php echo app('translator')->get('the system will route Cable TV purchase via the selected service provider.'); ?></small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <select class="form-control" name="cabletv_provider"
                             id="cabletv_provider"> 
                             <option selected disabled>Select A Provider</option>
                             <option <?php if($general->cabletv_provider == 'VTPASS'): ?> selected <?php endif; ?>>VTPASS</option>
                             <option <?php if($general->cabletv_provider == 'N3TDATA'): ?> selected <?php endif; ?>>N3TDATA</option>
                             <option <?php if($general->cabletv_provider == 'GSUBZ'): ?>  <?php endif; ?> disabled>NEW API COMING SOON</option>
                           </select>
                        </div>   
                        </div>  
                    </li>
                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-0"><?php echo app('translator')->get('Local Utility Bills'); ?></p>
                        <p class="mb-0">
                            <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Local Utility Bill'); ?></span>
                                <?php echo app('translator')->get('the system will enable visitor to pay local utility bill from your website.'); ?></small>
                        </p>
                    </div>
                        <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->utilitylocal): ?> checked <?php endif; ?> name="utilitylocal"
                            id="utilitylocal" /> 
                        </div>   
                        </div> 
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('Global Utility Bills'); ?></p>
                            <p class="mb-0">
                                <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Global Utility Bill'); ?></span>
                                    <?php echo app('translator')->get('the system will enable visitor to pay local global bill from your website.'); ?></small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->utilityglobal): ?> checked <?php endif; ?> name="utilityglobal"
                             id="utilityglobal" /> 
                        </div>   
                        </div> 
                    </li>

                    <li class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                        <div>
                            <p class="fw-bold mb-0"><?php echo app('translator')->get('P2P Transfer'); ?></p>
                            <p class="mb-0">
                                <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('P2P Transfer'); ?></span>
                                    <?php echo app('translator')->get('the system will enable visitor to transfer fund internaly on your website.'); ?></small>
                            </p>
                        </div>
                        <div class="form-group">
    
                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->utilityglobal): ?> checked <?php endif; ?> name="p2p"
                             id="p2p" /> 
                        </div>   
                        </div> 
                    </li>
                       

                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Daily Login Bonus'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Daily Login'); ?></span>
                                        <?php echo app('translator')->get('the system will credit visitor daily for visiting the site.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">

                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->login_bonus): ?> checked <?php endif; ?> name="login_bonus"
                                     id="login_bonus" /> 
                                </div>     
                            </div>
                        </li>

                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Daily Login Eaning'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('Enter Amount for'); ?> <span class="fw-bold"><?php echo app('translator')->get('Daily Login Bonus'); ?></span>
                                        <?php echo app('translator')->get('the system will credit visitor daily this amount for visiting the site.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" value="<?php echo e($general->login_earn); ?>" name="login_earn"
                                    <?php if($general->login_earn): ?> checked <?php endif; ?>>
                            </div>
                        </li>

                       

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Force SSL'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Force SSL (Secure Sockets Layer)'); ?></span>
                                            <?php echo app('translator')->get('the system will force a visitor that he/she must have to visit in secure mode. Otherwise, the site will be loaded in secure mode.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->force_ssl): ?> checked <?php endif; ?> name="force_ssl"
                             id="force_ssl" /> 
                        </div>     
                                </div>
                            </li>
                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Agree Policy'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you enable this module, that means a user must have to agree with your system\'s'); ?> <a
                                                href="<?php echo e(route('admin.frontend.sections', 'policy_pages')); ?>"><?php echo app('translator')->get('policies'); ?></a>
                                            <?php echo app('translator')->get('during registration.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->agree): ?> checked <?php endif; ?> name="agree"
                             id="agree" /> 
                        </div>      
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Force Secure Password'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('By enabling this module, a user must set a secure password while signing up or changing the password.'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->secure_password): ?> checked <?php endif; ?> name="secure_password"
                             id="secure_password" /> 
                        </div>       
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Email Verification'); ?></p>
                                    <p class="mb-0">
                                        <small>
                                            <?php echo app('translator')->get('If you enable'); ?> <span class="fw-bold"><?php echo app('translator')->get('Email Verification'); ?></span>,
                                            <?php echo app('translator')->get('users have to verify their email to access the dashboard. A 6-digit verification code will be sent to their email to be verified.'); ?>
                                            <br>
                                            <span class="fw-bold"><i><?php echo app('translator')->get('Note'); ?>:</i></span> <i><?php echo app('translator')->get('Make sure that the'); ?>
                                                <span class="fw-bold"><?php echo app('translator')->get('Email Notification'); ?> </span> <?php echo app('translator')->get('module is enabled'); ?></i>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->ev): ?> checked <?php endif; ?> name="ev"
                             id="ev" /> 
                        </div>       
 
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Email Notification'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you enable this module, the system will send emails to users where needed. Otherwise, no email will be sent.'); ?> <code><?php echo app('translator')->get('So be sure before disabling this module that, the system doesn\'t need to send any emails.'); ?></code></small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->en): ?> checked <?php endif; ?> name="en"
                             id="en" /> 
                        </div>        
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Mobile Verification'); ?></p>
                                    <p class="mb-0">
                                        <small>
                                            <?php echo app('translator')->get('If you enable'); ?> <span class="fw-bold"><?php echo app('translator')->get('Mobile Verification'); ?></span>,
                                            <?php echo app('translator')->get('users have to verify their mobile to access the dashboard. A 6-digit verification code will be sent to their mobile to be verified.'); ?>
                                            <br>
                                            <span class="fw-bold"><i><?php echo app('translator')->get('Note'); ?>:</i></span> <i><?php echo app('translator')->get('Make sure that the'); ?>
                                                <span class="fw-bold"><?php echo app('translator')->get('SMS Notification'); ?> </span> <?php echo app('translator')->get('module is enabled'); ?></i>
                                        </small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->sv): ?> checked <?php endif; ?> name="sv"
                             id="sv" /> 
                        </div>         
                                </div>
                            </li>


                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('SMS Notification'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you enable this module, the system will send SMS to users where needed. Otherwise, no SMS will be sent.'); ?> <code><?php echo app('translator')->get('So be sure before disabling this module that, the system doesn\'t need to send any SMS.'); ?></code></small>
                                    </p>
                                </div>
                                <div class="form-group">

                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" <?php if($general->sn): ?> checked <?php endif; ?> name="sn"
                             id="sn" /> 
                        </div>         
 
                                </div>
                            </li>

                            <li
                                class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                <div>
                                    <p class="fw-bold mb-0"><?php echo app('translator')->get('Language'); ?></p>
                                    <p class="mb-0">
                                        <small><?php echo app('translator')->get('If you disable this module, that means no one can change the language'); ?></small>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input" <?php if($general->ln): ?> checked <?php endif; ?> name="ln"
                                         id="ln" /> 
                                    </div>         
  
                                </div>
                            </li>
                            <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Welcome Bonus Status'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('By enabling'); ?> <span class="fw-bold"><?php echo app('translator')->get('Welcome Bonus Status'); ?></span>
                                        <?php echo app('translator')->get('the system will allow newly registered user earn welcome bonus daily for registring the site.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">

                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" <?php if($general->welcome_bonus): ?> checked <?php endif; ?> name="welcome_bonus"
                                     id="welcome_bonus" /> 
                                </div>  
                            </div>
                        </li>

                        <li
                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo app('translator')->get('Welcome Bonus'); ?></p>
                                <p class="mb-0">
                                    <small><?php echo app('translator')->get('Enter Amount for'); ?> <span class="fw-bold"><?php echo app('translator')->get('Welcome Bonus'); ?></span>
                                        <?php echo app('translator')->get('the system will credit new user this amount for registring on the site.'); ?></small>
                                </p>
                            </div>
                            <div class="form-group">
                                
                                <input type="number" class="form-control" value="<?php echo e($general->welcome_bonus_amount); ?>" name="welcome_bonus_amount"
                                    <?php if($general->welcome_bonus_amount): ?> checked <?php endif; ?>>
                            </div>
                        </li>


                        </ul>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/setting/configuration.blade.php ENDPATH**/ ?>