@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
<!-- person transaction list section starts -->
<section class="section-b-space">
  <div class="custom-container"> 

    <div class="row gy-3">
      @forelse($saved as $k=>$data)
      <div class="col-12">
        <div class="transaction-box">
          <a href="{{route('user.viewsaved',$data->reference)}}" class="d-flex gap-3">
            <div class="transaction-image">
              <i class="icon" data-feather="printer"></i>
            </div>
            <div class="transaction-details">
              <div class="transaction-name">
                <h5>{{ __($data->reference) }}</h5>
                @if($data->status == 1)
                <span class="badge rounded-pill bg-warning me-1">@lang('Running')</span>
                @elseif($data->status == 0)
                    <span class="badge rounded-pill bg-success me-1">@lang('Completed')</span>
                @endif
              </div>
              <div class="d-flex justify-content-between">
                <h5 class="light-text">@if($data->type == 1) Recurrent Savings  @elseif($data->type == 2) Target Savings  @elseif($data->type == 3) Fixed Savings @endif</h5>
                <h5 class="light-text">{{ diffForHumans($data->created_at) }}</h5>
              </div>
            </div>
          </a>
        </div>
      </div> 
      @empty
          {!!emptyData2()!!}
      @endforelse
    </div>
    @if ($saved->hasPages())
    <nav aria-label="Page navigation example mt-2">
      <ul class="pagination justify-content-center">
          {{ $saved->links() }}
      </ul>
  </nav> 
    @endif
     
  </div>
  @push('script')
  <script>
    function redirect(url)
    {
        window.location.href = url;
    }
  </script>
  @endpush
</section>
@endsection
<!-- person transaction list section end -->