@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        @if (request()->routeIs('admin.deposit.list') ||
            request()->routeIs('admin.deposit.method') ||
            request()->routeIs('admin.users.deposits') ||
            request()->routeIs('admin.users.deposits.method'))
             <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7">{{ __($general->cur_sym) }}{{ showAmount($successful) }}</h2>
                        <h6 class="fw-medium text-success mb-0">@lang('Successful Deposits')</h6>
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
                        <h2 class="fs-7">{{ __($general->cur_sym) }}{{ showAmount($pending) }}</h2>
                        <h6 class="fw-medium text-warning mb-0">@lang('Pending Deposits')</h6>
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
                        <h2 class="fs-7">{{ __($general->cur_sym) }}{{ showAmount($rejected) }}</h2>
                        <h6 class="fw-medium text-danger mb-0">@lang('Rejected Deposits')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-x"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-12">
                <div class="card border-top border-secondary">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7">{{ __($general->cur_sym) }}{{ showAmount($initiated) }}</h2>
                        <h6 class="fw-medium text-secondary mb-0">@lang('Initiated Deposits')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-secondary display-6"><i class="ti ti-alert-triangle"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                 
        @endif

        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Gateway | Transaction')</th>
                                    <th>@lang('Initiated')</th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Conversion')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $deposit)
                                    @php
                                        $details = $deposit->detail ? json_encode($deposit->detail) : null;
                                    @endphp
                                    <tr>
                                        <td>
                                            <span class="fw-bold"> <a
                                                    href="{{ appendQuery('method', @$deposit->gateway->alias) }}">{{ __(@$deposit->gateway->name) }}</a>
                                            </span>
                                            <br>
                                            <small> {{ $deposit->trx }} </small> 
                                        </td>

                                        <td>
                                            {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ __($deposit->user->fullname) }}</span>
                                            <br>
                                            <span class="small">
                                                <a
                                                    href="{{ appendQuery('search', @$deposit->user->username) }}"><span>@</span>{{ __($deposit->user->username) }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            {{ __($general->cur_sym) }}{{ showAmount($deposit->amount) }} + <span
                                                class="text--danger"
                                                title="@lang('charge')">{{ showAmount($deposit->charge) }} </span>
                                            <br>
                                            <strong title="@lang('Amount with charge')">
                                                {{ showAmount($deposit->amount + $deposit->charge) }}
                                                {{ __($general->cur_text) }}
                                            </strong>
                                        </td>
                                        <td>
                                            1 {{ __($general->cur_text) }} = {{ showAmount($deposit->rate) }}
                                            {{ __($deposit->method_currency) }}
                                            <br>
                                            <strong>{{ showAmount($deposit->final_amo) }}
                                                {{ __($deposit->method_currency) }}</strong>
                                        </td>
                                        <td>
                                            @php echo $deposit->statusBadge @endphp
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.deposit.details', $deposit->id) }}"
                                                class="btn btn-sm btn-outline-primary ms-1">
                                                <i class="ti ti-desktop"></i> @lang('Details')
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($deposits->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($deposits) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    @if (!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method'))
        <x-search-form dateSearch='yes' />
    @endif
@endpush
