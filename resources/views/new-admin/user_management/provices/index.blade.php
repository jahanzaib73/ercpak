@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Provinces')

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
                    <h4 class="card-title">Provinces</h4>
                </div>
                <div class="col-lg-12 col-sm-12">
                    @if (Auth::user()->can('Add Province'))
                    <div class="col-lg-12 col-sm-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <h5 class="header-title pb-3">
                                    @if (isset($data['province']))
                                        Update Province
                                    @else
                                        Add New Province
                                    @endif
                                </h5>
                    
                                <form class="form form-horizontal" method="POST"
                                    action="{{ isset($data['province']) ? route('provinces.update', ['id' => $data['province']->id]) : route('provinces.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="province">Province</label>
                                                <input type="text"
                                                    value="{{ old('name', isset($data['province']) ? $data['province']->name : '') }}"
                                                    class="form-control" name="name" id="province"
                                                    placeholder="Enter province">
                                                @error('name')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                    
                                        <div class="col-md-4 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="country_id">Select Country</label>
                                                <select name="country_id" id="country_id" class="form-control">
                                                    <option value="">Select Country</option>
                                                    @foreach ($data['countries'] as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country_id', isset($data['province']) ? $data['province']->country_id : '') == $country->id ? 'selected' : '' }}>
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                    
                                        <div class="col-md-4 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="status">Select Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1"
                                                        {{ isset($data['province']) && $data['province']->status == 1 ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="0"
                                                        {{ isset($data['province']) && $data['province']->status == 0 ? 'selected' : '' }}>
                                                        In-active
                                                    </option>
                                                </select>
                                                @error('status')
                                                <span class="error">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                    
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
                                <th>Country</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['provinces'] as $type)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($type->user)->full_name }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ optional($type->country)->name }}</td>
                                    <td><span class="badge badge-{{ $type->status == 1 ? 'success' : 'danger' }}">
                                            {{ $type->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                    <td>
                                        @if (Auth::user()->can('Edit Province'))
                                            <a class="btn bg-info btn-sm edit text-white_record text-white"
                                                href="{{ route('provinces.index', ['id' => $type->id]) }}"><i
                                                     data-feather="edit-2" ></i></a>
                                        @endif
                                        @if (Auth::user()->can('Delete Province'))
                                            |
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"
                                                href="{{ route('provinces.delete', ['id' => $type->id]) }}"><i
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
    function initAutocomplete() {
        var options = {
            types: ['geocode'],
            componentRestrictions: {
                country: "pk"
            }
        };

        var input = document.getElementsByClassName('autocomplete');

        for (i = 0; i < input.length; i++) {
            autocomplete = new google.maps.places.Autocomplete(input[i], options);
        }
    }
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&language=en&callback=initAutocomplete"
    async defer></script>
