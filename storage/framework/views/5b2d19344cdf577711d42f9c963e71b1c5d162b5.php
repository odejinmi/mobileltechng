
<?php $__env->startSection('panel'); ?>
 <!-- content @s
-->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
 
                <!--begin::Form-->
                    <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
                    <?php echo csrf_field(); ?>

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark"><?php echo app('translator')->get('Generate Voucher'); ?></h2>
                                <!--end::Title-->

                                
                            </div>
                            <!--end::Heading-->    
                            <!--begin::Input group-->
                             
                           
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3"><?php echo app('translator')->get('Enter Amount'); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" id="amount" class="form-control form-control-lg form-control-solid  amount <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('amount')); ?>" name="amount" placeholder="0.00" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 
 
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <br>
                                <label class="form-label mb-3"><?php echo app('translator')->get('Units '); ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" onkeyup="getvalue(this)" class="form-control form-control-lg form-control-solid  unit <?php $__errorArgs = ['unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="unit"
                                    name="unit" value="<?php echo e(old('unit')); ?>" placeholder="Enter Units" />
                                <!--end::Input-->
                                <label class="form-check-label" for="value">
                                    <small class="text-danger" id="value"></small>
                                </label>
                            </div>
                            <!--end::Input group-->  

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->

                    <?php $__env->startPush('script'); ?>
                     
                    <?php $__env->stopPush(); ?>

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit"><?php echo app('translator')->get('Proceed'); ?>
                                <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i> 
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a class="btn btn-sm btn-primary" href="<?php echo e(route('admin.voucher.log')); ?>"> <i class="ti ti-printer"></i> <?php echo app('translator')->get('View Voucher'); ?></a>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/voucher/create.blade.php ENDPATH**/ ?>