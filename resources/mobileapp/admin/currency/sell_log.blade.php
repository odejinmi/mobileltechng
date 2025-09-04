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
                                <th>@lang('Asset')</th>
                                <th class="text-center">@lang('Initiated')</th>
                                <th class="text-center">@lang('TRX')</th>
                                <th class="text-center">@lang('Proof')</th>
                                 <th class="text-center">@lang('Conversion | Value')</th>
                                 <th class="text-center">@lang('Rate')</th>
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
                                                    class="text-primary">{{ __($deposit->product_name) }}<small> ({{ __($deposit->asset->symbol) }})</small></span>
                                            </span> 
                                            <br>
                                            <span class="symbol symbol-40px me-6">
                                              <span class="symbol-label bg-light-primary">
                                                  <i class="ti ti-image fs-2x text-warning"><img src="{{ url('/') }}/assets/images/coins/{{$deposit->asset->image}}" width="30" class="path1"/></i>
                                              </span>
                                              
                                          </span> 
                                        </td>

                                        <td class="text-center">
                                            {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                        </td>

                                        <td class="text-center">
                                            {{ ($deposit->deposit_code) }}
                                        </td>

                                        <td>
                                          @if($deposit->val_2 != null)
                                          <span class="symbol-label bg-light-primary">
                                           {{-- <img src="{{url('/')}}/{{ imagePath()['trade']['path'].'/'.@$deposit->user->username}}/{{$deposit->val_2}}" width="30" class="path1"/> --}}
                                            <a href="{{url('/')}}/{{ imagePath()['trade']['path'].'/'.@$deposit->user->username}}/{{$deposit->val_2}}" target="_blank" class="btn btn-outline-primary">Download <i class="ti ti-download fs-2x text-primary"></i></a>
                                        </span>
                                        @endif
                                        
                                        </td>
                                       
                                        <td class="text-center">
                                           <small> {{ showAmount($deposit->payment) }}{{ __(@$deposit->asset->symbol) }}</small>
                                            <br> 
                                            <strong>{{ showAmount($deposit->price) }} {{ __($deposit->currency) }}</strong>                                        
                                        </td>
                                        <td class="text-center">
                                          {{ __($deposit->value) }}{{ __($general->cur_text) }}
                                        </td> 
                                        <td class="text-center">
                                           <label class='badge text-white  @if($deposit->status_code == 1 || $deposit->status_code == 3 || $deposit->status == 'success') bg-success @else bg-warning @endif'> @php echo $deposit->status @endphp</label>
                                           @if($deposit->status == 'pending' || $deposit->status == 'Pending')
                                           <br><br>
                                           <a href="#" data-bs-toggle="modal" data-bs-target="#al-success-alert{{$deposit->id}}" class="btn btn-sm btn-success">Approve</a>
                                           <a href="#" data-bs-toggle="modal" data-bs-target="#al-decline-alert{{$deposit->id}}" class="btn btn-sm btn-danger">Decline</a>
                                           @endif
                                        </td> 
                                    </tr>

                                    <!-- Vertically centered modal -->
                                    <div class="modal fade" id="al-success-alert{{$deposit->id}}" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                      <div
                                        class="modal-content modal-filled bg-light-success text-success"
                                      >
                                        <div class="modal-body p-4">
                                          <div class="text-center text-success">
                                            <i class="ti ti-circle-check fs-7"></i>
                                            <h4 class="mt-2">Approve Transaction!</h4>
                                            <p class="mt-3 text-success-50">
                                              @lang('You are about to approve this transaction. Please click on the continue button below to continue process')
                                            </p>
                                            <button type="button" class="btn btn-light my-2"  data-bs-dismiss="modal">
                                              Cancel
                                            </button>
                                            <a href="{{route('admin.crypto.assetselltrade.approve',$deposit->trx)}}" class="btn btn-success my-2">
                                              Continue
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                  </div>


                                  <div class="modal fade" id="al-decline-alert{{$deposit->id}}" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                      <div
                                        class="modal-content modal-filled bg-light-danger text-danger"
                                      >
                                        <div class="modal-body p-4">
                                          <div class="text-center text-danger">
                                            <i class="ti ti-circle-check fs-7"></i>
                                            <h4 class="mt-2">Decline Transaction!</h4>
                                            <p class="mt-3 text-danger-50">
                                              @lang('You are about to decline this transaction. Please click on the continue button below to continue process')
                                            </p>
                                            <button type="button" class="btn btn-light my-2"  data-bs-dismiss="modal">
                                              Cancel
                                            </button>
                                            <a href="{{route('admin.crypto.assetselltrade.decline',$deposit->trx)}}" class="btn btn-danger my-2">
                                              Continue
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                  </div>
                                @empty
                                    {!!emptyData2()!!}
                                @endforelse
                            <!-- end row -->
                            <!-- end row -->
                          </tbody>
                          <tfoot>
                            <tr>
                                <th>@lang('Product | ID')</th>
                                <th class="text-center">@lang('Initiated')</th>
                                <th class="text-center">@lang('TRX')</th>
                                <th class="text-center">@lang('Conversion | Value')</th>
                                <th class="text-center">@lang('Rate')</th>
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
