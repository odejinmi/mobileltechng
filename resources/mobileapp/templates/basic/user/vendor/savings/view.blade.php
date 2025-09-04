@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    @php
        if ($saved->total < 1) {
            $saved->total = 1;
        }

        $progress = ($saved->paid / $saved->total) * 100;
    @endphp
    <!-- total saving section starts -->
    <section>
        <div class="custom-container">
            <div class="statistics-banner">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="total-amount">
                        <h3>
                            @if ($saved->type == 1)
                                Recurrent Amount:
                            @elseif ($saved->type == 2)
                                Target Goal:
                            @elseif ($saved->type == 3)
                                Fixed Amount:
                            @endif
                        </h3>
                        <h2>{{ $general->cur_sym }}{{ number_format($saved->amount, 2) }}</h2>
                    </div>
                </div>
                <div class="saving-slider">
                    <input id="range-slider__range" type="range" disabled value="40" />

                    <!-- <span id="range-slider__value">40</span> -->
                </div>

                <div class="left-amount">
                    <h5>Total Saved</h5>
                    <h5 class="text-white fw-semibold">
                        {{ $general->cur_sym }}
                        {{ number_format($sum, 2) }}
                    </h5>
                </div>
            </div>
        </div>
    </section>
    <!-- total saving section end -->


    <!-- monthly statistics section starts -->
    <section>
        <div class="custom-container">
            <div class="statistics-banner">
                <div class="d-flex justify-content-center gap-3">
                    <div class="statistics-image">
                        <i class="icon" data-feather="clock"></i>
                    </div>
                    <div class="statistics-content d-block">
                        @if ($saved->type == 1)
                            <h5>CycleCycle</h5>
                            <h6>
                                @if ($saved->cycle == 1)
                                    Daily ({{ $saved->recurrent }} Days)
                                @elseif($saved->cycle == 7)
                                    Weekly ({{ $saved->recurrent }} Weeks)
                                @elseif($saved->cycle == 30)
                                    Monthly ({{ $saved->recurrent }} Months)
                                @endif
                            </h6>
                        @else
                            <h5> Mature Date</h5>
                            <h6>{!! date(' D d, M Y', strtotime($saved->mature)) !!}
                                {{ date('h:i A', strtotime($saved->mature)) }}</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- monthly statistics section end -->


    <!-- monthly statistics section starts -->
    <section>
        <div class="custom-container">
            <div class="statistics-banner">
                <div class="d-flex justify-content-center gap-3">
                    <div class="statistics-image">
                        <i class="icon" data-feather="bar-chart-2"></i>
                    </div>
                    <div class="statistics-content d-block">
                        <h5>
                            @if ($saved->type == 1)
                                Recurrent:
                            @else
                                Total Payment
                            @endif
                        </h5>
                        <h6>{{ $count }} Times</h6>
                    </div>
                </div>
            </div>
            @if ($saved->type == 2 && $saved->status != 0)
                <button type="button" data-bs-toggle="modal" data-bs-target="#saving"
                    class="btn theme-btn successfully w-100">Fast Save</button>
            @endif
            @if ($saved->status != 0)
                <br>
                <button type="button" data-bs-toggle="modal" data-bs-target="#closesavings"
                    class="btn btn-danger  w-100">Close Savings</button>
            @endif
        </div>
    </section>
    <!-- monthly statistics section end -->

    <!-- person transaction list section starts -->
    <section class="section-b-space">
        <div class="custom-container">
            <div class="title">
                <h2>Savings</h2>
            </div>

            <div class="row gy-3">
                @forelse ($pay as $data)
                    <div class="col-12">
                        <div class="transaction-box">
                            <a href="transaction-history.html#transaction-detail" data-bs-toggle="modal"
                                class="d-flex gap-3">
                                <div class="transaction-image">
                                    <img class="img-fluid"
                                        src="{{ asset($activeTemplateTrue . 'mobile/images/svg/15.svg') }}"
                                        alt="p10" />
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-name">
                                        <h5>{!! date(' D d, M Y', strtotime($saved->created_at)) !!}<small>
                                                {{ date('h:i A', strtotime($saved->created_at)) }}</small></h5>
                                        <h3 class="success-color">
                                            {{ $general->cur_sym }}{{ number_format($data->amount, 2) }}</h3>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="light-text">Savings Balance</h5>
                                        <h5 class="light-text">
                                            {{ $general->cur_sym }}{{ number_format($data->balance, 2) }}</h5>
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

    <!-- successful bill modal start -->
    <div class="modal successful-modal fade" id="saving" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Savings For {{ $saved->val_1 }}</h2>
                </div>
                <div class="modal-body">
                    <div class="saving-img">
                        <img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/15.svg') }}"
                            alt="p10" />
                    </div>
                    <form action="{{ route('user.save.pay', $saved->reference) }}" method="post">
                        @csrf
                        <ul class="details-list border-0">
                            <li>
                                <h3 class="fw-normal dark-text">
                                    @if ($saved->type == 1)
                                        Recurrent Amount:
                                    @elseif ($saved->type == 2)
                                        Target Goal:
                                    @elseif ($saved->type == 3)
                                        Fixed Amount:
                                    @endif
                                </h3>
                                <h3 class="fw-normal theme-color">
                                    {{ $general->cur_sym }}{{ number_format($saved->amount, 2) }}</h3>
                            </li>
                            <li>
                                <h3 class="fw-normal dark-text">Total Saved</h3>
                                <h3 class="fw-normal light-text">
                                    {{ $general->cur_sym }}{{ number_format($sum, 2) }}
                                </h3>
                            </li>
                        </ul>
                        <section class="pay-money section-b-space red box1">

                            <div class="form-group">
                                <div class="form-input mt-4">
                                    <input type="number" value="{{ old('amount') }}" name="amount" placeholder="0.00"
                                        class="form-control" id="amount" />
                                </div>
                            </div>
                        </section>
                        <button type="submit" class="btn theme-btn successfully w-100">Save</button>
                    </form>
                </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <i class="icon" data-feather="x"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- successful bill modal end -->


    <!-- period modal start -->
    <div class="modal successful-modal fade" id="closesavings" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">

                    <h2 class="modal-title">Close Savings Account</h2>

                </div>
                <div class="modal-body">

                    @if (\Carbon\Carbon::now() < $saved->mature)
                        <br>
                        <p class="text-danger">Please note you will lose {{ env('CLOSE_SAVINGS') }}% of your total savings
                            if you close before due date</p>
                    @endif
                    <ul class="details-list border-0">
                        <li>
                            <h3 class="fw-normal dark-text">
                                Total Saved
                            </h3>
                            <h3 class="fw-normal theme-color">{{ $general->cur_sym }}{{ number_format($sum, 2) }}</h3>
                        </li>
                        <li>
                            <h3 class="fw-normal dark-text">Total Charge</h3>
                            <h3 class="fw-normal text-danger">
                                @php
                                    $commission = (@$sum / 100) * @env('CLOSE_SAVINGS');

                                @endphp
                                {{ $general->cur_sym }}
                                {{ number_format($commission, 2) }}
                            </h3>
                        </li>
                        <li>
                            <h3 class="fw-normal dark-text">You Get</h3>
                            <h3 class="fw-normal text-success">
                                {{ $general->cur_sym }}
                                {{ number_format($sum - $commission, 2) }}
                            </h3>
                        </li>
                    </ul>
                    <form action="{{ route('user.save.close', $saved->reference) }}" method="post">
                        @csrf
                        <button type="submit" class="btn theme-btn successfully w-100">Close Savings</button>
                    </form>
                </div>
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    <i class="icon" data-feather="x"></i>
                </button>
            </div>
        </div>
    </div>
    <!--period modal end -->

