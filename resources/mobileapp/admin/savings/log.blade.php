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
                              <th>@lang('Username')</th>
                              <th>@lang('Trx')</th>
                              <th>@lang('Type')</th>
                              <th>@lang('Amount')</th>
                               <th>@lang('Status')</th>
                              <th>@lang('Action')</th>
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>
                             
                            @forelse($saved as $k=>$data)
                            <tr>
                              <td>
                                <a href="{{ route('admin.users.detail', $data->user_id) }}">
                                <div class="d-flex align-items-center">
                                  <img src="{{ getImage(getFilePath('userProfile') . '/' . @$data->user->image, getFileSize('userProfile')) }}" alt="avatar" class="rounded-circle" width="35" />
                                  <div class="ms-3">
                                    <div class="user-meta-info">
                                      <h6 class="user-name mb-0" data-name="{{ @$data->user->fullname }}"> {{ @$data->user->fullname }}</h6>
                                      <span class="user-work fs-3" data-occupation="{{ @$data->user->username }}"> {{ @$data->user->username }}</span>
                                    </div>
                                  </div>
                                </div>  
                                </a>
                              </td>
                              <td data-label="#@lang('Trx')">{{$data->reference}}<br>
                              <small>{{showDateTime($data->created_at)}}</small>
                              </td>
                              <td data-label="@lang('Type')">@if($data->type == 1) Recurrent Savings @elseif($data->type == 2) Target Savings @elseif($data->type == 3) Fixed Savings @endif</td>
                              <td data-label="@lang('Amount')">
                                  <strong>{{showAmount($data->amount)}} {{__($general->cur_text)}}</strong><br>
                                  <small>@if($data->type == 1) Recurrent Amount @elseif($data->type == 2) Targeted Amount @elseif($data->type == 3) Fixed Amount @endif</small>
                              </td>
                              
              
                              <td data-label="@lang('Status')">
                                   @if($data->status == 1)
                                  <span class="badge rounded-pill bg-warning me-1">@lang('Running')</span>
                                  @elseif($data->status == 0)
                                      <span class="badge rounded-pill bg-success me-1">@lang('Completed')</span>
              
                                  @endif
              
                              </td>
                              <td data-label="@lang('Saved')">
                              <a href="{{route('admin.savings.view',$data->reference)}}" class="btn btn-sm btn-primary">View</a>
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
                              <th>@lang('Username')</th>
                              <th>@lang('Trx')</th>
                              <th>@lang('Type')</th>
                              <th>@lang('Amount')</th>
                               <th>@lang('Status')</th>
                              <th>@lang('Action')</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                      @if ($saved->hasPages())
                    <div class="card-footer">
                        {{ $saved->links() }}
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
