@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Add Visa')

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
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <form class="form form-horizontal" method="POST" enctype="multipart/form-data"
                                    action="{{ route('visa.store') }}">
                                    @csrf
                                    <input type="hidden" name="guest_visitor_id" value="{{ $guestVisitId }}">

                                    <div class="row">
                                        <!-- Visa Photo -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="photo">Visa Photo</label>
                                                <div class="input-group mb-3 choseFileInputs">
                                                    <input type="file" class="form-control chooser" name="photo"
                                                        id="photo" accept="image/*">
                                                    <label class="input-group-text bg-danger text-white"
                                                        for="photo">Browse</label>
                                                </div>
                                                @error('photo')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Select Attachment (optional) -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="attachment">Select Additional
                                                    Attachment</label>
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

                                        <!-- Name -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="name">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}" placeholder="Full Name">
                                                @error('name')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- CNIC -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="cnic">CNIC</label>
                                                <input type="text" name="cnic" class="form-control"
                                                    value="{{ old('cnic') }}" placeholder="CNIC">
                                                @error('cnic')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Passport Number -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="passport">Passport Number</label>
                                                <input type="text" name="passport" class="form-control"
                                                    value="{{ old('passport') }}" placeholder="Passport Number">
                                                @error('passport')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Expiary Date -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="expiary_date">Date</label>
                                                <input type="date" name="expiary_date" class="form-control"
                                                    value="{{ old('expiary_date') }}" placeholder="Date">
                                                @error('expiary_date')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Expiary Date -->
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="city_id">City</label>
                                                <select class="select2 form-select" name="city_id" id="city_id">
                                                    <option value="">Select City</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')
                                                    <span class="error">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <!-- Additional Notes -->
                                        <div class="col-md-6 col-12">
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
    <script></script>
@endsection