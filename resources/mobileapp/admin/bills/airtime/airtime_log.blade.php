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
                                <th>@lang('Product | ID')</th>
                                <th class="text-center">@lang('Customer')</th>
                                <th class="text-center">@lang('Date')</th>
                                <th class="text-center">@lang('Beneficiary')</th>
                                 <th class="text-center">@lang('Conversion | Value')</th>
                                <th class="text-center">@lang('Status')</th>
                            </tr>
                            <!-- end row -->
                          </thead>
                          <tbody>
                             
                            @forelse(@$log as $deposit)
                                    <tr>
                                        <td>
                                            <span class="fw-bold"> 
                                              
                                              <span
                                                    class="text-primary">{{ __($deposit->product_name) }}</span>
                                            </span>
                                            <br>
                                            <small> {{ __($deposit->val_i) }} </small>
                                        </td>

                                        <td class="text-center">
                                          <a href="{{ route('admin.users.detail', $deposit->user_id) }}">
                                          <div class="d-flex align-items-center">
                                            <img src="{{ getImage(getFilePath('userProfile') . '/' . $deposit->user->image, getFileSize('userProfile')) }}" alt="avatar" class="rounded-circle" width="35" />
                                            <div class="ms-3">
                                              <div class="user-meta-info">
                                                <h6 class="user-name mb-0" data-name="{{ $deposit->user->fullname }}"> {{ $deposit->user->fullname }}</h6>
                                                <span class="user-work fs-3" data-occupation="{{ $deposit->user->username }}"> {{ $deposit->user->username }}</span>
                                              </div>
                                            </div>
                                          </div>
                                          </a>
                                        </td> 
                                        <td class="text-center">
                                            {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                        </td>
                                        <td class="text-center">
                                          {{ __($deposit->val_1) }}
                                            
                                        </td> 
                                        <td class="text-center">
                                           <small>{{ __($general->cur_text) }} {{ showAmount($deposit->payment / $deposit->quantity) }}</small>
                                            <br>
                                            <strong>{{ showAmount($deposit->payment) }} {{ __($general->cur_text) }}</strong>
                                        </td>
                                        <td class="text-center">
                                           <label class='badge @if($deposit->status == 'SUCCESSFUL') bg-success  @elseif($deposit->status == 'PENDING') bg-warning  @else  bg-danger @endif'> @php echo $deposit->status @endphp</label>
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
                                <th>@lang('Product | ID')</th>
                                <th class="text-center">@lang('Customer')</th>
                                <th class="text-center">@lang('Initiated')</th>
                                <th class="text-center">@lang('Beneficiary')</th>
                                <th class="text-center">@lang('Conversion | Value')</th>
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
