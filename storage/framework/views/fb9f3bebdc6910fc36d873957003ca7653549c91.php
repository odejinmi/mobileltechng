<?php $__env->startSection('panel'); ?>

<!-- pay money section starts -->
<section class="pay-money section-b-space">
  <div class="custom-container">
    <div class="profile-pic">
      <img class="img-fluid img" src="<?php echo e(getImage(imagePath()['withdraw']['method']['path'].'/'. $withdraw->method->image,imagePath()['withdraw']['method']['size'])); ?>" alt="p3" />
    </div>
    <h3 class="person-name">Make Payment</h3>
    <h5 class="upi-id">Method : <?php echo e($withdraw->method->name); ?></h5>
     

    <form action="<?php echo e(route('user.withdraw.submit')); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <ul class="card-list">
          <li class="payment-add-box">
            <div class="add-img"> 
              <div class="categories-box">
                  <i class="categories-icon" data-feather="shopping-cart"></i>
              </div>
            </div>
            <div class="add-content">
              <div>
                <h5 class="fw-semibold dark-text">Amount</h5>
                <h6 class="mt-2 light-text"></h6>
              </div> 

              <div class="form-check">
                <?php echo e(showAmount($withdraw->amount)); ?> <?php echo e(__($general->cur_text)); ?>

                </div>
            </div>
          </li> 

          <li class="payment-add-box">
              <div class="add-img">
                <div class="categories-box">
                    <i class="categories-icon" data-feather="percent"></i>
                </div>
              </div>
              <div class="add-content">
                <div>
                  <h5 class="fw-semibold dark-text">Fee</h5>
                  <h6 class="mt-2 light-text"></h6>
                </div> 

                <div class="form-check">
                    <?php echo e(showAmount($withdraw->charge)); ?> <?php echo e(__($general->cur_text)); ?>

                  </div>
              </div>
            </li>
  
          <li class="payment-add-box">
            <div class="add-img">
              <div class="categories-box">
                  <i class="categories-icon" data-feather="shopping-bag"></i>
              </div>
            </div>
            <div class="add-content">
              <div>
                <h5 class="fw-semibold dark-text">You Get</h5>
                <h6 class="mt-2 light-text"></h6>
              </div> 

              <div class="form-check">
                  <?php echo e(showAmount($withdraw->final_amount)); ?> <?php echo e(__($withdraw->currency)); ?>

                </div>
            </div>
          </li>

          <li class="payment-add-box">
            <div class="add-img">
              <div class="categories-box">
                  <i class="categories-icon" data-feather="shopping-bag"></i>
              </div>
            </div>
            <div class="add-content">
              <div>
                <h5 class="fw-semibold dark-text">Value</h5>
                <h6 class="mt-2 light-text"></h6>
              </div> 

              <div class="form-check">
                <?php echo e(showAmount($withdraw->final_amount)); ?> <?php echo e(__($withdraw->currency)); ?>

                </div>
            </div>
          </li>
        </ul>
        <p class="my-4 text-center"><?php echo $withdraw->method->description; ?></p>

        <?php if($withdraw->method->user_data): ?>
                <?php $__currentLoopData = $withdraw->method->user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($v->type == "text"): ?>
                        <div class="form-group mb-3">
                            <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                            <input type="text" name="<?php echo e($k); ?>" class="form-control" value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__($v->field_level)); ?>" <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                            <?php if($errors->has($k)): ?>
                                <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php elseif($v->type == "textarea"): ?>
                        <div class="form-group mb-3">
                            <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                            <textarea name="<?php echo e($k); ?>"  class="form-control"  placeholder="<?php echo e(__($v->field_level)); ?>" rows="3" <?php if($v->validation == "required"): ?> required <?php endif; ?>><?php echo e(old($k)); ?></textarea>
                            <?php if($errors->has($k)): ?>
                                <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php elseif($v->type == "file"): ?>
                        <label><strong><?php echo e(strtoUpper($v->field_level)); ?> <?php if($v->validation == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                        <div class="form-group mb-3">
                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                <div class="fileinput-new thumbnail withdraw-thumbnail"
                                     data-trigger="fileinput">
                                    <img class="w-100" src="<?php echo e(getImage('/')); ?>" alt="<?php echo app('translator')->get('Image'); ?>">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>
                                <div class="img-input-div">
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new "> <?php echo app('translator')->get('Select'); ?> <?php echo e(__($v->field_level)); ?></span>
                                        <span class="fileinput-exists"> <?php echo app('translator')->get('Change'); ?></span>
                                        <input type="file" class="form-control" name="<?php echo e($k); ?>" accept="image/*" <?php if($v->validation == "required"): ?> required <?php endif; ?>>
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                    data-dismiss="fileinput"> <?php echo app('translator')->get('Remove'); ?></a>
                                </div>
                            </div>
                            <?php if($errors->has($k)): ?>
                                <br>
                                <span class="text-danger"><?php echo e(__($errors->first($k))); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
      <button type="submit" class="btn theme-btn w-100 mt-3"
          id="btn-confirm" onClick="payWithRave()"><?php echo app('translator')->get('Withdraw Now'); ?></button>
      
  </form>

    

  </div>
</section> 
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/withdraw/preview.blade.php ENDPATH**/ ?>