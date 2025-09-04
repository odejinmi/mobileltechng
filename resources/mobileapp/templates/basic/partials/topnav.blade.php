
<div class="body-wrapper ">
  <!--  Header Start -->
  
  <header class="app-header"> 
    <nav class="navbar navbar-expand-lg navbar-light mb-2">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="nav-item d-none d-lg-block">
          <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ti ti-search"></i>
          </a>
        </li>
      </ul>
       
      <div class="d-block d-lg-none">
        <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="dark-logo" width="40" alt="" />
        <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="light-logo"  width="40" alt="" />
      </div>
      <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="p-2">
          <i class="ti ti-dots fs-7"></i>
        </span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between">
          <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
            <i class="ti ti-align-justified fs-7"></i>
          </a>
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
            
            	
          <!--begin::Menu toggle-->
          <a href="#" class="btn btn-icon btn-icon-muted btn-active-icon-primar ms-1" data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
            <i class="ti ti-sun theme-light-show fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>    <i class="ti ti-moon theme-dark-show fs-1"><span class="path1"></span><span class="path2"></span></i></a>
          <!--begin::Menu toggle-->

          <!--begin::Menu-->
          <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ti ti-sun fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span></i>            </span>
                    <span class="menu-title">
                      @lang('Light')
                    </span>
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ti ti-moon fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                    <span class="menu-title">
                      @lang('Dark')
                    </span>
                </a>
            </div>
            <!--end::Menu item-->

            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ti ti-palette fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>            </span>
                    <span class="menu-title">
                        @lang('System')
                    </span>
                </a>
            </div>
            <!--end::Menu item-->
          </div>
          <!--end::Menu-->

          

            <li class="nav-item dropdown">
              <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <div class="user-profile-img">
                    <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="rounded-circle" width="35" height="35" alt="" />
                  </div>
                </div>
              </a>
              <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="profile-dropdown position-relative" data-simplebar>
                  <div class="py-3 px-7 pb-0">
                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                  </div>
                  <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                    <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" class="rounded-circle" width="80" height="80" alt="" />
                    <div class="ms-3">
                      <h5 class="mb-1 fs-3">{{ auth()->user()->fullname }}</h5>
                      <span class="mb-1 d-block text-dark">{{ auth()->user()->username }}</span>
                      <p class="mb-0 d-flex text-dark align-items-center gap-2">
                        <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
                      </p>
                    </div>
                  </div>
                  <div class="message-body">
                    <a href="{{ route('user.profile.setting') }}" class="py-8 px-7 mt-8 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                        <img src="{{ asset('assets/assets/dist/images/backgrounds/icon-account.svg')}}" alt="" width="24" height="24">
                      </span>
                      <div class="w-75 d-inline-block v-middle ps-3">
                        <h6 class="mb-1 bg-hover-primary fw-semibold"> @lang('My Profile') </h6>
                        <span class="d-block text-dark">@lang('Account Settings')</span>
                      </div>
                    </a> 
                     
                  <div class="d-grid py-4 px-7 pt-8"> 
                    <a href="{{ route('user.logout') }}" class="btn btn-outline-primary">@lang('Log Out')</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>


  @include('templates.basic.partials.userbreadcrumb')
<!--  Search Bar -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-lg">
  <div class="modal-content rounded-1">
    
  <form class="navbar-search">
    <div class="modal-header border-bottom">
      <input type="search" name="#0" class="form-control gs-3 navbar-search-field" id="searchInput" autocomplete="off">
      <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
        <i class="ti ti-x fs-5 ms-3"></i>
      </span>
    </div>
    <div class="modal-body message-body" data-simplebar="">
      <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5> 
      <ul class="search-list"></ul>
    </div>
  </form>
  </div>
</div>
</div>

