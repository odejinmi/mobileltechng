
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
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/4759311.jpg')); ?>" alt="banner1" />
            </a>
          </div>

          <div class="swiper-slide">
            <a href="#">
              <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/4759311.jpg')); ?>" alt="banner2" />
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- banner section end -->
        <!-- my account section start -->
        <section class="section-b-space">
            <div class="custom-container">

                <form class="auth-form pt-0 mt-3" novalidate="novalidate" action="" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="inputpin" class="form-label">Network</label>
                        <select type="text" onchange="fixeamount(this)"
                            class="form-control form-select <?php $__errorArgs = ['network'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="network"
                            name="network" placeholder="network">
                            <option selected disabled value="empty">Select A Network</option>
                            <option value="airtel">AIRTEL</option>
                            <option value="mtn">MTN</option>
                            <option value="glo">GLOBACOM</option>
                            <option value="9mobile">9MOBILE</option>
                        </select>
                        <div id="networkfee"></div>

                    </div>

                    <div class="form-group">
                        <label for="inputusername" class="form-label">Amount</label>
                        <div class="form-input">
                            <input type="number" id="amount" onkeyup="fixeamount(this)"
                                class="form-control amount <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('amount')); ?>"
                                name="amount" placeholder="0.00" />
                            <span id="commision"></span>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="inputusername" class="form-label">Airtime Code</label>
                        <div class="form-input">
                            <input type="text" class="form-control username <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="code" name="code" value="<?php echo e(old('code')); ?>"
                                placeholder="XXXX-XXXX-XXXX-XXXX-XXXX" />
                        </div>
                        <span id="worth"></span>
                    </div>



                    <div class="form-group">
                        <label for="inputusername" class="form-label">Transaction PIN</label>
                        <div class="form-input">
                            <input type="text" class="form-control username <?php $__errorArgs = ['pin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="pin" name="pin" value="<?php echo e(old('pin')); ?>" placeholder="****" />
                        </div>
                    </div>

                    <button type="submit" class="btn theme-btn w-100" id="submit">Convert</button>
                </form>
            </div>
        </section>
        <!-- my account section end -->
    <?php $__env->stopSection(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
        <a href="<?php echo e(route('user.airtime.tocash.history')); ?>" class="back-btn">
            <i class="icon" data-feather="grid"></i>
        </a>
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script'); ?>
        <script>
            document.getElementById("code").disabled = true;
            document.getElementById("pin").disabled = true;

            function fixeamount(e) {
                if (e.name == 'amount') {
                    document.getElementById("amount").value = e.value;
                }

                if (document.getElementById("network").value != 'empty' && e.name == 'network') {
                    document.getElementById("amount").value = null;
                    getNetwork();
                    return;
                }
                submitform();
                // START AIRTIME FEE \\
                function getNetwork() {
                    var network_input = document.getElementById('network').value;
                    var raw = JSON.stringify({
                        _token: "<?php echo e(csrf_token()); ?>",
                        network: network_input,
                        fee: true,
                    });

                    var requestOptions = {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: raw
                    };
                    fetch("<?php echo e(route('user.airtime.tocash.fee')); ?>", requestOptions)
                        .then(response => response.text())
                        .then(result => {
                            resp = JSON.parse(result);
                            SlimNotifierJs.notification(`${resp.status}`, `${resp.status}`, `${resp.message}`, 3000);
                            var plans = resp.range;
                            var html = '';
                            if (resp.ok != false) {
                                plans.map(plan => {
                                    let htmlSegment =
                                        `
                                                        <li class="list-group-item d-flex align-items-center">
                                                        <i class="ti ti-gift fs-4 me-2 text-primary"></i>
                                                        <?php echo e($general->cur_sym); ?> ${plan['min']} - <?php echo e($general->cur_sym); ?>${plan['max']}
                                                        <span class="badge bg-light-danger text-danger font-medium rounded-pill ms-auto"
                                                            >${plan['fee']}%</span>
                                                        </li> `;
                                    html += htmlSegment;
                                });

                                document.getElementById("amount").disabled = false;
                                document.getElementById('networkfee').innerHTML =
                                    `
                                                    <div class="col-lg-12">
                                                      <div class="card">
                                                        <div class="card-body">
                                                        <div class="mb-3">
                                                            <h5 class="mb-0">Airtime Conversion Rate</h5>
                                                        </div>
                                                        <ul class="list-group"> 
                                                        ${html}
                                                        </ul>
                                                        </div>
                                                       </div>
                                                    </div> 
                                                    `;
                            } else {

                                document.getElementById("amount").disabled = true;
                                document.getElementById('networkfee').innerHTML = "";
                            }
                        })
                        .catch(error => {

                        });

                    document.getElementById("commision").innerHTML = '';
                    document.getElementById("worth").innerHTML = '';
                    return;

                }

                function submitform() {

                    var amount_input = document.getElementById('amount').value;
                    var network_input = document.getElementById('network').value;
                    var raw = JSON.stringify({
                        _token: "<?php echo e(csrf_token()); ?>",
                        network: network_input,
                        amount: amount_input,
                        fee: false,
                    });

                    var requestOptions = {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: raw
                    };
                    fetch("<?php echo e(route('user.airtime.tocash.fee')); ?>", requestOptions)
                        .then(response => response.text())
                        .then(result => {
                            resp = JSON.parse(result);
                            //SlimNotifierJs.notification(`${resp.status}`, `${resp.status}`,`${resp.message}`, 3000);
                            if (resp.ok != true) {
                                document.getElementById("code").disabled = true;
                                document.getElementById("pin").disabled = true;
                                document.getElementById("commision").innerHTML = '';
                                document.getElementById("worth").innerHTML = '';

                                document.getElementById("submit").disabled = true;
                            }
                            if (resp.ok != false) {
                                var fee = resp.range.fee;
                                var commission = (amount_input / 100) * fee; // Correct Calculation
                                var worth = amount_input - commission;
                                document.getElementById("commision").innerHTML =
                                    `<span class="badge bg-danger text-white" id="commision">Fee: ${commission}</span>`;
                                document.getElementById("worth").innerHTML =
                                    `<span class="badge bg-success text-white" id="worth">Value: <?php echo e($general->cur_text); ?> ${worth}</span>`;
                                document.getElementById("code").disabled = false;
                                document.getElementById("pin").disabled = false;

                                document.getElementById("submit").disabled = false;
                            }
                        })
                        .catch(error => {

                        });

                }
                // END AIRTIME FEE \\

            }
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/templates/basic/user/bills/airtime2cash/create.blade.php ENDPATH**/ ?>