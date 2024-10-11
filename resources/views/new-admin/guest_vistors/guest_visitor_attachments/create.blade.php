@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Add Attachements')

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
                <div class="col-lg-12 col-sm-12">
                    @if (Auth::user()->can('Add Department'))
                        <div class="card m-b-30">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" enctype="multipart/form-data"
                                    action="{{ route('guest-visitor-attachment.store') }}">
                                    @csrf
                                    <input type="hidden" name="guestVisitId" value="{{ $guestVisitId }}">

                                    <div class="row">
                                        <!-- Expiary Date -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="expiary_date">Expiary Date</label>
                                                <input type="date" name="expiary_date" class="form-control"
                                                    value="{{ old('expiary_date') }}" placeholder="Expiary Date">
                                                @error('expiary_date')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Attachment Name -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="name">Attachment Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}" placeholder="Name">
                                                @error('name')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Select Attachment -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="attachment">Select Attachment</label>
                                                <div class="input-group mb-3 choseFileInputs">
                                                    <input type="file" class="form-control chooser" name="attachment"
                                                        id="attachment">
                                                    <label class="input-group-text bg-danger text-white"
                                                        for="attachment">Browse</label>
                                                </div>
                                                @error('attachment')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div id="attachment_fileContainer"></div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="status">Select Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">Please select status</option>
                                                    <option value="In Process">
                                                        In Process
                                                    </option>
                                                    <option value="Submitted">
                                                        Submitted
                                                    </option>
                                                    <option value="Approved">
                                                        Approved
                                                    </option>
                                                    <option value="Rejected">
                                                        Rejected
                                                    </option>
                                                    <option value="Delivered">
                                                        Delivered
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Notes -->
                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="notes">Notes</label>
                                                <textarea name="notes" id="notes" class="form-control" cols="30" rows="3">{{ old('notes') }}</textarea>
                                                @error('notes')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-12 text-right">
                                            <div class="mb-1">
                                                <input type="checkbox" id="send_sms" name="send_sms" value="1">
                                                <label for="send_sms" class="form-label">Send SMS</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    @endif

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
@section('page_scripts')
    <script>
        $(document).ready(function() {

            $('#attachment').change(function() {
                renderFiles(this.files, 'attachment_fileContainer')
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
@endsection
