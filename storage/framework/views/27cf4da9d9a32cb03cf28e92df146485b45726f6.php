
<?php $__env->startSection('panel'); ?>
 <!-- content @s
-->

 <!-- banner section starts -->
 <section>
  <div class="custom-container">
    <div class="swiper banner">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href="#">
            <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banking.png')); ?>" alt="banner1" />
          </a>
        </div>

        <div class="swiper-slide">
          <a href="#">
            <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banking.png')); ?>" alt="banner2" />
          </a>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- banner section end --> 
<section class="section-b-space">
    <div class="custom-container">
        <form  class="auth-form p-0" action="" method="post">
            <?php echo csrf_field(); ?>
       

          <!--end::Input-->
        <section class="pay-money section-b-space">
          <div class="form-group">
              <div class="form-group mt-3">
                  <div class="form-input" id="">
                      <input type="number" name="amount" placeholder="$0.00" class="form-control amount"
                          id="amount">
                  </div>
                  
          <span class="badge text-white" id="commision"></span> 
          <span class="badge text-white" id="worth"></span>
          <span class="badge text-white" id="rate"></span>
          <span class="badge text-white" id="get"></span>
              </div>
          </div>
          <center>
              <ul class="nav nav-pills tab-style3 w-100 mt-3" id="myTab" role="tablist">
                  <li class="nav-item w-25"  onclick="setamount(200)" role="presentation">
                      <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                          type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">$200</button>
                  </li>
                  <li class="nav-item w-25"  onclick="setamount(500)" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                          type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">$500</button>
                  </li>
                  <li class="nav-item w-25"  onclick="setamount(1000)" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                          type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">$1k</button>
                  </li>
                  <li class="nav-item w-25" onclick="setamount(2000)" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                          type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">$2k</button>
                  </li>
              </ul>
           
          <?php $__env->startPush('script'); ?>
          <script>
              function setamount(amount) {
                  document.getElementById("amount").value = amount; 
              }
          </script>
         <?php $__env->stopPush(); ?> 
      </section>
      <?php $__env->startPush('script'); ?>
        <script>
            function submitform() { 
                var amount = document.getElementById('amount').value; 
                if(amount < 1)
                {
                    SlimNotifierJs.notification(`error`, `error`,`Please specify amount first`, 3000);
                    return;
                } 
                var account = document.getElementById('account'); 
                if(account == '')
                {
                    return;
                }
                var fee = account.selectedOptions[0].getAttribute("data-fee");
                var currency = account.selectedOptions[0].getAttribute("data-currency");
                var rate = account.selectedOptions[0].getAttribute("data-rate");
                var commission = (amount / 100) * fee; // Correct Calculation
                var worth = amount - commission;
                var get = worth * rate;
                let USDollar = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                });
                document.getElementById("commision").innerHTML = `<span class="badge bg-danger text-white">Fee: ${commission}</span><br>`;
                document.getElementById("worth").innerHTML = `<span class="badge bg-info text-white"  >Value: ${currency} ${worth}</span><br>`;
                document.getElementById("rate").innerHTML = `<span class="badge bg-dark text-white"  >Rate 1${currency} = ${USDollar.format(rate)}<?php echo e($general->cur_text); ?></span><br>`;
                document.getElementById("get").innerHTML = `<span class="badge bg-success text-white" >What You Get: ${USDollar.format(get)} <?php echo e($general->cur_text); ?> </span>`;
                               
            }
            
        </script> 
        <?php $__env->stopPush(); ?>
        <div class="form-group">
            <label for="inputmessage" class="form-label">Account</label>
            <div class="form-input">
              <select  onchange="submitform()"  class="form-control purpose <?php $__errorArgs = ['account'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="account" select-2" name="account">
                  <option selected disabled>Please Select Account</option>
                  <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option data-fee="<?php echo e($data->fee); ?>" data-rate="<?php echo e($data->rate); ?>" data-currency="<?php echo e($data->currency); ?>"  value="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>           
             </div>
          </div>
        <button type="submit" class="btn theme-btn w-100" >Create</button>
      </form>
    </div>
  </section>
  <!-- request section end -->

  <!-- successful transfer modal start -->
  <div class="modal successful-modal fade" id="done" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Successfully Transfer</h2>
        </div>
        <div class="modal-body">
          <div class="done-img">
            <img class="img-fluid" src="assets/images/svg/done.svg" alt="done" />
          </div>
          <h2>$49.85</h2>
          <h3><span class="theme-color">Diane</span> has got an application for money.</h3>
          <a href="landing.html" class="btn theme-btn successfully w-100">Back to home</a>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- successful transfer modal end -->
  
 
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.requestaccount.history')); ?>" class="back-btn">
    <i class="icon" data-feather="printer"></i>
  </a>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/vendor/request_account/create.blade.php ENDPATH**/ ?>