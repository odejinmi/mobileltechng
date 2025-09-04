<?php $__env->startSection('panel'); ?>
    <!-- Airtime section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="title">
                <h4>Select Wallet</h4>
                <a href="<?php echo e(route('user.airtime.history')); ?>">See all</a>

            </div>
            <form class="auth-form p-0" method="post">


                <ul class="select-bank">
                    <li>
                        <div class="balance-box active">
                            <input class="form-check-input" type="radio" name="account_type" onchange="selectwallet('main')"
                                checkeds />
                            <img class="img-fluid balance-box-img active"
                                src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg')); ?>"
                                alt="balance-box" />
                            <img class="img-fluid balance-box-img unactive"
                                src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg')); ?>"
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
                            <input class="form-check-input" type="radio" name="account_type"
                                onchange="selectwallet('ref')" />
                            <img class="img-fluid balance-box-img active"
                                src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg-active.svg')); ?>"
                                alt="balance-box" />
                            <img class="img-fluid balance-box-img unactive"
                                src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/balance-box-bg.svg')); ?>"
                                alt="balance-box" />
                            <div class="balance-content">
                                <h6><?php echo app('translator')->get('Ref Wallet'); ?></h6>
                                <h3><?php echo e($general->cur_sym); ?><?php echo e(showAmount(Auth::user()->ref_balance)); ?></h3>
                                <h5>**** **** ****</h5>
                            </div>
                        </div>
                    </li>
                </ul>
                <?php $__env->startPush('script'); ?>
                    <script>
                        function selectwallet(wallet) {
                            localStorage.setItem('wallet', wallet);
                        }
                    </script>
                <?php $__env->stopPush(); ?>


                <div class="form-group">
                    <label for="amount" class="form-label">Select Country</label>
                    <select name="country" class="form-select form-select-solid" data-control="select22"
                        id="youSendCurrency" data-hide-search="false" onchange="populate()"
                        data-placeholder="<?php echo app('translator')->get('Select Country'); ?>">
                        <option selected disableds><?php echo app('translator')->get('Select a Country'); ?>...</option>
                        <option value="nigeria" data-callingCode="NG" data-countrycurrency="NGN" data-isoName="NG"
                            data-countrycontinent="Africa" data-network="<?php echo e($networks); ?>" value="Nigeria"
                            data-icon="currency-flag currency-flag-ng me-1">Nigeria</option>
                    </select>
                </div>
                <?php $__env->startPush('script'); ?>
                    <script>
                        function populate() {

                            // Show page loading
                            document.getElementById('providers').innerHTML = '';
                            var network = $("#youSendCurrency option:selected").attr('data-network');

                            networks = JSON.parse(network);
                            let html = '';
                            networks.map(plan => {
                                let htmlSegment =
                                    `
                                    <div class="col-12 mb-1">
                                        <div class="transaction-box">
                                            <a href="#" class="d-flex gap-3">
                                            <div class="transaction-image color1">
                                                <img class="img-fluid icons" src="<?php echo e(url('/')); ?>/assets/images/provider/${plan['logo']}" width="30" alt="bitcoins" />
                                            </div>
                                            <div class="transaction-details">
                                                <div class="transaction-name pb-0">
                                                <h5>${plan['name']}</h5>
                                                <h5 class="dark-text fw-semibold">
                                                    <div class="form-check">
                                                        <input class="form-check-input" onchange="networkprovider('${plan['networkid']}','${plan['logo']}','${plan['name']}','${plan['networkid']}')" type="radio" name="operator" id="${plan['networkid']}" value="${plan['networkid']}" />
                                                        <label class="form-check-label" for="${plan['networkid']}"></label>
                                                    </div>    
                                                </h5>
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    </div> 
                                    
                                                `;
                                html += htmlSegment;
                            });

                            document.getElementById('providers').innerHTML =
                                `${html}`;
                        }
                        // END GET DATA \\ 
                    </script>
                    <script>
                        function networkprovider(operatorId, image, name, networkid) {
                            document.getElementById("operatorId").value = networkid;

                        }
                        // END GET OPERATORS
                    </script>
                <?php $__env->stopPush(); ?>
                <input id="operatorId" hidden />

                <div class="form-group">
                    <label class="form-label mb-3"><?php echo app('translator')->get('Network'); ?></label>
                    <div id="providers"></div>
                </div>

                <div class="form-group">
                    <label class="form-label mb-3"><?php echo app('translator')->get('Recipient\'s Phone Number'); ?></label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input name="phone" id="phone" class="form-control"
                        value="" />
                </div>

                <div class="form-group">
                    <label class="form-label mb-3"><?php echo app('translator')->get('Amount'); ?></label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input name="amount" id="amount" type="number"
                        class="form-control" />
                </div>

                <div class="form-group">
                    <label class="form-label mb-3"><?php echo app('translator')->get('Transaction PIN'); ?></label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="password" autocomplete="new-password"  maxlength="6"  onkeyup="verifypassword(this)" id="password"
                        class="form-control " name="password" placeholder=""
                        value=""  />
                </div>
                <div id="passmessage"></div>
                <?php $__env->startPush('script'); ?>
                    <script>
                        function verifypassword(e) {
                            if(e.value.length < 6)
                            {
                                return;
                            }
                            $("#passmessage").html(
                                `<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`
                                );
                            
                            var raw = JSON.stringify({
                                _token: "<?php echo e(csrf_token()); ?>",
                                password: e.value,
                            });

                            var requestOptions = {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                body: raw
                            };
                            fetch("<?php echo e(route('user.trxpass')); ?>", requestOptions)
                                .then(response => response.text())
                                .then(result => {
                                    resp = JSON.parse(result);
                                    if (resp.ok != true) {
                                        document.getElementById("submit").disabled = true;
                                    }
                                    if (resp.ok != false) {
                                        document.getElementById("submit").disabled = false;
                                    }
                                    $("#passmessage").html(
                                        `<div class="alert alert-${resp.status}" role="alert"><strong>${resp.status} - </strong> ${resp.message}</div>`
                                    );
                                })
                                .catch(error => {

                                });
                            // END GET DATA \\
                        }
                    </script>
                <?php $__env->stopPush(); ?>


                <button type="button" class="btn theme-btn w-100" onclick="submitform()" id="submit">Buy</button>
            </form>
        </div>
    </section>
    
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
    <!-- Withdraw section end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        // START BUY AIRTIME \\
        function submitform() {

            // Show page loading
            var raw = JSON.stringify({
                _token: "<?php echo e(csrf_token()); ?>",
                password: document.getElementById('password').value,
                amount: document.getElementById('amount').value,
                phone: document.getElementById('phone').value,
                operator: document.getElementById('operatorId').value,
                wallet: localStorage.getItem('wallet'),
            });
            var amount = document.getElementById('amount').value;
            document.getElementById("submit").disabled = true;
            $("#passmessage").html(`<center><div class="spinner-border theme-color mt-2" role="status"><span class="visually-hidden">Loading...</span></div></center>`);
            var requestOptions = {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: raw
            };
            fetch("<?php echo e(route('user.buy.airtime.local.post')); ?>", requestOptions)
                .then(response => response.text())
                .then(result => {
                    resp = JSON.parse(result);
                    document.getElementById("sentamount").innerHTML = '₦'+amount;
                    document.getElementById("sentmessage").innerHTML = resp.message;
                    document.getElementById("doneheader").innerHTML = 'Transaction Successful';
                    document.getElementById("doneimage").innerHTML = `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/done.svg')); ?>" alt="done" />`;
                    if(resp.status == 'danger')
                    {
                        document.getElementById("doneheader").innerHTML = 'Transaction Failed';
                        document.getElementById("doneimage").innerHTML = `<img class="img-fluid" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/svg/error.svg')); ?>" alt="done" />`;
                    }
                    $('#done').modal('show');
                    $("#passmessage").html(``);
                    document.getElementById("submit").disabled = false;


                })
                .catch(error => {


                });

        }

        // END BUY AIRTIME \\
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/core/resources/mobileapp/templates/basic/user/bills/airtime/airtime_buy_local.blade.php ENDPATH**/ ?>