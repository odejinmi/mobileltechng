<?php $__env->startSection('panel'); ?>
    <!-- chatting section start -->

  <section>
    <ul class="transfer-list add-transfer-person">
      <li class="w-100">
        <div class="transfer-person transfer-box">
          <div class="transfer-img">
            <img class="img-fluid icon" src="<?php echo e(getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile'))); ?>" alt="p1" />
          </div>
          <div class="transfer-details">
            <div>
              <h5 class="fw-semibold dark-text"><?php echo e(Auth::user()->fullname); ?></h5>
              <h6 class="fw-normal light-text mt-2"><?php echo e(Auth::user()->email); ?></h6>
            </div> 
          </div>
        </div>
      </li>
    </ul>
  </section>
    <section class="msger pt-1 section-b-space">
        <div class="custom-container">
            <div class="msger-chat">
                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if($message->admin_id == 1): ?>
                        <div class="msg right-msg mb-2">
                            <div class="msg-bubble">
                                <div class="msg-text"><?php echo e($message->message); ?><br>
                                    <small><?php echo e(diffForHumans($message->created_at)); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="msg left-msg mb-2">
                            <div class="msg-bubble">
                                <div class="msg-text"><?php echo e($message->message); ?><br>
                                    <small><?php echo e(diffForHumans($message->created_at)); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <section class="section-b-space">
                        <div class="custom-container">
                            <div class="empty-page">
                                <img class="notification-img" class="img-fluid"
                                    src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/notification.svg')); ?>"
                                    alt="notification" />
                                <h3 class="d-block fw-normal dark-text text-center mt-3">There is no new notification for
                                    you,
                                    Please checke back later for
                                    new notification</h3>
                            </div>
                            <a href="#" onclick="history.back()" class="btn theme-btn successfully w-100">Back</a>
                        </div>
                    </section>
                <?php endif; ?>

            </div>
            <!-- login section start -->
            <?php if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user): ?>
                <form method="post" class="auth-form" action="<?php echo e(route('ticket.reply', $myTicket->id)); ?>"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="custom-container">
                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <div class="form-input mb-3">
                                <input type="text" class="form-control" name="message"
                                    placeholder="Enter Message Here" />
                            </div>
                        </div>

                        <button name="replayTicket" value="1" type="submit"
                            class="btn theme-btn w-100">Send</button>
                    </div>
                </form>
            <?php endif; ?>
            <!-- login section start -->
        </div>
    </section>
    <!-- chatting section end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('ticket.index')); ?>" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
<?php $__env->stopPush(); ?> 

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/support/view.blade.php ENDPATH**/ ?>