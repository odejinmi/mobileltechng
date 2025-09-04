<?php $__env->startSection('panel'); ?>
    <?php
        $faqContent = getContent('faq.content', true);
        $faqElements = getContent('faq.element', null, false, true);
    ?> 
<?php $__env->startPush('style'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $__env->stopPush(); ?>
  <section>
    <div class="custom-container">
      <div class="title">
        <h2>Contact Us</h2>
        <a href="#"></a>
      </div>
      <div class="row gy-3">
        <div class="col-3">
          <a href="<?php echo e($general->social_facebook); ?>">
            <div class="service-box">
              <i class="service-icon" data-feather="facebook"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Facebook</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="<?php echo e($general->social_twitter); ?>">
            <div class="service-box">
              <i class="service-icon" data-feather="twitter"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Twitter</h5>
          </a>
        </div>

        <div class="col-3">
          <a href="<?php echo e($general->social_instagram); ?>">
            <div class="service-box">
              <i class="service-icon" data-feather="instagram"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Instagram</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="<?php echo e($general->social_mail); ?>">
            <div class="service-box">
              <i class="service-icon" data-feather="mail"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Mail</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="<?php echo e($general->social_phone); ?>">
            <div class="service-box">
              <i class="service-icon" data-feather="smartphone"></i>
            </div>
            <h5 class="mt-2 text-center dark-text">Phone</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="<?php echo e($general->social_whatsapp); ?>">
            <div class="service-box">
              <h1><i class="service-icon fa fa-whatsapp"></i></h1>
            </div>
            <h5 class="mt-2 text-center dark-text">Whatsapp</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="<?php echo e($general->social_telegram); ?>">
            <div class="service-box">
              <h1><i class="service-icon fa fa-telegram"></i></h1>
            </div>
            <h5 class="mt-2 text-center dark-text">Telegram</h5>
          </a>
        </div>
        <div class="col-3">
          <a href="<?php echo e($general->social_youtube); ?>">
            <div class="service-box">
              <h1><i class="service-icon fa fa-youtube"></i></h1>
            </div>
            <h5 class="mt-2 text-center dark-text">Youtube</h5>
          </a>
        </div>


         
      </div>
    </div>
  </section>
  <!-- service section end --><br>
    <section class="section-b-space">
        <div class="custom-container">
            <div class="help-center">
              <center>
                <h2 class="fw-semibold"><?php echo e(__(@$faqContent->data_values->heading)); ?></h2>
                <p class="test-muted fs-6"><?php echo e(__(@$faqContent->data_values->sub_heading)); ?></p>
              </center>
                <div class="accordion accordion-flush help-accordion" id="accordionFlushExample">
                    <?php $__empty_1 = true; $__currentLoopData = $faqElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne<?php echo e($item->id); ?>"><?php echo e(__(@$item->data_values->question)); ?></button>
                            </h2>
                            <div id="flush-collapseOne<?php echo e($item->id); ?>" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                  <?php echo e(__(@$item->data_values->answer)); ?></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php echo emptyData(); ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
    <!-- help section end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/contact.blade.php ENDPATH**/ ?>