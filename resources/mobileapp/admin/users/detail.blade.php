@extends('admin.layouts.app')

@section('panel')
<div class="card overflow-hidden">
    <div class="card-body p-0">
      <img src="{{ asset('assets/assets/dist/images/backgrounds/profilebg.jpg')}}" alt="" class="img-fluid">
      <div class="row align-items-center">
        <div class="col-lg-4 order-lg-1 order-2">
           
        </div>
        <div class="col-lg-4 mt-n3 order-lg-2 order-1">
          <div class="mt-n5">
            <div class="d-flex align-items-center justify-content-center mb-2">
               <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle" style="width: 110px; height: 110px;";>
                <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 100px; height: 100px;";>
                  <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}" alt="" class="w-100 h-100">
                </div>
              </div>
            </div>
            <div class="text-center">
              <h5 class="fs-5 mb-0 fw-semibold">{{$user->fullname}}</h5>
              <p class="mb-0 fs-4">{{$user->username}}</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-last">
             
        </div>
      </div>
       
         <div class="row">

                       <!--begin::Notice-->
        <div class="col-lg-12 mb-4 align-items-strech">

          <div class="notice d-flex bg-light-danger rounded border-danger rounded border-primary  border border-dashed min-w-lg-600px flex-shrink-0 p-6">
              <!--begin::Icon-->
              
              <i class=" ti ti-building-bank fs-2tx text-primary me-4">
                  <span class="path1"></span>
                  <span class="path2"></span>
                  <span class="path3"></span>
              </i> <!--end::Icon-->
  
              <!--begin::Wrapper-->
              <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                  <!--begin::Content-->
                  <div class="mb-3 mb-md-0 fw-semibold">
                      <h4 class="text-gray-900 fw-bold">@lang('Dedicated Account Number')</h4>
                      @if($user->nuban_ref != null || $user->nuban_ref != 0)
                      @if($general->nuban_provider == "MONNIFY")
                      @php
                      $nuban = json_decode(Auth::user()->nuban, true);
                      @endphp
                      @foreach($nuban as $data)
                       <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-3">
                          <!--begin::Item-->                  
                          <div class="d-flex align-items-center me-5 me-xl-13">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-30px symbol-circle me-3">                                                   
                                  <span class="symbol-label" style="background: #410a8fc1;">
                                      <i class="ti ti-building-bank fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>                                                        
                              </div>
                              <!--end::Symbol--> 
                              
                              <!--begin::Info-->
                              <div class="m-0">                               
                                  <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Bank Name')</a>
                                  <span class="fw-bold text-dark fs-7 d-block">{{@$data['bankName']}}</span>
                              </div>
                              <!--end::Info-->
                          </div>                    
                          <!--end::Item-->  
  
                          <!--begin::Item-->                    
                          <div class="d-flex align-items-center me-5 me-xl-13">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-30px symbol-circle me-3">                                                   
                                  <span class="symbol-label" style="background: #410a8fc1;">
                                      <i class="ti ti-user fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>                                                        
                              </div>
                              <!--end::Symbol--> 
                              
                              <!--begin::Info-->
                              <div class="m-0">                               
                                  <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Name')</a>
                                  <span class="fw-bold text-dark fs-7 d-block">{{@$data['accountName']}}</span>
                              </div>
                              <!--end::Info-->
                          </div>                    
                          <!--end::Item-->  
                          <!--begin::Item-->                    
                          <div class="d-flex align-items-center me-5 me-xl-13">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-30px symbol-circle me-3">                                                   
                                  <span class="symbol-label" style="background: #410a8fc1;">
                                      <i class="ti ti-wallet fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>                                                        
                              </div>
                              <!--end::Symbol--> 
                              
                              <!--begin::Info-->
                              <div class="m-0">                               
                                  <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Number')</a>
                                  <span class="fw-bold text-dark fs-7 d-block">{{@$data['accountNumber']}}</span>
                              </div>
                              <!--end::Info-->
                          </div>                    
                          <!--end::Item-->  
                      </div>
                      @endforeach
                      
                      @else
                      <div class="d-flex align-items-center flex-wrap d-grid gap-2 ">
                          <!--begin::Item-->                  
                          <div class="d-flex align-items-center me-5 me-xl-13">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-30px symbol-circle me-3">                                                   
                                  <span class="symbol-label" style="background: #410a8fc1;">
                                      <i class="ti ti-building-bank fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>                                                        
                              </div>
                              <!--end::Symbol--> 
                              
                              <!--begin::Info-->
                              <div class="m-0">                               
                                  <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Bank Name')</a>
                                  @php
                                  $bankdetails = json_decode($user->nuban);
                                  @endphp
                                  <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->bank_name}}</span>
                              </div>
                              <!--end::Info-->
                          </div>                    
                          <!--end::Item-->  
  
                          <!--begin::Item-->                    
                          <div class="d-flex align-items-center me-5 me-xl-13">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-30px symbol-circle me-3">                                                   
                                  <span class="symbol-label" style="background: #410a8fc1;">
                                      <i class="ti ti-user fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>                                                        
                              </div>
                              <!--end::Symbol--> 
                              
                              <!--begin::Info-->
                              <div class="m-0">                               
                                  <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Name')</a>
                                  <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->account_name}}</span>
                              </div>
                              <!--end::Info-->
                          </div>                    
                          <!--end::Item-->  
                          <!--begin::Item-->                    
                          <div class="d-flex align-items-center me-5 me-xl-13">
                              <!--begin::Symbol-->
                              <div class="symbol symbol-30px symbol-circle me-3">                                                   
                                  <span class="symbol-label" style="background: #410a8fc1;">
                                      <i class="ti ti-wallet fs-4 text-white"><span class="path1"></span><span class="path2"></span></i>                                    </span>                                                        
                              </div>
                              <!--end::Symbol--> 
                              
                              <!--begin::Info-->
                              <div class="m-0">                               
                                  <a href="#" class="text-dark text-opacity-75 fs-8">@lang('Account Number')</a>
                                  <span class="fw-bold text-dark fs-7 d-block">{{@$bankdetails->account_number}}</span>
                              </div>
                              <!--end::Info-->
                          </div>                    
                          <!--end::Item-->  
                      </div>
                      @endif
                      @else
                      <div class="d-flex align-items-center flex-wrap d-grid gap-2 ">
                        <!--begin::Item-->                  
                        <div class="d-flex align-items-center me-5 me-xl-13">
                      @lang('This user does not have a dedicated account number yet')
                        </div>
                      </div>
                      @endif
    
                  </div>
                  <!--end::Content-->
  
                  <!--begin::Action-->
                  <a href="{{ route('admin.users.generate.nuban',$user->id) }}" class="btn btn-primary px-6 align-self-center text-nowrap">
                      @lang('Generate') </a>
                  <!--end::Action-->
              </div>
              <!--end::Wrapper-->
          </div>
        </div>


          <div class="card col-md-6">
              <div class="card-body bg-light-primary">
                <div class="d-flex flex-row">
                  <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-primary">
                    <i class="ti ti-wallet fs-6"></i>
                  </div>
                  <div class="ms-3 align-self-center">
                    <h4 class="mb-0 fs-5">@lang('Main Balance')</h4>
                    <span class="text-muted">@lang('Main Wallet')</span>
                  </div>
                  <div class="ms-auto align-self-center">
                    <h2 class="fs-7 mb-0">{{ $general->cur_sym }}{{ showAmount($user->balance) }}</h2>
                  </div>
                </div>
              </div>
          </div>
          <div class="card col-md-6">
              <div class="card-body bg-light-primary">
                <div class="d-flex flex-row">
                  <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-primary">
                    <i class="ti ti-wallet fs-6"></i>
                  </div>
                  <div class="ms-3 align-self-center">
                    <h4 class="mb-0 fs-5">@lang('Ref Balance')</h4>
                    <span class="text-muted">@lang('Alternative Wallet')</span>
                  </div>
                  <div class="ms-auto align-self-center">
                    <h2 class="fs-7 mb-0">{{ $general->cur_sym }}{{ showAmount($user->ref_balance) }}</h2>
                  </div>
                </div>
              </div>
          </div>


          <div class="card col-md-4">
            <div class="card-body bg-light-success">
              <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                  <i class="ti ti-credit-card fs-6"></i>
                </div>
                <div class="ms-3 align-self-center">
                  <h4 class="mb-0 fs-5">@lang('Total Credit')</h4>
                  <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                  <h2 class="fs-7 mb-0">{{ $general->cur_sym }}{{ showAmount($totalDeposit) }}</h2>
                </div>
              </div>
            </div>
        </div>

        <div class="card col-md-4">
            <div class="card-body bg-light-danger">
              <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-danger">
                  <i class="ti ti-shopping-cart fs-6"></i>
                </div>
                <div class="ms-3 align-self-center">
                  <h4 class="mb-0 fs-5">@lang('Total Debit')</h4>
                  <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                  <h2 class="fs-7 mb-0">{{ $general->cur_sym }}{{ showAmount($totalSpent) }}</h2>
                </div>
              </div>
            </div>
        </div>
        <div class="card col-md-4">
            <div class="card-body bg-light-primary">
              <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-primary">
                  <i class="ti ti-credit-card fs-6"></i>
                </div>
                <div class="ms-3 align-self-center">
                  <h4 class="mb-0 fs-5">@lang('Transactions')</h4>
                  <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                  <h2 class="fs-7 mb-0">{{ ($totalTransaction) }}</h2>
                </div>
              </div>
            </div>
        </div>

        <div class="card col-md-6">
          <div class="card-body bg-light-success">
              <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                  <i class="ti ti-device-mobile fs-6"></i>
                </div>
                <div class="ms-3 align-self-center">
                  <h4 class="mb-0 fs-5">@lang('Airtime')</h4>
                  <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                  <h2 class="fs-7 mb-0">{{$general->cur_sym}}{{ getAmount($widget['airtime']) }}</h2>
                  <a href="{{ route('admin.bills.airtime', $user->id) }}"
                    class="btn btn-outline-secondary btn--shadow w-100 btn-sm">
                    <i class="ti ti-printer"></i>@lang('View')
                  </a>
                </div>
              </div>
            </div>
        </div>
        <div class="card col-md-6">
          <div class="card-body bg-light-success">
              <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-primary">
                  <i class="ti ti-umbrella fs-6"></i>
                </div>
                <div class="ms-3 align-self-center">
                  <h4 class="mb-0 fs-5">@lang('Insurance')</h4>
                  <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                  <h2 class="fs-7 mb-0">{{$general->cur_sym}}{{ getAmount($widget['insurance']) }}</h2>
                  <a href="{{ route('admin.bills.insurance', $user->id) }}"
                    class="btn btn-outline-secondary btn--shadow w-100 btn-sm">
                    <i class="ti ti-printer"></i>@lang('View')
                  </a>
                </div>
              </div>
            </div>
        </div>
        <div class="card col-md-6">
          <div class="card-body bg-light-success">
              <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-warning">
                  <i class="ti ti-wifi fs-6"></i>
                </div>
                <div class="ms-3 align-self-center">
                  <h4 class="mb-0 fs-5">@lang('Internet')</h4>
                  <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                  <h2 class="fs-7 mb-0">{{$general->cur_sym}}{{ getAmount($widget['internet']) }}</h2>
                  <a href="{{ route('admin.bills.internet', $user->id) }}"
                    class="btn btn-outline-secondary btn--shadow w-100 btn-sm">
                    <i class="ti ti-printer"></i>@lang('View')
                  </a>
                </div>
              </div>
            </div>
        </div>
        <div class="card col-md-6">
          <div class="card-body bg-light-success">
              <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-danger">
                  <i class="ti ti-video fs-6"></i>
                </div>
                <div class="ms-3 align-self-center">
                  <h4 class="mb-0 fs-5">@lang('Cabletv')</h4>
                  <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                  <h2 class="fs-7 mb-0">{{$general->cur_sym}}{{ getAmount($widget['cabletv']) }}</h2>
                  <a href="{{ route('admin.bills.cabletv', $user->id) }}"
                    class="btn btn-outline-secondary btn--shadow w-100 btn-sm">
                    <i class="ti ti-printer"></i>@lang('View')
                  </a>
                </div>
              </div>
            </div>
        </div>

        <div class="card col-md-6">
          <div class="card-body bg-light-success">
            <div class="d-flex flex-row">
              <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center bg-success">
                <i class="ti ti-bolt fs-6"></i>
              </div>
              <div class="ms-3 align-self-center">
                <h4 class="mb-0 fs-5">@lang('Utility')</h4>
                <span class="text-muted"></span>
              </div>
              <div class="ms-auto align-self-center">
                <h2 class="fs-7 mb-0">{{$general->cur_sym}}{{ getAmount($widget['utility']) }}</h2>
                <a href="{{ route('admin.bills.utility', $user->id) }}"
                  class="btn btn-outline-secondary btn--shadow w-100 btn-sm">
                  <i class="ti ti-printer"></i>@lang('View')
                </a>
              </div>
            </div>
          </div>
        </div>
 

      </div>


      <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab" role="tablist">
        <li class="nav-item mb-2 mt-2 mr-2" role="presentation">
            <button data-bs-toggle="modal" data-bs-target="#addSubModal"
            class="btn btn-outline-success btn--shadow w-100 btn-sm bal-btn" data-act="add">
            <i class="las la-plus-circle"></i> @lang('Credit Balance')
        </button>
        </li>
        &nbsp;
        <li class="nav-item mb-2 mt-2 mr-2"  role="presentation">
        <button data-bs-toggle="modal" data-bs-target="#addSubModal"
            class="btn btn-outline-danger btn--shadow w-100 btn-sm bal-btn" data-act="sub">
            <i class="las la-minus-circle"></i> @lang('Debit Balance')
        </button>
        </li>
        &nbsp;
        <li class="nav-item mb-2 mt-2 mr-2" role="presentation">
            <a href="{{ route('admin.report.login.history') }}?search={{ $user->username }}"
                class="btn btn-outline-primary btn--shadow w-100 btn-sm">
                <i class="las la-list-alt"></i>@lang('Logins')
            </a>
        </li>
        &nbsp;
        <li class="nav-item mb-2 mt-2 mr-2" role="presentation">
            <a href="{{ route('admin.users.notification.log', $user->id) }}"
                class="btn btn-outline-secondary btn--shadow w-100 btn-sm">
                <i class="las la-bell"></i>@lang('Notifications')
            </a>
        </li>
        &nbsp;
        <li class="nav-item mb-2 mt-2 mr-2" role="presentation">
        @if ($user->status == Status::USER_ACTIVE)
                        <button type="button" class="btn btn-outline-warning btn--gradi btn--shadow w-100 btn-sm userStatus"
                            data-bs-toggle="modal" data-bs-target="#userStatusModal">
                            <i class="las la-ban"></i>@lang('Ban User')
                        </button>
        @else
                        <button type="button" class="btn btn-outline-success btn--gradi btn--shadow w-100 btn-sm userStatus"
                            data-bs-toggle="modal" data-bs-target="#userStatusModal">
                            <i class="las la-undo"></i>@lang('Unban User')
                        </button>
        @endif
        </li>
        <li class="nav-item mb-2 mt-2 mr-2" role="presentation">
            <a href="{{ route('admin.users.login', $user->id) }}" target="_blank"
                class="btn btn-outline-primary btn--gradi btn--shadow w-100 btn-sm">
                <i class="las la-sign-in-alt"></i>@lang('Login as User')
            </a>
        </li>
      </ul>
    </div>
  </div>


  <div class="col-lg-12 col-md-12">
    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
      <div class="mb-3 mb-sm-0">
        <h5 class="card-title fw-semibold">@lang('Monthly Transaction Overview')</h5>
        <p class="card-subtitle mb-0"> @lang('Year '. date('Y'))</p>
      </div> 
    </div>
    
    <div id="DepositYear"></div>
  </div> 
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-4">
          <div class="card shadow-none border">
            <div class="card-body">
              <h4 class="fw-semibold mb-3">@lang('Bio')</h4>
              <ul class="list-unstyled mb-0">
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-briefcase text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{$user->fullname}}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-mail text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{$user->email}}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                  <i class="ti ti-device-desktop text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{$user->mobile}}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-4">
                    <i class="ti ti-map-pin text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{@$user->address->country}}</h6>
                </li>
                <li class="d-flex align-items-center gap-3 mb-2">
                  <i class="ti ti-calendar text-dark fs-6"></i>
                  <h6 class="fs-4 fw-semibold mb-0">{{@$user->created_at}}</h6>
                </li>
              </ul>
            </div>
          </div> 
        </div>
        <div class="col-lg-8">
          <div class="card shadow-none border">
            <div class="card-body">
               
              <div class="d-flex align-items-center gap-2">
                <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group ">
                                <label>@lang('First Name')</label>
                                <input class="form-control" type="text" name="firstname" required
                                    value="{{ $user->firstname }}">
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label class="form-control-label">@lang('Last Name')</label>
                                <input class="form-control" type="text" name="lastname" required
                                    value="{{ $user->lastname }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>@lang('Email') </label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>@lang('Mobile Number') </label>
                                <div class="input-group ">
                                    <span class="input-group-text mobile-code"></span>
                                    <input type="number" name="mobile" value="{{ old('mobile') }}" id="mobile"
                                        class="form-control checkUser" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($user->vendor > 0)
                    <div class="row mt-4"> 
                      <div class="col-md-12 mb-2">
                          <div class="form-group mb-3">
                              <label>@lang('Teminal PIN')</label>
                              <input class="form-control" type="number" name="terminal_pin">
                          </div>
                          <div class="alert alert-danger">
                            Please leave blank if you are not updating terminal PIN
                          </div>
                      </div>
                    </div>
                    @endif


                    <div class="row mt-4">
                        <div class="col-md-12 mb-2">
                            <div class="form-group ">
                                <label>@lang('Address')</label>
                                <input class="form-control" type="text" name="address"
                                    value="{{ @$user->address->address }}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-2">
                            <div class="form-group">
                                <label>@lang('City')</label>
                                <input class="form-control" type="text" name="city"
                                    value="{{ @$user->address->city }}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-2">
                            <div class="form-group ">
                                <label>@lang('State')</label>
                                <input class="form-control" type="text" name="state"
                                    value="{{ @$user->address->state }}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-2">
                            <div class="form-group ">
                                <label>@lang('Zip/Postal')</label>
                                <input class="form-control" type="text" name="zip"
                                    value="{{ @$user->address->zip }}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-2">
                            <div class="form-group ">
                                <label>@lang('Country')</label>
                                <select name="country" class="form-control">
                                    @foreach ($countries as $key => $country)
                                        <option data-mobile_code="{{ $country->dial_code }}"
                                            value="{{ $key }}">{{ __($country->country) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row mt-4">
                        <div class="form-group  col-xl-6 col-md-6 col-12 mb-2">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')"
                                name="ev" @if ($user->ev) checked @endif
                            />
                            <label
                              class="form-check-label"
                              for="flexSwitchCheckDefault"
                              >@lang('Email Verification')</label
                            >
                        </div>
                        </div>
                         
                        <div class="form-group  col-xl-6 col-md-6 col-12 mb-2">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')"
                                    name="sv" @if ($user->sv) checked @endif
                                />
                                <label
                                  class="form-check-label"
                                  for="flexSwitchCheckDefault"
                                  >@lang('SMS Verification')</label
                                >
                            </div>
                        </div>
                        <div class="form-group  col-xl-6 col-md-6 col-12 mb-2">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')"
                                    name="ts" @if ($user->ts) checked @endif
                                />
                                <label
                                  class="form-check-label"
                                  for="flexSwitchCheckDefault"
                                  >@lang('2FA Verification')</label
                                >
                            </div>
                        </div>

                          
                        <div class="form-group  col-xl-6 col-md-6 col-12 mb-2">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                    data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')"
                                    name="vendor" @if ($user->vendor) checked @endif
                                />
                                <label
                                  class="form-check-label"
                                  for="flexSwitchCheckDefault"
                                  >@lang('Vendor Status')</label
                                >
                            </div>
                        </div> 


                        <div class="form-group  col-xl-6 col-md-6 col-12 mb-2">
                          <div class="form-check form-switch">
                              <input type="checkbox" class="form-check-input" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                  data-bs-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')"
                                  name="api_access" @if ($user->api_access) checked @endif
                              />
                              <label
                                class="form-check-label"
                                for="flexSwitchCheckDefault"
                                >@lang('API Merchant Access')</label
                              >
                          </div>
                      </div> 

                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary h-45">@lang('Submit')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
           
            
        </div>
      </div>
    </div>
       
  </div>

    


    {{-- Add Sub Balance MODAL --}}
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span>@lang('Balance')</span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.add.sub.balance', $user->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="act">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>@lang('Amount')</label>
                            <div class="input-group">
                                <input type="number" step="any" name="amount" class="form-control"
                                    placeholder="@lang('Please provide positive amount')" required>
                                <div class="input-group-text">{{ __($general->cur_text) }}</div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label>@lang('Remark')</label>
                            <textarea class="form-control" placeholder="@lang('Remark')" name="remark" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="userStatusModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if ($user->status == Status::USER_ACTIVE)
                            <span>@lang('Ban User')</span>
                        @else
                            <span>@lang('Unban User')</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.status', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        @if ($user->status == 1)
                            <h6 class="mb-2">@lang('If you ban this user he/she won\'t able to access his/her dashboard.')</h6>
                            <div class="form-group mb-2">
                                <label>@lang('Reason')</label>
                                <textarea class="form-control" name="reason" rows="4" required></textarea>
                            </div>
                        @else
                            <p><span>@lang('Ban reason was'):</span></p>
                            <p>{{ $user->ban_reason }}</p>
                            <h4 class="text-center mt-3">@lang('Are you sure to unban this user?')</h4>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if ($user->status == Status::USER_ACTIVE)
                            <button type="submit" class="btn btn-outline-primary h-45 w-100">@lang('Submit')</button>
                        @else
                            <button type="button" class="btn btn--dark"
                                data-bs-dismiss="modal">@lang('No')</button>
                            <button type="submit" class="btn btn-outline-primary">@lang('Yes')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            "use strict"
            $('.bal-btn').click(function() {
                var act = $(this).data('act');
                $('#addSubModal').find('input[name=act]').val(act);
                if (act == 'add') {
                    $('.type').text('Add');
                } else {
                    $('.type').text('Subtract');
                }
            });
            let mobileElement = $('.mobile-code');
            $('select[name=country]').change(function() {
                mobileElement.text(`+${$('select[name=country] :selected').data('mobile_code')}`);
            });

            $('select[name=country]').val('{{ @$user->country_code }}');
            let dialCode = $('select[name=country] :selected').data('mobile_code');
            let mobileNumber = `{{ $user->mobile }}`;
            mobileNumber = mobileNumber.replace(dialCode, '');
            $('input[name=mobile]').val(mobileNumber);
            mobileElement.text(`+${dialCode}`);

        })(jQuery);
    </script>
@endpush


@push('script') 
<script>
  var chart = {
    series: [
      {
        name: "Deposit {{ __($general->cur_sym) }}",
        data: {!! json_encode($yearDeposit) !!},
      },
      {
        name: "Payout {{ __($general->cur_sym) }}",
        data: {!! json_encode($yearPayout) !!},
      },
    ],
    chart: {
      toolbar: {
        show: true,
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
          show: true,
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
      categories: {!! json_encode($yearLabels) !!},

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
@endpush