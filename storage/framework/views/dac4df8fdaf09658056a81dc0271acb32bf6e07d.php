<?php $__env->startSection('panel'); ?>
<!-- pay money section starts -->
<section class="pay-money section-b-space">
    <div class="custom-container">
      <div class="profile-pic">
        <img class="img-fluid img" src="<?php echo e(getImage(imagePath()['gateway']['path'] . '/' . @$data->gateway->image, imagePath()['gateway']['size'])); ?>" alt="p3" />
      </div>
      <h3 class="person-name">Make Payment</h3>
      <h5 class="upi-id">Method : <?php echo e($data->gateway->alias); ?></h5>
       

      <form action="<?php echo e(route('user.deposit.manual.update')); ?>" method="POST" enctype="multipart/form-data">
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
                    <?php echo e(showAmount($data->final_amo)); ?>

                    <?php echo e(__($data->method_currency)); ?>

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
                      <?php echo e(showAmount($data->charge)); ?> <?php echo e(__($data->method_currency)); ?>

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
                    <?php echo e(showAmount($data->amount)); ?> <?php echo e(__($general->cur_text)); ?>

                  </div>
              </div>
            </li>
          </ul>
          <p class="my-4 text-center"><?php echo  $data->gateway->description ?></p>

          <?php if($formData): ?>

                                    <?php $__currentLoopData = $formData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($v->type == "text"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <input type="text" class="form-control reason"
                                                           name="<?php echo e($k); ?>"  value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__(@$v->name)); ?>">
                                                </div>
                                            </div>
                                            <?php elseif($v->type == "checkbox"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <input  class="form-check-input" type="checkbox"
                                                           name="<?php echo e($k); ?>"  value="<?php echo e(old($k)); ?>" placeholder="<?php echo e(__(@$v->name)); ?>">
                                                </div>
                                            </div>
                                            <?php elseif($v->type == "select"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <select class="form-control select2" name="<?php echo e($k); ?>"  value="<?php echo e(old($k)); ?>">
                                                        <?php $__currentLoopData = $v->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option><?php echo e($data); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php elseif($v->type == "radio"): ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong><?php echo e(__(@inputTitle($v->name))); ?> <?php if(@$v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?></strong></label>
                                                    <?php $__currentLoopData = $v->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="<?php echo e($k); ?>" value="<?php echo e($data); ?>" name="exampleRadios" id="<?php echo e($data); ?>" value="option1" checked>
                                                        <label class="form-check-label" for="<?php echo e($data); ?>">
                                                            <?php echo e($data); ?>

                                                        </label>
                                                      </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </div>
                                            </div>
                                           <?php elseif($v->type == "textarea"): ?>
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label><strong><?php echo e(__(inputTitle($v->name))); ?>

                                                            <?php if($v->is_required == 'required'): ?>
                                                            <span class="text-danger">*</span>
                                                            <?php endif; ?></strong>
                                                        </label>
                                                        <textarea name="<?php echo e($k); ?>"  class="form-control"  placeholder="<?php echo e(__($v->name)); ?>" rows="3"><?php echo e(old($k)); ?></textarea>

                                                    </div>
                                                </div>
                                        <?php elseif($v->type == "file"): ?>
                                            <div class="col-md-12 mb-3">

                                                <label class="text-uppercase">
                                                    <strong>
                                                        <?php echo e(__($v->name)); ?> <?php if($v->is_required == 'required'): ?> <span class="text-danger">*</span>  <?php endif; ?>
                                                    </strong>
                                                </label>
                                                    <div class="image-upload">
                                                        <div class="image-edit">
                                                            <input type='file' name="<?php echo e($k); ?>" id="imageUpload" class="form-control" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="image-preview">
                                                            <div id="imagePreview" style="background-image: url(<?php echo e(asset(imagePath()['image']['default'])); ?>);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
        <button type="submit" class="btn theme-btn w-100 mt-3"
            id="btn-confirm" onClick="payWithRave()"><?php echo app('translator')->get('Pay Now'); ?></button>
        
    </form>

      

    </div>
  </section> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/payment/manual.blade.php ENDPATH**/ ?>