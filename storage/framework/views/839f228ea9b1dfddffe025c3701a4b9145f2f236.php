<?php $__env->startSection('panel'); ?> 
<section class="section-b-space">
    <div class="custom-container"> 
  
      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = @$transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="#transaction-detail<?php echo e($trx->id); ?>" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <i class="icon" data-feather="printer"></i>
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e(__($trx->trx)); ?></h5>
                  <h3 class="<?php if($trx->trx_type == '+'): ?> success-color <?php else: ?> error-color <?php endif; ?>"> <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($trx->amount)); ?><span></span></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="<?php if($trx->trx_type == '+'): ?> success-color <?php else: ?> error-color <?php endif; ?>"><?php if($trx->trx_type == '+'): ?> Credit <?php else: ?> Debit <?php endif; ?></h5>
                  <h5 class="light-text"><?php echo e(diffForHumans($trx->created_at)); ?></h5>
                </div>
              </div>
            </a>
          </div>
        </div>
  
  
  <!-- transaction detail modal start -->
  <div class="modal successful-modal transfer-details fade" id="transaction-detail<?php echo e($trx->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Transaction Detail</h2>
        </div>
        <div class="modal-body">
          <ul class="details-list">
            
            <li>
              <h3 class="fw-normal dark-text">Date</h3>
              <h3 class="fw-normal light-text"><?php echo e(showDateTime($trx->created_at)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Time</h3>
              <h3 class="fw-normal light-text"><?php echo e(diffForHumans($trx->created_at)); ?></h3>
            </li>
            <li>
              <h3 class="fw-normal dark-text">Amount </h3>
              <h3 class="fw-normal light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($trx->amount)); ?></h3>
            </li> 
            <li>
              <h3 class="fw-normal dark-text">Fee</h3>
              <h3 class="fw-normal light-text"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($trx->charge)); ?></h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Balance Before</h3>
              <h3 class="fw-normal light-text">
                <?php echo e(showAmount($trx->post_balance)); ?> <?php echo e(__($general->cur_text)); ?>

              </h3>
            </li>  
            <li>
              <h3 class="fw-normal dark-text">Remark</h3>
              <h3 class="fw-normal light-text"><?php echo e(__($trx->details)); ?></h3>
            </li>   
            <?php if($trx->remark == 'POS'): ?>
            <li>
              <h3 class="fw-normal dark-text"></h3>
              <h3 class="fw-normal light-text"><a href="?action=print&id=<?php echo e($trx->trx); ?>" class="badge bg-primary">Print Receipt</a></h3>
            </li>  
            <?php endif; ?>
             
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
      <?php if($transactions->hasPages()): ?>
      <br>
      <nav aria-label="Page navigation example mt-2">
        <ul class="pagination justify-content-center">
            <?php echo e($transactions->links()); ?>

        </ul>
    </nav> 
      <?php endif; ?>
    </div>
  </section>
  
  <?php $__env->startPush('style'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <?php $__env->stopPush(); ?>
  <?php $__env->startPush('script'); ?>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script>
    $(function() {
      $('input[name="date"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        document.getElementById("start").value = start.format('YYYY-MM-DD');
        document.getElementById("end").value = end.format('YYYY-MM-DD');
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });
    </script>
<?php $__env->stopPush(); ?>    
  <?php $__env->startPush('breadcrumb-plugins'); ?>

   <div class="dropdown">
    <a href="#form" class="btn theme-btn" data-bs-toggle="modal">
         <i class="icon" data-feather="printer"></i>
     </a>

  </div>
  <?php $__env->stopPush(); ?>
      <!-- form modal starts -->
      <div class="modal add-money-modal fade" id="form" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Generate Statement Of Account</h2>
                </div>
                <div class="modal-body">
                  <form action="">
                    <div class=" ">
                         <div class="form-group">
                          <label><?php echo app('translator')->get('Transaction Type'); ?></label>
                            <select class="form-control" name="trx_type">
                                <option value=""><?php echo app('translator')->get('All'); ?></option>
                                <option value="+" <?php if(request()->trx_type == '+'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Credit'); ?></option>
                                <option value="-" <?php if(request()->trx_type == '-'): echo 'selected'; endif; ?>><?php echo app('translator')->get('Debit'); ?></option>
                            </select>
                        </div> 
                        <div class="form-group">
                          <label><?php echo app('translator')->get('Date'); ?></label>
                            <input class="datepicker-here form-control" name="date" type="text" value="<?php echo e(request()->date); ?>" placeholder="<?php echo app('translator')->get('Start date - End date'); ?>" autocomplete="off">
                            <input name="start" hidden id="start">
                            <input name="end" hidden id="end">

                        </div>
                        <div class="form-group">
                          <button class="btn theme-btn successfully w-100"><i class="ti ti-search"></i>
                                <?php echo app('translator')->get('Filter'); ?></button>
                        </div>
                    </div>
                </form>

                 </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <i class="icon" data-feather="x"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- form modal end -->

<?php $__env->stopSection(); ?>  

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/transactions.blade.php ENDPATH**/ ?>