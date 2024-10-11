@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Attachments')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                @if (Auth::user()->can('Add Guest & Visitor Attachment'))
                    <div class="card-header" style="text-align: right">
                        <a href="{{ route('guest-visitor-attachment.create', ['id' => $guestVisitId]) }}"
                            class="btn btn-primary">Add</a>
                    </div>
                @endif
                <div class="table-responsive width-95-per mx-auto">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Attachment</th>
                                <th>Attachment Job#</th>
                                <th>Expiary Date</th>
                                <th>File Name</th>
                                <th>Created By</th>
                                <th>Guest/Visitor Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guestVisitorAttachments as $attachment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ $attachment->file_url }}" target="_blank">
                                            <i class="fa fa-file" style="font-size: 40px"></i>
                                        </a>
                                    </td>

                                    <td>{{ $attachment->id }}</td>
                                    <td>{{ $attachment->expiary_date }}</td>
                                    <td>{{ ucwords($attachment->file_name) }}</td>
                                    <td>{{ optional($attachment->user)->full_name }}</td>
                                    <td>{{ $attachment->guest_visitor_id }}</td>
                                    <td>
                                        <span class="badge badge-{{ $attachment->status == 1 ? 'success' : 'info' }}">
                                            {{ $attachment->status == 1 ? 'Closed' : 'Inprogress' }}</span>
                                    </td>

                                    <td>
                                        @if (Auth::user()->can('Edit Guest & Visitor Attachment'))
                                            <a class="btn bg-info btn-sm edit text-white"
                                                href="{{ route('guest-visitor-attachment.edit', ['id' => $attachment->id]) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg></a>
                                        @endif
                                        @if (Auth::user()->can('Delete Guest & Visitor Attachment'))
                                            |
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                                href="{{ route('guest-visitor-attachment.delete', ['id' => $attachment->id]) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg></a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection
