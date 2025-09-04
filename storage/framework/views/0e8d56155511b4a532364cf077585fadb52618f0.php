<?php $__env->startSection('panel'); ?>
<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = $card; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $gcard = App\Models\Giftcard::whereId($data->card_id)->first();
        ?>
      <div class="col-12">
        <div class="transaction-box">
          <a href="#transaction-detail<?php echo e($data->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
            <div class="transaction-image">
                <img width="50" src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e(@$gcard->image); ?>" alt="avatar">
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5><?php echo e(@$gcard->name); ?><br>
                  <small class="text-muted"><?php echo e(strToUpper($data->trx_type)); ?></small>
                </h5>
                
                <?php if($data->status == 1): ?>
                <span
                    class="badge bg-success"><?php echo e($data->country); ?><?php echo e($data->amount); ?></span>
                <?php elseif($data->status == 0): ?>
                    <span
                        class="badge bg-warning"><?php echo e($data->country); ?><?php echo e($data->amount); ?></span>
                <?php elseif($data->status == 2): ?>
                    <span
                        class="badge bg-danger"><?php echo e($data->country); ?><?php echo e($data->amount); ?></span>
                <?php endif; ?>  
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text"><?php echo e($data->remark); ?></h5>
                <h5 class="light-text"><?php echo e(diffForHumans($data->created_at)); ?></h5>
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
        <h2 class="modal-title">Trade Details</h2>
      </div>
      <div class="modal-body">
        <ul class="details-list">
          <li>
            <h3 class="fw-normal dark-text">Status</h3>
            <h3 class="fw-normal light-text">
                <?php if($data->status == 1): ?>
                <span
                    class="badge bg-success">Approved</span>
                <?php elseif($data->status == 0): ?>
                    <span
                        class="badge bg-warning">Pending</span>
                <?php elseif($data->status == 2): ?>
                    <span
                        class="badge bg-danger">Declined</span>
                <?php endif; ?>    
            </h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Date</h3>
            <h3 class="fw-normal light-text">1<?php echo e(showDateTime($data->created_at)); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Time</h3>
            <h3 class="fw-normal light-text"><?php echo e(diffForHumans($data->created_at)); ?></h3>
          </li>
          <li>
            <h3 class="fw-normal dark-text">Giftcard</h3>
            <h3 class="fw-normal light-text"><?php echo e(isset(App\Models\Giftcard::whereId($data->card_id)->first()->id) ? App\Models\Giftcard::whereId($data->card_id)->first()->name : 'N/A'); ?></h3>
          </li> 
          <li>
            <h3 class="fw-normal dark-text">Giftcard Type</h3>
            <h3 class="fw-normal light-text"><?php echo e(isset(App\Models\Giftcardtype::whereId($data->currency)->first()->id) ? App\Models\Giftcardtype::whereId($data->currency)->first()->name : 'N/A'); ?></h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Exchange Rate</h3>
            <h3 class="fw-normal light-text">1<?php echo e($data->country); ?> = <?php echo e($general->cur_sym); ?><?php echo e(number_format($data->rate, 2)); ?></h3>
          </li>  
          <li>
            <h3 class="fw-normal dark-text">Calculated Value</h3>
            <h3 class="fw-normal light-text"><?php echo e($general->cur_sym); ?><?php echo e(number_format($data->amount * $data->rate, 2)); ?></h3>
          </li>  
          <li class="amount">
            <h3 class="fw-normal dark-text">Card Type</h3>
            <h3 class="fw-semibold error-color"><?php echo e($data->type); ?></h3>
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
    <?php if($card->hasPages()): ?>
    <nav aria-label="Page navigation example mt-2">
        <ul class="pagination justify-content-center">
            <?php echo e($card->links()); ?>

        </ul>
    </nav> 
    <?php endif; ?>
     
  </div>
</section>
  
<?php $__env->stopSection(); ?>
 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/giftcard/giftcard-log.blade.php ENDPATH**/ ?>