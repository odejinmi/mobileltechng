
<div class="container-fluid">

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb border border-info px-3 py-2 rounded">
      <li class="breadcrumb-item">
        <a href="#" class="text-info d-flex align-items-center"><i class="ti ti-home fs-4 mt-1"></i></a>
      </li>
      <li class="breadcrumb-item">
        <a href="#" class="text-info"><?php echo app('translator')->get('Home'); ?></a>
      </li>
      <li class="breadcrumb-item active text-info font-medium" aria-current="page">
        <?php echo e(__($pageTitle)); ?>

      </li>
        
    <div style="display: flex; justify-content: flex-end; margin-left: auto; margin-right: 0;" class="d-flex flex-wrap justify-content-end gap-2 align-items-center breadcrumb-plsugins">
      <?php echo $__env->yieldPushContent('breadcrumb-plugins'); ?>
    </div>
  
    </ol>

  </nav> 
<?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/admin/partials/breadcrumb.blade.php ENDPATH**/ ?>