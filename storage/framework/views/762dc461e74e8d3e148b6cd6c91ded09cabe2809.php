<?php $__env->startSection('panel'); ?> 
<div class="container-fluid">
  
    <!--  Row 1 -->


    <div class="row">
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-primary has-link box--shadow2 overflow-hidden">
              <a class="item-link" href="<?php echo e(route('admin.users.all')); ?>"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                         <h2 class="text-primary"> <i class="ti ti-users"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-primary"><?php echo app('translator')->get('Total Users'); ?></span>
                          <h2 class="text-primary"><?php echo e($widget['total_users']); ?></h2>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- dashboard-w1 end -->
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-success has-link box--shadow2">
              <a class="item-link" href="<?php echo e(route('admin.users.active')); ?>"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                          <h2 class="text-success"> <i class="ti ti-user-check"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-success"><?php echo app('translator')->get('Active Users'); ?></span>
                          <h2 class="text-success"><?php echo e($widget['verified_users']); ?></h2>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- dashboard-w1 end -->
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-danger has-link box--shadow2">
              <a class="item-link" href="<?php echo e(route('admin.users.email.unverified')); ?>"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                          <h2 class="text-danger"> <i class="ti ti-users"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-danger"><?php echo app('translator')->get('Email Unverified'); ?></span>
                          <h2 class="text-danger"><?php echo e($widget['email_unverified_users']); ?></h2>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- dashboard-w1 end -->
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-danger has-link box--shadow2">
              <a class="item-link" href="<?php echo e(route('admin.users.mobile.unverified')); ?>"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                          <h2 class="text-danger"> <i class="ti ti-users"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-danger"><?php echo app('translator')->get('Mobile Unverified'); ?></span>
                          <h2 class="text-danger"><?php echo e($widget['mobile_unverified_users']); ?></h2>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Deposit Report'); ?></h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-warning">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['total_deposit_pending'])); ?></h2>
                        <h6 class="fw-medium text-warning mb-0"><?php echo app('translator')->get('Pending Deposits'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-warning display-6"><i class="ti ti-wallet"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['total_deposit_amount'])); ?></h2>
                        <h6 class="fw-medium text-success mb-0"><?php echo app('translator')->get('Approved Deposits '); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-wallet"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-danger">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['total_deposit_rejected'])); ?></h2>
                        <h6 class="fw-medium text-danger mb-0"><?php echo app('translator')->get('Declined Deposit '); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-wallet"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->




    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Withdrawal Report'); ?></h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-warning">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['pending_withdrawal'])); ?></h2>
                        <h6 class="fw-medium text-warning mb-0"><?php echo app('translator')->get('Pending Withdrawal'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-warning display-6"><i class="ti ti-building-bank"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['approved_withdrawal'])); ?></h2>
                        <h6 class="fw-medium text-success mb-0"><?php echo app('translator')->get('Approved Withdrawal '); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-building-bank"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-danger">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['declined_withdrawal'])); ?></h2>
                        <h6 class="fw-medium text-danger mb-0"><?php echo app('translator')->get('Declined Withdrawl '); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-building-bank"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->


    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Overall Transaction Report'); ?></h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-danger">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['total_debit'])); ?></h2>
                        <h6 class="fw-medium text-danger mb-0"><?php echo app('translator')->get('Total Debit'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-wallet-off"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> <?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['total_credit'])); ?></h2>
                        <h6 class="fw-medium text-success mb-0"><?php echo app('translator')->get('Total Credit '); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-wallet"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
               
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->




    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Bills Payment Overview'); ?></h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-primary">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['airtime'])); ?></h2>
                        <h6 class="fw-medium text-primary mb-0"><?php echo app('translator')->get('Airtime'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-primary display-6"><i class="ti ti-phone"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['internet'])); ?></h2>
                        <h6 class="fw-medium text-success mb-0"><?php echo app('translator')->get('Internet'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-wifi"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-warning">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['cabletv'])); ?></h2>
                        <h6 class="fw-medium text-warning mb-0"><?php echo app('translator')->get('Cable TV'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-warning display-6"><i class="ti ti-video"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-primary">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['insurance'])); ?></h2>
                        <h6 class="fw-medium text-primary mb-0"><?php echo app('translator')->get('Insurance'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-primary display-6"><i class="ti ti-umbrella"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-danger">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"><?php echo e($general->cur_sym); ?><?php echo e(getAmount($widget['electricity'])); ?></h2>
                        <h6 class="fw-medium text-danger mb-0"><?php echo app('translator')->get('Electricity'); ?></h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-power"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->



    

    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Monthly Transaction Overview'); ?></h5>
                <p class="card-subtitle mb-0"> <?php echo app('translator')->get('Year '. date('Y')); ?></p>
              </div> 
            </div>
            <div class="row align-items-center">
              <div class="col-lg-8 col-md-8">
                <div id="DepositYear"></div>
              </div> 
              <div class="col-lg-4 col-md-4">
                <div class="d-flex align-items-center mb-4 pb-1">
                  <div class="p-8 bg-light-success rounded-1 me-3 d-flex align-items-center justify-content-center">
                    <i class="ti ti-wallet text-success fs-6"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fs-7 fw-semibold"><?php echo e($general->cur_sym); ?><?php echo e(showAmount($total_deposit_amount)); ?></h4>
                    <p class="fs-3 mb-0"><?php echo app('translator')->get('Total Deposited'); ?></p>
                  </div>
                </div>

                <div class="d-flex align-items-center mb-4 pb-1">
                    <div class="p-8 bg-light-warning rounded-1 me-3 d-flex align-items-center justify-content-center">
                      <i class="ti ti-wallet text-warning fs-6"></i>
                    </div>
                    <div>
                      <h4 class="mb-0 fs-7 fw-semibold"><?php echo e($total_deposit_pending); ?></h4>
                      <p class="fs-3 mb-0"><?php echo app('translator')->get('Pending Deposited'); ?></p>
                    </div>
                  </div>

                  <div class="d-flex align-items-center mb-4 pb-1">
                    <div class="p-8 bg-light-danger rounded-1 me-3 d-flex align-items-center justify-content-center">
                      <i class="ti ti-wallet text-danger fs-6"></i>
                    </div>
                    <div>
                      <h4 class="mb-0 fs-7 fw-semibold"><?php echo e($total_deposit_rejected); ?></h4>
                      <p class="fs-3 mb-0"><?php echo app('translator')->get('Rejected Deposited'); ?></p>
                    </div>
                  </div>
                <div> 
                  <div>
                    <a href="<?php echo e(route('admin.deposit.list')); ?>" class="btn btn-outline-primary w-100">View Deposit Report</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Transactions Report'); ?></h5>
                <p class="card-subtitle mb-0"> (<?php echo app('translator')->get('Last 30 Days'); ?>)</p>
              </div> 
            </div>
            <div class="row align-items-center">
              <div class="col-lg-12 col-md-12">
                <div id="apex-line"></div>
              </div>  
              
            </div>
          </div>
        </div>
      </div>
       
    </div>
    <!--  Row 2 --> 
     <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="row align-items-center">
                    <div class="d-flex justify-content-center">
                        <div id="chart-browser"></div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="row align-items-center">
                    <div class="d-flex justify-content-center">
                        <div id="chart-country"></div>
                    </div>
                </div>
              </div>
            </div>
        </div> 
 
    <!--  Row 3 -->
    <div class="row">
      <!-- Top Performers -->
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold"><?php echo app('translator')->get('Top 10 Performers'); ?></h5>
                <p class="card-subtitle mb-0"><?php echo app('translator')->get('Best customers by transaction volume'); ?></p>
              </div> 
            </div>
            <div class="table-responsive">
              <table class="table align-middle text-nowrap mb-0">
                <thead>
                  <tr class="text-muted fw-semibold">
                    <th scope="col" class="ps-0">Name</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody class="border-top">
                <?php $__empty_1 = true; $__currentLoopData = $top_earners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td class="ps-0">
                      <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                          <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . @$data->user->image, getFileSize('userProfile'))); ?>" class="rounded-circle" width="40" height="40" alt="" />
                        </div>
                        <div>
                          <h6 class="fw-semibold mb-1"><?php echo e(@$data->user->fullname); ?></h6>
                          <p class="fs-2 mb-0 text-muted"><?php echo e(@$data->user->username); ?></p>
                        </div>
                      </div>
                    </td> 
                    <td>
                      <a class="label fw-semibold py-1 w-85 bg-light-primary text-primary"><?php echo e($general->cur_sym); ?><?php echo e(showAMount($data->sums)); ?></a>
                    </td> 
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php echo emptyData(); ?>

                <?php endif; ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="modal fade" id="cronModal" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo app('translator')->get('Cron Job Setting Instruction'); ?></h5>
                <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text--danger text-center"><?php echo app('translator')->get('Please Set Cron Job Now'); ?></h3>
                <p class="lead">
                    <?php echo app('translator')->get('To automate the api order placement, we need to set the cron job and make sure the cron job is running properly. Set the Cron time as minimum as possible. Once per 5-15 minutes is ideal while once every minute is the best option.'); ?> </p>
                <label class="font-weight-bold"><?php echo app('translator')->get('Cron Command'); ?></label>

                <div class="input-group">
                    <input class="form-control" id="referralURL" name="text" type="text" value="curl -s <?php echo e(route('cron')); ?>" readonly>
                    <span class="input-group-text copytext btn btn--primary copyBoard pt-2" id="copyBoard">
                        <?php echo app('translator')->get('Copy'); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php
        $lastCron = Carbon\Carbon::parse($general->last_cron)->diffInSeconds();
    ?>
    <span
        class="<?php if($lastCron < 300): ?> text--info <?php elseif($lastCron < 900): ?> text--warning <?php else: ?> text--danger <?php endif; ?>">
        <?php echo app('translator')->get('Last Cron Run'); ?>
        <strong class="text-primary"><?php echo e(diffForHumans($general->last_cron)); ?></strong>
    </span>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?> 
