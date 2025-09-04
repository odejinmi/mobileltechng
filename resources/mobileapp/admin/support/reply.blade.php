@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body ">

                    <h6 class="card-title  mb-4">
                        <div class="row">
                            <div class="col-sm-8 col-md-6">
                                @php echo $ticket->statusBadge; @endphp
                                [@lang('Ticket#'){{ $ticket->ticket }}] {{ $ticket->subject }}
                            </div>
                            <div class="col-sm-4  col-md-6 text-sm-end mt-sm-0 mt-3">
                                @if ($ticket->status != Status::TICKET_CLOSE)
                                    <button class="btn btn-outline-danger btn-sm" type="button" data-bs-toggle="modal"
                                        data-bs-target="#DelModal">
                                        <i class="fa fa-lg fa-times-circle"></i> @lang('Close Ticket')
                                    </button>
                                @endif
                            </div>
                        </div>
                    </h6>
                    <form action="{{ route('admin.ticket.reply', $ticket->id) }}" enctype="multipart/form-data"
                        method="post" class="form-horizontal">
                        @csrf


                        <div class="row ">

                            <div class="position-relative d-flex flex-grow-1 flex-column">
                                <div class="chat-box p-9" style="height: calc(100vh - 442px)" data-simplebar>
                                  <div class="chat-list chat active-chat" data-user-id="1">
                                    @forelse ($messages as $message)
                                    @if ($message->admin_id == 0)
                                    <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                                      <img src="{{ getImage(getFilePath('userProfile') . '/' . $ticket->user->image, getFileSize('userProfile')) }}" alt="user8" width="40" height="40" class="rounded-circle" />
                                      <div>
                                        <h6 class="fs-2 text-muted">{{ diffForHumans($message->created_at) }}</h6>
                                        <div class="p-2 bg-light rounded-1 d-inline-block text-dark fs-3"> {{ $message->message }} </div>
                                        @if ($message->attachments->count() > 0)
                                        <div class="my-3">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('admin.ticket.download', encrypt($image->id)) }}"
                                                    class="me-2"><i class="fa fa-file"></i> @lang('Attachment')
                                                    {{ ++$k }} </a>
                                            @endforeach
                                        </div>
                                        @endif
                                        <button type="button" class="btn btn-outline-danger btn-sm my-3 confirmationBtn"
                                        data-question="@lang('Are you sure to delete this message?')"
                                        data-action="{{ route('admin.ticket.delete', $message->id) }}"><i
                                            class="ti ti-trash"></i> @lang('Delete')</button>
                                      </div>
                                    </div>
                                    @else
                                    <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                                      <div class="text-end">
                                        <h6 class="fs-2 text-muted">{{ diffForHumans($message->created_at) }}</h6>
                                        <div class="p-2 bg-light-info text-dark rounded-1 d-inline-block fs-3"> {{ $message->message }}</div>
                                        @if ($message->attachments->count() > 0)
                                        <div class="my-3">
                                            @foreach ($message->attachments as $k => $image)
                                                <a href="{{ route('admin.ticket.download', encrypt($image->id)) }}"
                                                    class="me-2"><i class="fa fa-file"></i> @lang('Attachment')
                                                    {{ ++$k }} </a>
                                            @endforeach
                                        </div>
                                        @endif
                                        <button type="button" class="btn btn-outline-danger btn-sm my-3 confirmationBtn"
                                        data-question="@lang('Are you sure to delete this message?')"
                                        data-action="{{ route('admin.ticket.delete', $message->id) }}"><i
                                            class="ti ti-trash"></i> @lang('Delete')</button>
                                      </div>
                                    </div>
                                    @endif
                                    @empty
                                    {!!emptyData()!!}
                                    @endforelse
                                     
                                  </div> 
                                </div>
                                <div class="px-9 py-6 border-top chat-send-message-footer">
                                  <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2 w-85">
                                      <a class="position-relative nav-icon-hover z-index-5" href="javascript:void(0)"> <i class="ti ti-mood-smile text-dark bg-hover-primary fs-7"></i></a>
                                      <input type="text" name="message" class="form-control message-type-box text-muted border-0 p-0 ms-2" placeholder="Type a Message" />
                                    </div>
                                    
                                    <ul class="list-unstyledn mb-0 d-flex align-items-center">
                                       <li><a class="extraTicketAttachment text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5 " href="javascript:void(0)"><i class="ti ti-paperclip"></i></a></li>
                                     </ul>
                                  </div>
                                  <br>
                                  <span class="text-danger">@lang('Max 5 files can be uploaded. Maximum upload size is')
                                            {{ ini_get('upload_max_filesize') }}</span>
                                  <div class="d-flex align-items-center gap-2 w-85 mb-2">
                                    <input type="file" name="attachments[]" id="inputAttachments" class="form-control file-upload-field" />
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div id="fileUploadsContainer"></div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <button class="btn btn-outline-primary w-100 mt-4" type="submit" name="replayTicket"
                                            value="1"><i class="la la-fw la-lg la-reply"></i> @lang('Reply')
                                        </button>
                                    </div>
                                </div>
                              </div> 

                              

                             
                        </div>

                    </form>


                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Close Support Ticket!')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you want to close this support ticket?')</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('admin.ticket.close', $ticket->id) }}">
                        @csrf
                        <input type="hidden" name="replayTicket" value="2">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"> @lang('No') </button>
                        <button type="submit" class="btn btn-outline-primary"> @lang('Yes') </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.ticket.index') }}" />
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {
            $('.delete-message').on('click', function(e) {
                $('.message_id').val($(this).data('id'));
            })
            var fileAdded = 0;
            $('.extraTicketAttachment').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="row">
                        <div class="col-9 mb-3">
                            <div class="file-upload-wrapper" data-text="@lang('Select your file!')"><input type="file" name="attachments[]" id="inputAttachments" class="form-control file-upload-field"/></div>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-ouline-danger extraTicketAttachmentDelete"><i class="ti ti-x ms-0"></i></button>
                        </div>
                    </div>
                `)
            });

            $(document).on('click', '.extraTicketAttachmentDelete', function() {
                fileAdded--;
                $(this).closest('.row').remove();
            });
        })(jQuery);
    </script>
@endpush
