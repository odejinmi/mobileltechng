@extends('admin.layouts.app')
@section('panel')
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    @endpush
    <!-- File export -->
    <div class="row">
        <!-- Weekly Stats -->
        <div class="col-lg-12 d-flex align-items-strech">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title fw-semibold">@lang('Card Status')</h5>
              <p class="card-subtitle mb-0">
                
              </p>
              <div id="stats" class="my-4">
                @if ($reply['data']['status'] == 'active')
                <span class="badge bg-success text-white">{{ strToUpper($reply['data']['status']) }}</span>
                <span class="badge bg-success text-white">{{ strToUpper($reply['data']['pin']) }}</span>
                @else
                <span class="badge bg-warning text-white">{{ strToUpper($reply['data']['status']) }}</span>
                @endif
              </div>
              <hr>
              <div class="position-relative">
                <div
                  class="d-flex align-items-center justify-content-between mb-7"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-primary-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-credit-card text-primary fs-6"></i>
                    </div>
                    <div>
                      <h6 class="mb-1 fs-4 fw-semibold">@lang('Card Pan')</h6>
                      <p class="fs-3 mb-0">{{$reply['data']['pan']}}</p>
                    </div>
                  </div> 
                </div>
                <div
                  class="d-flex align-items-center justify-content-between mb-7"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-success-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-calendar text-success fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fs-4 fw-semibold">@lang('Expiry Month')</h6>
                        <p class="fs-3 mb-0">{{$reply['data']['expiry_month']}}</p>
                    </div>
                  </div> 
                </div>
                <div
                class="d-flex align-items-center justify-content-between mb-7"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-danger-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-calendar text-danger fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fs-4 fw-semibold">@lang('Expiry Year')</h6>
                        <p class="fs-3 mb-0">{{$reply['data']['expiry_year']}}</p>
                    </div>
                  </div> 
                </div>
                <div
                  class="d-flex align-items-center justify-content-between"
                >
                  <div class="d-flex">
                    <div
                      class="p-6 bg-info-subtle rounded me-6 d-flex align-items-center justify-content-center"
                    >
                      <i class="ti ti-calendar text-info fs-6"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fs-4 fw-semibold">@lang('Card CVV')</h6>
                        <p class="fs-3 mb-0">{{$reply['data']['cvv']}}</p>
                    </div>
                  </div> 
                </div>
              </div>
              <hr>
              @if ($reply['data']['status'] != 'active')
              <a href="{{ route('admin.bills.virtualcard.status.activate',$reply['data']['id']) }}" class="btn btn-success btn-sm"><i class="ti ti-check"></i> @lang('Unfreeze')</a>

                @else

              <a href="{{ route('admin.bills.virtualcard.status.block',$reply['data']['id']) }}" class="btn btn-danger btn-sm"><i class="ti ti-alert-circle"></i> @lang('Block ')</a>
                <a href="{{ route('admin.bills.virtualcard.status.deactivate',$reply['data']['id']) }}" class="btn btn-warning btn-sm"><i class="ti ti-alert-circle"></i> @lang('Freeze')</a>
              <a  data-bs-toggle="modal" data-bs-target="#pin-modal" data-bs-whatever="@getbootstrap" href="#" class="btn btn-primary btn-sm"><i class="ti ti-lock"></i> @lang('Pin')</a>
              <a  data-bs-toggle="modal" data-bs-target="#fund-modal" data-bs-whatever="@getbootstrap" href="#" class="btn btn-success btn-sm"><i class="ti ti-wallet"></i> @lang('Fund')</a>
             @endif
            </div>
          </div>
        </div>
        <!-- Top Performers --> 
      </div>
             

      <div class="modal fade" id="pin-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
              <h4 class="modal-title" id="exampleModalLabel1">
                Update Card PIN
              </h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  class="" novalidate="novalidate" action="{{ route('admin.bills.virtualcard.status.password',$reply['data']['id']) }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="control-label">Old Card Pin:</label>
                  <input type="password" name="old_pin" class="form-control" id="old_pin" />
                </div> 
                <div class="mb-3">
                  <label for="recipient-name" class="control-label">New Card Pin:</label>
                  <input type="number" name="new_pin" class="form-control" id="new_pin" />
                </div> 

                <div class="mb-3">
                    <label for="recipient-name" class="control-label">Account Transaction Password:</label>
                    <input type="password" name="password" class="form-control" id="password" />
                  </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-danger-subtle text-danger font-medium"
                data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-success">
                Change Pin
              </button>
            </div>
        </form>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="fund-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
              <h4 class="modal-title" id="exampleModalLabel1">
                Fund Card Balance
              </h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  class="" novalidate="novalidate" action="{{ route('admin.bills.virtualcard.fund.balance',$reply['data']['id']) }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label for="recipient-name" class="control-label">Amount <small>({{$reply['data']['currency']}})</small>:</label>
                  <input type="number" name="amount" class="form-control" placeholder="0.00{{$reply['data']['currency']}}" id="old_pin" />
                </div> 
                 

                <div class="mb-3">
                    <label for="recipient-name" class="control-label">Account Transaction Password:</label>
                    <input type="password" name="password" class="form-control" id="password" />
                  </div> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-danger-subtle text-danger font-medium"
                data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-success">
                Change Pin
              </button>
            </div>
        </form>
          </div>
        </div>
      </div>

        @endsection

        @push('breadcrumb-plugins')
      
        @endpush


        @push('script')

        @endpush
