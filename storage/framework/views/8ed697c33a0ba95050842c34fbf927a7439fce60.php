
<?php $__env->startSection('panel'); ?>
<!--begin::Container-->
 <!-- banner section starts -->
 <section>
  <div class="custom-container">
    <div class="swiper banner">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <a href="#">
            <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banking-business-facebook-template_23-2150956238.jpeg')); ?>" alt="banner1" />
          </a>
        </div>

        <div class="swiper-slide">
          <a href="#">
            <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/banking-business-facebook-template_23-2150956238.jpeg')); ?>" alt="banner2" />
          </a>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- banner section end -->

<!-- Withdraw section starts -->
<section class="section-b-space">
    <div class="custom-container">
      <div class="title">
        <h4>Select Wallet</h4>

      </div>
        <form class="auth-form p-0" novalidate="novalidate" action="" method="post">
        <?php echo csrf_field(); ?>
 
      <ul class="select-bank">
        <li>
          <div class="balance-box active">
            <input class="form-check-input" type="radio" onchange="selectwallet('main')"  name="wallet" value="act_wallet"  checked />
            <img class="img-fluid balance-box-img active" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg')); ?>"
              alt="balance-box" />
            <img class="img-fluid balance-box-img unactive" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg')); ?>"
              alt="balance-box" />
            <div class="balance-content">
              <h6> <?php echo app('translator')->get('Main Wallet'); ?></h6>
              <h3><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->balance)); ?></h3>
              <h5>**** **** ****</h5>
            </div>
          </div>
        </li>
        <li>
          <div class="balance-box">
            <input class="form-check-input" disabled type="radio" onchange="selectwallet('ref')"  name="wallet" value="ref_wallet"  />
            <img class="img-fluid balance-box-img active" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg')); ?>"
              alt="balance-box" />
            <img class="img-fluid balance-box-img unactive" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg')); ?>"
              alt="balance-box" />
            <div class="balance-content">
              <h6><?php echo app('translator')->get('Ref Wallet'); ?></h6>
              <h3><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->ref_balance)); ?></h3>
              <h5>**** **** ****</h5>
            </div>
          </div>
        </li>
      </ul>
     
      

        <div class="form-group mb-3">
            <label class="form-label"><?php echo app('translator')->get('Recipient\'s Bank'); ?></label> 
            <select class="form-control" name="bank"
            data-control="select2" id="banklist" data-hide-search="false"
            onchange="validatebank()" />
            <option selected disabled>Select Bank</option>
            <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option data-code="<?php echo e($data['bankCode']); ?>" data-name="<?php echo e($data['bankName']); ?>"
                    value="<?php echo e($data['bankCode']); ?>|<?php echo e($data['bankName']); ?>"><?php echo e($data['bankName']); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" data-kt-translate="two-step-label"><?php echo app('translator')->get('Account Number'); ?></label>
            <input type="text" onkeyup="validatebank()"  class="form-control <?php $__errorArgs = ['account'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="account" name="account" value="<?php echo e(old('account')); ?>" placeholder="Please enter NUBAN account number" />
        </div>
        <div id="beneficiary"></div>

        <section class="pay-money section-b-space">
          <div class="form-group">
              <div class="form-group mt-3">
                  <div class="form-input" id="">
                      <input type="number" name="amount" placeholder="<?php echo e($general->cur_sym); ?>0.00" class="form-control amount"
                          id="amount">
                  </div>
              </div>
          </div>
          <center>
              <ul class="nav nav-pills tab-style3 w-100 mt-3" id="myTab" role="tablist">
                  <li class="nav-item w-25"  onclick="setamount(500)" role="presentation">
                      <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                          type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><?php echo e($general->cur_sym); ?>500</button>
                  </li>
                  <li class="nav-item w-25"  onclick="setamount(1000)" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                          type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><?php echo e($general->cur_sym); ?>1k</button>
                  </li>
                  <li class="nav-item w-25"  onclick="setamount(2000)" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                          type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><?php echo e($general->cur_sym); ?>2k</button>
                  </li>
                  <li class="nav-item w-25" onclick="setamount(5000)" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                          type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><?php echo e($general->cur_sym); ?>5k</button>
                  </li>
              </ul>
           
          <?php $__env->startPush('script'); ?>
          <script>
              function setamount(amount) {
                  document.getElementById("amount").value = amount; 
              }
          </script>
         <?php $__env->stopPush(); ?>
          </center>
          <div class="form-group">
              <div class="form-input mt-3">
                <input type="text"
                class="form-control reason <?php $__errorArgs = ['narration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="narration" value="<?php echo e(old('narration')); ?>"
                placeholder="Narration"
              </div>
          </div>
      </section>

        <div class="form-group mb-3">
            <label class="form-label" data-kt-translate="two-step-label"><?php echo app('translator')->get('Transaction Pin'); ?></label>
            <input type="number" class="form-control username <?php $__errorArgs = ['pin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pin" name="pin" value="<?php echo e(old('pin')); ?>" placeholder="****" /> 
        </div>
        <input id="wallet" value="main" hidden>
        <input id="account_name" hidden>
        <input id="bank_name" hidden>
        <input id="sessionId" hidden>
        <div id="sending" class="mt-2"></div>

        <button type="button" class="btn theme-btn w-100" onclick="sendmoney()" id="submit" disabled>Transfer</button>
      </form>
    </div>
  </section>
  <!-- Withdraw section end -->

  <!-- successful transfer modal start -->
  
  <div class="modal successful-modal fade" id="done" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="doneheader"></h2>
        </div>
        <div class="modal-body">
          <div class="done-img">
            <div id="doneimage"></div>
          </div>
          <h2 id="sentamount"></h2>
          <h3 id="sentmessage"></h3>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- successful transfer modal end -->
  <?php $__env->startPush('script'); ?>
  <script>
      function selectwallet(wallet) {
         document.getElementById("wallet").value = wallet;
      }
  </script>
  <script>
      function validatebank() {
          var bankcode = $("#banklist option:selected").attr('data-code');
          var bankname = $("#banklist option:selected").attr('data-name');
          var account = document.getElementById("account").value;
          if (account.length < 10 || bankcode == '') {
              return;
          }
          // START VALIDATE \\
          $("#beneficiary").html(`<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`);
          // Show page loading
          var raw = JSON.stringify({
              _token: "<?php echo e(csrf_token()); ?>",
              bankcode: bankcode,
              account: account,
          });
          var requestOptions = {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              body: raw
          };
          fetch("<?php echo e(route('user.bank.validate.strowallet')); ?>", requestOptions)
              .then(response => response.text())
              .then(result => {
                  const reply = JSON.parse(result);
                  if (reply.ok != true) 
                  {
                      document.getElementById("submit").disabled = true;
                  }
                  if (reply.ok != false) {
                    document.getElementById("sessionId").value = reply.sessionId;
                      document.getElementById("submit").disabled = false;
                      document.getElementById("account_name").value = reply.message;
                      document.getElementById("bank_name").value = bankname;
                  }
                  $("#beneficiary").html(
                      `<label class="badge mb-1 bg-${reply.status}"> 
                          <span>${reply.message}</span>
                      </label>`
                  );
                  
              })
              .catch(error => {
                  console.log(error);
              });
      }
  </script>

  <script>
  function sendmoney() {
  var bankcode = $("#banklist option:selected").attr('data-code');
  var account = document.getElementById("account").value;
  var amount = document.getElementById("amount").value;
  var wallet = document.getElementById("wallet").value;
  var narration = document.getElementById("narration").value;
  var sessionid = document.getElementById("sessionId").value;
  var account_name = document.getElementById("account_name").value;
  var bank_name = document.getElementById("bank_name").value;
  var pin = document.getElementById("pin").value; 
  if (account.length < 10 || bankcode == '' || amount < 1 || wallet == '') {
      return;
  }
  // START VALIDATE \\
  $("#sending").html(`<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`);
  document.getElementById("submit").disabled = true;

  var raw = JSON.stringify({
      _token: "<?php echo e(csrf_token()); ?>",
      account_name: account_name,
      bank_name: bank_name,
      bankcode: bankcode,
      account: account,
      sessionid: sessionid,
      amount: amount,
      wallet: wallet,
      narration: narration,
      pin: pin,
  });
  var requestOptions = {
      method: 'POST',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: raw
  };
  fetch("<?php echo e(route('user.bank.transfer.strowallet')); ?>", requestOptions)
      .then(response => response.text())
      .then(result => {
          const reply = JSON.parse(result); 
              document.getElementById("submit").disabled = false;
              document.getElementById("sentamount").innerHTML = '₦'+amount;
              document.getElementById("sentmessage").innerHTML = reply.message;
              document.getElementById("doneheader").innerHTML = 'Transaction Successful';
              document.getElementById("doneimage").innerHTML = `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/done.svg')); ?>" alt="done" />`;
              if(reply.status == 'danger')
              {
                document.getElementById("doneheader").innerHTML = 'Transaction Failed';
                document.getElementById("doneimage").innerHTML = `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/error.svg')); ?>" alt="done" />`;
              }
              $('#done').modal('show');
             $("#sending").html(''); 
      })
      .catch(error => {
          console.log(error);
      });
  }
  </script>
<?php $__env->stopPush(); ?>
    <?php $__env->stopSection(); ?> 

<?php $__env->startPush('breadcrumb-plugins'); ?>
<a href="<?php echo e(route('user.bank.transfer.history')); ?>" class="back-btn">
    <i class="icon" data-feather="file-text"></i>
  </a>
<?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/bank/strowallet.blade.php ENDPATH**/ ?>