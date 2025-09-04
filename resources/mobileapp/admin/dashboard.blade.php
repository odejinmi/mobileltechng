@extends('admin.layouts.app')

@section('panel') 
<div class="container-fluid">
  
    <!--  Row 1 -->


    <div class="row">
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-primary has-link box--shadow2 overflow-hidden">
              <a class="item-link" href="{{ route('admin.users.all') }}"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                         <h2 class="text-primary"> <i class="ti ti-users"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-primary">@lang('Total Users')</span>
                          <h2 class="text-primary">{{ $widget['total_users'] }}</h2>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- dashboard-w1 end -->
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-success has-link box--shadow2">
              <a class="item-link" href="{{ route('admin.users.active') }}"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                          <h2 class="text-success"> <i class="ti ti-user-check"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-success">@lang('Active Users')</span>
                          <h2 class="text-success">{{ $widget['verified_users'] }}</h2>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- dashboard-w1 end -->
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-danger has-link box--shadow2">
              <a class="item-link" href="{{ route('admin.users.email.unverified') }}"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                          <h2 class="text-danger"> <i class="ti ti-users"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-danger">@lang('Email Unverified')</span>
                          <h2 class="text-danger">{{ $widget['email_unverified_users'] }}</h2>
                      </div>
                  </div>
              </div>
          </div>
      </div><!-- dashboard-w1 end -->
      <div class="col-xxl-3 col-sm-6">
          <div class="card bg-light-danger has-link box--shadow2">
              <a class="item-link" href="{{ route('admin.users.mobile.unverified') }}"></a>
              <div class="card-body">
                  <div class="row align-items-center">
                      <div class="col-4">
                          <h2 class="text-danger"> <i class="ti ti-users"></i></h2>
                      </div>
                      <div class="col-8 text-end">
                          <span class="text--small text-danger">@lang('Mobile Unverified')</span>
                          <h2 class="text-danger">{{ $widget['mobile_unverified_users'] }}</h2>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">@lang('Deposit Report')</h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-warning">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['total_deposit_pending']) }}</h2>
                        <h6 class="fw-medium text-warning mb-0">@lang('Pending Deposits')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-warning display-6"><i class="ti ti-wallet"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['total_deposit_amount']) }}</h2>
                        <h6 class="fw-medium text-success mb-0">@lang('Approved Deposits ')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-wallet"></i></span>
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
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['total_deposit_rejected']) }}</h2>
                        <h6 class="fw-medium text-danger mb-0">@lang('Declined Deposit ')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-wallet"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->




    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">@lang('Withdrawal Report')</h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-warning">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['pending_withdrawal']) }}</h2>
                        <h6 class="fw-medium text-warning mb-0">@lang('Pending Withdrawal')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-warning display-6"><i class="ti ti-building-bank"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['approved_withdrawal']) }}</h2>
                        <h6 class="fw-medium text-success mb-0">@lang('Approved Withdrawal ')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-building-bank"></i></span>
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
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['declined_withdrawal']) }}</h2>
                        <h6 class="fw-medium text-danger mb-0">@lang('Declined Withdrawl ')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-building-bank"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->


    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">@lang('Overall Transaction Report')</h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-danger">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['total_debit']) }}</h2>
                        <h6 class="fw-medium text-danger mb-0">@lang('Total Debit')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-wallet-off"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7"> {{$general->cur_sym}}{{ getAmount($widget['total_credit']) }}</h2>
                        <h6 class="fw-medium text-success mb-0">@lang('Total Credit ')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-wallet"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
               
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->




    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">@lang('Bills Payment Overview')</h5>
              </div> 
            </div>
            <div class="row align-items-center">
              
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-primary">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7">{{$general->cur_sym}}{{ getAmount($widget['airtime']) }}</h2>
                        <h6 class="fw-medium text-primary mb-0">@lang('Airtime')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-primary display-6"><i class="ti ti-phone"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6">
                <div class="card border-top border-success">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7">{{$general->cur_sym}}{{ getAmount($widget['internet']) }}</h2>
                        <h6 class="fw-medium text-success mb-0">@lang('Internet')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-success display-6"><i class="ti ti-wifi"></i></span>
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
                        <h2 class="fs-7">{{$general->cur_sym}}{{ getAmount($widget['cabletv']) }}</h2>
                        <h6 class="fw-medium text-warning mb-0">@lang('Cable TV')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-warning display-6"><i class="ti ti-video"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-primary">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7">{{$general->cur_sym}}{{ getAmount($widget['insurance']) }}</h2>
                        <h6 class="fw-medium text-primary mb-0">@lang('Insurance')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-primary display-6"><i class="ti ti-umbrella"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-6">
                <div class="card border-top border-danger">
                  <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                      <div>
                        <h2 class="fs-7">{{$general->cur_sym}}{{ getAmount($widget['electricity']) }}</h2>
                        <h6 class="fw-medium text-danger mb-0">@lang('Electricity')</h6>
                      </div>
                      <div class="ms-auto">
                        <span class="text-danger display-6"><i class="ti ti-power"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
    <!-- End Row -->



    

    <div class="row">
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">@lang('Monthly Transaction Overview')</h5>
                <p class="card-subtitle mb-0"> @lang('Year '. date('Y'))</p>
              </div> 
            </div>
            <div class="row align-items-center">
              <div class="col-lg-8 col-md-8">
                <div id="DepositYear"></div>
              </div> 
              <div class="col-lg-4 col-md-4">
                <div class="d-flex align-items-center mb-4 pb-1">
                  <div class="p-8 bg-light-success rounded-1 me-3 d-flex align-items-center justify-content-center">
                    <i class="ti ti-wallet text-success fs-6"></i>
                  </div>
                  <div>
                    <h4 class="mb-0 fs-7 fw-semibold">{{ $general->cur_sym }}{{ showAmount($total_deposit_amount) }}</h4>
                    <p class="fs-3 mb-0">@lang('Total Deposited')</p>
                  </div>
                </div>

                <div class="d-flex align-items-center mb-4 pb-1">
                    <div class="p-8 bg-light-warning rounded-1 me-3 d-flex align-items-center justify-content-center">
                      <i class="ti ti-wallet text-warning fs-6"></i>
                    </div>
                    <div>
                      <h4 class="mb-0 fs-7 fw-semibold">{{ $total_deposit_pending }}</h4>
                      <p class="fs-3 mb-0">@lang('Pending Deposited')</p>
                    </div>
                  </div>

                  <div class="d-flex align-items-center mb-4 pb-1">
                    <div class="p-8 bg-light-danger rounded-1 me-3 d-flex align-items-center justify-content-center">
                      <i class="ti ti-wallet text-danger fs-6"></i>
                    </div>
                    <div>
                      <h4 class="mb-0 fs-7 fw-semibold">{{ $total_deposit_rejected }}</h4>
                      <p class="fs-3 mb-0">@lang('Rejected Deposited')</p>
                    </div>
                  </div>
                <div> 
                  <div>
                    <a href="{{ route('admin.deposit.list') }}" class="btn btn-outline-primary w-100">View Deposit Report</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">@lang('Transactions Report')</h5>
                <p class="card-subtitle mb-0"> (@lang('Last 30 Days'))</p>
              </div> 
            </div>
            <div class="row align-items-center">
              <div class="col-lg-12 col-md-12">
                <div id="apex-line"></div>
              </div>  
              
            </div>
          </div>
        </div>
      </div>
       
    </div>
    <!--  Row 2 --> 
     <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="row align-items-center">
                    <div class="d-flex justify-content-center">
                        <div id="chart-browser"></div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="row align-items-center">
                    <div class="d-flex justify-content-center">
                        <div id="chart-country"></div>
                    </div>
                </div>
              </div>
            </div>
        </div> 
 
    <!--  Row 3 -->
    <div class="row">
      <!-- Top Performers -->
      <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
              <div class="mb-3 mb-sm-0">
                <h5 class="card-title fw-semibold">@lang('Top 10 Performers')</h5>
                <p class="card-subtitle mb-0">@lang('Best customers by transaction volume')</p>
              </div> 
            </div>
            <div class="table-responsive">
              <table class="table align-middle text-nowrap mb-0">
                <thead>
                  <tr class="text-muted fw-semibold">
                    <th scope="col" class="ps-0">Name</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody class="border-top">
                @forelse($top_earners as $data)
                  <tr>
                    <td class="ps-0">
                      <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                          <img src="{{ getImage(getFilePath('userProfile') . '/' . @$data->user->image, getFileSize('userProfile')) }}" class="rounded-circle" width="40" height="40" alt="" />
                        </div>
                        <div>
                          <h6 class="fw-semibold mb-1">{{@$data->user->fullname}}</h6>
                          <p class="fs-2 mb-0 text-muted">{{@$data->user->username}}</p>
                        </div>
                      </div>
                    </td> 
                    <td>
                      <a class="label fw-semibold py-1 w-85 bg-light-primary text-primary">{{$general->cur_sym}}{{showAMount($data->sums)}}</a>
                    </td> 
                  </tr>
                @empty
                {!!emptyData()!!}
                @endforelse 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="modal fade" id="cronModal" role="dialog" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('Cron Job Setting Instruction')</h5>
                <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <h3 class="text--danger text-center">@lang('Please Set Cron Job Now')</h3>
                <p class="lead">
                    @lang('To automate the api order placement, we need to set the cron job and make sure the cron job is running properly. Set the Cron time as minimum as possible. Once per 5-15 minutes is ideal while once every minute is the best option.') </p>
                <label class="font-weight-bold">@lang('Cron Command')</label>

                <div class="input-group">
                    <input class="form-control" id="referralURL" name="text" type="text" value="curl -s {{ route('cron') }}" readonly>
                    <span class="input-group-text copytext btn btn--primary copyBoard pt-2" id="copyBoard">
                        @lang('Copy')
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('breadcrumb-plugins')
    @php
        $lastCron = Carbon\Carbon::parse($general->last_cron)->diffInSeconds();
    @endphp
    <span
        class="@if ($lastCron < 300) text--info @elseif($lastCron < 900) text--warning @else text--danger @endif">
        @lang('Last Cron Run')
        <strong class="text-primary">{{ diffForHumans($general->last_cron) }}</strong>
    </span>
