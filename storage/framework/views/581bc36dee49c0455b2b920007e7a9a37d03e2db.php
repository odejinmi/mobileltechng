<?php $__env->startSection('panel'); ?>
  <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/sportsbettingposter.jpg')); ?>" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/sportsbettingposter.jpg')); ?>" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->
    <section class="section-b-space" id="step1">
        <div class="custom-container">
            <div class="currency-transfer">
                <form class="auth-form crypto-form" id="invoicedetails">
                    <div class="form-group">
                        <label for="inputassets" class="form-label mb-2">Sport Betting</label>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" id="bettingprovider">Select Company</a>

                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $networks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li  onclick="networkprovider('<?php echo e(strToUpper($data['provider'])); ?>','<?php echo e($general->cur_sym); ?> <?php echo e(@number_format($data['minAmount']['amount'],2)); ?>','<?php echo e($general->cur_sym); ?> <?php echo e(@number_format($data['maxAmount']['amount'],2)); ?>')">
                                            <a class="dropdown-item"><img class="img-fluid currency-icon" src="<?php echo e($data['providerLogoUrl']); ?>"
                                                    alt="provider" /><?php echo e(strToUpper($data['provider'])); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <input id="companyId" name="servprov" hidden> 
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <h5 class="light-text mb-0" id="minimum"></h5>
                            <h5 class="theme-color fw-normal mb-0" id="maximum"></h5>
                        </div>
                    </div>
                    
                    <?php $__env->startPush('script'); ?>
                        <script>
                            function networkprovider(provider,min,max) {
                                document.getElementById("companyId").value = provider;
                                document.getElementById("bettingprovider").innerHTML = provider;
                                document.getElementById("minimum").innerHTML = min;
                                document.getElementById("maximum").innerHTML = max;
                            }
                        </script>
                    <?php $__env->stopPush(); ?>
                    <section class="pay-money section-b-space">
                        <div class="form-group">
                            <div class="form-group mt-3">
                                <div class="form-input" id="">
                                    <input type="number" name="amount" placeholder="$0.00" class="form-control amount"
                                        id="amount">
                                </div>
                            </div>
                        </div>

                        
                        <center>
                            <ul class="nav nav-pills tab-style3 w-100 mt-3" id="myTab" role="tablist">
                                <li class="nav-item w-25"  onclick="setamount(200)" role="presentation">
                                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">$200</button>
                                </li>
                                <li class="nav-item w-25"  onclick="setamount(500)" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">$500</button>
                                </li>
                                <li class="nav-item w-25"  onclick="setamount(1000)" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">$1k</button>
                                </li>
                                <li class="nav-item w-25" onclick="setamount(2000)" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">$2k</button>
                                </li>
                            </ul>
                         
                        <?php $__env->startPush('script'); ?>
                        <script>
                            function setamount(amount) {
                                document.getElementById("amount").value = amount; 
                            }
                        </script>
                       <?php $__env->stopPush(); ?>
                        </center>
                        <div class="form-group">
                            <div class="form-group mt-3">
                                <div class="form-input" id="">
                                    <input type="text" name="merchant" onkeyup="verifywallet(this)" placeholder="Enter Wallet ID" class="form-control reason"
                                        id="merchant">
                                </div>
                            </div>
                            <center><div id="beneficiaryname"></div></center>
                            <center><div id="loader"></div></center>
                            <input id='customername' hidden>
                        </div>
                        <?php $__env->startPush('script'); ?>
                        <script>
                            function verifywallet(e) {
                                if (e.value.length < 5) {
                                    return;
                                }
                                $("#beneficiaryname").html(``);
                                $("#loader").html(
                                    `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
                                );
                                var company = document.getElementById("companyId").value;
                                var raw = JSON.stringify({
                                    _token: "<?php echo e(csrf_token()); ?>",
                                    customer: e.value,
                                    company: company,
                                    
                                });
    
                                var requestOptions = {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    body: raw
                                };
                                fetch("<?php echo e(route('user.betting.wallet.verify')); ?>", requestOptions)
                                    .then(response => response.text())
                                    .then(result => {
                                        resp = JSON.parse(result);
                                        if (resp.ok != true) {
                                            document.getElementById("submit").disabled = true;
                                            document.getElementById("beneficiaryname").innerHTML = `<span class="mb-1 badge font-medium bg-danger text-white">${resp.message}</span>`;

                                        }
                                        if (resp.ok != false) {
                                            document.getElementById("submit").disabled = false;
                                            document.getElementById("beneficiaryname").innerHTML = `<span class="mb-1 badge font-medium bg-primary text-white">Customer Name: ${resp.content}</span>`;
                                            document.getElementById("customername").value = resp.content;
                                        } 
                                        $("#loader").html('');  
                                    })
                                    .catch(error => {

                                        $("#loader").html('');  
                                    });
                                // END GET DATA \\
                            }
                        </script>
                        
                            <?php $__env->stopPush(); ?>
                        <div class="form-group">
                            <div class="form-input mt-3">
                                <input type="number" id="password"  autocomplete="new-password"  maxlength="6"  class="form-control reason" name="code"
                                    placeholder="Transaction PIN" />
                            </div>
                        </div>
                    </section>

                    <div class="transfer-btn">
                        <div class="custom-container">
                            <button type="button"  disabled onclick="submitform()" id="submit" class="btn theme-btn sub-btn  w-100">Process Request</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>


  <!-- pay money section starts -->
  <section class="pay-money section-b-space" id="step2">
    <div class="custom-container">
        <form class="auth-form" action="<?php echo e(route('user.crypto.sell.confirm.manual')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>                                          
         <div class="custom-container">
             <div class="profile-pic">
             <img class="img-fluid img" src="<?php echo e(asset('assets/assets/dist/images/backgrounds/2.png')); ?>" alt="p3" />
             </div>
             <h3 class="person-name"><?php echo app('translator')->get('Please send coin to the wallet address below'); ?></h3>
             <div class="contact-panel"> 
          
                  <div class="form-group">
                      <input type="text" class="form-control" id="WalletAddress" readonly  placeholder="Wallet Address">
                      <button type="button" onclick="CopyWalletAddress()" class="btn theme-btn w-100">Copy Address</button>

                     
                  </div>
             </div>
             
             <div class="form-group">
             <div class="form-input mt-3">
                 <input type="text" class="form-control reason" name="trxhash" id="trxhash" required="" placeholder="TRX ID" />
             </div>
             </div>
             <h3 class="info-id border-0 pb-0">Please enter your transaction reference number above.</h3>
             <input id="trxnumber" name="trx" hidden>


             <div class="form-group">
             <div class="upload-image rounded-image">
                 <input class="form-control upload-file" required type="file" name="proof" id="proof" accept=".png, .jpg, .jpeg" >
                 <i class="upload-icon dark-text" data-feather="plus"></i>
                </div>
             </div>
               

             <h3 class="info-id border-0 pb-0">To verify your payment, please upload proof of payment.</h3>

             <ul class="toogle-switch border-0 pt-0">
                 <li>
                     <h3>Agree</h3>
                     <div class="switch-btn">
                         <input type="checkbox" required />
                     </div>
                 </li> 
             </ul>


             <button type="submit" class="btn theme-btn w-100"><a id="button">I Paid</a></button>
         </div>
     </form>

    </div>
  </section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.betting.history')); ?>" class="back-btn">
    <i class="icon" data-feather="grid"></i>
  </a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/bills/betting/betting_buy.blade.php ENDPATH**/ ?>