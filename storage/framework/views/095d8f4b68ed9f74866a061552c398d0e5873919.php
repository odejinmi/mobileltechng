
<?php $__env->startSection('panel'); ?>
    <!-- content @s
        -->
        <section>
            <div class="custom-container">
              <div class="swiper banner">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <a href="#">
                      <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/savings1.png')); ?>" alt="banner1" />
                    </a>
                  </div>
        
                  <div class="swiper-slide">
                    <a href="#">
                        <img class="img-fluid banner-img" src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/banner/savings2.png')); ?>" alt="banner1" />
                    </a>
                  </div>
                </div>
              </div>
             
            </div>
            </div>
          </section>
          <!-- banner section end -->

      

        <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
            <?php echo csrf_field(); ?>
            <section class="pay-money section-b-space">
                <div class="custom-container">
 
                    
                    
                    <div class="profile-pic">
                        <img class="img-fluid pay-img"
                            src="<?php echo e(asset($activeTemplateTrue . 'mobile/images/gif/successfull-payment.gif')); ?>"
                            alt="Payment" />
                    </div>
                    <h3 class="person-name">Paying money to <?php echo e(auth::user()->username); ?></h3>
                    <h5 class="upi-id">APP ID : <?php echo e(auth::user()->username); ?></h5>


                    <!--begin::Input group-->
                    <div class="mb-1 fv-row">
                        <!--begin::Label-->
                        <label class="form-label mb-3"><?php echo app('translator')->get('Savings Type '); ?></label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select id="first" name="type" class="form-control">
                            <option selected disabled>Select An Option</option>
                            <option value="1">Recurrent Savings</option>
                            <option value="2">Target Savings</option>
                            <option value="3">Fixed Savings</option>
                        </select>
                        <label class="form-check-label" for="value">
                            <small class="text-danger" id="value"></small>
                        </label>
                    </div>
                    <!--end::Input group-->

                </div>
            </section>
            <!-- pay money section end -->



            <!-- payment-details section end -->
            <section class="pay-money section-b-space red box1">
                <div class="custom-container">
                    <div class="form-group">
                        <label class="form-label" for="email">Recurrent Cycle</label>
                        <select name="cycle" class="form-control">
                            <option selected disabled>Select An Option</option>
                            <option value="1">Daily</option>
                            <option value="7">Weekly</option>
                            <option value="30">Monthly</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-input mt-4">
                            <label class="form-label" for="email">Recurring Amount</label>

                            <input type="number" value="<?php echo e(old('ramount')); ?>" name="ramount" placeholder="0.00"
                                class="form-control" id="inputamount" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-input mt-4">
                            <label class="form-label" for="Min">Target Amount</label>
                            <input type="number" value="<?php echo e(old('ramount')); ?>" name="tamount" placeholder="0.00"
                                class="form-control" id="inputamount" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input mt-4">
                            <label class="form-label" for="email">Recurrent Times</label>

                            <input type="number" onkeyup="fixeamount(this)" value="<?php echo e(old('recurrent')); ?>" name="recurrent"
                                placeholder="0" class="form-control" id="recurrent" />
                        </div>
                    </div>

                </div>
            </section>
            <!-- pay money section end -->
            <!-- payment-details section end -->
            <section class="pay-money section-b-space green box1">
                <div class="custom-container">

                    <div class="form-group">
                        <div class="form-input mt-4">
                            <label class="form-label" for="Min">Target Amount</label>

                            <input type="number" value="<?php echo e(old('tamount')); ?>" name="tamount" placeholder="0.00"
                                class="form-control" id="tamount" />
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="form-input mt-4">
                            <label class="form-label" for="Min">Recurrent</label>

                            <input type="number" value="<?php echo e(old('recurrentt')); ?>" name="recurrentt" placeholder="0"
                                class="form-control" id="recurrentt" />
                        </div>
                    </div> 

                    <ul class="card-list">
                        <li class="payment-add-box">
                            <div class="add-img">
                                <i class="sidebar-icon" data-feather="home"></i>
                            </div>
                            <div class="add-content">
                                <div>
                                    <h5 class="fw-semibold dark-text">Accomodation</h5>
                                    <h6 class="mt-2 light-text"></h6>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason2"
                                        value="Accomodation">
                                </div>
                            </div>
                        </li>
                        <li class="payment-add-box">
                            <div class="add-img">
                                <i class="sidebar-icon" data-feather="settings"></i>
                            </div>
                            <div class="add-content">
                                <div>
                                    <h5 class="fw-semibold dark-text">Appliances</h5>
                                    <h6 class="mt-2 light-text"></h6>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason2"
                                        value="Appliances">
                                </div>
                            </div>
                        </li>
                        <li class="payment-add-box">
                            <div class="add-img">
                                <i class="sidebar-icon" data-feather="shopping-cart"></i>
                            </div>
                            <div class="add-content">
                                <div>
                                    <h5 class="fw-semibold dark-text">Business</h5>
                                    <h6 class="mt-2 light-text"></h6>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason3"
                                        value="Business">
                                </div>
                            </div>
                        </li>
                        <li class="payment-add-box">
                            <div class="add-img">
                                <i class="sidebar-icon" data-feather="truck"></i>
                            </div>
                            <div class="add-content">
                                <div>
                                    <h5 class="fw-semibold dark-text">Car</h5>
                                    <h6 class="mt-2 light-text"></h6>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason4"
                                        value="Car">
                                </div>
                            </div>
                        </li>
                        <li class="payment-add-box">
                            <div class="add-img">
                                <i class="sidebar-icon" data-feather="book"></i>
                            </div>
                            <div class="add-content">
                                <div>
                                    <h5 class="fw-semibold dark-text">Education</h5>
                                    <h6 class="mt-2 light-text"></h6>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason5"
                                        value="Education">
                                </div>
                            </div>
                        </li>
                        <li class="payment-add-box">
                            <div class="add-img">
                                <i class="sidebar-icon" data-feather="box"></i>
                            </div>
                            <div class="add-content">
                                <div>
                                    <h5 class="fw-semibold dark-text">Others</h5>
                                    <h6 class="mt-2 light-text"></h6>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="reason" id="reason9"
                                        value="Others">
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="form-group mt-2">
                        <label class="form-label" for="Min">Maturity Date </label>
                        <input type="date" name="mature" class="form-control" placeholder="Enter Date" />
                    </div>
                </div>
            </section>
            <!-- pay money section end -->
            <section class="pay-money section-b-space blue box1">
                <div class="custom-container">

                    <div class="form-group">
                        <div class="form-input mt-4">
                            <label class="form-label" for="Min">Target Amount</label>

                            <input type="number" value="<?php echo e(old('famount')); ?>" name="famount" placeholder="0.00"
                                class="form-control" id="tamount" />
                        </div>
                    </div>

                    <ul class="card-list">
                        <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="payment-add-box">
                                <div class="add-img">
                                    <i class="sidebar-icon" data-feather="lock"></i>
                                </div>
                                <div class="add-content">
                                    <div>
                                        <h5 class="fw-semibold dark-text"><?php echo e($data->name); ?></h5>
                                        <h6 class="mt-2 light-text"></h6>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="plan"
                                            id="reason<?php echo e($data->id); ?>" value="<?php echo e($data->id); ?>" checked>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php echo emptyData(); ?>


                        <?php endif; ?>
                    </ul>
                </div>
            </section>

            <section class="section-b-space">
                <div class="custom-container">
                    <button type="submit" class="btn theme-btn w-100" id="submit">Submit</button>
                </div>
            </section>
        </form>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script'); ?>
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#first").change(function() {
                    $(this).find("option:selected").each(function() {
                        if ($(this).attr("value") == "1") {
                            $(".box1").not(".red").hide();
                            $(".red").show();
                        } else if ($(this).attr("value") == "2") {
                            $(".box1").not(".green").hide();
                            $(".green").show();
                        } else if ($(this).attr("value") == "3") {
                            $(".box1").not(".blue").hide();
                            $(".blue").show();
                        } else {
                            $(".box1").hide();
                        }
                    });
                }).change();
            });
        </script>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('script'); ?>
        <script>
            function fixeamount(e) {
                document.getElementById("amount").value = e.value;
                document.getElementById("value").innerHTML = ''
                document.getElementById("unit").value = ''
                return;
            }

            function getvalue(e) {
                var unit = e.value;
                var amount = document.getElementById("amount").value;
                if (amount < 1) {
                    SlimNotifierJs.notification('error', 'error', 'Enter and amount first', 3000);
                    return;
                }
                var balance = "<?php echo e(Auth::user()->balance); ?>";
                var total = unit * amount;
                if (total > balance) {
                    SlimNotifierJs.notification('error', 'error', 'Insufficient wallet balance', 3000);
                    document.getElementById("value").innerHTML = ''
                    return;
                }
                document.getElementById("value").innerHTML =
                    `<br><div class="alert alert-primary" role="alert">
        <strong>The total value of this voucher will be : </strong> <?php echo e($general->cur_sym); ?> ${parseInt(total).toLocaleString()}<br>
        Ensure you have enough balance to generate this voucher
    </div>`
            }
        </script>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('breadcrumb-plugins'); ?>
    <a href="<?php echo e(route('user.savings.history')); ?>" class="back-btn">
        <i class="icon" data-feather="printer"></i>
      </a>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make($activeTemplate . 'layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/templates/basic/user/vendor/savings/request.blade.php ENDPATH**/ ?>