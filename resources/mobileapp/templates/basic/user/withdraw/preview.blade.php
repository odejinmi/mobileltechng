@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

<!-- pay money section starts -->
<section class="pay-money section-b-space">
  <div class="custom-container">
    <div class="profile-pic">
      <img class="img-fluid img" src="{{getImage(imagePath()['withdraw']['method']['path'].'/'. $withdraw->method->image,imagePath()['withdraw']['method']['size'])}}" alt="p3" />
    </div>
    <h3 class="person-name">Make Payment</h3>
    <h5 class="upi-id">Method : {{$withdraw->method->name}}</h5>
     

    <form action="{{ route('user.withdraw.submit') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <ul class="card-list">
          <li class="payment-add-box">
            <div class="add-img"> 
              <div class="categories-box">
                  <i class="categories-icon" data-feather="shopping-cart"></i>
              </div>
            </div>
            <div class="add-content">
              <div>
                <h5 class="fw-semibold dark-text">Amount</h5>
                <h6 class="mt-2 light-text"></h6>
              </div> 

              <div class="form-check">
                {{showAmount($withdraw->amount)  }} {{__($general->cur_text)}}
                </div>
            </div>
          </li> 

          <li class="payment-add-box">
              <div class="add-img">
                <div class="categories-box">
                    <i class="categories-icon" data-feather="percent"></i>
                </div>
              </div>
              <div class="add-content">
                <div>
                  <h5 class="fw-semibold dark-text">Fee</h5>
                  <h6 class="mt-2 light-text"></h6>
                </div> 

                <div class="form-check">
                    {{ showAmount($withdraw->charge) }} {{__($general->cur_text)}}
                  </div>
              </div>
            </li>
  
          <li class="payment-add-box">
            <div class="add-img">
              <div class="categories-box">
                  <i class="categories-icon" data-feather="shopping-bag"></i>
              </div>
            </div>
            <div class="add-content">
              <div>
                <h5 class="fw-semibold dark-text">You Get</h5>
                <h6 class="mt-2 light-text"></h6>
              </div> 

              <div class="form-check">
                  {{showAmount($withdraw->final_amount) }} {{__($withdraw->currency)}}
                </div>
            </div>
          </li>

          <li class="payment-add-box">
            <div class="add-img">
              <div class="categories-box">
                  <i class="categories-icon" data-feather="shopping-bag"></i>
              </div>
            </div>
            <div class="add-content">
              <div>
                <h5 class="fw-semibold dark-text">Value</h5>
                <h6 class="mt-2 light-text"></h6>
              </div> 

              <div class="form-check">
                {{showAmount($withdraw->final_amount) }} {{__($withdraw->currency)}}
                </div>
            </div>
          </li>
        </ul>
        <p class="my-4 text-center">{!!$withdraw->method->description!!}</p>

        @if($withdraw->method->user_data)
                @foreach($withdraw->method->user_data as $k => $v)
                    @if($v->type == "text")
                        <div class="form-group mb-3">
                            <label><strong>{{strtoUpper($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                            <input type="text" name="{{$k}}" class="form-control" value="{{old($k)}}" placeholder="{{__($v->field_level)}}" @if($v->validation == "required") required @endif>
                            @if ($errors->has($k))
                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                            @endif
                        </div>
                    @elseif($v->type == "textarea")
                        <div class="form-group mb-3">
                            <label><strong>{{strtoUpper($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                            <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->field_level)}}" rows="3" @if($v->validation == "required") required @endif>{{old($k)}}</textarea>
                            @if ($errors->has($k))
                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                            @endif
                        </div>
                    @elseif($v->type == "file")
                        <label><strong>{{strtoUpper($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                        <div class="form-group mb-3">
                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                <div class="fileinput-new thumbnail withdraw-thumbnail"
                                     data-trigger="fileinput">
                                    <img class="w-100" src="{{ getImage('/')}}" alt="@lang('Image')">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>
                                <div class="img-input-div">
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new "> @lang('Select') {{__($v->field_level)}}</span>
                                        <span class="fileinput-exists"> @lang('Change')</span>
                                        <input type="file" class="form-control" name="{{$k}}" accept="image/*" @if($v->validation == "required") required @endif>
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists"
                                    data-dismiss="fileinput"> @lang('Remove')</a>
                                </div>
                            </div>
                            @if ($errors->has($k))
                                <br>
                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                            @endif
                        </div>
                    @endif
                @endforeach
                @endif
      <button type="submit" class="btn theme-btn w-100 mt-3"
          id="btn-confirm" onClick="payWithRave()">@lang('Withdraw Now')</button>
      
  </form>

    

  </div>
</section> 
@endsection
 