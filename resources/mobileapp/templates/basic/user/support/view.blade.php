@extends($activeTemplate . 'layouts.dashboard')
@section('panel')
    <!-- chatting section start -->

  <section>
    <ul class="transfer-list add-transfer-person">
      <li class="w-100">
        <div class="transfer-person transfer-box">
          <div class="transfer-img">
            <img class="img-fluid icon" src="{{ getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile')) }}" alt="p1" />
          </div>
          <div class="transfer-details">
            <div>
              <h5 class="fw-semibold dark-text">{{Auth::user()->fullname}}</h5>
              <h6 class="fw-normal light-text mt-2">{{Auth::user()->email}}</h6>
            </div> 
          </div>
        </div>
      </li>
    </ul>
  </section>
    <section class="msger pt-1 section-b-space">
        <div class="custom-container">
            <div class="msger-chat">
                @forelse ($messages as $message)
                    @if ($message->admin_id == 1)
                        <div class="msg right-msg mb-2">
                            <div class="msg-bubble">
                                <div class="msg-text">{{ $message->message }}<br>
                                    <small>{{ diffForHumans($message->created_at) }}</small>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="msg left-msg mb-2">
                            <div class="msg-bubble">
                                <div class="msg-text">{{ $message->message }}<br>
                                    <small>{{ diffForHumans($message->created_at) }}</small>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    <section class="section-b-space">
                        <div class="custom-container">
                            <div class="empty-page">
                                <img class="notification-img" class="img-fluid"
                                    src="{{ asset($activeTemplateTrue . 'mobile/images/svg/notification.svg') }}"
                                    alt="notification" />
                                <h3 class="d-block fw-normal dark-text text-center mt-3">There is no new notification for
                                    you,
                                    Please checke back later for
                                    new notification</h3>
                            </div>
                            <a href="#" onclick="history.back()" class="btn theme-btn successfully w-100">Back</a>
                        </div>
                    </section>
                @endforelse

            </div>
            <!-- login section start -->
            @if ($myTicket->status != Status::TICKET_CLOSE && $myTicket->user)
                <form method="post" class="auth-form" action="{{ route('ticket.reply', $myTicket->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="custom-container">
                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <div class="form-input mb-3">
                                <input type="text" class="form-control" name="message"
                                    placeholder="Enter Message Here" />
                            </div>
                        </div>

                        <button name="replayTicket" value="1" type="submit"
                            class="btn theme-btn w-100">Send</button>
                    </div>
                </form>
            @endif
            <!-- login section start -->
        </div>
    </section>
    <!-- chatting section end -->
@stop
@push('breadcrumb-plugins')
<a href="{{ route('ticket.index') }}" class="back-btn">
    <i class="icon" data-feather="x"></i>
  </a>
@endpush 
