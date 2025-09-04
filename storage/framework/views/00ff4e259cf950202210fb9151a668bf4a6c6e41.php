
<?php $__env->startSection('panel'); ?>
<!--begin::Container-->
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
          <label for="amount" class="form-label">Amount</label>
          <input type="number" id="amount" class="form-control amount <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('amount')); ?>" name="amount" placeholder="0.00" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label"><?php echo app('translator')->get('Recipient\'s Bank'); ?></label> 
            <select class="form-control name="bank"
            data-control="select2" id="banklist" data-hide-search="false"
            onchange="validatebank()" />
            <option selected disabled>Select Bank</option>
            <?php $__currentLoopData = $banks['responseBody']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option data-code="<?php echo e($data['code']); ?>"
                data-name="<?php echo e($data['name']); ?>"
                    value="<?php echo e($data['code']); ?>|<?php echo e($data['name']); ?>"><?php echo e($data['name']); ?>

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

        <div class="mb-3 fv-row"> 
            <label class="form-label"><?php echo app('translator')->get('Narration'); ?></label> 
            <input type="text"
                class="form-control narration <?php $__errorArgs = ['account'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                id="narration" value="<?php echo e(old('narration')); ?>"
                placeholder="Please enter transfer narration" />
        </div>

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
          fetch("<?php echo e(route('user.bank.validate.monnify')); ?>", requestOptions)
              .then(response => response.text())
              .then(result => {
                  const reply = JSON.parse(result);
                  if (reply.ok != true) 
                  {
                      document.getElementById("submit").disabled = true;
                  }
                  if (reply.ok != false) {
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
  fetch("<?php echo e(route('user.bank.transfer.monnify')); ?>", requestOptions)
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
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/bank/monnify.blade.php ENDPATH**/ ?>