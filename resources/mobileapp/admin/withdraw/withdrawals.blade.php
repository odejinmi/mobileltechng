@extends('admin.layouts.app')

@section('panel')
@push('style')

@endpush
<div class="row justify-content-center">
    @if(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.method') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals.method'))
    <div class="col-lg-4 col-md-6">
        <div class="card border-top border-success">
          <div class="card-body">
            <div class="d-flex no-block align-items-center">
              <div>
                <h2 class="fs-7">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',1)->sum('amount') }}</h2>
                <h6 class="fw-medium text-success mb-0">@lang('Approved Withdrawal')</h6>
              </div>
              <div class="ms-auto">
                <span class="text-success display-6"><i class="ti ti-check"></i></span>
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
                <h2 class="fs-7">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',2)->sum('amount') }}</h2>
                <h6 class="fw-medium text-warning mb-0">@lang('Pending Withdrawal')</h6>
              </div>
              <div class="ms-auto">
                <span class="text-warning display-6"><i class="ti ti-loader"></i></span>
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
                <h2 class="fs-7">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',3)->sum('amount') }}</h2>
                <h6 class="fw-medium text-danger mb-0">@lang('Rejected Withdrawals')</h6>
              </div>
              <div class="ms-auto">
                <span class="text-danger display-6"><i class="ti ti-x"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    @endif
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">

                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Gateway | Trx')</th>
                                <th>@lang('Initiated')</th>
                                <th>@lang('User')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Conversion')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdrawals as $withdraw)
                            @php
                            $details = ($withdraw->withdraw_information != null) ? json_encode($withdraw->withdraw_information) : null;
                            @endphp
                            <tr>
                                <td data-label="@lang('Gateway | Trx')">
                                    <span class="font-weight-bold"><a href="{{ route('admin.withdraw.method',[$withdraw->method->id,'all']) }}"> {{ __(@$withdraw->method->name) }}</a></span>
                                    <br>
                                    <small>{{ $withdraw->trx }}</small>
                                </td>
                                <td data-label="@lang('Initiated')">
                                    {{ showDateTime($withdraw->created_at) }} <br>  {{ diffForHumans($withdraw->created_at) }}
                                </td>

                                <td data-label="@lang('User')">
                                    <span class="font-weight-bold">{{ $withdraw->user->fullname }}</span>
                                    <br>
                                    <span class="small"> <a href="{{ route('admin.users.detail', $withdraw->user_id) }}"><span>@</span>{{ $withdraw->user->username }}</a> </span>
                                </td>


                                <td data-label="@lang('Amount')">
                                   {{ __($general->cur_sym) }}{{ showAmount($withdraw->amount ) }} - <span class="text-danger" data-toggle="tooltip" data-original-title="@lang('charge')">{{ showAmount($withdraw->charge)}} </span>
                                    <br>
                                    <strong data-toggle="tooltip" data-original-title="@lang('Amount after charge')">
                                    {{ showAmount($withdraw->amount-$withdraw->charge) }} {{ __($general->cur_text) }}
                                    </strong>

                                </td>

                                <td data-label="@lang('Conversion')">
                                   1 {{ __($general->cur_text) }} =  {{ showAmount($withdraw->rate) }} {{ __($withdraw->currency) }}
                                    <br>
                                    <strong>{{ showAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }}</strong>
                                </td>



                                <td data-label="@lang('Status')">
                                    @if($withdraw->status == 2)
                                    <span class="text--small badge font-weight-normal bg-warning">@lang('Pending')</span>
                                    @elseif($withdraw->status == 1)
                                    <span class="text--small badge font-weight-normal bg-success">@lang('Approved')</span>
                                    <br>{{ diffForHumans($withdraw->updated_at) }}
                                    @elseif($withdraw->status == 3)
                                    <span class="text--small badge font-weight-normal bg-danger">@lang('Rejected')</span>
                                    <br>{{ diffForHumans($withdraw->updated_at) }}
                                    @endif
                                </td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.withdraw.details', $withdraw->id) }}" class="btn btn-outline-primary ml-1 " data-toggle="tooltip" data-original-title="@lang('Detail')">
                                       @lang('Details')
                                    </a>
                                </td>
                            </tr>
                        @empty
                        <tr>
                          <td class="text-muted text-center" colspan="100%">{!! alert('danger',$emptyMessage) !!}</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table><!-- table end -->
            </div>
        </div>

        <div class="card-footer py-4">
            {{ paginateLinks($withdrawals) }}
        </div>
    </div><!-- card end -->
</div>
</div>

@endsection




@push('breadcrumb-plugins')

    @if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method'))

    <form action="{{ route('admin.withdraw.search', $scope ?? str_replace('admin.withdraw.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white mb-2 ml-0 ml-xl-2 ml-lg-0">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Trx number/Username')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    <form action="{{route('admin.withdraw.dateSearch',$scope ?? str_replace('admin.withdraw.', '', request()->route()->getName()))}}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='bottom right' placeholder="@lang('Min Date - Max date')" autocomplete="off" value="{{ @$dateSearch }}">
            <input type="hidden" name="method" value="{{ @$method->id }}">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    @endif
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/thirdparty/css/vendor/datepicker.min.css') }}">
@endpush


@push('script-lib')
    <script src="{{ asset('assets/thirdparty/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/thirdparty/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            if (!$('.datepicker-here').val()) {
                $('.datepicker-here').datepicker();
            }
        })(jQuery)
    </script>
@endpush
