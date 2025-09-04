<?php $__env->startSection('panel'); ?>

    <section class="section-b-space">
        <div class="custom-container"> 

            <ul class="element-list transfer-list p-0">
                <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="w-100">
                        <div class="transaction-box">
                            <?php if(Route::is('user.sellgift')): ?>
                                <a href="<?php echo e(route('user.selectgiftcardsell', $gate->id)); ?>" class="d-flex gap-3">
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.selectgiftcardbuy', $gate->id)); ?>" class="d-flex gap-3">
                            <?php endif; ?>
                            <div class="transaction-image">
                                <img class="img-fluid icon" src="<?php echo e(asset('assets/images/giftcards')); ?>/<?php echo e($gate->image); ?>"
                                    alt="p1" />
                            </div>
                            <div class="transaction-details">
                                <div class="transaction-name">
                                    <h5><?php echo e($gate->name); ?></h5>
                                    <button type="button" class="btn theme-btn  p-1 btn-sm">Select</button>

                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="light-text"></h5>
                                    <h5 class="light-text"></h5>
                                </div>
                            </div>
                            </a>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </section> 



    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="#" onclick="history.back()" class="back-btn" data-bs-toggle="modal">
        <i class="icon" data-feather="x"></i>
      </a>
    <?php $__env->stopPush(); ?>
     
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/giftcard/giftcard.blade.php ENDPATH**/ ?>