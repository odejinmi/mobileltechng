<?php $__env->startSection('panel'); ?>

  <!-- banner section starts -->
  <section>
    <div class="custom-container">
      <div class="swiper banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="<?php echo e(route('user.downlines')); ?>">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banner2.png')); ?>" alt="banner2" />
            </a>
          </div> 
          <div class="swiper-slide">
            <a href="<?php echo e(route('user.downlines')); ?>">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banner2.png')); ?>" alt="banner2" />
            </a>
          </div> 

          
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->
  <!-- search section starts -->
  <section>
    <div class="custom-container">
      <form class="theme-form search-head" target="_blank">
        <div class="form-group">
          <div class="form-input">
            <input type="text" onclick="myFunction()"  readonly class="form-control search" value="<?php echo e(route('user.register', Auth::user()->username)); ?>" id="referralURL" placeholder="Search here..." />
            <i class="search-icon" data-feather="copy"></i>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- search section end -->
  <!-- person list starts -->
  <section>
    <div class="custom-container">

      <div class="title">
        <h2><?php echo app('translator')->get('Referral Downlines'); ?></h2>
      </div>
      <ul class="transfer-list">
        <?php $__empty_1 = true; $__currentLoopData = $ref; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <li class="w-100">
          <div class="transfer-box">
            <div class="transfer-img">
              <img class="img-fluid icon" src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $data->image, getFileSize('userProfile'))); ?>" alt="p1" />
            </div>
            <div class="transfer-details">
              <div>
                <a href="person-transaction.html">
                  <h5 class="fw-semibold dark-text"><?php echo e($data->username); ?></h5>
                </a>
                <h6 class="fw-normal light-text mt-2">Joined: <?php echo e(diffForHumans($data->created_at)); ?></h6>
              </div> 
            </div>
          </div>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php echo emptyData2(); ?>

        <?php endif; ?>
      </ul>
    </div>
  </section>
  <!-- person list end -->
  <section class="section-b-space">
    <div class="custom-container">
      <div class="title">
        <h2><?php echo app('translator')->get('Referral Earnings'); ?></h2>
      </div>

      <div class="row gy-3">
        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-12">
          <div class="transaction-box">
            <a href="transaction-history.html#transaction-detail" data-bs-toggle="modal" class="d-flex gap-3">
              <div class="transaction-image">
                <img class="img-fluid transaction-icon" src="assets/images/svg/1.svg" alt="p1" />
              </div>
              <div class="transaction-details">
                <div class="transaction-name">
                  <h5><?php echo e($data->remark); ?></h5>
                  <h3 class="error-color"><?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount($data->amount)); ?></h3>
                </div>
                <div class="d-flex justify-content-between">
                  <h5 class="light-text"><?php echo e($data->trx); ?></h5>
                  <h5 class="light-text"><?php echo e(diffForHumans($data->created_at)); ?></h5>
                </div>
              </div>
            </a>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <?php echo emptyData2(); ?>

        <?php endif; ?>
      </div>
    </div>
  </section>
 
       

    
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?> 
<script>
   function myFunction() {
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            document.execCommand("copy");
            iziToast.success({
                message: 'Link Copied',
                position: "topRight"
            });

        }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/ref.blade.php ENDPATH**/ ?>