@endpush
@push('script') 
<script>
  (function($) {
      "use strict";
      @if (Carbon\Carbon::parse($general->last_cron)->diffInMinutes() > 15)
          window.onload = () => {
              $('#cronModal').modal('show');
          }
      @endif

      $('.copyBoard').on('click', function() {
          var copyText = document.getElementById("referralURL");
          copyText.select();
          copyText.setSelectionRange(0, 99999);
          document.execCommand("copy");
          iziToast.success({
              message: "Copied: " + copyText.value,
              position: "topRight"
          });
      });
  });
</script>
 
@push('script')
<script>
     // apex-line trxchart
     var options = {
            chart: {
                //height: 450,
                type: "bar",
                toolbar: {
                    show: false
                },

                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
                height: 320,
                stacked: false,
                dropShadow: {
                    enabled: true,
                    enabledSeries: [0],
                    top: -2,
                    left: 0,
                    blur: 10,
                    opacity: 0.08
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            
            dataLabels: {
                enabled: false
            },
            series: [{
                    name: "Credit",
                    data: [
                        @foreach ($trxReport['date'] as $trxDate)
                            {{ @$plusTrx->where('date', $trxDate)->first()->amount ?? 0 }},
                        @endforeach
                    ]
                },
                {
                    name: "Debit",
                    data: [
                        @foreach ($trxReport['date'] as $trxDate)
                            {{ @$minusTrx->where('date', $trxDate)->first()->amount ?? 0 }},
                        @endforeach
                    ]
                }
            ],
            plotOptions: {
            bar: {
                horizontal: false,
                barHeight: "60%",
                columnWidth: "20%",
                borderRadius: [6],
                borderRadiusApplication: 'end',
                borderRadiusWhenStacked: 'all'
            },
            },
            xaxis: {
                categories: [
                    @foreach ($trxReport['date'] as $trxDate)
                        "{{ $trxDate }}",
                    @endforeach
                ]
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
            
        };

    var chart = new ApexCharts(document.querySelector("#apex-line"), options);

    chart.render();
</script>
<script>
  var chart = {
    series: [
      {
        name: "Deposit {{ __($general->cur_sym) }}",
        data: {!! json_encode($yearDeposit) !!},
      },
      {
        name: "Payout {{ __($general->cur_sym) }}",
        data: {!! json_encode($yearPayout) !!},
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "area",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
      height: 320,
      stacked: true,
    },
    colors: ["var(--bs-success)", "var(--bs-danger)"],
    plotOptions: {
      bar: {
        horizontal: false,
        barHeight: "60%",
        columnWidth: "20%",
        borderRadius: [6],
        borderRadiusApplication: 'end',
        borderRadiusWhenStacked: 'all'
      },
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: true,
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
        show: true,
      },
      categories: {!! json_encode($yearLabels) !!},

    },
    yaxis: {
      tickAmount: 4,
    },
    tooltip: {
      theme: "dark",
    },
  };
  var chart = new ApexCharts(document.querySelector("#DepositYear"), chart);
  chart.render();
</script> 
@endpush
@push('script')
        <script>
    var options_multiple = {
    series: {{ $chart['user_browser_counter']->flatten() }},
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      height: 200,
      type: "donut",
    },
    colors: ["#615dff", "#3dd9eb", "#ffae1f", "#fa896b"],
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            fontSize: "22px",
          },
          value: {
            fontSize: "16px",
            color: "#a1aab2",
          },
          total: {
            show: true,
            label: "Total",
            formatter: function (w) {
              //return 249;
            },
          },
        },
      },
    },
    labels: @json($chart['user_browser_counter']->keys()),
  };

  var chart_radial_multiple = new ApexCharts(
    document.querySelector("#chart-browser"),
    options_multiple
  );
  chart_radial_multiple.render();


  var options_multiple = {
    series: {{ $chart['user_os_counter']->flatten() }},
    chart: {
      fontFamily: '"Nunito Sans", sans-serif',
      height: 200,
      type: "donut",
    },
    colors: ["#615dff", "#3dd9eb", "#ffae1f", "#fa896b"],
    plotOptions: {
      radialBar: {
        dataLabels: {
          name: {
            fontSize: "22px",
          },
          value: {
            fontSize: "16px",
            color: "#a1aab2",
          },
          total: {
            show: true,
            label: "Total",
            formatter: function (w) {
              //return 249;
            },
          },
        },
      },
    },
    labels: @json($chart['user_os_counter']->keys()),
  };

  var chart_radial_multiple = new ApexCharts(
    document.querySelector("#chart-country"),
    options_multiple
  );
  chart_radial_multiple.render();

        </script>
        @endpush