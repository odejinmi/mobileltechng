@extends($activeTemplate . 'layouts.app')
@section('panel')
   <!-- Transaction Log -->
 <div class="col-lg-12 d-flex align-items-strech">
  <div class="card w-100">
    <div class="card-body">
      <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
        <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">@lang('Fund Card')</h5>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body p-4">
            <form action="{{ route('user.post_fund.card', $vcards->card_id) }}" method="POST">
              @csrf                
              <div class="row">
                <!-- Document Type Field -->
                <div class="col-sm-6">
                  <div class="mb-4">
                    <label class="form-label fw-semibold">@lang('Amount')</label>
                    <input type="number" class="form-control" name="amount" required="">
                  </div>
                </div>
                <div class="col-sm-6" style="margin-top:12px">
                  <button type="submit" class="mt-4 btn btn-primary">@lang('Submit')</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('breadcrumb-plugins') 
@endpush