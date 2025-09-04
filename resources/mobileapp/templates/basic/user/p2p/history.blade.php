@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    <section>
        <div class="custom-container">
            <div class="title">
                <h2></h2>
            </div>

            <div class="row gy-3">
                @forelse(@$p2p as $item)
                    <div class="col-12">
                        <div class="transaction-box">
                            <a href="#" class="d-flex gap-3">
                                <div class="transaction-image">
                                    <div class="categories-box">
                                        <i class="categories-icon" data-feather="repeat"></i>
                                      </div>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-name">
                                        <h5>{{ __($item->beneficiary->username) }}</h5>
                                        <h3 class="error-color">{{$general->cur_sym}}{{ number_format($item->amount, 2) }}</h3>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="light-text">{{ substr($item->trx, 0, 4) }}....</h5>
                                        <h5 class="light-text">{{ showDateTime($item->created_at) }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    {!! emptyData2() !!}
                @endforelse
                <div class="card-footer">
                    @if ($p2p->hasPages())
                    <nav aria-label="Page navigation example mt-2">
                        <ul class="pagination justify-content-center">
                            {{ paginateLinks($p2p) }}
                        </ul>
                    </nav>  
                    @endif
                </div>

            </div>
        </div>
    </section>
    <!-- Transaction section end -->
@endsection
