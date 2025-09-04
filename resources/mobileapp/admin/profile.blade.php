@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
         

        <div class="col-xl-12 col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 border-bottom pb-2">@lang('Profile Information')</h5>

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf



                        <div class="row">

                            <div class="col-xl-6 col-lg-12 col-md-6">

                                <div class="form-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="mb-0">@lang('Avatar')</h5>
                                            </div>

                                            <div class="text-center">
                                                <img src="{{ getImage(getFilePath('adminProfile') . '/' . $admin->image, getFileSize('adminProfile')) }}"
                                                    alt="image" class="rounded-circle" width="200" />
                                            </div>
                                        </div>
                                    </div>
 
                                </div>

                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label>@lang('Name')</label>
                                    <input class="form-control" type="text" name="name" value="{{ $admin->name }}"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>@lang('Email')</label>
                                    <input class="form-control" type="email" name="email" value="{{ $admin->email }}"
                                        required>
                                </div>

                                <div class="form-group mb-3">
                                    <label>@lang('Avatar')</label>

                                    <input type="file" class="form-control profilePicUpload" name="image"
                                        id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                     <small class="mt-2  ">@lang('Supported files'): <b>@lang('jpeg'),
                                            @lang('jpg').</b> @lang('Image will be resized into 400x400px') </small>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary h-45 w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.password') }}" class="btn btn-sm btn-outline-primary"><i
            class="ti ti-key"></i>@lang('Password Setting')</a>
@endpush
