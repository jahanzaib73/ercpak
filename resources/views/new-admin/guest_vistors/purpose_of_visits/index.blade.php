@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Purpose of Visits')

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
    <style>
        table {
            counter-reset: section;
        }

        .count:before {
            counter-increment: section;
            content: counter(section);
        }
    </style>
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purpose of Visits</h4>
                </div>
                <div class="col-lg-12 col-sm-12">
                    @if (Auth::user()->can('Add Purpose of Visit'))
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title pb-3">
                                        @if (isset($data['purposeOfVisit']))
                                            Update Purpose of Visit
                                        @else
                                            Add New Purpose of Visit
                                        @endif
                                    </h5>

                                    <form class="form form-horizontal" method="POST"
                                        action="{{ isset($data['purposeOfVisit']) ? route('purpose-of-visits.update', ['id' => $data['purposeOfVisit']->id]) : route('purpose-of-visits.store') }}">
                                        @csrf
                                        <div class="row">
                                            <!-- Purpose of Visit Input -->
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="purposeOfVisit">Purpose of Visit</label>
                                                    <input type="text"
                                                        value="{{ old('name', isset($data['purposeOfVisit']) ? $data['purposeOfVisit']->name : '') }}"
                                                        class="form-control" name="name" id="purposeOfVisit"
                                                        placeholder="Enter purpose of visit">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Type Dropdown -->
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="type">Select Type</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="">Please select Type</option>
                                                        <option value="VISA"
                                                            {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->type == 'VISA' ? 'selected' : '' }}>
                                                            VISA
                                                        </option>
                                                        <option value="ATTESTATION"
                                                            {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->type == 'ATTESTATION' ? 'selected' : '' }}>
                                                            ATTESTATION
                                                        </option>
                                                    </select>
                                                    @error('type')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Status Dropdown -->
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="status">Select Status</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="1"
                                                            {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->status == 1 ? 'selected' : '' }}>
                                                            Active
                                                        </option>
                                                        <option value="0"
                                                            {{ isset($data['purposeOfVisit']) && $data['purposeOfVisit']->status == 0 ? 'selected' : '' }}>
                                                            In-active
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif


                </div>
                <div class="table-responsive width-95-per mx-auto">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Created By</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['purposeOfVisits'] as $type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($type->user)->full_name }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->type }}</td>
                                    <td><span class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                    <td>
                                        @if (Auth::user()->can('Edit Purpose of Visit'))
                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                href="{{ route('purpose-of-visits.index', ['id' => $type->id]) }}"><i
                                                     data-feather="edit-2" ></i></a>
                                        @endif
                                        @if (Auth::user()->can('Delete Purpose of Visit'))
                                            |
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                                href="{{ route('purpose-of-visits.delete', ['id' => $type->id]) }}"><i
                                                     data-feather="trash" ></i></a>
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

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js
"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js
"></script>
<script src="{{ asset('swal/sweetalert.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            select: true
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('#department_logo').change(function() {
            renderFiles(this.files, 'department_logo_container')
        });

        $('#office_picture').change(function() {
            renderFiles(this.files, 'office_picture_container')
        });

    });


    function renderFiles(files, container) {
        var files = files;
        var container = $('#' + container);
        container.empty();

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var fileContent = e.target.result;
                var fileType = file.type;
                var fileName = file.name;

                var fileElement = $('<div class="col-md-2 mr-2 mb-4" style="font-size: 100px">');

                if (fileType.startsWith('image/')) {
                    fileElement.html('<i  class="mdi mdi-file-document"></i>');
                } else if (fileType === 'application/pdf') {
                    fileElement.html('<i class="mdi mdi-file-document"></i>');
                } else if (fileType === 'application/msword' || fileType ===
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    fileElement.html('<i class="mdi mdi-file-document"></i>');
                } else {
                    fileElement.html('<i class="mdi mdi-file-document"></i>');
                }

                container.append(fileElement);
            };

            reader.readAsDataURL(file);
        }
    }
</script>
