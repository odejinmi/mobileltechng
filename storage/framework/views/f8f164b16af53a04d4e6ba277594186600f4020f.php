
<?php $__env->startSection('panel'); ?>

<!-- profile section start -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="profile-section">
        <div class="profile-banner">
          <div class="profile-image">
            <img class="img-fluid profile-pic" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')); ?>" alt="p3" />
          </div>
        </div>
        <h2>Visa Card</h2>
        <h5></h5>
      </div>

      <ul class="profile-list">
        <li>
          <a href="<?php echo e(url('/user/create/customer')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="user"></i>
            </div>
            <div class="profile-details">
              <h4>Card Holder</h4>
              <img class="img-fluid arrow" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')); ?>" alt="arrow" />
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo e(url('/user/create/card')); ?>" class="profile-box">
            <div class="profile-img">
              <i class="icon" data-feather="credit-card"></i>
            </div>
            <div class="profile-details">
              <h4>Create Card</h4>
              <img class="img-fluid arrow" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/arrow.svg')); ?>" alt="arrow" />
            </div>
          </a>
        </li>
    </div>
</section>
  
  <!-- cards section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <ul class="card-list">
        <?php $__empty_1 = true; $__currentLoopData = $vcards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <li class="credit-card-box color1">
          <div class="card-logo">
            <img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')); ?>" alt="logo1" />
             
             <div class="dropdown">
              <a href="#" class="back-btn" role="button" data-bs-toggle="dropdown">
                <i class="icon" data-feather="more-horizontal"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo e(url('/user/view/card/'.$row->id)); ?>">View</a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('/user/withdraw/card/'.$row->id)); ?>">Withdraw</a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('/user/freeze/card/'.$row->id)); ?>">Freeze</a></li>
                <li><a class="dropdown-item" href="<?php echo e(url('/user/unfreeze/card/'.$row->id)); ?>">Unfreeze</a></li>
              </ul>
            </div>
            
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-number"> <?php if(isset($row->card_id)): ?><?php echo e($row->card_id); ?><?php endif; ?> </h6>
              <h5 class="card-name">Ref: <?php if(isset($row->reference)): ?><?php echo e($row->reference); ?><?php endif; ?></h5>
            </div>
            <img class="img-fluid chip" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/card-chip.svg')); ?>" alt="card-chip" />
          </div>
          <div class="d-flex justify-content-between">
            <h2 class="card-amount">
                
            </h2>
            <div class="card-date w-100">
              <h6></h6>
              <h6 class="text-white fw-semibold mt-1"></h6>
            </div>
            <div class="card-numbers w-100">
              <h6 class="cvv-code">Type</h6>
              <h6 class="text-white fw-semibold mt-1"><?php if(isset($row->card_type)): ?><?php echo e($row->card_type); ?><?php endif; ?></h6>
            </div>
          </div>
        </li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php echo emptyData2(); ?>

                                <?php endif; ?>
      </ul>
    </div>
    <?php if($vcards->hasPages()): ?>
                        <div class="card-footer">
                            <?php echo e($transactions->links()); ?>

                        </div>
                    <?php endif; ?>
  </section>
  <!-- cards section end -->
  
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/virtual_card/list_cards.blade.php ENDPATH**/ ?>