<?php $__env->startSection('panel'); ?>
 <!-- pay money section starts -->
 <section class="pay-money section-b-space">
    <div class="custom-container">
      <div class="profile-pic">
        <img class="img-fluid img" src="<?php echo e(getImage(imagePath()['gateway']['path'] . '/' . @$deposit->gateway->image, imagePath()['gateway']['size'])); ?>" alt="p3" />
      </div>
      <h3 class="person-name">Make Payment</h3>
      <h5 class="upi-id">Method : <?php echo e($deposit->gateway->alias); ?></h5>
       

      <form action="#" method="POST" class="text-center">
        <?php echo csrf_field(); ?> 
        <ul class="card-list">
            <li class="payment-add-box">
              <div class="add-img"> 
                <div class="categories-box">
                    <i class="categories-icon" data-feather="shopping-cart"></i>
                </div>
              </div>
              <div class="add-content">
                <div>
                  <h5 class="fw-semibold dark-text">Amount</h5>
                  <h6 class="mt-2 light-text"></h6>
                </div> 

                <div class="form-check">
                    <?php echo e(showAmount($deposit->final_amo)); ?>

                    <?php echo e(__($deposit->method_currency)); ?>

                  </div>
              </div>
            </li> 

            <li class="payment-add-box">
                <div class="add-img">
                  <div class="categories-box">
                      <i class="categories-icon" data-feather="percent"></i>
                  </div>
                </div>
                <div class="add-content">
                  <div>
                    <h5 class="fw-semibold dark-text">Fee</h5>
                    <h6 class="mt-2 light-text"></h6>
                  </div> 
  
                  <div class="form-check">
                      <?php echo e(showAmount($deposit->charge)); ?> <?php echo e(__($deposit->method_currency)); ?>

                    </div>
                </div>
              </li>
    
            <li class="payment-add-box">
              <div class="add-img">
                <div class="categories-box">
                    <i class="categories-icon" data-feather="shopping-bag"></i>
                </div>
              </div>
              <div class="add-content">
                <div>
                  <h5 class="fw-semibold dark-text">You Get</h5>
                  <h6 class="mt-2 light-text"></h6>
                </div> 

                <div class="form-check">
                    <?php echo e(showAmount($deposit->amount)); ?> <?php echo e(__($general->cur_text)); ?>

                  </div>
              </div>
            </li>
          </ul>
        <button type="button" class="btn theme-btn w-100 mt-3"
            id="btn-confirm" onClick="payWithRave()"><?php echo app('translator')->get('Pay Now'); ?></button>
        
    </form>

      

    </div>
  </section>
 
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script>
        "use strict"
        var btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");
        const API_publicKey = "<?php echo e($data->API_publicKey); ?>";

        function payWithRave() {
            var x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "<?php echo e($data->customer_email); ?>",
                amount: "<?php echo e($data->amount); ?>",
                customer_phone: "<?php echo e($data->customer_phone); ?>",
                currency: "<?php echo e($data->currency); ?>",
                txref: "<?php echo e($data->txref); ?>",
                onclose: function() {},
                callback: function(response) {
                    var txref = response.tx.txRef;
                    var status = response.tx.status;
                    var chargeResponse = response.tx.chargeResponseCode;
                    if (chargeResponse == "00" || chargeResponse == "0") {
                        window.location = '<?php echo e(url('ipn/flutterwave')); ?>/' + txref + '/' + status;
                    } else {
                        window.location = '<?php echo e(url('ipn/flutterwave')); ?>/' + txref + '/' + status;
                    }
                    // x.close(); // use this to close the modal immediately after payment.
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/payment/Flutterwave.blade.php ENDPATH**/ ?>