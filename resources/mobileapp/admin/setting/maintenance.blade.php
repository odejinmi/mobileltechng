@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group mb-3">
                        <label>@lang('Status')</label>
                        <div class="form-check form-switch form-check-success">
                          <input type="checkbox" class="form-check-input"  @if(@$general->maintenance_mode) checked @endif name="status""
                           id="status" /> 
                      </div> 

                       </div>
                    </div>
                  </div>
                    <div class="form-group mb-3">
                      <label>@lang('Description')</label>
                        <textarea class="form-control nicEdit" rows="10" name="description">@php echo @$maintenance->data_values->description @endphp</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary w-100 h-45">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