@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-sm btn-primary" href="{{ route('user.savings.history') }}"> <i class="ti ti-printer"></i>
        @lang('My Savings')</a>
@endpush
@push('script')
    <script>
        // =====================================
        // Profit
        // =====================================
        var chart = {
            series: [{
                name: "Savings this month",
                data: ["{{ number_format($jan, 2) }}", "{{ number_format($feb, 2) }}",
                    "{{ number_format($mar, 2) }}", "{{ number_format($apr, 2) }}",
                    "{{ number_format($may, 2) }}", "{{ number_format($jun, 2) }}",
                    "{{ number_format($jul, 2) }}", "{{ number_format($aug, 2) }}",
                    "{{ number_format($sep, 2) }}", "{{ number_format($oct, 2) }}",
                    "{{ number_format($nov, 2) }}", "{{ number_format($dec, 2) }}"
                ],
            }],
            chart: {
                toolbar: {
                    show: false,
                },
                type: "bar",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
                height: 320,
                stacked: true,
            },
            colors: ["var(--bs-primary)", "var(--bs-secondary)"],
            plotOptions: {
                bar: {
                    horizontal: false,
                    barHeight: "60%",
                    columnWidth: "20%",
                    borderRadius: [6],
                    borderRadiusApplication: "end",
                    borderRadiusWhenStacked: "all",
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
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
                    show: false,
                },
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
            yaxis: {
                tickAmount: 4,
            },
            tooltip: {
                theme: "dark",
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), chart);
        chart.render();
    </script>
@endpush
