@extends($activeTemplate . 'layouts.dashboard')
@section('panel') 
 <!-- pay money section starts -->
 <form  class="" novalidate="novalidate" action="{{ route('user.withdraw.money') }}" method="post">
    @csrf
<section class="pay-money section-b-space">
    <div class="custom-container">
        <div class="profile-pic">
            <img class="img-fluid img" src="{{ asset('assets/assets/dist/images/backgrounds/bank.png') }}" alt="p3" />
        </div>
        <h3 class="person-name">Balance: {{ number_format(Auth::user()->balance, 2) }}</h3>
        <h5 class="upi-id">APP ID : {{ Auth::user()->username }}</h5>
        <div class="form-group">
            <div class="form-input mt-4">
                <input type="number" class="form-control" placeholder="{{ $general->cur_sym }}0.00" id="amount"
                    name="amount" />
            </div>
        </div>

        <center>
            <ul class="nav nav-pills tab-style3 w-100 mt-3" id="myTab" role="tablist">
                <li class="nav-item w-25" onclick="setamount(200)" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true">{{ $general->cur_sym }}200</button>
                </li>
                <li class="nav-item w-25" onclick="setamount(500)" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">{{ $general->cur_sym }}500</button>
                </li>
                <li class="nav-item w-25" onclick="setamount(1000)" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">{{ $general->cur_sym }}1k</button>
                </li>
                <li class="nav-item w-25" onclick="setamount(2000)" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">{{ $general->cur_sym }}2k</button>
                </li>
            </ul>
        </center>

        @push('script')
            <script>
                function setamount(amount) {
                    document.getElementById("amount").value = amount;
                }
            </script>
        @endpush

        <ul class="card-list">
            @forelse ($withdrawMethod as $data)
                <li class="payment-add-box">
                    <div class="add-img">
                        <img class="img-fluid img"
                            src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $data->image,imagePath()['withdraw']['method']['size'])}}"
                            alt="card1" />
                    </div>
                    <div class="add-content">
                        <div>
                            <h5 class="fw-semibold dark-text">{{ __($data->name) }}</h5>
                            <h6 class="mt-2 light-text">{{ $general->cur_sym }}{{ showAmount($data->min_limit) }} -
                                {{ $general->cur_sym }}{{ showAmount($data->max_limit) }}</h6>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input methodId" value="{{ $data }}"
                                {{ old('methodId') == $data->id ? ' checked' : '' }} type="radio" name="methodId"
                                data-resource="{{ $data }}" id="{{ $data->id }}" />
                        </div>
                    </div>
                </li>

            @empty
                {!! emptyData() !!}
            @endforelse
        </ul>

        <input type="hidden" name="currency" class="edit-currency form-control">
        <input type="hidden" name="method_code" class="edit-method-code  form-control">
        <a type="button" data-bs-toggle="modal" href="#deposit-now" class="btn theme-btn w-100">Withdraw now</a>
    </div>
</section>
<!-- pay money section end -->

<!-- transaction detail modal start -->
<div class="modal successful-modal transfer-details fade" id="deposit-now" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="method">Payment Detail<br>
                </h2>
            </div>
            <div class="modal-body">
                <ul class="details-list">
                    <li>
                        <h3 class="fw-normal dark-text">@lang('Fixed charge')</h3>
                        <h3 class="fw-normal light-text" id="fixed_charge"></h3>
                    </li>
                    <li>
                        <h3 class="fw-normal dark-text">@lang('Percentage charge')</h3>
                        <h3 class="fw-normal light-text" id="percentage_charge"></h3>
                    </li>
                    <li>
                        <h3 class="fw-normal dark-text">@lang('Minimum Amount')</h3>
                        <h3 class="fw-normal light-text" id="min_limit"></h3>
                    </li>
                    <li>
                        <h3 class="fw-normal dark-text">@lang('Maximum Amount')</h3>
                        <h3 class="fw-normal light-text" id="max_limit"></h3>
                    </li>
                    <li class="amount">
                        <h3 class="fw-normal dark-text"></h3>
                        <h3 class="fw-semibold error-color">
                            <button type="submit" href="#" class="btn theme-btn w-100">Proceed</button>
                        </h3>
                    </li>
                </ul>
            </div>
            <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                <i class="icon" data-feather="x"></i>
            </button>
        </div>
    </div>
</div>
<!-- successful transfer modal end -->
</form>
@endsection


@push('breadcrumb-plugins')
<a href="{{ route('user.withdraw.history') }}" class="back-btn">
    <i class="icon" data-feather="printer"></i>
</a>
@endpush
 

@push('script')
<script>
'use strict';
$(document).ready(function () {
    
    $(document).on('input', 'input[name="amount"]', function () {
				let limit = '2';
				let amount = $(this).val();
				let fraction = amount.split('.')[1];
				if (fraction && fraction.length > limit) {
					amount = (Math.floor(amount * Math.pow(10, limit)) / Math.pow(10, limit)).toFixed(limit);
					$(this).val(amount);
				}
	}); 

    $(document).on('change, input', ".methodId", function (e) {
    var amount = document.getElementById("amount").value;
    let methodId = this.value;
    const errorlogs = JSON.stringify(methodId);
    const personObject = JSON.parse(methodId);
    // && amount < personObject.max_limit
    if( personObject.id ) {
    submitButton(true);
    $('.showCharge').removeClass('d-none');
    $('#method').html(personObject.name);
    $('#fixed_charge').html(parseFloat(personObject.fixed_charge) + '{{ __($general->cur_text) }}');
    $('#percentage_charge').html(personObject.percent_charge + '{{ __($general->cur_text) }} ');
    $('#min_limit').html(parseFloat(personObject.min_limit) + '{{ __($general->cur_text) }} ');
    $('#max_limit').html(parseFloat(personObject.max_limit) + '{{ __($general->cur_text) }} ');
    } else {
    $('.showCharge').addClass('d-none');
    }
           
    });        
});
function submitButton(status) {
        if (status) {
            $("#submit").removeAttr("disabled");
            $("#submitnow").removeAttr("disabled");
        } else {
            $("#submit").attr("disabled", true);
            $("#submitnow").attr("disabled", true);
        }
    }
</script>
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.withdraw').on('click', function () {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var withdrawLimit = `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  {{__($general->cur_text)}}`;
                $('.withdrawLimit').text(withdrawLimit);
                var withdrawCharge = `@lang('Charge'): ${fixCharge} {{__($general->cur_text)}} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery);
    </script>

@endpush

@push('style')
<style>
    .list-group-item{
        background: transparent;
    }
</style>
@endpush
