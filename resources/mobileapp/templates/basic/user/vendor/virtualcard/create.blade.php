@extends($activeTemplate . 'layouts.dashboard')
@section('panel')

  <!-- cards section starts -->
  <section class="section-b-space">
    <div class="custom-container">
      <ul class="card-list">
        @forelse(@$log as $item)
        <li class="credit-card-box color1">
          <div class="card-logo">
            <img class="img-fluid" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/logo1.svg')}}" alt="logo1" />
            <div class="dropdown">
              <a href="{{route('user.virtualcard.details',$item->card_id)}}" class="back-btn" role="button" >
                <i class="icon" data-feather="more-horizontal"></i>
              </a> 
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h6 class="card-number">{{ $item->pan }} </h6>
              <h5 class="card-name">{{ __($item->brand) }}</h5>
            </div>
            <img class="img-fluid chip" src="{{ asset($activeTemplateTrue . 'mobile/images/svg/card-chip.svg')}}" alt="card-chip" />
          </div>
          <div class="d-flex justify-content-between">
            <h2 class="card-amount">
                @if ($item->status == 'active')
                                                <span class="badge bg-success">{{ strToUpper($item->status) }}</span>
                                                @else
                                                <span class="badge bg-warning">{{ strToUpper($item->status) }}</span>
                                                @endif
            </h2>
            <div class="card-date w-100">
              <h6>Exp. date</h6>
              <h6 class="text-white fw-semibold mt-1">{{$item->expiry_month}} /{{$item->expiry_year}}</h6>
            </div>
            <div class="card-numbers w-100">
              <h6 class="cvv-code">Cvv</h6>
              <h6 class="text-white fw-semibold mt-1">***</h6>
            </div>
          </div>
        </li>

        @empty
                                    {!! emptyData2() !!}
                                @endforelse
      </ul>
    </div>
  </section>
  <!-- cards section end -->
  
  <!-- add card modal starts -->
  <form  class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" action="" method="post">
    @csrf
  <div class="modal add-money-modal fade" id="add-card" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Add Card</h2>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="inputcards" class="form-label mb-2">Card type</label>
            <div class="d-flex gap-2">
                <select type="text" class="form-select  username @error('card') is-invalid @enderror" id="card"
                name="type">
                <option selected disabled>Select An Option</option>
                <option value="Verve">Verve (NGN)</option>
                <option value="MasterCard">MasterCard (USD)</option>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Account BVN</label>
            <div class="form-input mb-3">
                <input  type="text" name="bvn" maxlength="11" class="form-control form-control-solid"/>
            </div>
          </div>
          
              <div class="form-group">
                <label class="form-label">Transaction PIN</label>
                <div class="form-input mb-3">
                  <input type="number" name="pin" class="form-control" />
                </div>
              </div>
             
          <button type="submit" class="btn theme-btn successfully w-100">Create Card</button>
        </div>
        <button type="button" class="btn close-btn" data-bs-dismiss="modal">
          <i class="icon" data-feather="x"></i>
        </button>
      </div>
    </div>
  </div>
  </form>
  <!-- add card modal end -->
@endsection
@push('breadcrumb-plugins')
<a href="#add-card" class="back-btn" data-bs-toggle="modal">
    <i class="icon" data-feather="plus"></i>
  </a>
@endpush
