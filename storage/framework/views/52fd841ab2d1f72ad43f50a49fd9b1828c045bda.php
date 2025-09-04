<?php $__env->startSection('content'); ?>
 <!--  Body Wrapper -->
 <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-4">
            <div class="card mb-0">
              <div class="card-body">
                <a href="#" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                  <img width="100" src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" width="180" alt="">
                </a>
                 
                <div class="position-relative text-center my-4">
                     
                  <p class="mb-0 fs-4 px-3 d-inline-block bg-white text-dark z-index-5 position-relative"><?php echo e(__($pageTitle)); ?> <?php echo app('translator')->get('to'); ?> <?php echo e(__($general->site_name)); ?>

                    <?php echo app('translator')->get('Dashboard'); ?></p>
                  <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <form class="" action="<?php echo e(route('admin.login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><?php echo app('translator')->get('Username'); ?></label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label"><?php echo app('translator')->get('Password'); ?></label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <?php if (isset($component)) { $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243 = $component; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243)): ?>
<?php $component = $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243; ?>
<?php unset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243); ?>
<?php endif; ?>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        <?php echo app('translator')->get('Remember Me'); ?>
                      </label>
                    </div>
                    <a class="text-primary fw-medium" href="<?php echo e(route('admin.password.reset')); ?>"><?php echo app('translator')->get('Forgot Password'); ?> ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2 submits"><?php echo app('translator')->get('SIGN IN'); ?></a>
                    
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
   

</script> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/auth/login.blade.php ENDPATH**/ ?>