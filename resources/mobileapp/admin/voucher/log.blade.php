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
                        @can(['admin.voucher.create'])
                        <a class="btn btn-md btn-success" href="{{ route('admin.voucher.create') }}"> <i class="ti ti-plus"></i> @lang('Clicke Here To Generate Voucher')</a>
                        <hr>
                        @endcan
                        <table
                          id="file_export"
                          class="table border table-striped table-bordered display text-nowrap"
                        >
                          <thead>
                            <!-- start row -->
                            <tr>
                                <th>@lang('Code')</th>
                                <th>@lang('Vendor')</th>
                                <th>@lang('Beneficiary')</th>
                                <th class="text-center">@lang('Date Created')</th>
                                <th class="text-center">@lang('Amount')</th> 
                                <th class="text-center">@lang('Status')</th> 
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>
                             
                            @forelse(@$log as $deposit)
                                    <tr>
                                      <td> 
                                        <label class='badge text-white @if($deposit->status == 1) bg-success @else  bg-danger @endif'> @if($deposit->status == 1) Active @else Used @endif</label>
                                        <br>
                                            <span class="">{{ __($deposit->code) }}</span> 
                                      </td>
                                      <td> 
                                            <span class="text-primary">{{ __(@$deposit->user->username ?? 'Admin') }}</span> 
                                      </td>
                                      <td> 
                                            <span class="text-success">{{ __(@$deposit->beneficiary->username ?? 'N/A') }}</span> 
                                      </td>

                                        <td class="text-center">
                                            {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                        </td> 
                                        <td class="text-center"> 
                                            <strong>{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</strong>                                        
                                        </td>
                                        <td class="text-center">
                                          @can(['admin.voucher.delete'])
                                           <a class="btn btn-sm btn-danger" href="{{route('admin.voucher.delete',$deposit->code)}}">Delete</a>
                                          @endcan
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
                              <th>@lang('Code')</th>
                              <th>@lang('Vendor')</th>
                              <th>@lang('Beneficiary')</th>
                              <th class="text-center">@lang('Date Created')</th>
                              <th class="text-center">@lang('Amount')</th> 
                              <th class="text-center">@lang('Status')</th> 
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
