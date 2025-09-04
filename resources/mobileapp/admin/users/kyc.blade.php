@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="card card-body">
            <div class="table-responsive">
              <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                  <th>@lang('Customer')</th>
                  <th>@lang('Type')</th>
                  <th>@lang('Date Submited')</th>
                  <th>@lang('Action')</th>
                </thead>
                <tbody>
                  <!-- start row -->
                  @forelse($users as $user)
                  <tr class="search-items">
                    
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}" alt="avatar" class="rounded-circle" width="35" />
                        <div class="ms-3">
                          <a href="{{ route('admin.users.detail', $user->id) }}">
                          <div class="user-meta-info">
                            <h6 class="user-name mb-0" data-name="{{ $user->fullname }}"> {{ $user->fullname }}</h6>
                            <span class="user-work fs-3" data-occupation="{{ $user->username }}"> {{ $user->username }}</span><br>
                            <span class="user-work fs-3" data-occupation="{{ $user->email }}"> {{ $user->email }}</span>
                          </div>
                        </a>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="usr-email-addr" data-email="{{ $user->kyc->type }}">{{ $user->kyc->type }}</span>
                      <br>
                      <a href="{{asset('assets/images/images/kyc')}}/{{$user->username}}/front_kyc_image.png" target="_blank" class="btn btn-sm btn-primary">
                        <i class="ti ti-download fs-5"></i>Front 
                      </a>
                      <a href="{{asset('assets/images/images/kyc')}}/{{$user->username}}/back_kyc_image.png" target="_blank" class="btn btn-sm btn-secondary">
                        <i class="ti ti-download fs-5"></i> Back
                      </a>  
                    </td>
                    
                    <td>
                      <span class="usr-ph-no" data-date=""> 
                        {{ showDateTime(@$user->kyc->date) }} <br>
                        {{ diffForHumans(@$user->kyc->date) }}    
                    </span>
                    </td>
                    <td>
                      <div class="action-btn">
                        @if($user->kyc_complete == 3)
                        <a href="{{ route('admin.users.kyc.approve', $user->id) }}" class="btn btn-sm btn-success">
                         @lang('Approve')
                        </a> 
                        <a href="{{ route('admin.users.kyc.reject', $user->id) }}" class="btn btn-sm btn-danger">
                         @lang('Reject')
                        </a> 
                        @endif
                      </div>
                    </td>
                  </tr>
                  <!-- end row -->
                  @empty
                  {!!emptyData()!!}
                  @endforelse
                </tbody>
              </table>
            </div>
            @if ($users->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($users) }}
            </div>
           @endif
          </div>
        </div>

@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Username / Email" />
@endpush
