<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
            <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="30" class="dark-logo"  alt="" />
            <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" width="30" class="light-logo" alt="" />
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
              <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-home"></i>
                </span>
                <span class="hide-menu">@lang('Dashboard')</span>
              </a>
            </li>


            <!-- ============================= -->
            <!-- Payment Account -->
            <!-- ============================= -->
            @can(['admin.paymentaccount*'])
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">@lang('Payment Account')</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.paymentaccount.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-brand-paypal-filled"></i>
                </span>
                <span class="hide-menu">@lang('Manage Accounts')</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.paymentaccount.request',1) }}" aria-expanded="false">
                <span>
                  <i class="ti ti-check"></i>
                </span>
                <span class="hide-menu">@lang('Approved Request')</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.paymentaccount.request',2) }}" aria-expanded="false">
                <span>
                  <i class="ti ti-loader"></i>
                </span>
                <span class="hide-menu">@lang('Pending Request')</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.paymentaccount.request',3) }}" aria-expanded="false">
                <span>
                  <i class="ti ti-trash"></i>
                </span>
                <span class="hide-menu">@lang('Canceled Request')</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.paymentaccount.request',4) }}" aria-expanded="false">
                <span>
                  <i class="ti ti-x"></i>
                </span>
                <span class="hide-menu">@lang('Declined Request')</span>
              </a>
            </li>            
            @endcan

            <!-- ============================= -->
            <!-- Loan -->
            <!-- ============================= -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">@lang('Loan')</span>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.plans.loan.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-box"></i>
                </span>
                <span class="hide-menu">@lang('Loan Plans')</span>
              </a>
            </li>
              
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-heart-handshake"></i>
                </span>
                <span class="hide-menu">@lang('Manage Loans')</span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="{{ route('admin.loan.pending') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Pending Loan')</span>
                    @if ($pendingLoanCount)
                    <div class="hide-menu">
                      <span
                        class="badge rounded-circle bg-danger d-flex align-items-center justify-content-center rounded-pill fs-2"
                        >{{ $pendingLoanCount }}</span
                      >
                    </div> 
                    @endif
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="{{ route('admin.loan.running') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Running Loan')</span>
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="{{ route('admin.loan.due') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Due Loan')</span>
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="{{ route('admin.loan.paid') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Paid Loan')</span>
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="{{ route('admin.loan.rejected') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Rejected Loan')</span> 
                  </a>
                </li> 
                 
                <li class="sidebar-item">
                  <a href="{{ route('admin.loan.index') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('All Loans')</span>
                  </a>
                </li>  
              </ul>
            </li>

             
            <!-- ============================= -->
            <!-- Trade -->
            <!-- ============================= -->
            @can(['admin.crypto.currency','admin.giftcardindex','admin.crypto.assetselltrade*','admin.crypto.assetbuytrade*','admin.sellpenex*','admin.selldecex*','admin.buypenex*','admin.buyproex*','admin.buydecex*'])
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">@lang('Asset Trade')</span>
            </li>
            @endcan
            @can(['admin.crypto.currency'])
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.crypto.currency') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-coin"></i>
                </span>
                <span class="hide-menu">@lang('Crypto Settings')</span>
              </a>
            </li>
            @endcan
            @can(['admin.giftcardindex'])
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.giftcardindex')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-wallet"></i>
                </span>
                <span class="hide-menu">@lang('Giftcard Settings')</span>
              </a>
            </li>
            @endcan
            @can(['admin.crypto.assetselltrade*','admin.crypto.assetbuytrade*'])
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-coin-bitcoin"></i>
                </span>
                <span class="hide-menu">@lang('Crypto Trade')</span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                @can(['admin.crypto.assetselltrade*'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.crypto.assetselltrade','pending') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Pending Sales')</span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="{{ route('admin.crypto.assetselltrade','success') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Approved Sales')</span>
                  </a>
                </li>  
                <li class="sidebar-item">
                  <a href="{{ route('admin.crypto.assetselltrade','declined') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Declined Sales')</span>
                  </a>
                </li> 
                <hr> 
                @endcan
                @can(['admin.crypto.assetbuytrade*'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.crypto.assetbuytrade','pending') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Pending Purchase')</span>
                  </a>
                </li> 

                <li class="sidebar-item">
                  <a href="{{ route('admin.crypto.assetbuytrade','success') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Approved Purchase')</span>
                  </a>
                </li> 
                
                <li class="sidebar-item">
                  <a href="{{ route('admin.crypto.assetbuytrade','declined') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Declined Purchase')</span>
                  </a>
                </li> 
                @endcan   
              </ul>
            </li>
            @endcan
            @can(['admin.sellpenex*','admin.selldecex*','admin.buypenex*','admin.buyproex*','admin.buydecex*'])
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu">@lang('Giftcard Trade')</span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                @can(['admin.sellpenex*'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.sellpenex',0) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Pending Sales')</span>
                  </a>
                </li> 
                @endcan
                @can(['admin.sellproex*'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.sellproex',1) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Approved Sales')</span>
                  </a>
                </li>
                @endcan
                @can(['admin.selldecex*']) 
                
                <li class="sidebar-item">
                  <a href="{{ route('admin.selldecex',2) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Declined Sales')</span>
                  </a>
                </li> 

                @endcan
                @can(['admin.buypenex*'])
                <hr>
                <li class="sidebar-item">
                  <a href="{{ route('admin.buypenex',0) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Pending Purcahse')</span>
                  </a>
                </li> 

                @endcan
                @can(['admin.buyproex*'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.buyproex',1) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Approved Purchase')</span>
                  </a>
                </li> 
                @endcan
                @can(['admin.buydecex*'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.buydecex',2) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Declined Purchase')</span>
                  </a>
                </li>
                @endcan    
              </ul>
            </li>
            @endcan
            
            @if ($general->crypto > 0)
            @can(['admin.crypto.wallet*'])
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.crypto.wallet')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-wallet"></i>
                </span>
                <span class="hide-menu">@lang('Crypto Wallet')</span>
              </a>
            </li>
            @endcan
            @endif
           

             <!-- ============================= -->
            <!-- Apps -->
            <!-- ============================= -->
            @can(['admin.storefront.index','admin.admin.savings.log','admin.plans*','admin.voucher*','admin.bills*'])
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">@lang('Apps')</span>
            </li>
            @endcan
 
            @if ($general->virtualcard > 0)
            @can(['admin.bills.virtualcard'])
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.bills.virtualcard') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-credit-card"></i>
                </span>
                <span class="hide-menu">@lang('Virtual Card')</span>
              </a>
            </li>
            @endcan
            @endif
            @if ($general->savings > 0)
            @can(['admin.admin.savings.log'])
             <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.savings.log') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-pig"></i>
                </span>
                <span class="hide-menu">@lang('Savings')</span>
              </a>
            </li>
            @endcan
            @can(['admin.plans*'])
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.plans.fdr.index') }}">
                <span class="d-flex">
                  <i class="ti ti-cash"></i>
                </span>
                <span class="hide-menu">@lang('Savings Plans')</span> 
              </a> 
            </li>
            @endcan
            @endif

            @if ($general->voucher > 0)
            @can(['admin.voucher*'])
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.voucher.log') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-tag"></i>
                </span>
                <span class="hide-menu">@lang('Voucher')</span>
              </a>
            </li>
            @endcan
            @endif
            @if ($general->airtime2cash > 0)
            @can(['admin.bills.airtime2cash'])
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-cash"></i>
                </span>
                <span class="hide-menu">@lang('Airtime To Cash')</span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.airtime2cashFees') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Fees Settings')</span>
                  </a>
                </li>  
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.airtime2cash') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('All Transactions')</span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.airtime2cash',0) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Pending Transactions')</span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.airtime2cash',1) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Successfull Transactions')</span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.airtime2cash',2) }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Declined Transactions')</span>
                  </a>
                </li> 
                 
              </ul>
            </li> 
            @endcan
            @endif
            @can(['admin.bills.airtime','admin.bills.internet','admin.bills.cabletv','admin.bills.utility','admin.bills.insurance'])
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-cash"></i>
                </span>
                <span class="hide-menu">@lang('Bills Payments')</span> 
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                @can(['admin.bills.airtime'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.airtime') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Airtime')</span>
                  </a>
                </li> 
                @endcan
                @can(['admin.bills.insurance'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.insurance') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Insurance')</span>
                  </a>
                </li> 
                 
                @endcan
                @can(['admin.bills.internet'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.internet') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Internet')</span>
                  </a>
                </li>
                 
                @endcan
                @can(['admin.bills.cabletv'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.cabletv') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Cable TV')</span>
                  </a>
                </li>  
                @endcan
                @can(['admin.bills.utility'])
                <li class="sidebar-item">
                  <a href="{{ route('admin.bills.utility') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Utility')</span>
                  </a>
                </li> 
                @endcan 
              </ul>
            </li>
            @endcan
           
              
            @can(['admin.staff.index', 'admin.roles.index', 'admin.users.kyc.approved','admin.users.kyc.pending','admin.permissions.index','admin.users*'])
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Users</span>
            </li>
            @can(['admin.users.kyc.approved','admin.users.kyc.pending'])
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu">@lang('Manage KYC')</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                @can('admin.users.kyc.pending')
                <li class="sidebar-item">
                  <a href="{{ route('admin.users.kyc.pending') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Pending KYC')</span>
                  </a>
                </li>
                @endcan
                @can('admin.users.kyc.verified')
                <li class="sidebar-item">
                  <a href="{{ route('admin.users.kyc.approved') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Approved KYC')</span>
                  </a>
                </li>
                @endcan
              </ul>
             </li>
            @endcan
          @can('admin.staff.index')
            <li class="sidebar-item">
              <a class="sidebar-link " href="{{ route('admin.staff.index') }}" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-shield"></i>
                </span>
                <span class="hide-menu">@lang('Manage Staff')</span>
              </a> 
            </li>
          @endcan
          @can('admin.roles.index')
            <li class="sidebar-item">
              <a class="sidebar-link " href="{{ route('admin.roles.index') }}" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-key"></i>
                </span>
                <span class="hide-menu">@lang('Roles & Permission')</span>
              </a> 
            </li>
          @endcan 
          @can(['admin.users*'])
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-users"></i>
                  </span>
                  <span class="hide-menu">@lang('Manage Users')</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  @can('admin.users.active')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.active') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Active Users')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.users.vendor')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.vendor') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Vendor Accounts')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.users.banned')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.banned') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Banned Users')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.users.email.unverified')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.email.unverified') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Email Unverified')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.users.mobile.unverified')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.mobile.unverified') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Phone Unverified')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.users.with.balance')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.with.balance') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Users With Balance')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.users.all')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.all') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('All Users')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.users.notification.all')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.users.notification.all') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Send Broadcast')</span>
                    </a>
                  </li>
                  @endcan
                </ul>
            </li>
            @endcan
            @endcan
            @if (can(['admin.gateway*','admin.deposit*',]))
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">@lang('Payment Gateway')</span>
            </li>
            @endif
            @if (can(['admin.gateway*',]))
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-credit-card"></i>
                  </span>
                  <span class="hide-menu">@lang('Manage Gateways')</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  @can('admin.gateway.automatic.index')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.gateway.automatic.index') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Automatic Gateways')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.gateway.manual.index')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.gateway.manual.index') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Manual Gateways')</span>
                    </a>
                  </li>
                  @endcan
                </ul>
            </li>
            @endif
            @can(['admin.deposit*'])
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-wallet"></i>
                  </span>
                  <span class="hide-menu">@lang('Manage Deposits')</span>

                  @if (0 < $pendingDepositsCount)
                  <div class="hide-menu">
                    <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><i class="ti ti-alert-circle"></i></span>
                  </div>
                 @endif

                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="{{ route('admin.deposit.pending') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Pending Deposits')</span>
                      @if ($pendingDepositsCount)
                      <div class="hide-menu">
                        <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0">{{ $pendingDepositsCount }}</span>
                      </div>
                      @endif
                    </a>
                  </li>
                  @can('admin.deposit.pending')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.deposit.approved') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Approved Deposits')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.deposit.successful')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.deposit.successful') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Successful Deposits')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.deposit.rejected')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.deposit.rejected') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Rejected Deposits')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.deposit.initiated')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.deposit.initiated') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Initiated Deposits')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.deposit.list')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.deposit.list') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('All Deposits')</span>
                    </a>
                  </li>
                  @endcan
                </ul>
            </li>
            @endcan
            @can(['admin.withdraw*'])
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">@lang('Payout Gateway')</span>
            </li>
            @can('admin.withdraw.method.index')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.withdraw.method.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-building-bank"></i>
                </span>
                <span class="hide-menu">@lang('Withdrawal Methods')</span>
              </a>
            </li>
            @endcan
            @if (can(['admin.withdraw.pending','admin.withdraw.approved','admin.withdraw.rejected','admin.withdraw.log',]))
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-shopping-cart"></i>
                  </span>
                  <span class="hide-menu">@lang('Manage Payouts')</span>
                  @if(0 < @$pending_withdraw_count)
                  <div class="hide-menu">
                    <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><i class="ti ti-alert-circle"></i></span>
                  </div>
                  @endif
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  @can('admin.withdraw.pending')
                  <li class="sidebar-item">
                    <a href="{{route('admin.withdraw.pending')}}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Pending Payouts')</span>
                      @if(@$pending_withdraw_count)
                      <div class="hide-menu">
                        <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0">{{@$pending_withdraw_count}}</span>
                      </div>
                      @endif
                    </a>
                  </li>
                  @endcan
                  @can('admin.withdraw.approved')
                  <li class="sidebar-item">
                    <a href="{{route('admin.withdraw.approved')}}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Approved Payouts')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.withdraw.rejected')
                  <li class="sidebar-item">
                    <a href="{{route('admin.withdraw.rejected')}}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Rejected Payouts')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.withdraw.log')
                  <li class="sidebar-item">
                    <a href="{{route('admin.withdraw.log')}}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('All Payouts')</span>
                    </a>
                  </li>
                  @endcan
                </ul>
            </li>
            @endcan
            @endcan

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">@lang('POS Terminals')</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.terminal.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-id-badge"></i>
                </span>
                <span class="hide-menu">@lang('Manage Terminals')</span>
              </a>
            </li> 
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.terminal.fee') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-tag"></i>
                </span>
                <span class="hide-menu">@lang('Manage Fees')</span>
              </a>
            </li> 

            @if (can(['admin.ticket*','admin.report*']))

            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Misc</span>
            </li>
            @endcan
            @can(['admin.ticket*'])
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-help"></i>
                  </span>
                  <span class="hide-menu">@lang('Support Tickets')</span>
                  @if (0 < $pendingTicketCount)
                      <div class="hide-menu">
                        <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0"><i class="ti ti-alert-circle"></i></span>
                    </div>
                  @endif
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  @can('admin.ticket.pending')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.ticket.pending') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Pending Tickets')</span>
                    </a>
                  </li>
                  @endif
                  @can('admin.ticket.closed')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.ticket.closed') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Closed Ticket')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.ticket.answered')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.ticket.answered') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Answered Ticket')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.ticket.index')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.ticket.index') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('All Tickets')</span>
                    </a>
                  </li>
                  @endcan
                </ul>
            </li>
            @endcan
            @can(['admin.report*'])
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-printer"></i>
                  </span>
                  <span class="hide-menu">@lang('Report')</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  @can('admin.report.transaction')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.report.transaction') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Transaction Logs')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.report.login.history')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.report.login.history') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Login History')</span>
                    </a>
                  </li>
                  @endcan
                  @can('admin.report.notification.history')
                  <li class="sidebar-item">
                    <a href="{{ route('admin.report.notification.history') }}" class="sidebar-link">
                      <div class="round-16 d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle"></i>
                      </div>
                      <span class="hide-menu">@lang('Notification History')</span>
                    </a> 
                  </li>
                  @endcan
                </ul>
            </li>
            @endcan
            
            @can('admin.subscriber.index')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.subscriber.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-mail"></i>
                </span>
                <span class="hide-menu">@lang('Subscribers')</span>
              </a>
            </li>
            @endcan
             <!-- ============================= -->
            <!-- Settings -->
            <!-- ============================= -->
            @if (can(['admin.setting.index','admin.cron.index','admin.setting.logo.icon','admin.setting.system.configuration','admin.kyc.setting','admin.referral.setting','admin.extensions.index','admin.language.manage','admin.seo','admin.setting.notification']))
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">@lang('Settings')</span>
              </li>
            @endif
            @can('admin.setting.index')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.setting.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">@lang('General Settings')</span>
              </a>
            </li>
            @endcan
            @can('admin.setting.system.configuration')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.setting.system.configuration') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-adjustments-alt"></i>
                </span>
                <span class="hide-menu">@lang('System Configuration')</span>
              </a>
            </li>
            @endcan 
            @can('admin.referral.setting')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.referral.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-sitemap"></i>
                </span>
                <span class="hide-menu">@lang('Referral Settings')</span>
              </a>
            </li>
            @endcan
            @can('admin.setting.logo.icon')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.setting.logo.icon') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-photo-check"></i>
                </span>
                <span class="hide-menu">@lang('Logo & Favicon')</span>
              </a>
            </li>
            @endcan
            @can('admin.extensions.index')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.extensions.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-file"></i>
                </span>
                <span class="hide-menu">@lang('Extensions')</span>
              </a>
            </li>
            @endcan
            @can('admin.language.manage')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.language.manage') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-globe"></i>
                </span>
                <span class="hide-menu">@lang('Language')</span>
              </a>
            </li>
            @endcan
            @can('admin.seo')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.seo') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-circle"></i>
                </span>
                <span class="hide-menu">@lang('SEO Settings')</span>
              </a>
            </li>
            @endcan
            @can(['admin.setting.notification*'])
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript: void(0)" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-mail-cog"></i>
                </span>
                <span class="hide-menu">@lang('Notification Setting')</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                @can('admin.setting.notification.global')
                <li class="sidebar-item">
                  <a href="{{ route('admin.setting.notification.global') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Global Template')</span>
                  </a>
                </li>
                @endcan
                @can('admin.setting.notification.email')
                <li class="sidebar-item">
                  <a href="{{ route('admin.setting.notification.email') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Email Setting')</span>
                  </a>
                </li>
                @endcan
                @can('admin.setting.notification.sms')
                <li class="sidebar-item">
                  <a href="{{ route('admin.setting.notification.sms') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('SMS Setting')</span>
                  </a>
                </li>
                @endcan
                @can('admin.setting.notification.templates')
                <li class="sidebar-item">
                  <a href="{{ route('admin.setting.notification.templates') }}" class="sidebar-link">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="ti ti-circle"></i>
                    </div>
                    <span class="hide-menu">@lang('Notification Templates')</span>
                  </a>
                </li>
                @endcan
              </ul>
            </li>
            @endcan
            <!-- ============================= -->
            <!-- UI -->
            <!-- ============================= -->
            @if (can(['admin.frontend.templates','admin.frontend.manage.pages','admin.frontend.sections']))
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">@lang('Frontend Settings')</span>
            </li>
            @endif
            <!-- =================== -->
            <!-- UI Elements -->
            <!-- =================== -->
            @can('admin.frontend.manage.pages')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.frontend.manage.pages') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-file"></i>
                  </span>
                  <span class="hide-menu">@lang('Manage Pages')</span>
                </a>
              </li>
            @endcan
             

            <!-- ============================= -->
            <!-- System -->
            <!-- ============================= -->
            @if (can(['admin.maintenance.mode','admin.setting.cookie','admin.system','admin.setting.custom.css','admin.request.report']))
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Extra</span>
            </li>
            @endif
            @can('admin.maintenance.mode')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.maintenance.mode') }}" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">@lang('Maintenance Mode')</span>
              </a>
            </li>
            @endcan
            @can('admin.setting.cookie')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.setting.cookie') }}" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-cookie"></i>
                </span>
                <span class="hide-menu">@lang('GDPR Cookie')</span>
              </a>
            </li>
            @endcan
            @can(['admin.system*'])
            @can('admin.system.info')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.system.info') }}" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-apps"></i>
                </span>
                <span class="hide-menu">@lang('Application')</span>
              </a>
            </li>
            @endcan
            @can('admin.system.server.info')
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('admin.system.server.info') }}" aria-expanded="false">
                <span class="d-flex">
                  <i class="ti ti-server"></i>
                </span>
                <span class="hide-menu">@lang('Server')</span>
              </a>
            </li>
            @endcan
            @can('admin.system.optimize')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.system.optimize') }}" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-separator-horizontal"></i>
                  </span>
                  <span class="hide-menu">@lang('Clear Cache')</span>
                </a>
              </li>
            @endcan
            @can('admin.setting.custom.css')
              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.setting.custom.css') }}" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-template"></i>
                  </span>
                  <span class="hide-menu">@lang('Custom CSS')</span>
                </a>
              </li>
              @endcan
              @endcan
          </ul>
          <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">{{ __(systemDetails()['name']) }}</h6>
                <button class="btn btn-primary fs-2 fw-semibold lh-sm">@lang('V'){{ systemDetails()['version'] }}</button>
              </div>
              <div class="unlimited-access-img">
                <img src="{{ asset('assets/assets/dist/images/backgrounds/rocket.png')}}" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </nav>
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
          <div class="hstack gap-3">
            <div class="john-img">
              <img src="{{ getImage('assets/images/admin/profile/' .auth()->guard('admin')->user()->image) }}" class="rounded-circle" width="40" height="40" alt="">
            </div>
            <div class="john-title">
              <h6 class="mb-0 fs-4 fw-semibold">{{ auth()->guard('admin')->user()->username }}</h6>
              <span class="fs-2 text-dark">@lang('Admin')</span>
            </div>
            <a href="{{ route('admin.logout') }}" class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
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

@push('script')
    
@endpush
