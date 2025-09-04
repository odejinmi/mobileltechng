@extends('admin.layouts.app')
@section('panel')
 <!-- content @s
-->
<!--begin::Container-->
<div id="kt_content_container" class=" container-xxl ">
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
 
                <!--begin::Form-->
                    <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
                    @csrf

                    <!--begin::Step 2-->
                    <div data-kt-stepper-element="scontent">
                        
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold text-dark">@lang('Generate Voucher')</h2>
                                <!--end::Title-->

                                
                            </div>
                            <!--end::Heading-->    
                            <!--begin::Input group-->
                             
                           
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="form-label mb-3">@lang('Enter Amount')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" id="amount" class="form-control form-control-lg form-control-solid  amount @error('amount') is-invalid @enderror" value="{{ old('amount') }}" name="amount" placeholder="0.00" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group--> 
 
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <br>
                                <label class="form-label mb-3">@lang('Units ')</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" onkeyup="getvalue(this)" class="form-control form-control-lg form-control-solid  unit @error('unit') is-invalid @enderror" id="unit"
                                    name="unit" value="{{ old('unit') }}" placeholder="Enter Units" />
                                <!--end::Input-->
                                <label class="form-check-label" for="value">
                                    <small class="text-danger" id="value"></small>
                                </label>
                            </div>
                            <!--end::Input group-->  

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->

                    @push('script')
                     
                    @endpush

                    <!--begin::Actions-->
                    <div class="d-flex flex-stack pt-15">
                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Proceed')
                                <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i> 
                            </button>
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Stepper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->
 
@endsection

@push('breadcrumb-plugins')
<a class="btn btn-sm btn-primary" href="{{ route('admin.voucher.log') }}"> <i class="ti ti-printer"></i> @lang('View Voucher')</a>
@endpush