@extends('admin.layouts.app')
@section('panel')
    <div class="row">

      <div class="show-filter mb-3 text-end">
        <button type="button" class="btn btn-outline-danger btn-sm"  data-bs-toggle="modal" data-bs-target="#flushrecord"><i class="fa fa-trash"></i>
            @lang('Flush Inactive User Record')</button>
    </div>

        <div class="card card-body">
            <div class="table-responsive">
              <table class="table search-table align-middle text-nowrap">
                <thead class="header-item">
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Balance</th>
                  <th>Date Joined</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <!-- start row -->
                  @forelse($users as $user)
                  <tr class="search-items">
                    
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}" alt="avatar" class="rounded-circle" width="35" />
                        <div class="ms-3">
                          <div class="user-meta-info">
                            <h6 class="user-name mb-0" data-name="{{ $user->fullname }}"> {{ $user->fullname }}</h6>
                            <span class="user-work fs-3" data-occupation="{{ $user->username }}"> {{ $user->username }}</span>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="usr-email-addr" data-email="{{ $user->email }}">{{ $user->email }}</span>
                    </td>
                    <td>
                      <span class="usr-location" data-mobile="{{ $user->mobile }}">{{ $user->mobile }}</span>
                    </td>
                    <td>
                      <span class="usr-ph-no" data-balance="{{ showAmount($user->balance) }}"> {{ $general->cur_sym }}{{ showAmount($user->balance) }}</span>
                    </td>
                    <td>
                      <span class="usr-ph-no" data-date=""> 
                        {{ showDateTime($user->created_at) }} <br>
                        {{ diffForHumans($user->created_at) }}    
                    </span>
                    </td>
                    <td>
                      <div class="action-btn">
                        <a href="{{ route('admin.users.detail', $user->id) }}" class="text-info edit">
                          <i class="ti ti-eye fs-5"></i>
                        </a> 
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


        <div class="modal fade" id="flushrecord" tabindex="-1" role="dialog" aria-labelledby="flushrecordLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="flushrecordLabel">Delete Incative Users</h5> 
              </div>
              <form action="{{ route('admin.users.banned.flush') }}" method="post">
              @csrf
              <div class="modal-body">
                  <div class='alert alert-danger'>
                      This operation will delete all inactive users within the site. This operation cannot be reversed once completed
                  </div> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Continue</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Username / Email" />
@endpush
