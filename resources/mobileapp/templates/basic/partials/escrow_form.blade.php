@php
    $categories = App\Models\Category::active()->get();
@endphp

<form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="{{ route('user.escrow.step.one.submit') }}" method="post">
    @csrf

    <!--begin::Step 2-->
    <div data-kt-stepper-element="scontent">
        
        <!--begin::Wrapper-->
        <div class="w-100">
            <!--begin::Heading-->
            <div class="pb-10 pb-lg-15">
                <!--begin::Title-->
                <h2 class="fw-bold text-dark">@lang('Create New Escrow')</h2>
                <!--end::Title-->

                <!--begin::Notice-->
                <div class="text-muted fw-semibold fs-6">
                    @lang('If you need more info, please check out')
                    <a href="#" class="link-primary fw-bold">Help Page</a>.
                </div>
                <!--end::Notice-->
            </div>
            <!--end::Heading-->
<!--begin::Input group-->
<div class="fv-row">
<!--begin::Row-->
<div class="row">
<!--begin::Col-->
<div class="col-lg-6">
<!--begin::Option-->
<input type="radio" class="btn-check" name="type" value="1" checked="checked" id="selling"/>
<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10" for="selling">
<i class="ti ti-wallet fs-3x me-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
<!--begin::Info-->
<span class="d-block fw-semibold text-start">                            
    <span class="text-dark fw-bold d-block fs-4 mb-2">
        @lang('I am Selling')
    </span>
    <span class="text-muted fw-semibold fs-6"></span>
</span>
<!--end::Info-->
</label>   
<!--end::Option-->
</div>
<!--end::Col-->

<!--begin::Col-->
<div class="col-lg-6">
<!--begin::Option-->
<input type="radio" class="btn-check"  name="type" value="2"  id="buying"/>
<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="buying">
<i class="ti ti-cash fs-3x me-5"><span class="path1"></span><span class="path2"></span></i>
<!--begin::Info-->
<span class="d-block fw-semibold text-start">                              
    <span class="text-dark fw-bold d-block fs-4 mb-2"> @lang('I am Buying')</span>
    <span class="text-muted fw-semibold fs-6"></span>
</span>           
<!--end::Info-->               
</label>           
<!--end::Option-->   
</div>
<!--end::Col-->
</div>
<!--end::Row-->        
</div>
<!--end::Input group-->    
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center form-label mb-3">
                    @lang('Fixed Amount') 
                    <span class="ms-1" data-bs-toggle="tooltip"
                        title="Select a fixed amount">
                        <i class="ti ti-alert-circle text-gray-500 fs-6"><span
                                class="path1"></span><span class="path2"></span><span
                                class="path3"></span></i></span> </label>
                <!--end::Label-->

                <!--begin::Row-->
                <div class="row mb-2" data-kt-buttons="true">
                    <!--begin::Col-->
                    <div class="col">
                        <!--begin::Option-->
                        <label
                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="200" />

                            <span class="fw-bold fs-3">200</span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col">
                        <!--begin::Option-->
                        <label
                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="500" />
                            <span class="fw-bold fs-3">500</span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col">
                        <!--begin::Option-->
                        <label
                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="1000" />
                            <span class="fw-bold fs-3">1000</span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col">
                        <!--begin::Option-->
                        <label
                            class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                            <input type="radio"  onchange="fixeamount(this)"  class="btn-check" value="2000" />
                            <span class="fw-bold fs-3">2000</span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Hint-->
                <div class="form-text">
                    @lang('Select a fixed amount above or enter a custom amount below')
                </div>
                <!--end::Hint-->
            </div>
            <!--end::Input group-->
            @push('script')
            <script>
                function fixeamount(e)
                {
                document.getElementById("amount").value = e.value;
                }
            </script>
            @endpush
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
                <label class="form-label mb-3">@lang('Escrow Category')</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select name="category_id" class="form-control select-2 form-control-lg form-control-solid @error('category_id') is-invalid @enderror" required>
                    <option value="">@lang('Select One')</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ __($category->name) }}</option>
                    @endforeach
                </select>
                <!--end::Input-->
            </div>
            <!--end::Input group-->

            <div class="mb-10 fv-row">
                <div>
                    <label class="form-label mb-3">@lang('Milestone')</label>
                    <p class="mb-0">
                        <small>@lang('By enabling') <span class="fw-bold">@lang('Milestone')</span>
                            @lang('the system will enable a milestone function where beneficiary can get payment according to service delivery milestone till service is completed or product is delivered.')</small>
                    </p>
                </div>
                <div class="form-group">

                <div class="form-check form-switch form-check-success">
                    <input type="checkbox" class="form-check-input" name="milestone"
                     id="milestone" /> 
                </div>   
                </div> 
            </div>

 

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Step 2-->



    <!--begin::Actions-->
    <div class="d-flex flex-stack pt-15">

        <!--begin::Wrapper-->
        <div>

            <button type="submit" class="btn btn-lg btn-primary" type="button" id="submit">@lang('Proceed')
                
                <i class="ti ti-arrow-right fs-4 ms-1 me-0"><span class="path1"></span><span class="path2"></span></i> </button>
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Actions-->
</form>

