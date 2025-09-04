<?php $__env->startSection('panel'); ?>

<!-- person transaction list section starts -->
<section>
  <div class="custom-container">
    <div class="crypto-wallet-box">
      <div class="card-details">
        <div class="d-block w-75">
          <h5 class="fw-semibold"><?php echo app('translator')->get('Invoice Amount'); ?></h5>
          <h2 class="mt-2"><?php echo e(showAmount($invoice->amount)); ?> <?php echo e(__($general->cur_text)); ?></h2>
        </div> 
      </div>
    </div>
  </div>
</section>
<section>
  <div class="custom-container">
    <div class="crypto-wallet-box">
      <div class="card-details">
        <div class="d-block w-75">
          <h5 class="fw-semibold"><?php echo app('translator')->get('Total Payment'); ?></h5>
          <h2 class="mt-2"><?php echo e(showAmount($invoicetotal)); ?> <?php echo e(__($general->cur_text)); ?></h2>
        </div> 
      </div>
    </div>
  </div>
</section>
<!-- card end -->

<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">

      <div>
        <label><?php echo app('translator')->get('Invoice Link'); ?></label>
        <div class="input-group d-nones">
          <input type="text"id="referralURL" value="<?php echo e(url('/')); ?>/user/invoice/pay/<?php echo e(($invoice->trx)); ?>" readonly class="form-control"  onclick="myFunction()" > 
      </div>
      <hr>
      <?php $__empty_1 = true; $__currentLoopData = @$log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <?php
      $deposit = App\Models\Deposit::whereTrx($data->trx)->first();
      ?>
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail<?php echo e($deposit->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5><?php echo e(showDate($data->created_at)); ?></h5>
                <h3 class="<?php if($deposit->status == 1): ?> success-color <?php else: ?>  error-color <?php endif; ?>"> <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($deposit->amount)); ?><span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">Payment</h5>
                <h5 class="light-text"><?php echo e(showTime($deposit->created_at)); ?></h5>
              </div>
            </div>
          </a>
        </div>
      </div>


<!-- transaction detail modal start -->
<div class="modal successful-modal transfer-details fade" id="transaction-detail<?php echo e($deposit->id); ?>" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Invoice Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          
          <li>
            <h3 class="fw-normal dark-text">Name</h3>
            <h3 class="fw-normal light-text"><?php echo e(__(explode("|", $deposit->val_1)[0])); ?> <?php echo e(__(explode("|", $deposit->val_1)[1])); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Email</h3>
            <h3 class="fw-normal light-text"><?php echo e(__(explode("|", $deposit->val_1)[2])); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Phone</h3>
            <h3 class="fw-normal light-text"><?php echo e(__(explode("|", $deposit->val_1)[3])); ?></h3>
          </li> 
          <li class="amount">
            <h3 class="fw-normal dark-text">Amount</h3>
            <h3 class="fw-semibold error-color"><?php echo e(showAmount($data->amount)); ?> <?php echo e(__($general->cur_text)); ?></h3>
          </li>
        </ul>
      </div>
      <button type="button" class="btn close-btn" data-bs-dismiss="modal">
        <i class="icon" data-feather="x"></i>
      </button>

    </div>
  </div>
</div>
<!-- successful transfer modal end -->

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <?php echo emptyData2(); ?>

      <?php endif; ?>
    </div>

     
  </div>
</section>
<!-- person transaction list section end -->
 

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
 <script>
  function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            SlimNotifierJs.notification('success', 'Invoice Link Copied');

        }
 </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/vendor/invoice/invoice_payment_log.blade.php ENDPATH**/ ?>