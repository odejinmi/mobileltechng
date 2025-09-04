@extends('admin.layouts.app')
@section('panel')
    @push('style')
        <link rel="stylesheet" href="{{ asset('assets/assets/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    @endpush
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <!-- ---------------------
                              start File export
                          ---------------- -->
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="mb-0">{{ $pageTitle }}</h5>
                    </div>
                    <p class="card-subtitle mb-3">
                        @lang('A table showing all the ') {{ $pageTitle }} @lang('on your account. You can export transaction record')
                    </p>
                    <div class="table-responsive">
                        <table id="file_export" class="table border table-striped table-bordered display text-nowrap">
                            <thead>
                                <!-- start row -->
                                <tr>
                                    <th>@lang('Card Pan')</th>
                                    <th>@lang('Brand')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Date Requested')</th>
                                    <th></th>
                                </tr>
                                <!-- end row -->
                            </thead>
                            <tbody>

                                @forelse(@$log as $item)
                                    <tr>
                                        <td>{{ $item->pan }} 
                                        </td>
                                        <td class="break_line">{{ __($item->brand) }}<br>
                                            <small>{{ __($item->currency) }}</small>
                                        </td> 
                                            <td>{{ $item->environment }}</td>
                                            <td>
                                                @if ($item->status == 'active')
                                                <span class="badge bg-success">{{ strToUpper($item->status) }}</span>
                                                @else
                                                <span class="badge bg-warning">{{ strToUpper($item->status) }}</span>
                                                @endif
                                            </td>
                                        <td>{{ showDateTime($item->created_at) }}</td>
                                        <td>
                                            @can(['admin.bills.virtualcard.details'])
                                            <a href="{{route('admin.bills.virtualcard.details',$item->card_id)}}" class="btn btn-sm btn-primary">View Card</a>
                                            @endcan
                                        </td>

                                    </tr>
                                @empty
                                    {!! emptyData2() !!}
                                @endforelse
                                <!-- end row -->
                                <!-- end row -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>@lang('Card Pan')</th>
                                    <th>@lang('Brand')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Date Requested')</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        @if ($log->hasPages())
                            <div class="card-footer">
                                {{ paginateLinks($orders) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- ---------------------
                              end File export
                          ---------------- -->
        @endsection

        @push('breadcrumb-plugins')
            <x-search-form placeholder="Search by Pan" />
            
        @endpush


        @push('script')
            <script src="{{ asset('assets/assets/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('assets/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('assets/assets/dist/js/datatable/datatable-advanced.init.js') }}"></script>
        @endpush
