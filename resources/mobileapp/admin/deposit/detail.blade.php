@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30 justify-contenst-center">
        <div class="col-lg-5 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body">
                <h5 class="card-title fw-semibold">@lang('Payment Via') {{ __(@$deposit->gateway->name) }}</h5>
                <h5 class="badge bg-primary">{{ strToUpper($deposit->type) }} </h5>
                
                <p class="card-subtitle">@lang('Please find payment details below')</p>
                <div class="mt-9 py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-primary rounded-circle round d-flex align-items-center justify-content-center">
                    <i class="ti ti-calendar text-primary fs-6"></i>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">@lang('Date')</h6>
                    <span class="fs-3">@lang('Transaction Date')</span>
                  </div>
                  <div class="ms-auto">
                    <span class="fs-2">{{ showDateTime($deposit->created_at) }}</span>
                  </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-danger rounded-circle round d-flex align-items-center justify-content-center">
                    <i class="ti ti-bookmark fs-6 text-danger"></i>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">@lang('TRX ID')</h6>
                    <span class="fs-3">@lang('Transaction Number')</span>
                  </div>
                  <div class="ms-auto">
                    <span class="fs-2">{{ $deposit->trx }}</span>
                  </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-success rounded-circle round d-flex align-items-center justify-content-center">
                    <i class="ti ti-user fs-6 text-success"></i>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">@lang('Username')</h6>
                    <span class="fs-3">@lang('Customer\'s Username')</span>
                  </div>
                  <div class="ms-auto">
                    <span class="fs-2"><a
                        href="{{ route('admin.users.detail', $deposit->user_id) }}">{{ @$deposit->user->username }}</a></span>
                  </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-warning rounded-circle round d-flex align-items-center justify-content-center">
                    <i class="ti ti-building-bank text-warning fs-6"></i>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-0 fw-semibold ">@lang('Gateway')</h6>
                    <span class="fs-3">@lang('Payment Gateway')</span>
                  </div>
                  <div class="ms-auto">
                    <span class="fs-2">{{ __(@$deposit->gateway->name) }}</span>
                  </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-info rounded-circle round d-flex align-items-center justify-content-center">
                    <i class="ti ti-wallet text-info fs-6"></i>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">@lang('Amount')</h6>
                    <span class="fs-3">@lang('Transaction Amount')</span>
                  </div>
                  <div class="ms-auto">
                    <span class="fs-2">{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</span>
                  </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-danger rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-file-percent text-danger fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">@lang('Fee')</h6>
                      <span class="fs-3">@lang('Transaction Fee')</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">{{ showAmount($deposit->charge) }} {{ __($general->cur_text) }}</span>
                    </div>
                  </div>
                  <div class="py-6 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-light-info rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-receipt-tax text-info fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">@lang('After Fee')</h6>
                      <span class="fs-3">@lang('After Fee')</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">{{ showAmount($deposit->amount + $deposit->charge) }}{{ __($general->cur_text) }}</span>
                    </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-primary rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-percentage text-primary fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">@lang('Rate')</h6>
                      <span class="fs-3">@lang('Exchange Rate')</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">1 {{ __($general->cur_text) }}
                        = {{ showAmount($deposit->rate) }} {{ __($deposit->baseCurrency()) }}</span>
                    </div>
                </div>


                

                <div class="py-6 d-flex align-items-center">
                  <div class="flex-shrink-0 bg-light-info rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-building-bank text-info fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">@lang('Payable')</h6>
                      <span class="fs-3">@lang('Amount Paid')</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">{{ showAmount($deposit->final_amo) }}
                                {{ __($deposit->method_currency) }}</span>
                    </div>
                  </div>

                  <div class="pt-6 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-light-info rounded-circle round d-flex align-items-center justify-content-center">
                      <i class="ti ti-alert-square text-info fs-6"></i>
                    </div>
                    <div class="ms-3">
                      <h6 class="mb-0 fw-semibold">@lang('Status')</h6>
                      <span class="fs-3">@lang('Transaction Status')</span>
                    </div>
                    <div class="ms-auto">
                      <span class="fs-2">@php echo $deposit->statusBadge @endphp</span>
                    </div>
                  </div>

                  
              </div>
            </div>
          </div>
        
        
        @if ($details || $deposit->status == Status::PAYMENT_PENDING)
            <div class="col-xl-7 col-md-6 mb-30">
                <div class="card b-radius--10 overflow-hidden box--shadow1">
                    <div class="card-body">
                        <h5 class="card-title mb-50 border-bottom pb-2">@lang('User Payment Information')</h5>
                        @if ($details != null)
                            @foreach (json_decode($details) as $val)
                                @if ($deposit->method_code >= 1000)
                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item m-0">{{ __($val->name) }}: @if ($val->type == 'checkbox')
                                        {{ implode(',', $val->value) }}
                                    @elseif($val->type == 'file')
                                        @if ($val->value)
                                            <a href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"
                                                class="me-3"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                        @else
                                            @lang('No File')
                                        @endif
                                    @else
                                        {{ __($val->value) }}
                                    @endif</li> 
                                  
                                    
                                </ol>
                                @endif
                            @endforeach
                            @if ($deposit->method_code < 1000)
                                @include('admin.deposit.gateway_data', [
                                    'details' => json_decode($details),
                                ])
                            @endif
                        @endif
                        @if ($deposit->status == Status::PAYMENT_PENDING)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button class="btn btn-outline-success btn-sm ms-1 confirmationBtn"
                                        data-action="{{ route('admin.deposit.approve', $deposit->id) }}"
                                        data-question="@lang('Are you sure to approve this transaction?')"><i class="las la-check-double"></i>
                                        @lang('Approve')
                                    </button>

                                    <button class="btn btn-outline-danger btn-sm ms-1 rejectBtn"
                                        data-id="{{ $deposit->id }}" data-info="{{ $details }}"
                                        data-amount="{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}"
                                        data-username="{{ @$deposit->user->username }}"><i class="las la-ban"></i>
                                        @lang('Reject')
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Deposit Confirmation')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.deposit.reject') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to') <span class="fw-bold">@lang('reject')</span> <span
                                class="fw-bold withdraw-amount text--success"></span> @lang('deposit of') <span
                                class="fw-bold withdraw-user"></span>?</p>

                        <div class="form-group">
                            <label class="mt-2">@lang('Reason for Rejection')</label>
                            <textarea name="message" maxlength="255" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary w-100 h-45">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-user').text($(this).data('username'));
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
