<?php $__env->startSection('panel'); ?>
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Heading-->
                    <div class="card-px text-center pt-15 pb-15">
                        <!--begin::Alert-->

                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                            <!--begin::Icon-->
                            <i class="ti ti-alert-circle fs-2tx text-warning me-4"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 ">
                                <!--begin::Content-->
                                <div class=" fw-semibold">
                                    <h4 class="text-gray-900 fw-bold"><?php echo app('translator')->get('Betting Service'); ?></h4>

                                    <div class="fs-6 text-gray-700 "><?php echo app('translator')->get('Welcome to our online betting wallet funding system where you can fund your online betting wallet from over 30 service providers<br>
                                   <b> You can click on the Betting Log button at the top right corner of your screen to view your payment log</b>
                                    '); ?>
                                        <br> <br>
                                        <!--begin::Action-->
                                        <a href="<?php echo e(route('user.fund.betting.wallet')); ?>" class="btn btn-primary er fs-6 px-8 py-4">
                                            <?php echo app('translator')->get('Fund Wallet'); ?> </a>
                                        <br> <br>
                                        <!--end::Action-->
                                    </div>
                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                        <!--end::Alert-->


                    </div>
                    <!--end::Heading-->

                    <!--begin::Illustration-->
                    <div class="text-center pb-15 px-5">
                        <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/betting.svg')); ?>" alt=""
                            class="mw-100 h-200px h-sm-325px" />
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a class="btn btn-sm btn-primary" href="<?php echo e(route('user.betting.history')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('Payment Log'); ?></a>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/bills/betting/index.blade.php ENDPATH**/ ?>