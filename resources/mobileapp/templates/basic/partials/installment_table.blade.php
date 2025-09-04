<section class="section-b-space">
    <div class="custom-container">
        <div class="title">
            <h2>Today</h2>
        </div>

        <div class="row gy-3">
            @forelse($installments as $installment)
                <div class="col-12">
                    <div class="transaction-box">
                        <a href="#transaction-detail" data-bs-toggle="modal" class="d-flex gap-3">
                            <div class="transaction-image">
                                <i class="sidebar-icon" data-feather="credit-card"></i>
                            </div>
                            <div class="transaction-details">
                                <div class="transaction-name">
                                    <h5>{{ showDateTime($installment->installment_date, 'd M, Y') }}</h5>
                                    <h3
                                        class=" @if ($installment->given_at) success-color @else error-color @endif">
                                        {{ $general->cur_sym . showAmount($installment->amount) }}</h3>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="light-text">
                                        @if ($installment->given_at)
                                            {{ showDateTime($installment->given_at, 'd M, Y') }}
                                        @else
                                            <small>@lang('Not yet')</small>
                                        @endif
                                    </h5>
                                    <h5 class="light-text">
                                        @if ($installment->given_at)
                                            {{ $installment->given_at->diffInDays($installment->installment_date) }}
                                            @lang('Day')
                                        @else
                                            ...
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                {!! emptyData2() !!}
            @endforelse
        </div>
    </div>
</section>

<section class="section-b-space">
    <div class="custom-container">
        @if ($installments->hasPages())
            <nav aria-label="Page navigation example mt-2">
                <ul class="pagination justify-content-center">
                    {{ $installments->links() }}
                </ul>
            </nav>
        @endif
    </div>
</section>
