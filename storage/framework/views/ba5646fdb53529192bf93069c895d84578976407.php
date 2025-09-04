<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-nowrap logo-img">
            <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" width="30" class="dark-logo"  alt="" />
            <img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" width="30" class="light-logo" alt="" />
          </a>
          <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8 text-muted"></i>
          </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
          <ul id="sidebarnav">
            <!-- ============================= -->
            <!-- Home -->
            <!-- ============================= -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <!-- =================== -->
            <!-- Dashboard -->
            <!-- =================== -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.dashboard')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-home"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Dashboard'); ?></span>
              </a>
            </li>


            <!-- ============================= -->
            <!-- Payment Account -->
            <!-- ============================= -->
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.paymentaccount*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><?php echo app('translator')->get('Payment Account'); ?></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.paymentaccount.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-brand-paypal-filled"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Manage Accounts'); ?></span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.paymentaccount.request',1)); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-check"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Approved Request'); ?></span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.paymentaccount.request',2)); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-loader"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Pending Request'); ?></span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.paymentaccount.request',3)); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-trash"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Canceled Request'); ?></span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.paymentaccount.request',4)); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-x"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Declined Request'); ?></span>
              </a>
            </li>            
            <?php endif ?>

            <!-- ============================= -->
            <!-- Loan -->
            <!-- ============================= -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><?php echo app('translator')->get('Loan'); ?></span>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.plans.loan.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-box"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Loan Plans'); ?></span>
              </a>
            </li>
              
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-heart-handshake"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Manage Loans'); ?></span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.loan.pending')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Pending Loan'); ?></span>
                    <?php if($pendingLoanCount): ?>
                    <div class="hide-menu">
                      <span
                        class="badge rounded-circle bg-danger d-flex align-items-center justify-content-center rounded-pill fs-2"
                        ><?php echo e($pendingLoanCount); ?></span
                      >
                    </div> 
                    <?php endif; ?>
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.loan.running')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Running Loan'); ?></span>
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.loan.due')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Due Loan'); ?></span>
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.loan.paid')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Paid Loan'); ?></span>
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.loan.rejected')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Rejected Loan'); ?></span> 
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.loan.index')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('All Loans'); ?></span>
                  </a>
                </li>  
              </ul>
            </li>

             
            <!-- ============================= -->
            <!-- Trade -->
            <!-- ============================= -->
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.currency','admin.giftcardindex','admin.crypto.assetselltrade*','admin.crypto.assetbuytrade*','admin.sellpenex*','admin.selldecex*','admin.buypenex*','admin.buyproex*','admin.buydecex*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><?php echo app('translator')->get('Asset Trade'); ?></span>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.currency'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.crypto.currency')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-coin"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Crypto Settings'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.giftcardindex'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.giftcardindex')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-wallet"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Giftcard Settings'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.assetselltrade*','admin.crypto.assetbuytrade*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-coin-bitcoin"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Crypto Trade'); ?></span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.assetselltrade*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.crypto.assetselltrade','pending')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Pending Sales'); ?></span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.crypto.assetselltrade','success')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Approved Sales'); ?></span>
                  </a>
                </li>  
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.crypto.assetselltrade','declined')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Declined Sales'); ?></span>
                  </a>
                </li> 
                <hr> 
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.assetbuytrade*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.crypto.assetbuytrade','pending')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Pending Purchase'); ?></span>
                  </a>
                </li> 

                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.crypto.assetbuytrade','success')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Approved Purchase'); ?></span>
                  </a>
                </li> 
                
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.crypto.assetbuytrade','declined')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Declined Purchase'); ?></span>
                  </a>
                </li> 
                <?php endif ?>   
              </ul>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.sellpenex*','admin.selldecex*','admin.buypenex*','admin.buyproex*','admin.buydecex*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Giftcard Trade'); ?></span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.sellpenex*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.sellpenex',0)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Pending Sales'); ?></span>
                  </a>
                </li> 
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.sellproex*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.sellproex',1)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Approved Sales'); ?></span>
                  </a>
                </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.selldecex*'])  ? 1 : 0;
            if($hasPermission == 1): ?> 
                
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.selldecex',2)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Declined Sales'); ?></span>
                  </a>
                </li> 

                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.buypenex*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <hr>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.buypenex',0)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Pending Purcahse'); ?></span>
                  </a>
                </li> 

                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.buyproex*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.buyproex',1)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Approved Purchase'); ?></span>
                  </a>
                </li> 
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.buydecex*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.buydecex',2)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Declined Purchase'); ?></span>
                  </a>
                </li>
                <?php endif ?>    
              </ul>
            </li>
            <?php endif ?>
            
            <?php if($general->crypto > 0): ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.crypto.wallet*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.crypto.wallet')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-wallet"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Crypto Wallet'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php endif; ?>
           

             <!-- ============================= -->
            <!-- Apps -->
            <!-- ============================= -->
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.storefront.index','admin.admin.savings.log','admin.plans*','admin.voucher*','admin.bills*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><?php echo app('translator')->get('Apps'); ?></span>
            </li>
            <?php endif ?>
 
            <?php if($general->virtualcard > 0): ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.virtualcard'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.bills.virtualcard')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Virtual Card'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php endif; ?>
            <?php if($general->savings > 0): ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.admin.savings.log'])  ? 1 : 0;
            if($hasPermission == 1): ?>
             <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.savings.log')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-pig"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Savings'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.plans*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.plans.fdr.index')); ?>">
                <span class="d-flex">
                  <i class="ti ti-cash"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Savings Plans'); ?></span> 
              </a> 
            </li>
            <?php endif ?>
            <?php endif; ?>

            <?php if($general->voucher > 0): ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.voucher*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.voucher.log')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-tag"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Voucher'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php endif; ?>
            <?php if($general->airtime2cash > 0): ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.airtime2cash'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-cash"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Airtime To Cash'); ?></span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.airtime2cashFees')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Fees Settings'); ?></span>
                  </a>
                </li>  
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.airtime2cash')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('All Transactions'); ?></span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.airtime2cash',0)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Pending Transactions'); ?></span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.airtime2cash',1)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Successfull Transactions'); ?></span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.airtime2cash',2)); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Declined Transactions'); ?></span>
                  </a>
                </li> 
                 
              </ul>
            </li> 
            <?php endif ?>
            <?php endif; ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.airtime','admin.bills.internet','admin.bills.cabletv','admin.bills.utility','admin.bills.insurance'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-cash"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Bills Payments'); ?></span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.airtime'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.airtime')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Airtime'); ?></span>
                  </a>
                </li> 
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.insurance'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.insurance')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Insurance'); ?></span>
                  </a>
                </li> 
                 
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.internet'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.internet')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Internet'); ?></span>
                  </a>
                </li>
                 
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.cabletv'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.cabletv')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Cable TV'); ?></span>
                  </a>
                </li>  
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission(['admin.bills.utility'])  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.bills.utility')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Utility'); ?></span>
                  </a>
                </li> 
                <?php endif ?> 
              </ul>
            </li>
            <?php endif ?>
           
              
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.staff.index', 'admin.roles.index', 'admin.users.kyc.approved','admin.users.kyc.pending','admin.permissions.index','admin.users*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Users</span>
            </li>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.users.kyc.approved','admin.users.kyc.pending'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Manage KYC'); ?></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.users.kyc.pending')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.users.kyc.pending')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Pending KYC'); ?></span>
                  </a>
                </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.users.kyc.verified')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.users.kyc.approved')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Approved KYC'); ?></span>
                  </a>
                </li>
                <?php endif ?>
              </ul>
             </li>
            <?php endif ?>
          <?php $hasPermission = App\Models\Role::hasPermission('admin.staff.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link " href="<?php echo e(route('admin.staff.index')); ?>" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-shield"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Manage Staff'); ?></span>
              </a> 
            </li>
          <?php endif ?>
          <?php $hasPermission = App\Models\Role::hasPermission('admin.roles.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link " href="<?php echo e(route('admin.roles.index')); ?>" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-key"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Roles & Permission'); ?></span>
              </a> 
            </li>
          <?php endif ?> 
          <?php $hasPermission = App\Models\Role::hasPermission(['admin.users*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Manage Users'); ?></span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.active')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.active')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Active Users'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.vendor')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.vendor')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Vendor Accounts'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.banned')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.banned')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Banned Users'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.email.unverified')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.email.unverified')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Email Unverified'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.mobile.unverified')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.mobile.unverified')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Phone Unverified'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.with.balance')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.with.balance')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Users With Balance'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.all')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('All Users'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.users.notification.all')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.users.notification.all')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Send Broadcast'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                </ul>
            </li>
            <?php endif ?>
            <?php endif ?>
            <?php if(can(['admin.gateway*','admin.deposit*',])): ?>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu"><?php echo app('translator')->get('Payment Gateway'); ?></span>
            </li>
            <?php endif; ?>
            <?php if(can(['admin.gateway*',])): ?>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-credit-card"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Manage Gateways'); ?></span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.gateway.automatic.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.gateway.automatic.index')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Automatic Gateways'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.gateway.manual.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.gateway.manual.index')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Manual Gateways'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.deposit*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-wallet"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Manage Deposits'); ?></span>

                  <?php if(0 < $pendingDepositsCount): ?>
                  <div class="hide-menu">
                    <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><i class="ti ti-alert-circle"></i></span>
                  </div>
                 <?php endif; ?>

                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.deposit.pending')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Pending Deposits'); ?></span>
                      <?php if($pendingDepositsCount): ?>
                      <div class="hide-menu">
                        <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><?php echo e($pendingDepositsCount); ?></span>
                      </div>
                      <?php endif; ?>
                    </a>
                  </li>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.deposit.pending')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.deposit.approved')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Approved Deposits'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.deposit.successful')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.deposit.successful')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Successful Deposits'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.deposit.rejected')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.deposit.rejected')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Rejected Deposits'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.deposit.initiated')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.deposit.initiated')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Initiated Deposits'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.deposit.list')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.deposit.list')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('All Deposits'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                </ul>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.withdraw*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu"><?php echo app('translator')->get('Payout Gateway'); ?></span>
            </li>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.withdraw.method.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.withdraw.method.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-building-bank"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Withdrawal Methods'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php if(can(['admin.withdraw.pending','admin.withdraw.approved','admin.withdraw.rejected','admin.withdraw.log',])): ?>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-shopping-cart"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Manage Payouts'); ?></span>
                  <?php if(0 < @$pending_withdraw_count): ?>
                  <div class="hide-menu">
                    <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><i class="ti ti-alert-circle"></i></span>
                  </div>
                  <?php endif; ?>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.withdraw.pending')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.withdraw.pending')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Pending Payouts'); ?></span>
                      <?php if(@$pending_withdraw_count): ?>
                      <div class="hide-menu">
                        <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><?php echo e(@$pending_withdraw_count); ?></span>
                      </div>
                      <?php endif; ?>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.withdraw.approved')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.withdraw.approved')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Approved Payouts'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.withdraw.rejected')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.withdraw.rejected')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Rejected Payouts'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.withdraw.log')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.withdraw.log')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('All Payouts'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                </ul>
            </li>
            <?php endif ?>
            <?php endif ?>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><?php echo app('translator')->get('POS Terminals'); ?></span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.terminal.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-id-badge"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Manage Terminals'); ?></span>
              </a>
            </li> 
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.terminal.fee')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-tag"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Manage Fees'); ?></span>
              </a>
            </li> 

            <?php if(can(['admin.ticket*','admin.report*'])): ?>

            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Misc</span>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.ticket*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-help"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Support Tickets'); ?></span>
                  <?php if(0 < $pendingTicketCount): ?>
                      <div class="hide-menu">
                        <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><i class="ti ti-alert-circle"></i></span>
                    </div>
                  <?php endif; ?>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.pending')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.ticket.pending')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Pending Tickets'); ?></span>
                    </a>
                  </li>
                  <?php endif; ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.closed')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.ticket.closed')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Closed Ticket'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.answered')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.ticket.answered')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Answered Ticket'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.ticket.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.ticket.index')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('All Tickets'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                </ul>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.report*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-printer"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Report'); ?></span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.report.transaction')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.report.transaction')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Transaction Logs'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.report.login.history')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.report.login.history')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Login History'); ?></span>
                    </a>
                  </li>
                  <?php endif ?>
                  <?php $hasPermission = App\Models\Role::hasPermission('admin.report.notification.history')  ? 1 : 0;
            if($hasPermission == 1): ?>
                  <li class="sidebar-item">
                    <a href="<?php echo e(route('admin.report.notification.history')); ?>" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu"><?php echo app('translator')->get('Notification History'); ?></span>
                    </a> 
                  </li>
                  <?php endif ?>
                </ul>
            </li>
            <?php endif ?>
            
            <?php $hasPermission = App\Models\Role::hasPermission('admin.subscriber.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.subscriber.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-mail"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Subscribers'); ?></span>
              </a>
            </li>
            <?php endif ?>
             <!-- ============================= -->
            <!-- Settings -->
            <!-- ============================= -->
            <?php if(can(['admin.setting.index','admin.cron.index','admin.setting.logo.icon','admin.setting.system.configuration','admin.kyc.setting','admin.referral.setting','admin.extensions.index','admin.language.manage','admin.seo','admin.setting.notification'])): ?>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu"><?php echo app('translator')->get('Settings'); ?></span>
              </li>
            <?php endif; ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.setting.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('General Settings'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.system.configuration')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.setting.system.configuration')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-adjustments-alt"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('System Configuration'); ?></span>
              </a>
            </li>
            <?php endif ?> 
            <?php $hasPermission = App\Models\Role::hasPermission('admin.referral.setting')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.referral.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-sitemap"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Referral Settings'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.logo.icon')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.setting.logo.icon')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-photo-check"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Logo & Favicon'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.extensions.index')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.extensions.index')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Extensions'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.language.manage')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.language.manage')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-globe"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Language'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.seo')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.seo')); ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-user-circle"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('SEO Settings'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.setting.notification*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-mail-cog"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Notification Setting'); ?></span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.global')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.setting.notification.global')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Global Template'); ?></span>
                  </a>
                </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.email')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.setting.notification.email')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Email Setting'); ?></span>
                  </a>
                </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.sms')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.setting.notification.sms')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('SMS Setting'); ?></span>
                  </a>
                </li>
                <?php endif ?>
                <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.notification.templates')  ? 1 : 0;
            if($hasPermission == 1): ?>
                <li class="sidebar-item">
                  <a href="<?php echo e(route('admin.setting.notification.templates')); ?>" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu"><?php echo app('translator')->get('Notification Templates'); ?></span>
                  </a>
                </li>
                <?php endif ?>
              </ul>
            </li>
            <?php endif ?>
            <!-- ============================= -->
            <!-- UI -->
            <!-- ============================= -->
            <?php if(can(['admin.frontend.templates','admin.frontend.manage.pages','admin.frontend.sections'])): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><?php echo app('translator')->get('Frontend Settings'); ?></span>
            </li>
            <?php endif; ?>
            <!-- =================== -->
            <!-- UI Elements -->
            <!-- =================== -->
            <?php $hasPermission = App\Models\Role::hasPermission('admin.frontend.manage.pages')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo e(route('admin.frontend.manage.pages')); ?>" aria-expanded="false">
                  <span>
                    <i class="ti ti-file"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Manage Pages'); ?></span>
                </a>
              </li>
            <?php endif ?>
             

            <!-- ============================= -->
            <!-- System -->
            <!-- ============================= -->
            <?php if(can(['admin.maintenance.mode','admin.setting.cookie','admin.system','admin.setting.custom.css','admin.request.report'])): ?>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Extra</span>
            </li>
            <?php endif; ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.maintenance.mode')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.maintenance.mode')); ?>" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Maintenance Mode'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.cookie')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.setting.cookie')); ?>" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-cookie"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('GDPR Cookie'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission(['admin.system*'])  ? 1 : 0;
            if($hasPermission == 1): ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.system.info')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.system.info')); ?>" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-apps"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Application'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.system.server.info')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo e(route('admin.system.server.info')); ?>" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-server"></i>
                </span>
                <span class="hide-menu"><?php echo app('translator')->get('Server'); ?></span>
              </a>
            </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.system.optimize')  ? 1 : 0;
            if($hasPermission == 1): ?>
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo e(route('admin.system.optimize')); ?>" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-separator-horizontal"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Clear Cache'); ?></span>
                </a>
              </li>
            <?php endif ?>
            <?php $hasPermission = App\Models\Role::hasPermission('admin.setting.custom.css')  ? 1 : 0;
            if($hasPermission == 1): ?>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo e(route('admin.setting.custom.css')); ?>" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-template"></i>
                  </span>
                  <span class="hide-menu"><?php echo app('translator')->get('Custom CSS'); ?></span>
                </a>
              </li>
              <?php endif ?>
              <?php endif ?>
          </ul>
          <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85"><?php echo e(__(systemDetails()['name'])); ?></h6>
                <button class="btn btn-primary fs-2 fw-semibold lh-sm"><?php echo app('translator')->get('V'); ?><?php echo e(systemDetails()['version']); ?></button>
              </div>
              <div class="unlimited-access-img">
                <img src="<?php echo e(asset('assets/assets/dist/images/backgrounds/rocket.png')); ?>" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </nav>
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
          <div class="hstack gap-3">
            <div class="john-img">
              <img src="<?php echo e(getImage('assets/images/admin/profile/' .auth()->guard('admin')->user()->image)); ?>" class="rounded-circle" width="40" height="40" alt="">
            </div>
            <div class="john-title">
              <h6 class="mb-0 fs-4 fw-semibold"><?php echo e(auth()->guard('admin')->user()->username); ?></h6>
              <span class="fs-2 text-dark"><?php echo app('translator')->get('Admin'); ?></span>
            </div>
            <a href="<?php echo e(route('admin.logout')); ?>" class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
              <i class="ti ti-power fs-6"></i>
            </a>
          </div>
        </div>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->

<?php $__env->startPush('script'); ?>
    
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/billspaypointmobile/mobile-app/resources/mobileapp/admin/partials/sidenav.blade.php ENDPATH**/ ?>