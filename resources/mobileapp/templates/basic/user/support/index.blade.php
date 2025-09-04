@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    <!-- notification section starts -->
    <section class="section-b-space">
        <div class="custom-container">

            <ul class="notification-list">
                @forelse($supports as $support)
                    <li class="notification-box">
                        <div class="notification-img">
                            <img class="img-fluid icon" src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) }}" alt="p2" />
                        </div>
                        <div class="notification-details">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-semibold dark-text">
                                        @if ($support->priority == Status::PRIORITY_LOW)
                                            <span class="badge bg-warning">@lang('Low')</span>
                                        @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                            <span class="badge bg-success">@lang('Medium')</span>
                                        @elseif($support->priority == Status::PRIORITY_HIGH)
                                            <span class="badge bg-danger">@lang('High')</span>
                                        @endif
                                    </h5>
                                    <h6 class="fw-normal light-text mt-1">[@lang('Ticket')#{{ $support->ticket }}]</h6>
                                </div>
                                <h6 class="time fw-normal light-text">
                                    {{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }}</h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h5 class="dark-text fw-normal">{{ __($support->subject) }}
                                </h5>
                                <a href="{{ route('ticket.view', $support->ticket) }}"
                                    class="btn theme-btn pay-btn mt-0">View</a>
                            </div>
                        </div>
                    </li>

                @empty

                    <section class="section-b-space">
                        <div class="custom-container">
                            <div class="empty-page">
                                <img class="notification-img" class="img-fluid"
                                    src="{{ asset($activeTemplateTrue . 'mobile/images/svg/notification.svg') }}"
                                    alt="notification" />
                                <h3 class="d-block fw-normal dark-text text-center mt-3">There is no new notification for
                                    you, Please checke back later for
                                    new notification</h3>
                            </div>
                            <a href="#" onclick="history.back()" class="btn theme-btn successfully w-100">Back</a>
                        </div>
                    </section>
                @endforelse
            </ul>
            @if ($supports->hasPages())
                <div class="card-footer py-4">
                    @php echo paginateLinks($supports) @endphp
                </div>
            @endif
        </div>
    </section>
    <!-- notification section end -->
@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('ticket.open') }}" class="back-btn">
        <i class="icon" data-feather="plus"></i>
    </a>
@endpush
