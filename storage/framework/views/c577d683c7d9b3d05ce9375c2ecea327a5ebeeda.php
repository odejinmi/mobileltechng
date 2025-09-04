<?php $__env->startSection('panel'); ?>
  <!-- pay money section starts -->
  <section class="pay-money section-b-space">
    <div class="custom-container">
      <div class="profile-pic">
        <img class="img-fluid img" src="<?php echo e(getImage(imagePath()['gateway']['path'] . '/' . @$deposit->gateway->image, imagePath()['gateway']['size'])); ?>" alt="p3" />
      </div>
      <h3 class="person-name">Make Payment</h3>
      <h5 class="upi-id">Method : <?php echo e($deposit->gateway->alias); ?></h5>
       

      <form action="<?php echo e(route('ipn.' . $deposit->gateway->alias)); ?>" method="POST" class="text-center">
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
            id="btn-confirm"><?php echo app('translator')->get('Pay Now'); ?></button>
        <script src="//js.paystack.co/v1/inline.js" data-key="<?php echo e($data->key); ?>" data-email="<?php echo e($data->email); ?>"
            data-amount="<?php echo e(round($data->amount)); ?>" data-currency="<?php echo e($data->currency); ?>" data-ref="<?php echo e($data->ref); ?>"
            data-custom-button="btn-confirm"></script>
    </form>

      

    </div>
  </section>
  <!-- pay money section end -->
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/payment/Paystack.blade.php ENDPATH**/ ?>