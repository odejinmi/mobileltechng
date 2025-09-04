@extends('admin.layouts.app')

@section('panel')
    <div class="page-content">
        <div class="container">
            <div class="content-area card">
                <div class="card-innr"> 

                    <div class="rosw match-height">
                        <!-- Company Table Card -->
                        <div class="col-lg-12 col-12">
                          <div class="card card-company-table">
                            <div class="card-body p-0">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Type</th>
                                      <th>User</th>
                                      <th>Amount</th> 
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @forelse ($exchange as $k => $data)

                                    @php 
                                    $card = App\Models\Giftcard::whereId($data->card_id)->first();
                                    $cardtype = App\Models\Giftcardtype::whereId($data->currency)->first();
                                    @endphp
                                    <tr>
                                      <td>
                                        <div class="d-flex align-items-center">
                                          <div class="avatar rounded">
                                            <div class="avatar-content">
                                              <img width="40" src="{{ asset('assets/images/giftcards') }}/{{ @$card->image }}" alt="Toolbar svg" />
                                            </div>
                                          </div>
                                          <div>
                                            <div class="fw-bolder">{{@$card->name}}</div>
                                            <div class="font-small-2 text-muted">{{@$cardtype->name}}</div>
                                            <small>  {{ $data->created_at }}</small>
                                          </div>
                                        </div>
                                      </td> 
                                      <td>
                                        <div class="d-flex align-items-center">
                                          <div class="avatar bg-light-primary me-1">
                                            <div class="avatar-content">
                                              <i data-feather="user" class="font-medium-3"></i>
                                            </div>
                                          </div>
                                          <a href="{{ route('admin.users.detail', $data->user_id) }}">{{@$data->user->username}}</a>
                                        </div>
                                      </td>
                                      <td class="text-nowrap">
                                        <div class="d-flex flex-column">
                                          <span class="fw-bolder mb-25">{{ number_format($data->amount, 2) }}<small>{{$data->country}}</small></span>
                                          <span class="font-small-2 text-muted">{{$data->type}}</span>
                                        </div>
                                      </td> 
                                      <td>
                                        <div class="d-flex align-items-center">
                                          <span class="fw-bolder me-1">
                                            @if ($data->status == 1)
                                            <span
                                                class="dt-type-md badge badge-outline bg-success badge-md">Approved</span>
                                        @elseif($data->status == 2)
                                            <span
                                                class="dt-type-md badge badge-outline bg-danger badge-md">Declined</span> 
                                        @else
                                            <span
                                                class="dt-type-md badge badge-outline bg-warning badge-md">Pending</span>                                         @endif
                                          </span>
                                           
                                        </div>
                                        <a href="{{ route('admin.card-info', $data->id) }}" class="btn btn-light-alt btn-xs btn-icon toggle-tigger">
                                            Manage
                                        </a> 
                                      </td>
                                    </tr>
                                    @empty
                                    Data not found
                                    @endforelse
                                     
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--/ Company Table Card -->
                    

 
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
