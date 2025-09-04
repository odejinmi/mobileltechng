@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

    <section class="section-b-space">
        <div class="custom-container"> 

            <ul class="element-list transfer-list p-0">
                @foreach ($currency as $gate)
                    <li class="w-100">
                        <div class="transaction-box">
                            @if (Route::is('user.sellgift'))
                                <a href="{{ route('user.selectgiftcardsell', $gate->id) }}" class="d-flex gap-3">
                                @else
                                    <a href="{{ route('user.selectgiftcardbuy', $gate->id) }}" class="d-flex gap-3">
                            @endif
                            <div class="transaction-image">
                                <img class="img-fluid icon" src="{{ asset('assets/images/giftcards') }}/{{ $gate->image }}"
                                    alt="p1" />
                            </div>
                            <div class="transaction-details">
                                <div class="transaction-name">
                                    <h5>{{ $gate->name }}</h5>
                                    <button type="button" class="btn theme-btn  p-1 btn-sm">Select</button>

                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="light-text"></h5>
                                    <h5 class="light-text"></h5>
                                </div>
                            </div>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section> 



    @stop

    @push('breadcrumb-plugins')
    <a href="#" onclick="history.back()" class="back-btn" data-bs-toggle="modal">
        <i class="icon" data-feather="x"></i>
      </a>
    @endpush
     