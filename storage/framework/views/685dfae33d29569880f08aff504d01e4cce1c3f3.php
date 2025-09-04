
<?php $__env->startSection('panel'); ?>

<!-- person transaction list section starts -->
<section>
  <div class="custom-container">
    <div class="crypto-wallet-box">
      <div class="card-details">
        <div class="d-block w-75">
          <h5 class="fw-semibold"><?php echo app('translator')->get('Total Sent'); ?></h5>
          <h2 class="mt-2"><?php echo e($general->cur_sym); ?><?php echo e(number_format($payment,2)); ?></h2>
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
          <h5 class="fw-semibold"><?php echo app('translator')->get('Total Received'); ?></h5>
          <h2 class="mt-2"><?php echo e($general->cur_sym); ?><?php echo e(number_format($received,2)); ?></h2>
        </div> 
      </div>
    </div>
  </div>
</section>
<!-- card end -->

<section> 
<div class="container">
  <h4 class="fw-semibold fs-s5">Scan QR Codes</h4>
  <div class="mb-4 mt-4">
    <center>
<img src="<?php echo e(QR($url)); ?>" class="card-img" style="  display: block;
max-width:250px;
max-height:250;
width: auto;
height: auto;" alt="nft" />
</center>
</div>
  <div class="section">
      <div id="my-qr-reader"></div>
  </div>
</div>
</section>

<section class="section-b-space">
  <div class="custom-container"> 
    <div class="row gy-3">
      <div>  
        <?php $__empty_1 = true; $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail<?php echo e($data->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5><?php echo e(showDate($data->created_at)); ?></h5>
                <h3 class="success-color"><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->amount,2)); ?><span></span></h3>
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">Payment</h5>
                <h5 class="light-text"><?php echo e(showTime($data->created_at)); ?></h5>
              </div>
            </div>
          </a>
        </div>
      </div>


<!-- transaction detail modal start -->
<div class="modal successful-modal transfer-details fade" id="transaction-detail<?php echo e($data->id); ?>" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Payment Detail</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          
          <li>
            <h3 class="fw-normal dark-text">Name</h3>
            <h3 class="fw-normal light-text"><?php echo e(@$data->customer->username); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Email</h3>
            <h3 class="fw-normal light-text"><?php echo e(@$data->customer->email); ?></h3>
          </li>
          
          <li class="amount">
            <h3 class="fw-normal dark-text">Amount</h3>
            <h3 class="fw-semibold error-color"><?php echo e(showAmount($data->amount)); ?> <?php echo e(__($general->cur_text)); ?></h3>
          </li>
        </ul>
      </div>
      <a type="button" class="btn close-btn" data-bs-dismiss="modal">
        <i class="icon" data-feather="x"></i>
      </a>

    </div>
  </div>
</div>
<!-- successful transfer modal end -->

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <?php echo emptyData2(); ?>

      <?php endif; ?>
    </div>
    <?php if($trx->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($trx->links()); ?>

    </div>
    <?php endif; ?>
     
  </div>
</section>
<!-- person transaction list section end -->
 

<?php $__env->startPush('style'); ?>
<style>

#my-qr-reader {
    padding: 20px !important;
    border: 1.5px solid #b2b2b2 !important;
    border-radius: 8px;
}
 
#my-qr-reader img[alt="Info icon"] {
    display: none;
}
 
#my-qr-reader img[alt="Camera based scan"] {
    width: 100px !important;
    height: 100px !important;
}
 
button {
    padding: 10px 20px;
    border: 1px solid #b2b2b2;
    outline: none;
    border-radius: 0.25em;
    color: white;
    font-size: 15px;
    cursor: pointer;
    margin-top: 15px;
    margin-bottom: 10px;
    background-color: #008000ad;
    transition: 0.3s background-color;
}
 
button:hover {
    background-color: #008000;
}
 
#html5-qrcode-anchor-scan-type-change {
    text-decoration: none !important;
    color: #1d9bf0;
}
 
video {
    width: 100% !important;
    border: 1px solid #b2b2b2 !important;
    border-radius: 0.25em;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>

<script
src="https://unpkg.com/html5-qrcode">
</script>
<script>
    function domReady(fn) {
    if (
        document.readyState === "complete" ||
        document.readyState === "interactive"
    ) {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}
 
domReady(function () {
 
    // If found you qr code
    function onScanSuccess(decodeText, decodeResult) {
        window.location.replace(decodeText, "_newtab");
        //alert("You Qr is : " + decodeText, decodeResult);
    }
 
    let htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbos: 250 }
    );
    htmlscanner.render(onScanSuccess);
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/qr/index.blade.php ENDPATH**/ ?>