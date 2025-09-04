<?php $__env->startSection('panel'); ?>
     <!-- drives area starts-->
    <div class="drives">
      <div class="row">
        <div class="col-12">
          <h6 class="files-section-title mb-75">Available  Currencies</h6>
        </div>
        <?php $__currentLoopData = $currency; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card shadow-none border cursor-pointer">
            <div class="card-body">
               
              <div class="my-1">
                <h5><?php echo e($data->name); ?> <small><?php echo e($data->symbol); ?></small></h5>
              </div>
               <p class="text-muted text-center mt-1 col-6">
										<?php if($data->status == 1): ?>
										<a class="badge bg-success text-white">Status :Active</a>
										<?php else: ?>
										<a class="badge bg-danger text-white">Status: Inactive</a>
										<?php endif; ?>
										</p>
                    <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.deactivatecoin*','admin.crypto.activatecoin*','admin.crypto.edit*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                    <div class="btn-group mb-2">
                      <button
                        class="btn btn-light-primary btn-sm text-primary dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <?php echo app('translator')->get('Manage'); ?>
                      </button>
                      <ul
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                       <?php if($data->status == 1): ?>
                       <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.deactivatecoin*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li><a class="dropdown-item" href="<?php echo e(route('admin.crypto.deactivatecoin',$data->id)); ?>"><?php echo app('translator')->get('Deactivate'); ?></a></li>
                      <?php endif ?>
                        <?php else: ?>
                        <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.activatecoin*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li>
                          <a class="dropdown-item" href="<?php echo e(route('admin.crypto.activatecoin',$data->id)); ?>"><?php echo app('translator')->get('Activate'); ?></a>
                        </li>
                        <?php endif ?>
                        <?php endif; ?>
                        <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.edit*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                        <li>
                          <a class="dropdown-item" href="<?php echo e(route('admin.crypto.edit',$data->id)); ?>"><?php echo app('translator')->get('Settings'); ?></a>
                        </li>
                        <?php endif ?>
                      </ul>
                    </div>
              <?php endif ?>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    <!-- drives area ends-->

    <div id="CurrencyModel" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title"><?php echo app('translator')->get('Add New Asset'); ?></h5> 
              </div>
              <form action="<?php echo e(route('admin.crypto.addcoin')); ?>" method="POST" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="modal-body">
                      <div class="form-group mb-3">
                          <label for="name" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Name'); ?></label>
                          <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="<?php echo app('translator')->get("Enter Name"); ?>"  maxlength="80" required="">
                      </div>
                      <div class="form-group mb-3">
                        <label for="symbol" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Symbol'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="symbol" id="symbol" placeholder="<?php echo app('translator')->get("Enter Symbol"); ?>"  maxlength="80" required="">
                    </div>

                      <div class="form-group mb-3">
                          <label for="symbol" class="form-control-label font-weight-bold"><?php echo app('translator')->get('Logo Image'); ?></label>
                          <div class="custom-file">
                            <input type="file" name="logo" class="form-control" id="customFileLangHTML">
                           </div>
                      </div> 
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                      <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i><?php echo app('translator')->get('Create'); ?></button>
                  </div>
              </form>
          </div>
      </div>
  </div>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a href="javascript:void(0)" class="btn btn-sm btn-primary box--shadow1 text--small addCurrency" ><i class="fa fa-fw fa-plus"></i><?php echo app('translator')->get('Add Asset'); ?></a>
    <?php $__env->stopPush(); ?> 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    "use strict";
    $('.addCurrency').on('click', function() {
        $('#CurrencyModel').modal('show');
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/currency/index.blade.php ENDPATH**/ ?>