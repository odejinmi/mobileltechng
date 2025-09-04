@extends('admin.layouts.app')
@section('panel')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            @php
                if ($saved->total < 1) {
                    $saved->total = 1;
                }

                $progress = ($saved->paid / $saved->total) * 100;
            @endphp

            <div class="row layout-top-spacing">

                <div class="col-lg-12 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">
                                        @if ($saved->type == 1)
                                            Recurrent Savings
                                        @else
                                            Target Savings
                                        @endif
                                    </h5>
                                    <p class="card-subtitle mb-0">Overview of Savings</p>
                                </div>
                                
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div id="chart"></div>
                                </div>
                                <div class="col-md-4">
                                     

                                    <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-success rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                                Total Saved
                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0">
                                                {{ $general->cur_sym }}
                                                {{ number_format($sum, 2) }}
                                            </h6>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="d-flex align-items-baseline mb-4">
                                            <span class="round-8 text-bg-primary rounded-circle me-6"></span>
                                            <div>
                                                <p class="fs-3 mb-1">
                                                    @if ($saved->type == 1)
                                                        Recurrent Amount:
                                                    @else
                                                        Target Goal:
                                                    @endif
                                                </p>
                                                <h6 class="fs-5 fw-semibold mb-0">
                                                    {{ $general->cur_sym }}{{ number_format($saved->amount, 2) }}</h6>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-baseline mb-4 pb-1">
                                            <span class="round-8 text-bg-secondary rounded-circle me-6"></span>
                                            <div>
                                                <p class="fs-3 mb-1">
                                                    @if ($saved->type == 1)
                                                        Cycle:

                                                </p>
                                                <h6 class="fs-5 fw-semibold mb-0">
                                                    @if ($saved->cycle == 1)
                                                        Daily ({{ $saved->recurrent }} Days)
                                                    @elseif($saved->cycle == 7)
                                                        Weekly ({{ $saved->recurrent }} Weeks)
                                                    @elseif($saved->cycle == 30)
                                                        Monthly ({{ $saved->recurrent }} Months)
                                                    @endif
                                                </h6>
                                            @else
                                                <p class="fs-3 mb-1"> Mature Date:</p>
                                                <h6 class="fs-5 fw-semibold mb-0">{!! date(' D d, M Y', strtotime($saved->mature)) !!} <small>
                                                        {{ date('h:i A', strtotime($saved->mature)) }}</small></h6>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="d-flex align-items-baseline mb-4 pb-1">
                                            <span class="round-8 text-bg-secondary rounded-circle me-6"></span>
                                            <div>
                                                <p class="fs-3 mb-1">
                                                    @if ($saved->type == 1)
                                                        Recurrent:
                                                    @else
                                                        Total Payment
                                                    @endif

                                                </p>
                                                <h6 class="fs-5 fw-semibold mb-0">
                                                    {{ $count }} Times
                                                </h6>
                                            </div>
                                        </div>

                                        <div>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12 col-12">
                              <div class="card card-company-table">
                                  <div class="card-body p-0">
                                      <div class="table-responsive">
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                      <th>Ref No</th>
                                                      <th>Date</th>
                                                      <th>Amount</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  @foreach ($pay as $data)
                                                      <tr>
                                                          <td>
                                                              <div class="d-flex align-items-center">
                                                                  <div>
                                                                      <div class="fw-bolder">
                                                                          {{ $data->trx }}</div>
                                                                      <div
                                                                          class="font-small-2 text-muted">
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </td>
                                                          <td>
                                                              <div class="fw-bolder align-items-center">

                                                                  <span>{!! date(' D d, M Y', strtotime($saved->expire)) !!}<br><small>
                                                                          {{ date('h:i A', strtotime($saved->created_at)) }}</small></span>
                                                              </div>
                                                          </td>
                                                          <td class="text-nowrap">
                                                              <div class="d-flex flex-column">
                                                                  <span
                                                                      class="fw-bolder mb-25">{{ $general->cur_sym }}{{ number_format($data->amount, 2) }}</span>
                                                                  <span
                                                                      class="font-small-2 text-muted">Bal:
                                                                      {{ $general->cur_sym }}{{ number_format($data->balance, 2) }}</span>
                                                              </div>
                                                          </td>
                                                      </tr>
                                                  @endforeach
                                              </tbody>
                                          </table>
                                      </div>
                                      @if (count($pay) < 1)
                                          <div class="demo-spacing-0">
                                              <div class="alert alert-danger" role="alert">
                                                  <div class="alert-body"><strong>Hello
                                                         User has not made any savings.</div>
                                              </div>
                                          </div>
                                      @endif
                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>


 

        @endsection

        @push('breadcrumb-plugins')
            <a class="btn btn-sm btn-primary" href="{{ route('admin.savings.log') }}"> <i class="ti ti-printer"></i>
                @lang('Back To Savings')</a>
        @endpush
        @push('script')
        <script>
          // =====================================
  // Profit
  // =====================================
  var chart = {
    series: [
      {
        name: "Savings this month",
        data: ["{{number_format($jan,2)}}","{{number_format($feb,2)}}","{{number_format($mar,2)}}","{{number_format($apr,2)}}","{{number_format($may,2)}}","{{number_format($jun,2)}}","{{number_format($jul,2)}}","{{number_format($aug,2)}}","{{number_format($sep,2)}}","{{number_format($oct,2)}}","{{number_format($nov,2)}}","{{number_format($dec,2)}}"],
      }
    ],
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
