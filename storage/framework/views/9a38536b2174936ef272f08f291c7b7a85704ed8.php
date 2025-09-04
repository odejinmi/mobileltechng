
<?php $__env->startSection('panel'); ?>

  <!-- cards section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <ul class="card-list">
        <?php $__empty_1 = true; $__currentLoopData = @$log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <li class="credit-card-box color1">
          <div class="card-logo">
            <img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')); ?>" alt="logo1" />
            <div class="dropdown">
              <a href="<?php echo e(route('user.virtualcard.details',$item->card_id)); ?>" class="back-btn" role="button" >
                <i class="icon" data-feather="more-horizontal"></i>
              </a> 
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-number"><?php echo e($item->pan); ?> </h6>
              <h5 class="card-name"><?php echo e(__($item->brand)); ?></h5>
            </div>
            <img class="img-fluid chip" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/card-chip.svg')); ?>" alt="card-chip" />
          </div>
          <div class="d-flex justify-content-between">
            <h2 class="card-amount">
                <?php if($item->status == 'active'): ?>
                                                <span class="badge bg-success"><?php echo e(strToUpper($item->status)); ?></span>
                                                <?php else: ?>
                                                <span class="badge bg-warning"><?php echo e(strToUpper($item->status)); ?></span>
                                                <?php endif; ?>
            </h2>
            <div class="card-date w-100">
              <h6>Exp. date</h6>
              <h6 class="text-white fw-semibold mt-1"><?php echo e($item->expiry_month); ?> /<?php echo e($item->expiry_year); ?></h6>
            </div>
            <div class="card-numbers w-100">
              <h6 class="cvv-code">Cvv</h6>
              <h6 class="text-white fw-semibold mt-1">***</h6>
            </div>
          </div>
        </li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData2(); ?>

                                <?php endif; ?>
      </ul>
    </div>
  </section>
  <!-- cards section end -->
  
  <!-- add card modal starts -->
  <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
    <?php echo csrf_field(); ?>
  <div class="modal add-money-modal fade" id="add-card" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Add Card</h2>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="inputcards" class="form-label mb-2">Card type</label>
            <div class="d-flex gap-2">
                <select type="text" class="form-select  username <?php $__errorArgs = ['card'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="card"
                name="type">
                <option selected disabled>Select An Option</option>
                <option value="Verve">Verve (NGN)</option>
                <option value="MasterCard">MasterCard (USD)</option>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Account BVN</label>
            <div class="form-input mb-3">
                <input  type="text" name="bvn" maxlength="11" class="form-control form-control-solid"/>
            </div>
          </div>
          
              <div class="form-group">
                <label class="form-label">Transaction PIN</label>
                <div class="form-input mb-3">
                  <input type="number" name="pin" class="form-control" />
                </div>
              </div>
             
          <button type="submit" class="btn theme-btn successfully w-100">Create Card</button>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  </form>
  <!-- add card modal end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="#add-card" class="back-btn" data-bs-toggle="modal">
    <i class="icon" data-feather="plus"></i>
  </a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/vendor/virtualcard/create.blade.php ENDPATH**/ ?>