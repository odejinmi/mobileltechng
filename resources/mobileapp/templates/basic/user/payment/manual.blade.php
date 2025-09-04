@extends($activeTemplate . 'layouts.dashboard')

@section('panel')
<!-- pay money section starts -->
<section class="pay-money section-b-space">
    <div class="custom-container">
      <div class="profile-pic">
        <img class="img-fluid img" src="{{ getImage(imagePath()['gateway']['path'] . '/' . @$data->gateway->image, imagePath()['gateway']['size']) }}" alt="p3" />
      </div>
      <h3 class="person-name">Make Payment</h3>
      <h5 class="upi-id">Method : {{$data->gateway->alias}}</h5>
       

      <form action="{{ route('user.deposit.manual.update') }}" method="POST" enctype="multipart/form-data">
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
                    {{ showAmount($data->final_amo) }}
                    {{ __($data->method_currency) }}
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
                      {{ showAmount($data->charge) }} {{ __($data->method_currency) }}
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
                    {{ showAmount($data->amount) }} {{ __($general->cur_text) }}
                  </div>
              </div>
            </li>
          </ul>
          <p class="my-4 text-center">@php echo  $data->gateway->description @endphp</p>

          @if($formData)

                                    @foreach($formData as $k => $v)

                                        @if($v->type == "text")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <input type="text" class="form-control reason"
                                                           name="{{$k}}"  value="{{old($k)}}" placeholder="{{__(@$v->name)}}">
                                                </div>
                                            </div>
                                            @elseif($v->type == "checkbox")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <input  class="form-check-input" type="checkbox"
                                                           name="{{$k}}"  value="{{old($k)}}" placeholder="{{__(@$v->name)}}">
                                                </div>
                                            </div>
                                            @elseif($v->type == "select")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <select class="form-control select2" name="{{$k}}"  value="{{old($k)}}">
                                                        @foreach($v->options as $data)
                                                        <option>{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @elseif($v->type == "radio")
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label><strong>{{__(@inputTitle($v->name))}} @if(@$v->is_required == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    @foreach($v->options as $data)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="{{$k}}" value="{{$data}}" name="exampleRadios" id="{{$data}}" value="option1" checked>
                                                        <label class="form-check-label" for="{{$data}}">
                                                            {{$data}}
                                                        </label>
                                                      </div>
                                                    @endforeach 
                                                </div>
                                            </div>
                                           @elseif($v->type == "textarea")
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label><strong>{{__(inputTitle($v->name))}}
                                                            @if($v->is_required == 'required')
                                                            <span class="text-danger">*</span>
                                                            @endif</strong>
                                                        </label>
                                                        <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->name)}}" rows="3">{{old($k)}}</textarea>

                                                    </div>
                                                </div>
                                        @elseif($v->type == "file")
                                            <div class="col-md-12 mb-3">

                                                <label class="text-uppercase">
                                                    <strong>
                                                        {{__($v->name)}} @if($v->is_required == 'required') <span class="text-danger">*</span>  @endif
                                                    </strong>
                                                </label>
                                                    <div class="image-upload">
                                                        <div class="image-edit">
                                                            <input type='file' name="{{$k}}" id="imageUpload" class="form-control" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="image-preview">
                                                            <div id="imagePreview" style="background-image: url({{ asset(imagePath()['image']['default']) }});">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif

                                    @endforeach
                                @endif
        <button type="submit" class="btn theme-btn w-100 mt-3"
            id="btn-confirm" onClick="payWithRave()">@lang('Pay Now')</button>
        
    </form>

      

    </div>
  </section> 
@endsection
