<?php $__env->startSection('panel'); ?>
    <!-- notification section starts -->
    <section class="section-b-space">
        <div class="custom-container">

            <ul class="notification-list">
                <?php $__empty_1 = true; $__currentLoopData = $supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="notification-box">
                        <div class="notification-img">
                            <img class="img-fluid icon" src="<?php echo e(getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile'))); ?>" alt="p2" />
                        </div>
                        <div class="notification-details">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-semibold dark-text">
                                        <?php if($support->priority == Status::PRIORITY_LOW): ?>
                                            <span class="badge bg-warning"><?php echo app('translator')->get('Low'); ?></span>
                                        <?php elseif($support->priority == Status::PRIORITY_MEDIUM): ?>
                                            <span class="badge bg-success"><?php echo app('translator')->get('Medium'); ?></span>
                                        <?php elseif($support->priority == Status::PRIORITY_HIGH): ?>
                                            <span class="badge bg-danger"><?php echo app('translator')->get('High'); ?></span>
                                        <?php endif; ?>
                                    </h5>
                                    <h6 class="fw-normal light-text mt-1">[<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($support->ticket); ?>]</h6>
                                </div>
                                <h6 class="time fw-normal light-text">
                                    <?php echo e(\Carbon\Carbon::parse($support->last_reply)->diffForHumans()); ?></h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="dark-text fw-normal"><?php echo e(__($support->subject)); ?>

                                </h5>
                                <a href="<?php echo e(route('ticket.view', $support->ticket)); ?>"
                                    class="btn theme-btn pay-btn mt-0">View</a>
                            </div>
                        </div>
                    </li>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <section class="section-b-space">
                        <div class="custom-container">
                            <div class="empty-page">
                                <img class="notification-img" class="img-fluid"
                                    src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/notification.svg')); ?>"
                                    alt="notification" />
                                <h3 class="d-block fw-normal dark-text text-center mt-3">There is no new notification for
                                    you, Please checke back later for
                                    new notification</h3>
                            </div>
                            <a href="#" onclick="history.back()" class="btn theme-btn successfully w-100">Back</a>
                        </div>
                    </section>
                <?php endif; ?>
            </ul>
            <?php if($supports->hasPages()): ?>
                <div class="card-footer py-4">
                    <?php echo paginateLinks($supports) ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- notification section end -->
<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('ticket.open')); ?>" class="back-btn">
        <i class="icon" data-feather="plus"></i>
    </a>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/support/index.blade.php ENDPATH**/ ?>