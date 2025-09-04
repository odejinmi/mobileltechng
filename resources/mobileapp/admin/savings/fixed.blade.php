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

                                    @elseif ($saved->type == 2)
                                        Target Savings
                                    @else
                                        Fixed Savings
                                    @endif
                                </h5>
                                <p class="card-subtitle mb-0">{{ $fdr->plan->name }}</p>
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
                                            Amount Fixed
                                        </p>
                                        <h6 class="fs-5 fw-semibold mb-0">
                                            {{ showAmount($fdr->amount) }} {{ $general->cur_text }}
                                        </h6>
                                    </div>
                                </div>

                                <div>
                                    <div class="d-flex align-items-baseline mb-4">
                                        <span class="round-8 text-bg-primary rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                                Interest Rate
                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0">
                                                {{ getAmount($fdr->interest_rate) }}%</h6>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-secondary rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                               Per Return

                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0">
                                                {{ showAmount($fdr->per_installment) }} {{ $general->cur_text }}
                                            </h6>
                                         
                                        </div>
                                    </div>

                                     <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-info rounded-circle me-6"></span>
                                        <div>
                                    <p class="fs-3 mb-1"> Return Count:</p>
                                            <h6 class="fs-5 fw-semibold mb-0">{{ $fdr->installments->count() }} </h6>
                                        </div>
                                    </div> 

                                    <div class="d-flex align-items-baseline mb-4 pb-1">
                                        <span class="round-8 text-bg-warning rounded-circle me-6"></span>
                                        <div>
                                            <p class="fs-3 mb-1">
                                               Total Profit

                                            </p>
                                            <h6 class="fs-5 fw-semibold mb-0">
                                                {{ getAmount($fdr->profit) }} {{ $general->cur_text }}
                                            </h6>
                                        </div>
                                    </div>

                                     
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12 col-12">
                          <div class="card card-company-table">
                              <div class="card-body p-0">
                                @include($activeTemplate . 'partials.installment_table')
  
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>

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
    