<script>
  (function($) {
      "use strict";
      <?php if(Carbon\Carbon::parse($general->last_cron)->diffInMinutes() > 15): ?>
          window.onload = () => {
              $('#cronModal').modal('show');
          }
      <?php endif; ?>

      $('.copyBoard').on('click', function() {
          var copyText = document.getElementById("referralURL");
          copyText.select();
          copyText.setSelectionRange(0, 99999);
          document.execCommand("copy");
          iziToast.success({
              message: "Copied: " + copyText.value,
              position: "topRight"
          });
      });
  });
</script>
 
<?php $__env->startPush('script'); ?>
<script>
     // apex-line trxchart
     var options = {
            chart: {
                //height: 450,
                type: "bar",
                toolbar: {
                    show: false
                },

                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
                height: 320,
                stacked: false,
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            
            dataLabels: {
                enabled: false
            },
            series: [{
                    name: "Credit",
                    data: [
                        <?php $__currentLoopData = $trxReport['date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trxDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(@$plusTrx->where('date', $trxDate)->first()->amount ?? 0); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                },
                {
                    name: "Debit",
                    data: [
                        <?php $__currentLoopData = $trxReport['date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trxDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(@$minusTrx->where('date', $trxDate)->first()->amount ?? 0); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }
            ],
            plotOptions: {
            bar: {
                horizontal: false,
                barHeight: "60%",
                columnWidth: "20%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            },
            },
            xaxis: {
                categories: [
                    <?php $__currentLoopData = $trxReport['date']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trxDate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        "<?php echo e($trxDate); ?>",
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ]
            },
            grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
                lines: {
                show: false,
                },
            },
            },
            
        };

    var chart = new ApexCharts(document.querySelector("#apex-line"), options);

    chart.render();
</script>
<script>
  var chart = {
    series: [
      {
        name: "Deposit <?php echo e(__($general->cur_sym)); ?>",
        data: <?php echo json_encode($yearDeposit); ?>,
      },
      {
        name: "Payout <?php echo e(__($general->cur_sym)); ?>",
        data: <?php echo json_encode($yearPayout); ?>,
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "area",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 320,
      stacked: true,
    },
    colors: ["var(--bs-success)", "var(--bs-danger)"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "20%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: true,
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
      xaxis: {
        lines: {
          show: false,
        },
      },
    },
    yaxis: {
      min: -5,
      max: 5,
      title: {
        // text: 'Age',
      },
    },
    xaxis: {
      axisBorder: {
        show: true,
      },
      categories: <?php echo json_encode($yearLabels); ?>,

    },
    yaxis: {
      tickAmount: 4,
    },
    tooltip: {
      theme: "dark",
    },
  };
  var chart = new ApexCharts(document.querySelector("#DepositYear"), chart);
  chart.render();
</script> 
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
        <script>
    var options_multiple = {
    series: <?php echo e($chart['user_browser_counter']->flatten()); ?>,
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      height: 200,
      type: "donut",
    },
    colors: ["#615dff", "#3dd9eb", "#ffae1f", "#fa896b"],
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            fontSize: "22px",
          },
          value: {
            fontSize: "16px",
            color: "#a1aab2",
          },
          total: {
            show: true,
            label: "Total",
            formatter: function (w) {
              //return 249;
            },
          },
        },
      },
    },
    labels: <?php echo json_encode($chart['user_browser_counter']->keys(), 15, 512) ?>,
  };

  var chart_radial_multiple = new ApexCharts(
    document.querySelector("#chart-browser"),
    options_multiple
  );
  chart_radial_multiple.render();


  var options_multiple = {
    series: <?php echo e($chart['user_os_counter']->flatten()); ?>,
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      height: 200,
      type: "donut",
    },
    colors: ["#615dff", "#3dd9eb", "#ffae1f", "#fa896b"],
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            fontSize: "22px",
          },
          value: {
            fontSize: "16px",
            color: "#a1aab2",
          },
          total: {
            show: true,
            label: "Total",
            formatter: function (w) {
              //return 249;
            },
          },
        },
      },
    },
    labels: <?php echo json_encode($chart['user_os_counter']->keys(), 15, 512) ?>,
  };

  var chart_radial_multiple = new ApexCharts(
    document.querySelector("#chart-country"),
    options_multiple
  );
  chart_radial_multiple.render();

        </script>
        <?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ltecyxtc/mobile.ltechng.co/mobile-app/resources/mobileapp/admin/dashboard.blade.php ENDPATH**/ ?>