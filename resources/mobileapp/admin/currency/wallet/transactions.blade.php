@extends('admin.layouts.app')
@section('panel')
<div class="row g-5 g-xl-10">     
  <!--begin::Col-->
  <div class="col-xxl-12">
      
<!--begin::Table widget 7-->
<div class="card card-flush h-xl-100">
  <!--begin::Header-->
  <div class="card-header pt-7">
      <!--begin::Title-->
      <h4 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold text-gray-800">@lang('Transaction Log')</span><br>
          <span class="text-gray-400 mt-1 fw- fs-">{{$wallet->address}}</span>
      </h4>
      <!--end::Title--> 
  </div>
  <!--end::Header-->
 
   <!--begin::Body-->
<div class="card-body py-3">
      <!--begin::Table container-->
      <div class="table-responsive">
          <!--begin::Table-->
          <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
              <!--begin::Table head-->
              <thead>
                  <tr class="border-bottom-0">                                    
                      <th class="p-0 w-50px"></th>
                      <th class="p-0 min-w-175px"></th>
                      <th class="p-0 min-w-175px"></th>
                      <th class="p-0 min-w-150px"></th>                                     
                      <th class="p-0 min-w-150px"></th>
                      <th class="p-0 min-w-50px"></th>
                  </tr>
              </thead>
              <!--end::Table head-->

              <!--begin::Table body-->
              <tbody>
                @forelse(@$transactions['data'] as $data)
                                          <tr>                            
                          <td> 
                              <div class="symbol symbol-40wpx">
                                  
                                    @if($data['type'] == 'receive')
                                    <span class="symbol-label bg-light-success">
                                      <i class="ki-duotone ti ti-wallet fs-2x text-success"><span class="path1"></span><span class="path2"></span></i> 
                                    </span>
                                      @else
                                    <span class="symbol-label bg-light-danger">
                                    <i class="ki-duotone ti ti-wallet-off fs-2x text-danger"><span class="path1"></span><span class="path2"></span></i> 
                                    </span>
                                    @endif
                              </div>
                          </td>  

                          <td class="ps-0">
                              <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-">{{@strToUpper($data['type'])}}</a>
                              <span class="text-muted fw-semibold d-block fs-">#{{@substrinput($data['txid'])}} </span>
                          </td>    

                          <td>
                              <span class="text-dark fw-bold d-block fs-">{{$data['coin_short_name']}} Wallet</span>

                              <span class="text-gray-400 fw-semibold d-block fs-">{{$data['address']}}</span>
                          </td>

                          <td>
                              <span class="text-dark fw-bold d-block fs-">{{showDate($data['date'])}}</span>

                              <span class="text-gray-400 fw-semibold d-block fs-">@lang('Payment Date')</span>
                          </td> 

                          <td>
                              <span class="text-dark fw-bold d-block fs-">{{$data['amount']}} {{$data['coin_short_name']}}</span>

                              <span class="text-gray-400 fw-semibold d-block fs-">{{$data['confirmations']}} @lang('Confirmations')</span>
                          </td> 

                          <td class="text-end">
                              <a href="{{$data['explorer_url']}}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                  <i class="ki-duotone ti ti-arrow-right fs-2"><span class="path1"></span><span class="path2"></span></i>                                </a>
                          </td>
                      </tr>
                      @empty
              <div class="alert alert-default alert-dismissible fade show" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-download"></i></span>
                <span class="alert-inner--text"><strong>Hello!</strong> There is no transaction log at the moment!</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              @endforelse
                                     
                                  </tbody>
              <!--end::Table body-->
          </table>
          <!--end::Table-->
      </div>
      <!--end::Table container-->     
  </div>
<!--begin::Body-->
</div>
<!--end::Table widget 7-->    </div>
  <!--end::Col-->   
</div>
 
<!-- Row End -->
   

@endsection



@push('script') 

@endpush

