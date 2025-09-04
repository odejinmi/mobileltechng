@extends('admin.layouts.app')
@section('panel')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
@endpush
<div class="row">
  <div class="col-12">
      <!-- ---------------------
                        start File export
                    ---------------- -->
      <div class="card">
          <div class="card-body">
              <div class="mb-2">
                  <h5 class="mb-0">{{ $pageTitle }}</h5>
              </div>
              <p class="card-subtitle mb-3">
                  @lang('A table showing all the ') {{ $pageTitle }} @lang('on your account. You can export transaction record')
              </p>
              <div class="table-responsive">
                  <table id="file_export" class="table border table-striped table-bordered display text-nowrap">
                      <thead>
                          <!-- start row -->
                          <tr>
                              <th>@lang('TRX ID')</th>
                              <th>@lang('Customer')</th>
                              <th>@lang('Network')</th>
                              <th>@lang('Code')</th>
                              <th>@lang('Amount')</th>
                              <th>@lang('Value')</th>
                              <th>@lang('Fee')</th>
                              <th>@lang('Status')</th>
                              <th>@lang('Date')</th>
                              <th></th>
                          </tr>
                          <!-- end row -->
                      </thead>
                      <tbody>

                          @forelse(@$log as $item)
                              <tr>
                                <td>{{ $item->trx }}</td>
                                <td>{{ $item->user->username }}</td>
                                  <td class="break_line">
                                    <center> <img src="{{ url('/') }}/assets/images/provider/{{$item->product_name}}.jpeg" class="rounded-circle" alt="..." width="56"
                                        height="56">
                                    </center></td>
                                  <td class="break_line">
                                      {{ __($item->val_2) }}</td>
                                      <td>{{$general->cur_sym}}{{ number_format($item->price, 2) }}</td>
                                      <td>{{$general->cur_sym}}{{ number_format($item->payment, 2) }}</td>
                                      <td>{{$general->cur_sym}}{{ number_format($item->val_1, 2) }}</td>
                                  <td>
                                      <div class="td-content">
                                          @if ($item->status == 1)
                                              <span
                                                  class="badge bg-success">Approved</span>
                                          @elseif($item->status == 0)
                                              <span
                                                  class="badge bg-warning">Pending</span>
                                          @elseif($item->status == 2)
                                              <span
                                                  class="badge bg-danger">Declined</span>
                                          @endif
                                      </div>
                                  </td>
                                  <td>{{ showDateTime($item->created_at) }}</td>
                                  <td>
                                    @if($item->status == 0)
                                    <a href="{{route('admin.bills.airtime2cash.approve',$item->trx)}}" class="btn btn-sm btn-success">Approve</a>
                                    <a href="{{route('admin.bills.airtime2cash.decline',$item->trx)}}" class="btn btn-sm btn-danger">Decline</a>
                                    @endif
                                  </td>

                              </tr>
                          @empty
                              {!! emptyData2() !!}
                          @endforelse
                          <!-- end row -->
                          <!-- end row -->
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>@lang('TRX ID')</th>
                              <th>@lang('Customer')</th>
                              <th>@lang('Network')</th>
                              <th>@lang('Code')</th>
                              <th>@lang('Amount')</th>
                              <th>@lang('Value')</th>
                              <th>@lang('Fee')</th>
                              <th>@lang('Status')</th>
                              <th>@lang('Date')</th>
                              <th></th>
                          </tr>
                      </tfoot>
                  </table>
              </div>
              <div class="card-footer">
                  @if ($log->hasPages())
                      <div class="card-footer">
                          {{ paginateLinks($log) }}
                      </div>
                  @endif
              </div>
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
