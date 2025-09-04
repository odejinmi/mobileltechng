@extends('admin.layouts.app')
@section('panel')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
@endpush
            <!-- File export -->
            <div class="row">
                <div class="col-12"> 

                  <!-- ---------------------
                              start File export
                          ---------------- -->
                  <div class="card">
                    <div class="card-body">
                      <div class="mb-2">
                        <h5 class="mb-0">{{$pageTitle}}</h5>
                      </div>
                      <p class="card-subtitle mb-3">
                        @lang('A table showing all the ') {{$pageTitle}} @lang('on your account. You can export transaction record')
                      </p>
                      <div class="table-responsive">
                        <table
                          id="file_export"
                          class="table border table-striped table-bordered display text-nowrap"
                        >
                          <thead>
                            <!-- start row -->
                            <tr>
                                <th>@lang('TRX')</th>
                                <th>@lang('Details')</th>
                                <th class="text-center">@lang('Initiated')</th>
                                <th class="text-center">@lang('Amount')</th> 
                                <th class="text-center">@lang('Payment')</th> 
                                <th class="text-center">@lang('Status')</th>
                                <th class="text-center">@lang('')</th>
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>
                             
                            @forelse(@$log as $deposit)
                                    <tr>
                                      <td> 
                                            <span class="">{{ __($deposit->trx) }}</span> 
                                      </td>
                                      <td> 
                                            <span class="text-primary">{{ __(@$deposit->account->name) }}<br>
                                              {{ __($deposit->details) }}
                                            </span> 
                                      </td>

                                        <td class="text-center">
                                            {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                        </td> 
                                        <td class="text-center"> 
                                            <strong>{{ showAmount($deposit->amount) }} {{ __(@$deposit->account->currency) }}</strong>  <br>
                                            <small>@lang('Rate'): 1{{ __(@$deposit->account->currency) }} = {{showAmount($deposit->rate)}}{{ __($general->cur_text) }}</small><br>
                                            <small>@lang('Fee'): {{ __(@showAmount($deposit->fee)) }} {{ __(@$deposit->account->currency) }}</small>
                                            
                                        </td>
                                        <td class="text-center"> 
                                            <strong>{{ showAmount($deposit->pay) }} {{ __($general->cur_text) }}</strong>  <br>
                                            <a href="{{url('/')}}/assets/images/proof/{{ __(@$deposit->user->username) }}/{{$deposit->proof}}" class="btn btn-sm btn-outline-primary"><i class="ti ti-download"></i>Download Proof</a>                                      
                                        </td>
                                        <td class="text-center">
                                           <label class='badge @if($deposit->status == 1) bg-success @elseif($deposit->status == 0)  bg-dark text-white @elseif($deposit->status == 2)  bg-warning @else  bg-danger @endif'> @if($deposit->status == 1) Successful @elseif($deposit->status == 2) Pending Approval @elseif($deposit->status == 0) Unpaid @elseif($deposit->status == 3) Canceled @else Declined @endif</label>
                                        </td> 
                                        <td>
                                          @if($deposit->status == 2) 
                                          <a href="{{route('admin.paymentaccount.approve',$deposit->trx)}}" class="btn btn-sm btn-primary">Approve Payment</a>
                                          <a href="{{route('admin.paymentaccount.decline',$deposit->trx)}}" class="btn btn-sm btn-danger">Decline Request</a>
                                          @endif
                                        </td>
                                    </tr>
                                @empty
                                    {!!emptyData2()!!}
                                @endforelse
                            <!-- end row -->
                            <!-- end row -->
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>@lang('TRX')</th>
                              <th>@lang('Details')</th>
                              <th class="text-center">@lang('Initiated')</th>
                              <th class="text-center">@lang('Amount')</th> 
                              <th class="text-center">@lang('Status')</th>
                              <th class="text-center">@lang('')</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      @if ($log->hasPages())
                    <div class="card-footer">
                        {{ $log->links() }}
                    </div>
                    @endif
                    </div>
                  </div>
                  <!-- ---------------------
                              end File export
                          ---------------- -->
  
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Trx" />
@endpush
@push('script')
<script src="{{ asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('assets/assets/dist/js/datatable/datatable-advanced.init.js')}}"></script>
 
@endpush
