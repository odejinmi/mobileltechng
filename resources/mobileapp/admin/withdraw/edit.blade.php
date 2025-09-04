@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.withdraw.method.update', $method->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="payment-method-item">
                            <div class="payment-method-header">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{getImage(imagePath()['withdraw']['method']['path'].'/'. $method->image,imagePath()['withdraw']['method']['size'])}})"></div>
                                    </div>

                                    <label>@lang('Method Logo')</label>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="form-control profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                    </div>
                                </div>
                                
                                <div class="content mt-3">
                                    <label>@lang('Method Name')</label>
                                    <div class="d-flex justify-content-between">
                                        <input type="text" class="form-control" placeholder="@lang('Method Name')" name="name" value="{{ $method->name }}"/>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                    <ul class="list-group">
                                        <li
                                            class="list-group-item d-flex flex-wrap flex-sm-nowrap gap-2 justify-content-between align-items-center">
                                            <div>
                                                <p class="fw-bold mb-0">@lang('Affiliate Payout')</p>
                                                <p class="mb-0">
                                                    <small>@lang('If you disable this module, non affiliate users will be able to make request using this method')</small>
                                                </p>

                                                <div class="form-check form-switch form-check-success">
                                                    <input type="checkbox" class="form-check-input" name="affiliate"
                                                    @if ($method->affiliate) checked @endif id="affiliate" />
                                                    <label class="form-check-label" for="affiliate">
                                                        <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                                        <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                    </label>
                                                </div>

                                            </div>
                                           
                                        </li>
                                        
                                    </ul>
                                    
                                    </div>
                                    <div class="row mt-4">
                                         
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="w-100">@lang('Currency') <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="currency" class="form-control border-radius-5" value="{{ $method->currency }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="w-100">@lang('Rate') <span class="text-danger">*</span></label>

                                                <div class="input-group has_append">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">1 {{ __($general->cur_text) }}
                                                            =
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0" name="rate" value="{{ getAmount($method->rate) }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="currency_symbol"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="w-100">@lang('Processing Time') <span class="text-danger">*</span></label>
                                                <input type="text" name="delay" class="form-control border-radius-5" value="{{  $method->delay }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-lg-12 mt-4">
                                        <div class="card border-primary mb-2">
                                            <h5 class="card-header bg-light-primary">@lang('Payout Days')</h5>
                                            <div class="card-body">
                                                <small class="ms-2 mt-2  ">@lang('Separate multiple days by') <code>,</code>(@lang('comma'))
                                                    @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                                                    <br>
                                                    <small> <b class="text-danger">Days of the week are case sensitive. Please use correct spelling starting the first letter with an <b>Uppercase</b></b></small>

                                                <select name="payout_days[]" class="form-control select2-auto-tokenize" multiple="multiple"
                                                    required>
                                                    @if (@$method->payout_days)
                                                    @foreach (json_decode($method->payout_days,true) as $option)
                                                        <option value="{{ $option }}" selected>{{ __($option) }}</option>
                                                    @endforeach
                                                    @endif 
                                                </select>
                                                
                                                @push('script')
                                                <script>
                                                    (function($) {
                                                        "use strict";
                                                        $('.select2-auto-tokenize').select2({
                                                           // dropdownParent: $('.card-body'),
                                                            tags: true,
                                                            tokenSeparators: [',']
                                                        });
                                                    })(jQuery);
                                                </script>
                                                @endpush
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border-primary mb-2">
                                            <h5 class="card-header bg-light-primary">@lang('Range')</h5>
                                            <div class="card-body">
                                                <div class="input-group has_append mb-3">
                                                    <label class="w-100">@lang('Minimum Amount') <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="min_limit" placeholder="0" value="{{ getAmount($method->min_limit)}}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> {{ __($general->cur_text) }} </div>
                                                    </div>
                                                </div>
                                                <div class="input-group has_append">
                                                    <label class="w-100">@lang('Maximum Amount') <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="0" name="max_limit" value="{{getAmount($method->max_limit) }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> {{ __($general->cur_text) }} </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border-primary">
                                            <h5 class="card-header bg-light-primary">@lang('Charge')</h5>
                                            <div class="card-body">
                                                <div class="input-group has_append mb-3">
                                                    <label class="w-100">@lang('Fixed Charge') <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="{{ getAmount($method->fixed_charge) }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> {{ __($general->cur_text) }} </div>
                                                    </div>
                                                </div>
                                                <div class="input-group has_append">
                                                    <label class="w-100">@lang('Percent Charge') <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="0" name="percent_charge" value="{{ getAmount($method->percent_charge) }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border-primary my-2">
                                            <h5 class="card-header bg-light-primary">@lang('Withdraw Instruction') </h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="5" class="form-control border-radius-5 nicEdit" name="instruction">{{ $method->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border-primary">

                                            <h5 class="card-header bg-light-primary"> 
                                                <button style="display: flex; justify-content: flex-end; margin-left: auto; margin-right: 0;" type="button" class="btn btn-sm btn-outline-primary float-right addUserData">
                                                    <i class="ti ti-plus"></i>@lang('Add New')
                                                </button>
                                            </h5>


                                            <div class="card-body">
                                                <div class="row addedField">

                                                    @if($method->user_data != null)
                                                        @foreach($method->user_data as $k => $v)
                                                            <div class="col-md-12 user-data">
                                                                <div class="form-group">
                                                                    <div class="input-group mb-md-0 mb-4">
                                                                        <div class="col-md-4">
                                                                            <input name="field_name[]" class="form-control" type="text" value="{{$v->field_level}}" required placeholder="@lang('Field Name')">
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <select name="type[]" class="form-control">
                                                                                <option value="text" @if($v->type == 'text') selected @endif> 
                                                                                    @lang('Input Text')
                                                                                </option>
                                                                                <option value="textarea" @if($v->type == 'textarea') selected @endif> 
                                                                                    @lang('Textarea')
                                                                                </option>
                                                                                <option value="file" @if($v->type == 'file') selected @endif> 
                                                                                    @lang('File')
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-3 mt-md-0 mt-2">
                                                                            <select name="validation[]" class="form-control">
                                                                                <option value="required" @if($v->validation == 'required') selected @endif> @lang('Required') </option>
                                                                                <option value="nullable" @if($v->validation == 'nullable') selected @endif>  @lang('Optional') </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 mt-md-0 mt-2 text-right">
                                                                            <span class="input-group-btn">
                                                                                <button class="btn btn-outline-danger btn-lg removeBtn w-100" type="button">
                                                                                    <i class="ti ti-trash"></i>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary btn-block">@lang('Save Method')</button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('admin.withdraw.method.index') }}" class="btn btn-sm btn-outline-primary box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> @lang('Go Back')
    </a>
@endpush
@push('style')
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";

            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });
            $('.currency_symbol').text($('input[name=currency]').val());

            $('.addUserData').on('click', function () {
                var html = `
                <div class="col-md-12 user-data">
                    <div class="form-group">
                        <div class="input-group mb-md-0 mb-4">
                            <div class="col-md-4">
                                <input name="field_name[]" class="form-control" type="text" required placeholder="@lang('Field Name')">
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="type[]" class="form-control">
                                    <option value="text" > @lang('Input Text') </option>
                                    <option value="textarea" > @lang('Textarea') </option>
                                    <option value="file"> @lang('File') </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="validation[]"
                                        class="form-control">
                                    <option value="required"> @lang('Required') </option>
                                    <option value="nullable">  @lang('Optional') </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2 text-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-outline-danger btn-lg removeBtn w-100" type="button">
                                        <i class="ti ti-x"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('.addedField').append(html);
            });


            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            @if(old('currency'))
            $('input[name=currency]').trigger('input');
            @endif
        })(jQuery);


    </script>
@endpush
