<?php $__env->startSection('panel'); ?> 
   
  <!-- total saving section starts -->
  
  <!-- cards section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <ul class="card-list">
        <li class="credit-card-box color1">
          <div class="card-logo">
            <h4 class="card-name"><?php echo e(@$reply['data']['brand']); ?></h4>
            <div class="dropdown">
              <a role="button" >
               
              </a> 
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-number"><b>Card Pan:</b><?php echo e($reply['data']['pan']); ?></h6>
              <h5 class="card-name"><b>PIN:</b> <?php echo e(strToUpper($reply['data']['pin'])); ?></h5>
            </div>
            <img class="img-fluid chip" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/card-chip.svg')); ?>" alt="card-chip" />
          </div>
          <div class="d-flex justify-content-between">
            <h2 class="card-amount">
             
              <?php if($reply['data']['status'] != 'active'): ?>
             <div class="alert alert-danger" role="alert">
              <strong>Card Is <?php echo e(strToUpper($reply['data']['status'])); ?> - </strong> <?php echo app('translator')->get('Please contact admin to activate card'); ?>
              </div>
              <?php endif; ?>
            </h2>
            <div class="card-date w-100">
              <h6>Exp. date</h6>
              <h6 class="text-white fw-semibold mt-1"><?php echo e($reply['data']['expiry_month']); ?>/<?php echo e($reply['data']['expiry_year']); ?></h6>
            </div>
            <div class="card-numbers w-100">
              <h6 class="cvv-code">CVV</h6>
              <h6 class="text-white fw-semibold mt-1"><?php echo e($reply['data']['cvv']); ?></h6>
            </div>
          </div>
        </li>
 
      </ul>
        <?php if($reply['data']['status'] == 'active'): ?>
              <a href="<?php echo e(route('user.virtualcard.status.block',$reply['data']['id'])); ?>" class="btn btn-danger btn-sm"><i class="ti ti-lock"></i> <?php echo app('translator')->get('Block'); ?></a>
             
              <a  data-bs-toggle="modal" data-bs-target="#pin-modal" data-bs-whatever="@getbootstrap" href="#" class="btn btn-primary btn-sm"><i class="ti ti-key"></i> <?php echo app('translator')->get('Pin'); ?></a>
              <a  data-bs-toggle="modal" data-bs-target="#fund-modal" data-bs-whatever="@getbootstrap" href="#" class="btn btn-success btn-sm"><i class="ti ti-wallet"></i> <?php echo app('translator')->get('Fund'); ?></a>
             <?php endif; ?>
    </div>
  </section>
   
  <!-- total saving section end -->
  <div class="modal fade" id="pin-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="exampleModalLabel1">
            Update Card PIN
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form  class="" novalidate="novalidate" action="<?php echo e(route('user.virtualcard.status.password',$reply['data']['id'])); ?>" method="post">
            <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="mb-3">
              <label for="recipient-name" class="control-label">Old Card Pin:</label>
              <input type="password" name="old_pin" class="form-control" id="old_pin" />
            </div> 
            <div class="mb-3">
              <label for="recipient-name" class="control-label">New Card Pin:</label>
              <input type="number" name="new_pin" class="form-control" id="new_pin" />
            </div> 

            <div class="mb-3">
                <label for="recipient-name" class="control-label">Account Transaction Password:</label>
                <input type="password" name="password" class="form-control" id="password" />
              </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-danger-subtle text-danger font-medium"
            data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-success">
            Change Pin
          </button>
        </div>
    </form>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="fund-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h4 class="modal-title" id="exampleModalLabel1">
            Fund Card Balance
          </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form  class="" novalidate="novalidate" action="<?php echo e(route('user.virtualcard.fund.balance',$reply['data']['id'])); ?>" method="post">
            <?php echo csrf_field(); ?>
        <div class="modal-body">
            <div class="mb-3">
              <label for="recipient-name" class="control-label">Amount <small>(<?php echo e($reply['data']['currency']); ?>)</small>:</label>
              <input type="number" name="amount" class="form-control" placeholder="0.00<?php echo e($reply['data']['currency']); ?>" id="old_pin" />
            </div> 
             

            <div class="mb-3">
                <label for="recipient-name" class="control-label">Account Transaction Password:</label>
                <input type="password" name="password" class="form-control" id="password" />
              </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-danger-subtle text-danger font-medium"
            data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-success">
            Change Pin
          </button>
        </div>
    </form>
      </div>
    </div>
  </div>
   
        <?php $__env->stopSection(); ?>

        <?php $__env->startPush('breadcrumb-plugins'); ?>
           
        <?php $__env->stopPush(); ?>
 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/vendor/virtualcard/details.blade.php ENDPATH**/ ?>