<?php $__env->startSection('panel'); ?>
    <div class="row mb-none-30">
      
        <div class="col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" class="" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="form-group col-xl-6  mb-3">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="mb-2">
                                                                <h5 class="mb-0"><?php echo app('translator')->get('Favicon'); ?></h5>
                                                            </div>

                                                            <div class="text-center">
                                                                <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png', '?' . time())); ?>"
                                                                    alt="image" class="rounded-circle" width="100" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="form-control profilePicUpload"
                                                id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="logo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xl-6 mb-3">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="mb-2">
                                                                <h5 class="mb-0"><?php echo app('translator')->get('Favicon'); ?></h5>
                                                            </div>
                                                            <div class="text-center">
                                                                <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/favicon.png', '?' . time())); ?>"
                                                                    alt="image" class="rounded-circle" width="100" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="form-control profilePicUpload"
                                                id="profilePicUpload2" accept=".png" name="favicon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary h-45"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/admin/setting/logo_icon.blade.php ENDPATH**/ ?>