@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Guest and Customer')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
    <link href="{{ asset('assets/css/cropper.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

    <style>
        .card-custom {
            margin-bottom: 10px;
            padding: 15px;
            border: 1px solid #ececec;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1) !important;
            border-radius: 8px;
            background: white;

        }

        .card-custom.active {
            background-color: #d4a05a;
            color: white;
        }

        /* Hide the ul */
        ul#listing-pills-tab {
            display: none;
        }

        .total-guests {
            font-size: 36px;
            font-weight: bold;
        }

        .guest-label {
            font-size: 16px;
        }

        .region-name {
            font-size: 20px;
            font-weight: bold;
        }

        #listing_map .model-green .state .shape {
            fill: #ffffff;
        }

        #regional_map .model-green .state .shape {
            fill: #ffffff;
        }

        table {
            counter-reset: section;
        }

        .count:before {
            counter-increment: section;
            content: counter(section);
        }

        #multiselect .btn.dropdown-toggle.btn-light {
            background: #ffffff;
            border-color: var(--bs-btn-hover-border-color);
        }

        #multiselect .dropdown.bootstrap-select.show-tick {
            width: 100% !important;
        }

        /* Custom dropdown styling */
        #multiselect .dropdown-toggle {
            border-color: var(--bs-btn-hover-border-color) !important;
            /* Matches the color from the image */
            color: black !important;
            /* Dropdown text color */
        }

        #multiselect .dropdown-menu {
            border-color: var(--bs-btn-hover-border-color);
            /* Dropdown border color */
        }

        #multiselect .dropdown-menu .active {
            background-color: var(--bs-btn-hover-border-color) !important;
            /* Active item background */
            color: #fff !important;
            /* Active item text color */
        }

        #multiselect .filter-option-inner-inner {
            color: var(--bs-btn-hover-border-color);
            /* Placeholder color */
        }

        #multiselect .dropdown-menu>.inner>.selected {
            background-color: var(--bs-btn-hover-border-color) !important;
            /* Selected option background color */
            color: #fff !important;
            /* Selected option text color */
        }
    </style>
@endsection

@section('content')
    <!-- Basic Tables start -->
    <div class="row match-height">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="d-flex justify-content-end pt-2">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <button
                                class="nav-link active btn btn-primary me-1 waves-effect waves-float waves-light px-5 my-2 my-sm-0 d-flex"
                                id="inventory-tab" data-bs-toggle="tab" href="#inventory" role="tab"
                                aria-controls="inventory" aria-selected="true">
                                <p class="pb-0 mb-0">Listing</p>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                                class="nav-link btn btn-primary me-1 waves-effect waves-float waves-light my-2 px-5 my-sm-0 d-flex"
                                id="vendors-tab" data-bs-toggle="tab" href="#vendors" role="tab" aria-controls="vendors"
                                aria-selected="false">
                                <p class="pb-0 mb-0">Region</p>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" id="myTabsContent">
                    <div class="tab-pane fade show active" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">


                        <div class="container">
                            <!--                     <h4 class="mt-2 mb-2">Guest & Customers</h4> -->
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        @include('new-admin.guest_vistors._partials._listing_map')
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- @include('new-admin.guest_vistors._partials._pai_chart_state') --}}

                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="mb-3 row">
                                            <div class="align-content-center col-md-4">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="all-records-tab" data-bs-toggle="tab"
                                                            href="#all-records" role="tab" aria-controls="all-records"
                                                            aria-selected="true">All
                                                            Records</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="official-tab" data-bs-toggle="tab"
                                                            href="#official" role="tab" aria-controls="official"
                                                            aria-selected="false">Official</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="notable-tab" data-bs-toggle="tab"
                                                            href="#notable" role="tab" aria-controls="notable"
                                                            aria-selected="false">Notable</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="business-tab" data-bs-toggle="tab"
                                                            href="#business" role="tab" aria-controls="business"
                                                            aria-selected="false">Business</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-8 text-end">
                                                @include('new-admin.guest_vistors._partials._module_button')
                                            </div>
                                            @include('new-admin.guest_vistors._partials._module_modal')
                                            {{-- @if (Auth::user()->can('Add Guest and Visitors'))
                                                    <div class="col-md-5 text-right">
                                                        <a href="{{ route('guest-and-visitors.create', ['module' => App\Models\GuestVistor::GUEST]) }}"
                                                            class="btn save-btn mr-3 btn-sm">Add
                                                            New</a>
                                                    </div>
                                                @endif --}}
                                        </div>


                                        <div class="row mt-3">
                                            <div class="col-3" id="multiselect">
                                                <select id="column-select" class="selectpicker" multiple
                                                    title="Select options">
                                                    <option value="photo" selected>Photo</option>
                                                    <option value="category" selected>Category</option>
                                                    <option value="cnic" selected>CNIC</option>
                                                    <option value="passport" selected>Passport #</option>
                                                    <option value="full-name" selected>Full Name</option>
                                                    <option value="special-field" selected>Special Field</option>
                                                    <option value="residence-address" selected>Residence Address</option>
                                                    <option value="city" selected>City</option>
                                                    <option value="contact" selected>Contact</option>
                                                    <option value="email" selected>Email</option>
                                                    <option value="purpose-of-visit" selected>Purpose Of Visit</option>
                                                    <option value="department" selected>Department</option>
                                                    <option value="sub-department" selected>Sub Department</option>
                                                    <option value="gender" selected>Gender</option>
                                                    <option value="dob" selected>DOB</option>
                                                    <option value="no-visa" selected>Number Of Visa</option>
                                                    <option value="datetime" selected>DateTime</option>
                                                    <option value="attachments" selected>Attachments</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <select id="department" class="select2 form-select">
                                                    <option value="">All Departments</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">
                                                            {{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <select id="subdepartment" class="select2 form-select">
                                                    <option value="">All Sub Departments</option>
                                                    @foreach ($subdepartments as $subdepartment)
                                                        <option value="{{ $subdepartment->id }}">
                                                            {{ $subdepartment->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" id="fp-range" class="form-control flatpickr-range"
                                                    placeholder="Select Date Range" />
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-3">
                                                <button id="deleteSelected" class="btn btn-danger">Delete
                                                    Selected</button>
                                                <button id="exportSelected" class="btn btn-primary">Export
                                                    Selected</button>

                                            </div>

                                        </div>

                                        <div class="tab-content" id="myTabContent">
                                            <!-- All Records Table -->
                                            <div class="tab-pane fade show active" id="all-records" role="tabpanel"
                                                aria-labelledby="all-records-tab">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table id="all-records-table"
                                                                class="ajax-table datatables-basic table table-hover m-b-0"
                                                                style="width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="select-checkbox">Checkbox</th>
                                                                        <th>#</th>
                                                                        <th class="photo">Photo</th>
                                                                        <th class="category">Category</th>
                                                                        <th class="cnic">CNIC</th>
                                                                        <th class="passport">Passport #</th>
                                                                        <th class="full-name">Full Name</th>
                                                                        <th class="special-field">Special Field</th>
                                                                        <th class="residence-address">Residence Address
                                                                        </th>
                                                                        <th class="city">City</th>
                                                                        <th class="contact">Contact</th>
                                                                        <th class="email">Email</th>
                                                                        <th class="purpose-of-visit">Purpose Of Visit</th>
                                                                        <th class="department">Department</th>
                                                                        <th class="sub-department">Sub Department</th>
                                                                        <th class="gender">Gender</th>
                                                                        <th class="dob">DOB</th>
                                                                        <th class="no-visa">Number Of Visa</th>
                                                                        <th class="datetime">DateTime</th>
                                                                        <th class="attachments">Attachments</th>
                                                                        <th>Action</th>
                                                                        <th>Expand</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Official Table -->
                                            <div class="tab-pane fade" id="official" role="tabpanel"
                                                aria-labelledby="official-tab">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table id="official-table"
                                                                class="ajax-table datatables-basic table table-hover m-b-0"
                                                                style="width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="select-checkbox">Checkbox</th>
                                                                        <th>#</th>
                                                                        <th class="photo">Photo</th>
                                                                        <th class="category">Category</th>
                                                                        <th class="cnic">CNIC</th>
                                                                        <th class="passport">Passport #</th>
                                                                        <th class="full-name">Full Name</th>
                                                                        <th class="special-field">Special Field</th>
                                                                        <th class="residence-address">Residence Address
                                                                        </th>
                                                                        <th class="city">City</th>
                                                                        <th class="contact">Contact</th>
                                                                        <th class="email">Email</th>
                                                                        <th class="purpose-of-visit">Purpose Of Visit</th>
                                                                        <th class="department">Department</th>
                                                                        <th class="sub-department">Sub Department</th>
                                                                        <th class="gender">Gender</th>
                                                                        <th class="dob">DOB</th>
                                                                        <th class="no-visa">Number Of Visa</th>
                                                                        <th class="datetime">DateTime</th>
                                                                        <th class="attachments">Attachments</th>
                                                                        <th>Action</th>
                                                                        <th>Expand</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Notable Table -->
                                            <div class="tab-pane fade" id="notable" role="tabpanel"
                                                aria-labelledby="notable-tab">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table id="notable-table"
                                                                class="ajax-table datatables-basic table table-hover m-b-0"
                                                                style="width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="select-checkbox">Checkbox</th>
                                                                        <th>#</th>
                                                                        <th class="photo">Photo</th>
                                                                        <th class="category">Category</th>
                                                                        <th class="cnic">CNIC</th>
                                                                        <th class="passport">Passport #</th>
                                                                        <th class="full-name">Full Name</th>
                                                                        <th class="special-field">Special Field</th>
                                                                        <th class="residence-address">Residence Address
                                                                        </th>
                                                                        <th class="city">City</th>
                                                                        <th class="contact">Contact</th>
                                                                        <th class="email">Email</th>
                                                                        <th class="purpose-of-visit">Purpose Of Visit</th>
                                                                        <th class="department">Department</th>
                                                                        <th class="sub-department">Sub Department</th>
                                                                        <th class="gender">Gender</th>
                                                                        <th class="dob">DOB</th>
                                                                        <th class="no-visa">Number Of Visa</th>
                                                                        <th class="datetime">DateTime</th>
                                                                        <th class="attachments">Attachments</th>
                                                                        <th>Action</th>
                                                                        <th>Expand</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Business Table -->
                                            <div class="tab-pane fade" id="business" role="tabpanel"
                                                aria-labelledby="business-tab">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table id="business-table"
                                                                class="ajax-table datatables-basic table table-hover m-b-0"
                                                                style="width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="select-checkbox">Checkbox</th>
                                                                        <th>#</th>
                                                                        <th class="photo">Photo</th>
                                                                        <th class="category">Category</th>
                                                                        <th class="cnic">CNIC</th>
                                                                        <th class="passport">Passport #</th>
                                                                        <th class="full-name">Full Name</th>
                                                                        <th class="special-field">Special Field</th>
                                                                        <th class="residence-address">Residence Address
                                                                        </th>
                                                                        <th class="city">City</th>
                                                                        <th class="contact">Contact</th>
                                                                        <th class="email">Email</th>
                                                                        <th class="purpose-of-visit">Purpose Of Visit</th>
                                                                        <th class="department">Department</th>
                                                                        <th class="sub-department">Sub Department</th>
                                                                        <th class="gender">Gender</th>
                                                                        <th class="dob">DOB</th>
                                                                        <th class="no-visa">Number Of Visa</th>
                                                                        <th class="datetime">DateTime</th>
                                                                        <th class="attachments">Attachments</th>
                                                                        <th>Action</th>
                                                                        <th>Expand</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">

                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3">District Wise Visits</h5>
                                        <div class="row">
                                            <div class="col-lg-6" style="overflow: hidden">
                                                @include('new-admin.guest_vistors._partials._regional_map')
                                            </div>
                                            <div class="col-lg-6 ">
                                                <div class="row">
                                                    <div class="col-12 mb-5">
                                                        <!-- Search bar -->
                                                        <input type="text" id="searchInput"
                                                            class="form-control mb-3 d-none" placeholder="Search...">

                                                        <!-- Filter tabs -->
                                                        <ul class="nav nav-tabs mb-3">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-bs-toggle="tab"
                                                                    href="#all">All
                                                                    <span id="allCount"
                                                                        class="badge badge-info">{{ (array_key_exists('protocolLiaisons', $allData) ? count($allData['protocolLiaisons']) : 0) + (array_key_exists('customerVisits', $allData) ? count($allData['customerVisits']) : 0) }}</span></a>
                                                            </li>

                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#official">Official
                                                                    <span id="officialCount"
                                                                        class="badge badge-info">{{ count($officials) }}</span></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#notables">Notables
                                                                    <span id="notableCount"
                                                                        class="badge badge-info">{{ count($notables) }}</span></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#business">Business
                                                                    <span id="businessCount"
                                                                        class="badge badge-info">{{ count($businesses) }}</span></a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#customers">Customers
                                                                    <span id="customerCount"
                                                                        class="badge badge-info">{{ count($customerVisits) }}</span></a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content" style="overflow: auto;">
                                                            <!-- All Tab -->
                                                            <div id="all" class="tab-pane fade show active">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label><input type="checkbox" id="exportFilter">
                                                                            Count
                                                                            check</label>
                                                                        <table id="allTable"
                                                                            class="table table-bordered table-responsive-sm small">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Photo
                                                                                    </th>
                                                                                    <th scope="col">Name
                                                                                    </th>
                                                                                    <th scope="col">
                                                                                        Designation
                                                                                    </th>
                                                                                    <th scope="col">
                                                                                        Department
                                                                                    </th>
                                                                                    <th scope="col">Office
                                                                                    </th>
                                                                                    <th scope="col">
                                                                                        Residence
                                                                                    </th>
                                                                                    <th scope="col">Contact
                                                                                        Numbers
                                                                                    </th>
                                                                                    <th scope="col">Visits
                                                                                    </th>
                                                                                    <th scope="col">View
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php $counter = 1; @endphp
                                                                                @if (array_key_exists('protocolLiaisons', $allData))
                                                                                    @foreach ($allData['protocolLiaisons'] as $item)
                                                                                        <tr>
                                                                                            <td>{{ $counter++ }}
                                                                                            </td>
                                                                                            <td><a href="{{ optional($item->officialImage)->file_url ?? '' }}"
                                                                                                    target="_blank"><img
                                                                                                        width="50"
                                                                                                        src="{{ optional($item->officialImage)->file_url ?? '' }}"
                                                                                                        alt="user profile picture"></a>
                                                                                                <p class="d-none">
                                                                                                    {{ optional($item->officialImage)->file_url ?? '' }}
                                                                                                </p>
                                                                                            </td>
                                                                                            <td>{{ $item->official_name ?? ($item->notable_name ?? ($item->company_name ?? '')) }}
                                                                                            </td>
                                                                                            <td>{{ $item->official_designation }}
                                                                                            </td>
                                                                                            <td>{{ optional($item->department)->name }}
                                                                                            </td>
                                                                                            <td>{{ $item->official_address ?? ($item->notable_address ?? ($item->company_address ?? '')) }}
                                                                                            </td>
                                                                                            <td>{{ optional($item->city)->name ?? ($item->company_city ?? '') }}
                                                                                            </td>
                                                                                            <td>{{ $item->phone ?? ($item->company_email ?? '') }}
                                                                                            </td>
                                                                                            <td>{{ $item->visits_count }}
                                                                                            </td>
                                                                                            <td><a href="{{ route('protocol-and-liaisons.show', $item->id) }}"
                                                                                                    title="Show Detail"
                                                                                                    class="btn btn-eye-icon btn-sm edit"><i
                                                                                                        class="fa fa-eye"></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if (array_key_exists('customerVisits', $allData))
                                                                                    @foreach ($allData['customerVisits'] as $item)
                                                                                        <tr>
                                                                                            <td>{{ $counter++ }}
                                                                                            </td>
                                                                                            <td><a href="{{ $item->image_url ?? '' }}"
                                                                                                    target="_blank"><img
                                                                                                        width="50"
                                                                                                        src="{{ $item->image_url ?? '' }}"
                                                                                                        alt="user profile picture"></a>
                                                                                                <p class="d-none">
                                                                                                    {{ $item->image_url ?? '' }}
                                                                                                </p>
                                                                                            </td>
                                                                                            <td>{{ $item->vistor_name }}
                                                                                            </td>
                                                                                            <td></td>
                                                                                            <td>{{ optional($item->department)->name }}
                                                                                            </td>
                                                                                            <td>{{ $item->address }}
                                                                                            </td>
                                                                                            <td>{{ optional($item->city)->name }}
                                                                                            </td>
                                                                                            <td>{{ $item->vistor_contact }}
                                                                                            </td>
                                                                                            <td>{{ $item->customer_visits }}
                                                                                            </td>
                                                                                            <td><a href="{{ route('guest-and-visitors.show', $item->id) }}"
                                                                                                    title="Show Detail"
                                                                                                    class="btn btn-eye-icon btn-sm edit"><i
                                                                                                        class="fa fa-eye"></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @endif
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Official Tab -->
                                                            <div id="official" class="tab-pane fade">
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-3">
                                                                        <select name="department_id" id="department_id"
                                                                            class="form-control">
                                                                            <option value="0">All
                                                                                Departments
                                                                            </option>
                                                                            @foreach ($departments as $department)
                                                                                <option value="{{ $department->id }}"
                                                                                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                                                    {{ $department->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label><input type="checkbox" id="exportFilter">
                                                                            Count
                                                                            check</label>
                                                                        <table id="officialTable"
                                                                            class="table table-bordered table-responsive-sm small">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col">Photo
                                                                                    </th>
                                                                                    <th scope="col">Name
                                                                                    </th>
                                                                                    <th scope="col">
                                                                                        Designation
                                                                                    </th>
                                                                                    <th scope="col">
                                                                                        Department
                                                                                    </th>
                                                                                    <th scope="col">Office
                                                                                    </th>
                                                                                    <th scope="col">
                                                                                        Residence
                                                                                    </th>
                                                                                    <th scope="col">Contact
                                                                                        Numbers
                                                                                    </th>
                                                                                    <th scope="col">Visits
                                                                                    </th>
                                                                                    <th scope="col">View
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($officials as $official)
                                                                                    <tr>
                                                                                        <td><a href="{{ optional($official->officialImage)->file_url ?? '' }}"
                                                                                                target="_blank"><img
                                                                                                    width="50"
                                                                                                    src="{{ optional($official->officialImage)->file_url ?? '' }}"
                                                                                                    alt="user profile picture"></a>
                                                                                            <p class="d-none">
                                                                                                {{ optional($official->officialImage)->file_url ?? '' }}
                                                                                            </p>
                                                                                        </td>
                                                                                        <td>{{ $official->official_name }}
                                                                                        </td>
                                                                                        <td>{{ $official->official_designation }}
                                                                                        </td>
                                                                                        <td>{{ optional($official->department)->name }}
                                                                                        </td>
                                                                                        <td>{{ $official->official_address }}
                                                                                        </td>
                                                                                        <td>{{ optional($official->city)->name }}
                                                                                        </td>
                                                                                        <td>{{ $official->phone ?? '' }}
                                                                                        </td>
                                                                                        <td>{{ $official->visits_count }}
                                                                                        </td>
                                                                                        <td><a href="{{ route('protocol-and-liaisons.show', $official->id) }}"
                                                                                                title="Show Detail"
                                                                                                class="btn btn-eye-icon btn-sm edit"><i
                                                                                                    class="fa fa-eye"></i></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Notables Tab -->
                                                            <div id="notables" class="tab-pane fade">
                                                                <label><input type="checkbox" id="exportFilter">
                                                                    Count
                                                                    check</label>
                                                                <table id="notablesTable"
                                                                    class="table table-bordered table-responsive-sm small">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Photo</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">Designation</th>
                                                                            <th scope="col">Department</th>
                                                                            <th scope="col">Office</th>
                                                                            <th scope="col">Residence</th>
                                                                            <th scope="col">Contact Numbers
                                                                            </th>
                                                                            <th scope="col">Visits</th>
                                                                            <th scope="col">View</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($notables as $notable)
                                                                            <tr>
                                                                                <td><a href="{{ optional($notable->officialImage)->file_url ?? '' }}"
                                                                                        target="_blank"><img
                                                                                            width="50"
                                                                                            src="{{ optional($notable->officialImage)->file_url ?? '' }}"
                                                                                            alt="user profile picture"></a>
                                                                                    <p class="d-none">
                                                                                        {{ optional($notable->officialImage)->file_url ?? '' }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>{{ $notable->notable_name }}
                                                                                </td>
                                                                                <td></td>
                                                                                <td>{{ optional($notable->department)->name ?? '' }}
                                                                                </td>
                                                                                <td>{{ $notable->notable_address }}
                                                                                </td>
                                                                                <td>{{ optional($notable->city)->name ?? '' }}
                                                                                </td>
                                                                                <td>{{ $notable->phone }}</td>
                                                                                <td>{{ $notable->visits_count }}
                                                                                </td>
                                                                                <td><a href="{{ route('protocol-and-liaisons.show', $notable->id) }}"
                                                                                        title="Show Detail"
                                                                                        class="btn btn-eye-icon btn-sm edit"><i
                                                                                            class="fa fa-eye"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <!-- Business Tab -->
                                                            <div id="business" class="tab-pane fade">
                                                                <label><input type="checkbox" id="exportFilter">
                                                                    Count
                                                                    check</label>
                                                                <table id="businessesTable"
                                                                    class="table table-bordered table-responsive-sm small">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Photo</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">Designation</th>
                                                                            <th scope="col">Department</th>
                                                                            <th scope="col">Office</th>
                                                                            <th scope="col">Residence</th>
                                                                            <th scope="col">Contact Numbers
                                                                            </th>
                                                                            <th scope="col">Visits</th>
                                                                            <th scope="col">View</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($businesses as $business)
                                                                            <tr>
                                                                                <td><a href="{{ optional($business->officialImage)->file_url ?? '' }}"
                                                                                        target="_blank"><img
                                                                                            width="50"
                                                                                            src="{{ optional($business->officialImage)->file_url ?? '' }}"
                                                                                            alt="user profile picture"></a>
                                                                                    <p class="d-none">
                                                                                        {{ optional($business->officialImage)->file_url ?? '' }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>{{ $business->company_name }}
                                                                                    (COMPANY)</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>{{ $business->company_address ?? '' }}
                                                                                </td>
                                                                                <td>{{ $business->company_city }}
                                                                                </td>
                                                                                <td>{{ $business->company_email ?? '' }}
                                                                                </td>
                                                                                <td>{{ $business->visits_count }}
                                                                                </td>
                                                                                <td><a href="{{ route('protocol-and-liaisons.show', $business->id) }}"
                                                                                        title="Show Detail"
                                                                                        class="btn btn-eye-icon btn-sm edit"><i
                                                                                            class="fa fa-eye"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                            @foreach ($business->members as $member)
                                                                                <tr>
                                                                                    <td><a href="{{ $member->photo_url ?? '' }}"
                                                                                            target="_blank"><img
                                                                                                width="50"
                                                                                                src="{{ $member->photo_url ?? '' }}"
                                                                                                alt="user profile picture"></a>
                                                                                        <p class="d-none">
                                                                                            {{ $member->photo_url ?? '' }}
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>{{ $member->name }}
                                                                                        (MEMBER)
                                                                                    </td>
                                                                                    <td>{{ $member->Designation }}
                                                                                    </td>
                                                                                    <td>{{ $business->company_name ?? '' }}
                                                                                    </td>
                                                                                    <td>{{ $business->company_address ?? '' }}
                                                                                    </td>
                                                                                    <td>{{ $business->company_city }}
                                                                                    </td>
                                                                                    <td>{{ $member->contact_number ?? '' }}
                                                                                    </td>
                                                                                    <td>{{ $business->visits_count }}
                                                                                    </td>
                                                                                    <td><a href="{{ route('protocol-and-liaisons.show', $business->id) }}"
                                                                                            title="Show Detail"
                                                                                            class="btn btn-eye-icon btn-sm edit"><i
                                                                                                class="fa fa-eye"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <!-- Customers Tab -->
                                                            <div id="customers" class="tab-pane fade">
                                                                <label><input type="checkbox" id="exportFilter">
                                                                    Count
                                                                    check</label>
                                                                <table id="customersTable"
                                                                    class="table table-bordered table-responsive-sm small">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Photo</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">Designation</th>
                                                                            <th scope="col">Department</th>
                                                                            <th scope="col">Office</th>
                                                                            <th scope="col">Residence</th>
                                                                            <th scope="col">Contact Numbers
                                                                            </th>
                                                                            <th scope="col">Visits</th>
                                                                            <th scope="col">View</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($customerVisits as $visit)
                                                                            <tr>
                                                                                <td><a href="{{ $visit->image_url ?? '' }}"
                                                                                        target="_blank"><img
                                                                                            width="50"
                                                                                            src="{{ $visit->image_url ?? '' }}"
                                                                                            alt="user profile picture"></a>
                                                                                    <p class="d-none">
                                                                                        {{ $visit->image_url ?? '' }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>{{ $visit->vistor_name }}
                                                                                </td>
                                                                                <td></td>
                                                                                <td>{{ optional($visit->department)->name }}
                                                                                </td>
                                                                                <td>{{ $visit->address }}</td>
                                                                                <td>{{ optional($visit->city)->name }}
                                                                                </td>
                                                                                <td>{{ $visit->vistor_contact }}
                                                                                </td>
                                                                                <td>{{ $item->customer_visits }}
                                                                                </td>
                                                                                <td><a href="{{ route('guest-and-visitors.show', $visit->id) }}"
                                                                                        title="Show Detail"
                                                                                        class="btn btn-eye-icon btn-sm edit"><i
                                                                                            class="fa fa-eye"></i></a>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
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
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.date.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/picker.time.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/pickadate/legacy.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <!-- Bootstrap Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
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
@section('page-script')
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset('assets/js/cropper.min.js') }}"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY" type="text/javascript">
    </script>
    <script>
        const allVisits = {!! json_encode($allData) !!};
        const moduleName = {!! json_encode($moduleName) !!};
        const guests = {!! json_encode($guests ?? '') !!};
        const visitors = {!! json_encode($visitors ?? '') !!};
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('app_js_functions/protocol_map.js') }}"></script>

    <script>
        function showForm(category) {
            $('#category').val(category);
            $('#specialFieldGroup').show();
            $('#department_ministry').addClass('d-none');
            $('#sub-department_ministry').addClass('d-none');

            if (category === 'OFFICIAL') {
                $('#specialFieldGroup label').text('Designation');
                $('#department_ministry').removeClass('d-none');
                $('#sub-department_ministry').removeClass('d-none');
            } else if (category === 'NOTABLE') {
                $('#specialFieldGroup label').text('Tribe Name');
            } else if (category === 'BUSINESS') {
                $('#specialFieldGroup label').text('Business Name');
            }

            $('#entryFormModal').modal('show');
        }

        $(document).ready(function() {

            // ----------------- IMAGE CROP ---------------------

            let cropper;

            $('#visitor_photo').change(function(event) {
                const files = event.target.files;
                const reader = new FileReader();

                if (files && files.length > 0) {
                    reader.onload = function(e) {
                        $('#photoPreview').attr('src', e.target.result);

                        if (cropper) {
                            cropper.destroy();
                        }

                        cropper = new Cropper($('#photoPreview')[0], {
                            aspectRatio: 1 / 1,
                            viewMode: 1,
                            autoCropArea: 0.8,
                            responsive: true,
                            background: false,
                            cropBoxResizable: true,
                            cropBoxMovable: true,
                            minContainerWidth: 50,
                            minContainerHeight: 400,
                            minCropBoxWidth: 10,
                            minCropBoxHeight: 10,
                        });

                        $('#cropButton').show(); // Show the crop button

                    };

                    reader.readAsDataURL(files[0]);
                }
            });

            $('#cropButton').click(function() {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas();
                    const croppedImage = canvas.toDataURL('image/png');

                    $('#croppedImage').val(croppedImage);

                    // Replace the image with the cropped image
                    $('#photoPreview').attr('src', croppedImage);

                    // Hide the crop button and remove the cropper instance
                    $('#cropButton').hide();
                    cropper.destroy();
                    cropper = null; // Set cropper to null
                }
            });

            // ----------------- END IMAGE CROP ---------------------

            $('#entryForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get form data
                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;

                        if (errors && Object.keys(errors).length > 0) {
                            // There are validation errors
                            $('.error').remove(); // Clear previous errors

                            // Display validation errors
                            for (const [key, value] of Object.entries(errors)) {
                                let element = $('#' + key);

                                if (key === 'croppedImage') {
                                    // For croppedImage, insert the error message after visitor_photo input
                                    $('#visitor_photo').closest('.input-group').after(
                                        '<span class="error"><strong>' + value[0] +
                                        '</strong></span>');
                                } else if (element.is('select')) {
                                    // For Select2, find the original select element and insert the error message
                                    element.next('.select2-container').after(
                                        '<span class="error"><strong>' + value[0] +
                                        '</strong></span>');
                                } else {
                                    // For other form fields
                                    element.after('<span class="error"><strong>' + value[0] +
                                        '</strong></span>');
                                }
                            }
                        } else {
                            $('.error').remove(); // Clear previous errors

                            // If there are no validation errors but still an error occurred
                            alert("Something went wrong!");
                        }
                    }
                });
            });


            // Reset form fields and errors when the modal is shown
            $('#entryFormModal').on('shown.bs.modal', function() {
                $('#entryForm')[0].reset(); // Reset the form fields
                $('.error').remove(); // Remove any validation error messages
                $('#photoPreview').hide(); // Hide the photo preview
                $('#croppedImage').val(''); // Clear the hidden input for cropped image
                $('#cropButton').hide(); // Hide the crop button

                if (cropper) {
                    cropper.destroy(); // Destroy the cropper instance
                    cropper = null; // Set cropper to null
                }
            });

            // Optionally reset form fields and errors when the modal is hidden
            $('#entryFormModal').on('hidden.bs.modal', function() {
                $('#entryForm')[0].reset(); // Reset the form fields
                $('.error').remove(); // Remove any validation error messages
                $('#photoPreview').hide(); // Hide the photo preview
                $('#croppedImage').val(''); // Clear the hidden input for cropped image
                $('#cropButton').hide(); // Hide the crop button

                if (cropper) {
                    cropper.destroy(); // Destroy the cropper instance
                    cropper = null; // Set cropper to null
                }
            });

            // ---------- CNIC LIVE SEARCH -------------
            let ajaxRequest = null;
            $('#cnic').on('input', function() {
                var cnic = $(this).val();
                var category = $('#category').val();

                if (cnic.length > 2) { // Start searching after 3 characters
                    if (ajaxRequest) {
                        ajaxRequest.abort();
                    }
                    // debugger;
                    ajaxRequest = $.ajax({
                        url: "{{ route('guest-and-visitors.searchSuggestion') }}",
                        method: 'GET',
                        data: {
                            cnic: cnic,
                            category: category
                        },
                        success: function(response) {

                            var suggestions = $('#cnic-suggestions');
                            suggestions.empty();
                            if (response.length > 0) {
                                response.forEach(function(cnic) {
                                    suggestions.append(
                                        '<a href="#" class="list-group-item list-group-item-action" data-cnic="' +
                                        cnic + '">' + cnic + '</a>');
                                });
                            } else {
                                suggestions.append(
                                    '<div class="list-group-item">No matches found</div>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#cnic-suggestions').empty();
                }
            });

            // Handle clicking on CNIC suggestions
            $('#cnic-suggestions').on('click', '.list-group-item', function(e) {
                e.preventDefault(); // Prevent the default anchor action

                var cnic = $(this).data('cnic');
                if (ajaxRequest) {
                    ajaxRequest.abort();
                }
                ajaxRequest = $.ajax({
                    url: "{{ route('guest-and-visitors.getDetails') }}",
                    method: 'GET',
                    data: {
                        cnic: cnic
                    },
                    success: function(response) {
                        // Assuming response contains the visitor details
                        $('#cnic').val(response.cnic);
                        $('#passport_number').val(response.passport_number);
                        $('#vistor_name').val(response.vistor_name);
                        $('#specialField').val(response.specialField);
                        $('#address').val(response.address);
                        // Set the value for Select2 and trigger change
                        $('#city_id').val(response.city_id).trigger('change');
                        $('#vistor_contact').val(response.vistor_contact);
                        $('#vistor_email').val(response.vistor_email);
                        // $('#date_time').val(response.date_time);

                        // Handle photo preview if there's an image URL in the response
                        if (response.visitor_photo_url) {
                            $('#photoPreview').attr('src', response.visitor_photo_url).show();
                            $('#croppedImage').val(response.visitor_photo_url);
                        } else {
                            $('#photoPreview').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                // Optionally hide suggestions once a suggestion is clicked
                $('#cnic-suggestions').empty();
            });

            // ---------- END CNIC LIVE SEARCH -------------
        });
    </script>

    <script>
        const listingStateLinks = document.querySelectorAll('#listing_map .model-green .state');
        const listingSelectedDistricts = new Set();
        const listingDistrictMap = new Map();
        const provinceTabs = document.querySelectorAll('#listing-pills-tab .nav-link');
        let selectedProvince = null;
        $(document).ready(function() {
            var categories = {
                official: 'Official',
                notable: 'Notable',
                business: 'Business'
            };

            function initDataTable(id, category) {
                var table = $('#' + id).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('guest-and-visitors.index') }}",
                        data: function(d) {
                            d.moduleNmae = "{{ $moduleName }}";
                            d.districts = Array.from(
                                listingSelectedDistricts); // Use districts from #listing_map
                            d.category = category;
                            d.province = selectedProvince; // Pass the selected province as a filter
                            d.department = $('#department').val();
                            d.sub_department = $('#subdepartment').val();
                            d.daterange = $('#fp-range').val();
                        }
                    },
                    columns: [{
                            data: 'checkbox', // Column for checkboxes
                            name: 'checkbox',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<input type="checkbox" class="select-row" value="' + row
                                    .id + '">';
                            },
                            className: 'select-checkbox'
                        },
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'photo',
                            name: 'photo',
                            className: 'photo'
                        },
                        {
                            data: 'category',
                            name: 'category',
                            className: 'category'
                        },
                        {
                            data: 'cnic',
                            name: 'cnic',
                            className: 'cnic'
                        },
                        {
                            data: 'passport_number',
                            name: 'passport_number',
                            className: 'passport'
                        },
                        {
                            data: 'vistor_name',
                            name: 'vistor_name',
                            className: 'full-name'
                        },
                        {
                            data: 'special_field',
                            name: 'special_field',
                            className: 'special-field'
                        },
                        {
                            data: 'address',
                            name: 'address',
                            className: 'residence-address'
                        },
                        {
                            data: 'city',
                            name: 'city',
                            className: 'city'
                        },
                        {
                            data: 'vistor_contact',
                            name: 'vistor_contact',
                            className: 'contact'
                        },
                        {
                            data: 'vistor_email',
                            name: 'vistor_email',
                            className: 'email'
                        },
                        {
                            data: 'pyrposeOfVisit',
                            name: 'pyrposeOfVisit',
                            className: 'purpose-of-visit'
                        },
                        {
                            data: 'department',
                            name: 'department',
                            className: 'department'
                        },
                        {
                            data: 'sub_department',
                            name: 'sub_department',
                            className: 'sub-department'
                        },
                        {
                            data: 'gender',
                            name: 'gender',
                            className: 'gender'
                        },
                        {
                            data: 'dob',
                            name: 'dob',
                            className: 'dob'
                        },
                        {
                            data: 'no_visa',
                            name: 'no_visa',
                            className: 'no-visa'
                        },
                        {
                            data: 'date_time',
                            name: 'date_time',
                            className: 'datetime'
                        },
                        {
                            data: 'attachments',
                            name: 'attachments',
                            className: 'attachments'
                        },
                        {
                            data: 'action', // Add the action column here
                            name: 'action',
                            orderable: false, // Disable ordering for action buttons
                            searchable: false // Disable searching for action buttons
                        },
                        {
                            data: 'expandable_cnic',
                            name: 'expandable_cnic',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
                $(document).on('click', '#' + id + ' button.toggle-details', function() {
                    console.log('Button clicked'); // This should log when the button is clicked
                    const tr = $(this).closest('tr');
                    const row = table.row(tr); // Use the `table` variable here
                    const cnic = $(this).data('cnic');

                    if (row.child.isShown()) {
                        // Close the row
                        row.child.hide();
                        $(this).text('+');
                    } else {
                        // Open the row and fetch details
                        const btn = this; // Save context to change the button text later
                        $.ajax({
                            url: "{{ route('guest-and-visitors.details') }}", // Ensure this route returns all records for the CNIC
                            data: {
                                cnic: cnic,
                                _token: "{{ csrf_token() }}"
                            },
                            type: 'post',
                            success: function(data) {
                                // Format the details and show them as a child row
                                row.child(formatDetails(data)).show();
                                $(btn).text('-'); // Change button text to "-"
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching details:', error);
                            }
                        });
                    }
                });



                return table;
            }

            // Initialize All Records table with no category filter
            // $('#' + 'all-records-table').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: {
            //         url: "{{ route('guest-and-visitors.index') }}",
            //         data: function(d) {
            //             d.moduleNmae = "{{ $moduleName }}";
            //             d.districts = Array.from(
            //                 listingSelectedDistricts); // Use districts from #listing_map
            //             d.category = null; // No filter for all records
            //             d.province = selectedProvince; // Pass the selected province as a filter
            //             d.department = $('#department').val();
            //             d.subdepartment = $('#subdepartment').val();
            //             d.daterange = $('#fp-range').val();
            //         }
            //     },
            //     columns: [{
            //             data: 'DT_RowIndex',
            //             name: 'DT_RowIndex',
            //             orderable: false,
            //             searchable: false
            //         },
            //         {
            //             data: 'photo',
            //             name: 'photo',
            //             className: 'photo'
            //         },
            //         {
            //             data: 'category',
            //             name: 'category',
            //             className: 'category'
            //         },
            //         {
            //             data: 'cnic',
            //             name: 'cnic',
            //             className: 'cnic'
            //         },
            //         {
            //             data: 'passport_number',
            //             name: 'passport_number',
            //             className: 'passport'
            //         },
            //         {
            //             data: 'vistor_name',
            //             name: 'vistor_name',
            //             className: 'full-name'
            //         },
            //         {
            //             data: 'special_field',
            //             name: 'special_field',
            //             className: 'special-field'
            //         },
            //         {
            //             data: 'address',
            //             name: 'address',
            //             className: 'residence-address'
            //         },
            //         {
            //             data: 'city',
            //             name: 'city',
            //             className: 'city'
            //         },
            //         {
            //             data: 'vistor_contact',
            //             name: 'vistor_contact',
            //             className: 'contact'
            //         },
            //         {
            //             data: 'vistor_email',
            //             name: 'vistor_email',
            //             className: 'email'
            //         },
            //         {
            //             data: 'pyrposeOfVisit',
            //             name: 'pyrposeOfVisit',
            //             className: 'purpose-of-visit'
            //         },
            //         {
            //             data: 'department',
            //             name: 'department',
            //             className: 'department'
            //         },
            //         {
            //             data: 'sub_department',
            //             name: 'sub_department',
            //             className: 'sub-department'
            //         },
            //         {
            //             data: 'gender',
            //             name: 'gender',
            //             className: 'gender'
            //         },
            //         {
            //             data: 'dob',
            //             name: 'dob',
            //             className: 'dob'
            //         },
            //         {
            //             data: 'no_visa',
            //             name: 'no_visa',
            //             className: 'no-visa'
            //         },
            //         {
            //             data: 'date_time',
            //             name: 'date_time',
            //             className: 'datetime'
            //         },
            //         {
            //             data: 'attachments',
            //             name: 'attachments',
            //             className: 'attachments'
            //         },
            //         {
            //             data: 'action', // Add the action column here
            //             name: 'action',
            //             orderable: false, // Disable ordering for action buttons
            //             searchable: false // Disable searching for action buttons
            //         },
            //         {
            //             data: 'expandable_cnic',
            //             name: 'expandable_cnic',
            //             orderable: false,
            //             searchable: false
            //         },
            //     ]
            // });

            // Initialize specific category tables
            initDataTable('all-records-table', null);
            initDataTable('official-table', categories.official);
            initDataTable('notable-table', categories
                .notable);
            initDataTable('business-table', categories.business);

            function formatDetails(data) {
                console.log(data);
                // Create table structure with the same columns as your original table, except the expand button column
                let detailTable = '<table class="table table-bordered"><thead><tr>';
                detailTable += '<th>#</th>';
                detailTable += '<th class="photo">Photo</th>';
                detailTable += '<th class="category">Category</th>';
                detailTable += '<th class="cnic">CNIC</th>';
                detailTable += '<th class="passport">Passport #</th>';
                detailTable += '<th class="full-name">Full Name</th>';
                detailTable += '<th class="special-field">Special Field</th>';
                detailTable += '<th class="residence-address">Residence Address</th>';
                detailTable += '<th class="city">City</th>';
                detailTable += '<th class="contact">Contact</th>';
                detailTable += '<th class="email">Email</th>';
                detailTable += '<th class="purpose-of-visit">Purpose Of Visit</th>';
                detailTable += '<th class="department">Department</th>';
                detailTable += '<th class="sub-department">Sub Department</th>';
                detailTable += '<th class="gender">Gender</th>';
                detailTable += '<th class="dob">DOB</th>';
                detailTable += '<th class="datetime">DateTime</th>';
                detailTable += '<th>Action</th>';
                detailTable += '</tr></thead><tbody>';

                // Loop through each item in `data` and construct the corresponding row
                data.forEach(function(detail, index) {
                    detailTable += '<tr>';
                    detailTable += '<td>' + (index + 1) + '</td>';

                    // Photo column with image and link
                    detailTable += '<td class="photo"><a href="' + detail.image_url +
                        '" target="_blank"><img width="50" src="' + detail.image_url + '"></a></td>';

                    // Add other columns
                    detailTable += '<td class="category">' + detail.category + '</td>';
                    detailTable += '<td class="cnic">' + detail.cnic + '</td>';
                    detailTable += '<td class="passport">' + detail.passport_number + '</td>';
                    detailTable += '<td class="full-name">' + detail.vistor_name + '</td>';
                    detailTable += '<td class="special-field">' + detail.special_field + '</td>';
                    detailTable += '<td class="residence-address">' + detail.address + '</td>';
                    detailTable += '<td class="city">' + detail.city.name + '</td>';
                    detailTable += '<td class="contact">' + detail.vistor_contact + '</td>';
                    detailTable += '<td class="email">' + detail.vistor_email + '</td>';
                    detailTable += '<td class="purpose-of-visit">' + detail.pyrpose_of_visit.name + '</td>';
                    detailTable += '<td class="department">' + detail.department.name + '</td>';
                    detailTable += '<td class="sub-department">' + detail.subdepartment.name + '</td>';
                    detailTable += '<td class="gender">' + detail.gender + '</td>';
                    detailTable += '<td class="dob">' + detail.dob + '</td>';
                    detailTable += '<td class="datetime">' + detail.date_time + '</td>';

                    // Action column with dropdown for edit, delete, and other actions
                    detailTable += '<td><div class="dropdown">';
                    detailTable +=
                        '<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">';
                    detailTable +=
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>';
                    detailTable += '</button>';
                    detailTable += '<div class="dropdown-menu dropdown-menu-end">';
                    detailTable += '<a class="dropdown-item" href="' + detail.edit_url +
                        '"><i data-feather="edit-2"></i><span>Edit</span></a>';
                    detailTable += '<a class="dropdown-item" href="' + detail.delete_url +
                        '" onclick="return confirm(\'Are you sure?\')"><i data-feather="trash"></i><span>Delete</span></a>';
                    detailTable += '<a class="dropdown-item" href="' + detail.attachment_url +
                        '"><i data-feather="paperclip"></i><span>Add Attachments</span></a>';
                    detailTable += '<a class="dropdown-item" href="' + detail.view_visa_url +
                        '"><i data-feather="paperclip"></i><span>View Visa</span></a>';
                    detailTable += '</div></div></td>';

                    detailTable += '</tr>';
                });

                detailTable += '</tbody></table>';
                return detailTable;
            }


        });

        // FILTRATION + EXPORT TO EXCEL
        // $(document).ready(function() {

        //     // Destroy and reinitialize DataTable on page load
        //     if ($.fn.DataTable.isDataTable('.table')) {
        //         $('.table').DataTable().destroy();
        //     }

        //     var table = $('.table').DataTable({
        //         dom: 'Bfrtip',
        //         buttons: [{
        //             processing: true,
        //             text: '<div style="height: 30px;width: 70px;" class="d-flex justify-content-center"><div class="loader"></div><span class="excel-text h4">Excel</span></div>',
        //             action: function(e, dt, button, config) {
        //                 $(".excel-text").hide();
        //                 $(".loader").show();

        //                 var workbook = new ExcelJS.Workbook();
        //                 var worksheet = workbook.addWorksheet('Sheet1');
        //                 var exportFilter = $('#exportFilter').is(':checked');

        //                 // Determine if the # column is present
        //                 var hasHashColumn = dt.column(0).header().innerText === '#';
        //                 var photoColumnIndex = hasHashColumn ? 1 : 0;

        //                 // Add headers with styling, excluding the 2nd and last columns
        //                 var headerData = dt.buttons.exportData().header.filter((header,
        //                         index) => index !== dt.buttons.exportData().header.length -
        //                     1);
        //                 var headerRow = worksheet.addRow(headerData);
        //                 headerRow.eachCell(function(cell, colNumber) {
        //                     cell.font = {
        //                         bold: true
        //                     };
        //                     cell.fill = {
        //                         type: 'pattern',
        //                         pattern: 'solid',
        //                         fgColor: {
        //                             argb: 'FFCCCCCC'
        //                         }
        //                     }; // Light grey background
        //                 });

        //                 var imagePromises = [];
        //                 var rowsData = [];

        //                 // Process rows and images, excluding the 2nd and last columns
        //                 dt.buttons.exportData().body.forEach(function(row, rowIndex) {
        //                     var visits = parseInt(row[8]);
        //                     if (!exportFilter || visits > 0) {
        //                         var excelRow = [];
        //                         row.forEach(function(cell, cellIndex) {
        //                             // Exclude the last column (index row.length - 1)
        //                             if (cellIndex !== row.length - 1) {
        //                                 if (cellIndex === photoColumnIndex) {
        //                                     // Extract the image URL from the cell
        //                                     var imageUrl = cell;

        //                                     // Create a promise to fetch the image
        //                                     var imagePromise = fetch(imageUrl)
        //                                         .then(response => response
        //                                             .blob())
        //                                         .then(blob => new Promise((
        //                                             resolve, reject
        //                                         ) => {
        //                                             var reader =
        //                                                 new FileReader();
        //                                             reader.onloadend =
        //                                                 function() {
        //                                                     var base64data =
        //                                                         reader
        //                                                         .result
        //                                                         .split(
        //                                                             ','
        //                                                         )[
        //                                                             1];
        //                                                     var extension =
        //                                                         blob
        //                                                         .type
        //                                                         .split(
        //                                                             '/'
        //                                                         )[
        //                                                             1
        //                                                         ]; // Get the image extension
        //                                                     resolve({
        //                                                         base64data,
        //                                                         extension
        //                                                     });
        //                                                 };
        //                                             reader.onerror =
        //                                                 reject;
        //                                             reader
        //                                                 .readAsDataURL(
        //                                                     blob);
        //                                         }));

        //                                     // Add the promise to the array
        //                                     imagePromises.push(imagePromise);

        //                                     // Add a placeholder for the image
        //                                     excelRow.push('');
        //                                 } else {
        //                                     excelRow.push(cell);
        //                                 }
        //                             }
        //                         });
        //                         rowsData.push(excelRow);
        //                     }
        //                 });

        //                 // Wait for all image promises to resolve and then add images to the worksheet
        //                 Promise.all(imagePromises).then(images => {
        //                     rowsData.forEach((excelRow, rowIndex) => {
        //                         var row = worksheet.addRow(excelRow);

        //                         // Adjust row height based on the content length
        //                         row.height = Math.max(50, ...excelRow.map(
        //                             cell => cell.toString().length));
        //                     });

        //                     images.forEach((image, key) => {
        //                         var imageId = workbook.addImage({
        //                             base64: image.base64data,
        //                             extension: image.extension
        //                         });

        //                         // Add the image to the worksheet at the specified position
        //                         worksheet.addImage(imageId, {
        //                             tl: {
        //                                 col: photoColumnIndex,
        //                                 row: key + 1
        //                             },
        //                             ext: {
        //                                 width: 50,
        //                                 height: 50
        //                             }
        //                         });
        //                     });

        //                     // Adjust column widths based on the maximum length of content
        //                     worksheet.columns.forEach(column => {
        //                         var maxLength = 10; // Default length
        //                         column.eachCell({
        //                             includeEmpty: false
        //                         }, function(cell) {
        //                             if (cell.value != null) {
        //                                 if (cell.value.toString()
        //                                     .length >= maxLength) {
        //                                     maxLength = cell.value
        //                                         .toString().length;
        //                                 }
        //                             }
        //                         });
        //                         column.width = maxLength + 5;
        //                     });

        //                     // Generate a random name for the download
        //                     var timestamp = new Date().toISOString().replace(/[-:T.]/g,
        //                         '');
        //                     var fileName = `DataTableExport_${timestamp}.xlsx`;

        //                     // Download the workbook once all images are added
        //                     workbook.xlsx.writeBuffer().then(function(buffer) {
        //                         var blob = new Blob([buffer], {
        //                             type: 'application/octet-stream'
        //                         });
        //                         var url = URL.createObjectURL(blob);
        //                         var a = document.createElement('a');
        //                         a.href = url;
        //                         a.download = fileName;
        //                         document.body.appendChild(a);
        //                         a.click();
        //                         document.body.removeChild(a);
        //                         URL.revokeObjectURL(url);

        //                         $(".loader").hide();
        //                         $(".excel-text").show();
        //                     }).catch(error => {
        //                         alert("Something went wrong!");
        //                         console.error('Error:', error);
        //                         $(".loader").hide();
        //                         $(".excel-text").show();
        //                     });
        //                 }).catch(error => {
        //                     alert("Something went wrong!");
        //                     console.error('Error:', error);
        //                     $(".loader").hide();
        //                     $(".excel-text").show();
        //                 });
        //             }
        //         }]
        //     });

        //     const stateLinks = document.querySelectorAll('#regional_map .model-green .state');
        //     const selectedDistricts = new Set();
        //     const districtMap = new Map();

        //     // Add event listener for department dropdown
        //     $('#department_id').on('change', function() {
        //         const selectedDepartment = $(this).val();
        //         const activeProvinceName = $('#pills-tab button.active').data('name');
        //         updateFilterVisits(activeProvinceName,
        //             selectedDepartment); // Pass selected department to the update function
        //     });

        //     $('#pills-tab button').on('click', function() {
        //         var provinceName = $(this).data('name');
        //         clearSelectedStates();
        //         updateFilterVisits(provinceName, $('#department_id')
        //             .val()); // Pass selected department to the update function
        //     });

        //     function clearSelectedStates() {
        //         stateLinks.forEach(link => {
        //             $(link).removeClass('selected');
        //         });
        //         selectedDistricts.clear();
        //     }

        //     // Function to filter visits based on selected provinces
        //     function filterVisits(provinceName = null, selectedCities = [], selectedDepartment = null) {
        //         $.ajax({
        //             url: '{{ route('guest-and-visitors.filter-visits.ajax') }}',
        //             method: 'GET',
        //             data: {
        //                 cities: selectedCities,
        //                 province: provinceName,
        //                 department: selectedDepartment // Include department in request
        //             },
        //             success: function(response) {
        //                 let allCount = (response.allData ? response.allData.length : 0);
        //                 let officialCount = response.officials ? response.officials.length : 0;
        //                 let notableCount = response.notables ? response.notables.length : 0;
        //                 let businessCount = response.businesses ? response.businesses.length : 0;
        //                 let customerCount = response.customers ? response.customers.length : 0;

        //                 // Update the badge text
        //                 $('#allCount').text(allCount);
        //                 $('#officialCount').text(officialCount);
        //                 $('#notableCount').text(notableCount);
        //                 $('#businessCount').text(businessCount);
        //                 $('#customerCount').text(customerCount);
        //                 $('.table').DataTable().destroy();
        //                 // Clear existing data
        //                 $('.table tbody').empty();
        //                 // Populate new data
        //                 $.each(response.allData, function(key, item) {
        //                     if (item.vistor_name) {
        //                         $('#allTable tbody').append(
        //                             '<tr>' +
        //                             '<td>' + (key + 1) + '</td>' +
        //                             '<td><a href="' + (item.image_url ?? '') +
        //                             '" target="_blank">' +
        //                             '<img width="50" src="' + (item.image_url ?? '') +
        //                             '" alt="user profile picture"></a>' +
        //                             '<p class="d-none">' + (item.image_url ?? '') + '</p>' +
        //                             '</td>' +
        //                             '<td>' + item.vistor_name + ' (CUSTOMER)' + '</td>' +
        //                             '<td>' + '' + '</td>' +
        //                             '<td>' + (item.department ? item.department.name :
        //                                 '') +
        //                             '</td>' +
        //                             '<td>' + item.address + '</td>' +
        //                             '<td>' + (item.city ? item.city.name : '') + '</td>' +
        //                             '<td>' + item.vistor_contact + '</td>' +
        //                             '<td>' + item.customer_visits + '</td>' +
        //                             '<td><a href="{{ route('guest-and-visitors.show', '') }}/' +
        //                             item.id +
        //                             '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
        //                             '</tr>'
        //                         );
        //                     } else {
        //                         $('#allTable tbody').append(
        //                             '<tr>' +
        //                             '<td>' + (key + 1) + '</td>' +
        //                             '<td><a href="' + (item.official_image ?
        //                                 item.official_image.file_url :
        //                                 '') + '" target="_blank">' +
        //                             '<img width="50" src="' + (item.official_image ? item
        //                                 .official_image.file_url :
        //                                 '') +
        //                             '" alt="user profile picture"></a>' +
        //                             '<p class="d-none">' + (item.official_image ? item
        //                                 .official_image.file_url :
        //                                 '') + '</p>' + '</td>' +
        //                             '<td>' + (item.official_name ?? (item.notable_name ?? (
        //                                 item
        //                                 .company_name ?? ''))) + '</td>' +
        //                             '<td>' + (item.official_designation ?? '') +
        //                             '</td>' +
        //                             '<td>' + (item.department ? item.department.name :
        //                                 '') + '</td>' +
        //                             '<td>' + (item.official_address ?? (item
        //                                 .notable_address ??
        //                                 (item.company_address ?? ''))) + '</td>' +
        //                             '<td>' + (item.city ? item.city.name : item
        //                                 .company_city ??
        //                                 '') +
        //                             '</td>' +
        //                             '<td>' + (item.phone ?? (item.company_email ?? '')) +
        //                             '</td>' +
        //                             '<td>' + (item.visits_count ?? '') + '</td>' +
        //                             '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
        //                             item.id +
        //                             '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
        //                             '</tr>'
        //                         );
        //                     }
        //                 });

        //                 $.each(response.officials, function(key, official) {
        //                     $('#officialTable tbody').append(
        //                         '<tr>' +
        //                         '<td><a href="' + (official.official_image ?
        //                             official.official_image.file_url :
        //                             '') + '" target="_blank">' +
        //                         '<img width="50" src="' + (official.official_image ?
        //                             official.official_image.file_url :
        //                             '') +
        //                         '" alt="user profile picture"></a>' +
        //                         '<p class="d-none">' + (official.official_image ?
        //                             official.official_image.file_url :
        //                             '') + '</p>' + '</td>' +
        //                         '<td>' + official.official_name + '</td>' +
        //                         '<td>' + (official.official_designation ?? '') +
        //                         '</td>' +
        //                         '<td>' + (official.department ? official.department.name :
        //                             '') + '</td>' +
        //                         '<td>' + (official.official_address ?? '') + '</td>' +
        //                         '<td>' + (official.city ? official.city.name : '') +
        //                         '</td>' +
        //                         '<td>' + official.phone + '</td>' +
        //                         '<td>' + (official.visits_count ?? '') + '</td>' +
        //                         '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
        //                         official.id +
        //                         '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
        //                         '</tr>'
        //                     );
        //                 });
        //                 $.each(response.notables, function(key, notable) {
        //                     $('#notablesTable tbody').append(
        //                         '<tr>' +
        //                         '<td><a href="' + (notable.official_image ?
        //                             notable.official_image.file_url :
        //                             '') + '" target="_blank">' +
        //                         '<img width="50" src="' + (notable.official_image ? notable
        //                             .official_image.file_url :
        //                             '') +
        //                         '" alt="user profile picture"></a>' +
        //                         '<p class="d-none">' + (notable.official_image ? notable
        //                             .official_image.file_url :
        //                             '') + '</p>' + '</td>' +
        //                         '<td>' + notable.notable_name + '</td>' +
        //                         '<td>' + '' + '</td>' +
        //                         '<td>' + (notable.department ? notable.department.name :
        //                             '') + '</td>' +
        //                         '<td>' + (notable.notable_address ?? '') + '</td>' +
        //                         '<td>' + (notable.city ? notable.city.name : '') + '</td>' +
        //                         '<td>' + notable.phone + '</td>' +
        //                         '<td>' + (notable.visits_count ?? '') + '</td>' +
        //                         '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
        //                         notable.id +
        //                         '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
        //                         '</tr>'
        //                     );
        //                 });
        //                 $.each(response.businesses, function(key, business) {
        //                     $('#businessesTable tbody').append(
        //                         '<tr>' +
        //                         '<td><a href="' + (business.official_image ?
        //                             business.official_image.file_url :
        //                             '') + '" target="_blank">' +
        //                         '<img width="50" src="' + (business.official_image ?
        //                             business
        //                             .official_image.file_url :
        //                             '') +
        //                         '" alt="user profile picture"></a>' +
        //                         '<p class="d-none">' + (business.official_image ?
        //                             business.official_image.file_url :
        //                             '') + '</p>' + '</td>' +
        //                         '<td>' + business.company_name + ' (COMPANY)</td>' +
        //                         '<td>' + '' + '</td>' +
        //                         '<td>' + '' + '</td>' +
        //                         '<td>' + business.company_address + '</td>' +
        //                         '<td>' + business.company_city + '</td>' +
        //                         '<td>' + (business.company_email ?? '') + '</td>' +
        //                         '<td>' + business.visits_count + '</td>' +
        //                         '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
        //                         business.id +
        //                         '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
        //                         '</tr>'
        //                     );
        //                     if (business.members) {
        //                         $.each(business.members, function(key, member) {
        //                             $('#businessesTable tbody').append(
        //                                 '<tr>' +
        //                                 '<td><a href="' + (member.photo_url ?? '') +
        //                                 '" target="_blank">' +
        //                                 '<img width="50" src="' + (member
        //                                     .photo_url ?? '') +
        //                                 '" alt="user profile picture"></a>' +
        //                                 '<p class="d-none">' + (member.photo_url ??
        //                                     '') + '</p>' + '</td>' +
        //                                 '<td>' + member.name + ' (MEMBER)</td>' +
        //                                 '<td>' + member.Designation + '</td>' +
        //                                 '<td>' + business.company_name + '</td>' +
        //                                 '<td>' + business.company_address +
        //                                 '</td>' +
        //                                 '<td>' + business.company_city + '</td>' +
        //                                 '<td>' + (member.contact_number ?? '') +
        //                                 '</td>' +
        //                                 '<td>' + business.visits_count + '</td>' +
        //                                 '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
        //                                 business.id +
        //                                 '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
        //                                 '</tr>'
        //                             );
        //                         });
        //                     }

        //                 });
        //                 $.each(response.customers, function(key, visit) {
        //                     $('#customersTable tbody').append(
        //                         '<tr>' +
        //                         '<td><a href="' + (visit.image_url ?? '') +
        //                         '" target="_blank">' +
        //                         '<img width="50" src="' + (visit.image_url ?? '') +
        //                         '" alt="user profile picture"></a>' +
        //                         '<p class="d-none">' + (visit.image_url ?? '') + '</p>' +
        //                         '</td>' +
        //                         '<td>' + visit.vistor_name + ' (CUSTOMER)' + '</td>' +
        //                         '<td>' + '' + '</td>' +
        //                         '<td>' + (visit.department ? visit.department.name : '') +
        //                         '</td>' +
        //                         '<td>' + visit.address + '</td>' +
        //                         '<td>' + (visit.city ? visit.city.name : '') + '</td>' +
        //                         '<td>' + visit.vistor_contact + '</td>' +
        //                         '<td>' + visit.customer_visits + '</td>' +
        //                         '<td><a href="{{ route('guest-and-visitors.show', '') }}/' +
        //                         visit.id +
        //                         '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
        //                         '</tr>'
        //                     );
        //                 });
        //                 // Reinitialize DataTable
        //                 $('.table').DataTable({
        //                     dom: 'Bfrtip',
        //                     buttons: [{
        //                         processing: true,
        //                         text: '<div style="height: 30px;width: 70px;" class="d-flex justify-content-center"><div class="loader"></div><span class="excel-text h4">Excel</span></div>',
        //                         action: function(e, dt, button, config) {
        //                             $(".excel-text").hide();
        //                             $(".loader").show();

        //                             var workbook = new ExcelJS.Workbook();
        //                             var worksheet = workbook.addWorksheet('Sheet1');
        //                             var exportFilter = $('#exportFilter').is(
        //                                 ':checked');

        //                             // Determine if the # column is present
        //                             var hasHashColumn = dt.column(0).header()
        //                                 .innerText === '#';
        //                             var photoColumnIndex = hasHashColumn ? 1 : 0;

        //                             // Add headers with styling, excluding the 2nd and last columns
        //                             var headerData = dt.buttons.exportData().header
        //                                 .filter((header,
        //                                         index) => index !== dt.buttons
        //                                     .exportData().header.length - 1);
        //                             var headerRow = worksheet.addRow(headerData);
        //                             headerRow.eachCell(function(cell, colNumber) {
        //                                 cell.font = {
        //                                     bold: true
        //                                 };
        //                                 cell.fill = {
        //                                     type: 'pattern',
        //                                     pattern: 'solid',
        //                                     fgColor: {
        //                                         argb: 'FFCCCCCC'
        //                                     }
        //                                 }; // Light grey background
        //                             });

        //                             var imagePromises = [];
        //                             var rowsData = [];

        //                             // Process rows and images, excluding the 2nd and last columns
        //                             dt.buttons.exportData().body.forEach(function(
        //                                 row, rowIndex) {
        //                                 var visits = parseInt(row[8]);
        //                                 if (!exportFilter || visits > 0) {
        //                                     var excelRow = [];
        //                                     row.forEach(function(cell,
        //                                         cellIndex) {
        //                                         // Exclude the last column (index row.length - 1)
        //                                         if (cellIndex !==
        //                                             row.length - 1
        //                                         ) {
        //                                             if (cellIndex ===
        //                                                 photoColumnIndex
        //                                             ) {
        //                                                 // Extract the image URL from the cell
        //                                                 var imageUrl =
        //                                                     cell;

        //                                                 // Create a promise to fetch the image
        //                                                 var imagePromise =
        //                                                     fetch(
        //                                                         imageUrl
        //                                                     )
        //                                                     .then(
        //                                                         response =>
        //                                                         response
        //                                                         .blob()
        //                                                     )
        //                                                     .then(
        //                                                         blob =>
        //                                                         new Promise(
        //                                                             (
        //                                                                 resolve,
        //                                                                 reject
        //                                                             ) => {
        //                                                                 var reader =
        //                                                                     new FileReader();
        //                                                                 reader
        //                                                                     .onloadend =
        //                                                                     function() {
        //                                                                         var base64data =
        //                                                                             reader
        //                                                                             .result
        //                                                                             .split(
        //                                                                                 ','
        //                                                                             )[
        //                                                                                 1
        //                                                                             ];
        //                                                                         var extension =
        //                                                                             blob
        //                                                                             .type
        //                                                                             .split(
        //                                                                                 '/'
        //                                                                             )[
        //                                                                                 1
        //                                                                             ]; // Get the image extension
        //                                                                         resolve
        //                                                                             ({
        //                                                                                 base64data,
        //                                                                                 extension
        //                                                                             });
        //                                                                     };
        //                                                                 reader
        //                                                                     .onerror =
        //                                                                     reject;
        //                                                                 reader
        //                                                                     .readAsDataURL(
        //                                                                         blob
        //                                                                     );
        //                                                             }
        //                                                         )
        //                                                     );

        //                                                 // Add the promise to the array
        //                                                 imagePromises
        //                                                     .push(
        //                                                         imagePromise
        //                                                     );

        //                                                 // Add a placeholder for the image
        //                                                 excelRow
        //                                                     .push(
        //                                                         '');
        //                                             } else {
        //                                                 excelRow
        //                                                     .push(
        //                                                         cell
        //                                                     );
        //                                             }
        //                                         }
        //                                     });
        //                                     rowsData.push(excelRow);
        //                                 }
        //                             });

        //                             // Wait for all image promises to resolve and then add images to the worksheet
        //                             Promise.all(imagePromises).then(images => {
        //                                 rowsData.forEach((excelRow,
        //                                     rowIndex) => {
        //                                     var row = worksheet
        //                                         .addRow(excelRow);

        //                                     // Adjust row height based on the content length
        //                                     row.height = Math.max(
        //                                         50, ...excelRow
        //                                         .map(
        //                                             cell => cell
        //                                             .toString()
        //                                             .length));
        //                                 });

        //                                 images.forEach((image, key) => {
        //                                     var imageId = workbook
        //                                         .addImage({
        //                                             base64: image
        //                                                 .base64data,
        //                                             extension: image
        //                                                 .extension
        //                                         });

        //                                     // Add the image to the worksheet at the specified position
        //                                     worksheet.addImage(
        //                                         imageId, {
        //                                             tl: {
        //                                                 col: photoColumnIndex,
        //                                                 row: key +
        //                                                     1
        //                                             },
        //                                             ext: {
        //                                                 width: 50,
        //                                                 height: 50
        //                                             }
        //                                         });
        //                                 });

        //                                 // Adjust column widths based on the maximum length of content
        //                                 worksheet.columns.forEach(
        //                                     column => {
        //                                         var maxLength =
        //                                             10; // Default length
        //                                         column.eachCell({
        //                                             includeEmpty: false
        //                                         }, function(
        //                                             cell) {
        //                                             if (cell
        //                                                 .value !=
        //                                                 null) {
        //                                                 if (cell
        //                                                     .value
        //                                                     .toString()
        //                                                     .length >=
        //                                                     maxLength
        //                                                 ) {
        //                                                     maxLength
        //                                                         =
        //                                                         cell
        //                                                         .value
        //                                                         .toString()
        //                                                         .length;
        //                                                 }
        //                                             }
        //                                         });
        //                                         column.width =
        //                                             maxLength + 5;
        //                                     });

        //                                 // Generate a random name for the download
        //                                 var timestamp = new Date()
        //                                     .toISOString().replace(
        //                                         /[-:T.]/g,
        //                                         '');
        //                                 var fileName =
        //                                     `DataTableExport_${timestamp}.xlsx`;

        //                                 // Download the workbook once all images are added
        //                                 workbook.xlsx.writeBuffer().then(
        //                                     function(buffer) {
        //                                         var blob = new Blob([
        //                                             buffer
        //                                         ], {
        //                                             type: 'application/octet-stream'
        //                                         });
        //                                         var url = URL
        //                                             .createObjectURL(
        //                                                 blob);
        //                                         var a = document
        //                                             .createElement('a');
        //                                         a.href = url;
        //                                         a.download = fileName;
        //                                         document.body
        //                                             .appendChild(a);
        //                                         a.click();
        //                                         document.body
        //                                             .removeChild(a);
        //                                         URL.revokeObjectURL(
        //                                             url);

        //                                         $(".loader").hide();
        //                                         $(".excel-text").show();
        //                                     }).catch(error => {
        //                                     alert(
        //                                         "Something went wrong!"
        //                                     );
        //                                     console.error('Error:',
        //                                         error);
        //                                     $(".loader").hide();
        //                                     $(".excel-text").show();
        //                                 });
        //                             }).catch(error => {
        //                                 alert("Something went wrong!");
        //                                 console.error('Error:', error);
        //                                 $(".loader").hide();
        //                                 $(".excel-text").show();
        //                             });
        //                         }
        //                     }]
        //                 });
        //             }
        //         });
        //     }

        //     function updateFilterVisits(provinceName = null, selectedDepartment = null) {
        //         const selectedCities = Array.from(document.querySelectorAll(
        //                 '#regional_map .model-green .state.selected'))
        //             .map(link => link.id.split("_").filter(part => part !== "state").join(" "));

        //         // Use a Set to filter out duplicate cities
        //         const uniqueSelectedCities = [...new Set(selectedCities)];

        //         filterVisits(provinceName, uniqueSelectedCities, selectedDepartment);
        //     }

        //     // Highlight the selected districts
        //     stateLinks.forEach(link => {
        //         const districtName = link.id.split("_").filter(part => part !== "state").join(" ");

        //         if (!districtMap.has(districtName)) {
        //             districtMap.set(districtName, []);
        //         }
        //         districtMap.get(districtName).push(link);

        //         link.addEventListener('click', (event) => {
        //             event.preventDefault();

        //             const selected = !selectedDistricts.has(districtName);

        //             districtMap.get(districtName).forEach(districtLink => {
        //                 if (selected) {
        //                     selectedDistricts.add(districtName);
        //                     $(districtLink).addClass('selected');
        //                 } else {
        //                     selectedDistricts.delete(districtName);
        //                     $(districtLink).removeClass('selected');
        //                 }
        //             });

        //             updateFilterVisits(null, $('#department_id')
        //                 .val()); // Pass selected department to the update function
        //         });
        //     });
        // });

        // Checkboxes functionality
        const checkboxes = document.querySelectorAll('#exportFilter');

        // Function to update all checkboxes
        function updateAllCheckboxes(event) {
            const isChecked = event.target.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        }

        // Add event listeners to all checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateAllCheckboxes);
        });

        //------------------(    GUESTS LISTING MAP DISTRICTS   )----------------------------

        // Function to update the DataTable based on selected districts
        function updateListingFilterVisits() {
            // Reload DataTables with the updated filters
            $('#all-records-table').DataTable().ajax.reload();
            $('#official-table').DataTable().ajax.reload();
            $('#notable-table').DataTable().ajax.reload();
            $('#business-table').DataTable().ajax.reload();
        }
        // Listen for the change event on the department filter
        $('#department').on('change', function() {
            // Reload the DataTable with the selected departmen            
            $('#all-records-table').DataTable().ajax.reload();
            $('#official-table').DataTable().ajax.reload();
            $('#notable-table').DataTable().ajax.reload();
            $('#business-table').DataTable().ajax.reload();
            updateCardCounts();
        });
        $('#fp-range').on('change', function() {
            // Reload the DataTable with the selected departmen            
            $('#all-records-table').DataTable().ajax.reload();
            $('#official-table').DataTable().ajax.reload();
            $('#notable-table').DataTable().ajax.reload();
            $('#business-table').DataTable().ajax.reload();
            updateCardCounts();
        });
        $('#subdepartment').on('change', function() {
            // Reload the DataTable with the selected departmen            
            $('#all-records-table').DataTable().ajax.reload();
            $('#official-table').DataTable().ajax.reload();
            $('#notable-table').DataTable().ajax.reload();
            $('#business-table').DataTable().ajax.reload();
            updateCardCounts();
        });

        function updateCardCounts() {
            $.ajax({
                url: "{{ route('guest-and-visitors.counts') }}",
                type: 'GET',
                data: {
                    department: $('#department').val(),
                    sub_department: $('#subdepartment').val(),
                    daterange: $('#fp-range').val()
                },
                success: function(response) {
                    // Assuming `response.counts` is an object containing all necessary counts from the server response
                    var counts = response.counts;
                    $('#allstate').text(counts.totalGuests);
                    $('#allMale').text(counts.allMale);
                    $('#allFemale').text(counts.allFemale);
                    $('#baluchistan').text(counts.baluchistanVisitor);
                    $('#baluchistanMale').text(counts.baluchistanMale);
                    $('#baluchistanFemale').text(counts.baluchistanFemale);
                    $('#kpk').text(counts.khyberVisitor);
                    $('#khyberMale').text(counts.khyberMale);
                    $('#khyberFemale').text(counts.khyberFemale);
                    $('#punjab').text(counts.punjabVisitor);
                    $('#punjabMale').text(counts.punjabMale);
                    $('#punjabFemale').text(counts.punjabFemale);
                    $('#sindh').text(counts.sindhVisitor);
                    $('#sindhMale').text(counts.sindhMale);
                    $('#sindhFemale').text(counts.sindhFemale);
                },
                error: function(xhr, status, error) {
                    console.error("An error occurred: " + error);
                }
            });
        }
        $('#column-select').on('change', function() {
            // Get all selected options
            var selectedColumns = $(this).val();

            // Define all possible column classes based on your table headers
            var allColumns = [
                'photo', 'category', 'cnic', 'passport', 'full-name', 'special-field',
                'residence-address', 'city', 'contact', 'email', 'purpose-of-visit',
                'department', 'sub-department', 'gender', 'dob', 'no-visa', 'datetime', 'attachments'
            ];

            // Loop through all columns and toggle their visibility
            allColumns.forEach(function(column) {
                if (selectedColumns.includes(column)) {
                    // Show column
                    $('th.' + column).show();
                    $('td.' + column).show();
                } else {
                    // Hide column
                    $('th.' + column).hide();
                    $('td.' + column).hide();
                }
            });
        });

        // Function to handle region card clicks and trigger necessary updates
        function handleRegionClick(region) {
            // Remove 'active' class from all cards
            $('.card-custom').removeClass('active');

            // Add 'active' class to the clicked card
            region.addClass('active');

            // Get the region name
            selectedProvince = region.find('.region-name').text().trim().toLowerCase();
            selectedProvinceForButton = region.find('.region-name').text().trim().toLowerCase();
            if (selectedProvince == 'pakistan') {
                selectedProvince = null;
            }

            // Log the selected province for debugging
            console.log("Selected province:", selectedProvince);
            $('ul#listing-pills-tab li button').each(function() {
                var buttonName = $(this).data('name');
                if (buttonName && buttonName.toLowerCase() === selectedProvinceForButton) {
                    $(this).trigger('click');
                }
            });

            // Trigger DataTables reload with the updated province filter
            updateListingFilterVisits(); // Assuming this function reloads DataTables
        }

        // Event handlers for each region card
        $('#listing .card-custom').on('click', function() {
            handleRegionClick($(this));
        });
        $('#regional .card-custom').on('click', function() {
            $('#regional .card-custom').removeClass('active');
            $(this).addClass('active');
        });

        // Trigger click events on specific divs when clicked
        $('#listing .region-name').on('click', function() {
            var regionDiv = $(this).closest('.card-custom');
            handleRegionClick(regionDiv);
        });

        // Special handling for "All Pakistan"
        $('.region-name:contains("Pakistan")').parent().on('click', function() {
            $('#pills-home-tab').trigger('click');
            $('.card-custom').removeClass('active');
            $(this).closest('.card-custom').addClass('active');

            // Set province as "Pakistan" or null to indicate all Pakistan
            selectedProvince = "pakistan";
            console.log("Selected province: All Pakistan");

            // Reload DataTables with "All Pakistan" selected
            updateListingFilterVisits(); // Assuming this function reloads DataTables
        });



        // Highlight the selected districts in #listing_map
        listingStateLinks.forEach(link => {
            const districtName = link.id.split("_").filter(part => part !== "state").join(" ");

            if (!listingDistrictMap.has(districtName)) {
                listingDistrictMap.set(districtName, []);
            }
            listingDistrictMap.get(districtName).push(link);

            link.addEventListener('click', (event) => {
                event.preventDefault();

                const selected = !listingSelectedDistricts.has(districtName);

                listingDistrictMap.get(districtName).forEach(districtLink => {
                    if (selected) {
                        listingSelectedDistricts.add(districtName);
                        $(districtLink).addClass('selected');
                    } else {
                        listingSelectedDistricts.delete(districtName);
                        $(districtLink).removeClass('selected');
                    }
                });

                updateListingFilterVisits(); // Trigger the DataTable reload with the new filters
            });
        });

        //------------------(    END OF GUESTS LISTING MAP DISTRICTS   )----------------------------

        // Show marker and detail on map
        $.ajax({
            type: "GET",
            url: $('#regional_map_url').val(),
            data: {
                'modeuleName': "{{ $moduleName }}"
            },
            success: function(response) {
                if (response.status) {
                    var infowindow = new google.maps.InfoWindow();
                    var cooridnates = response.cooridnates;
                    console.log(cooridnates);
                    var lat = 30.3753;
                    var lng = 69.3451;

                    {{--  if (cooridnates.length > 0) {
                    lat = cooridnates[0].lat;
                    lng = cooridnates[0].lng;
                }  --}}

                    var map = new google.maps.Map(document.getElementById('main_map'), {
                        zoom: 5,
                        center: new google.maps.LatLng(lat, lng),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    cooridnates.forEach((coordinate, i) => {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(coordinate.lat, coordinate.lng),
                            map: map,
                        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent(`
                            <div class="margin-bottom: 10px !important">
                                <div class="text-center" style="margin-bottom: -20px;"><img src="${coordinate.image_url}" width="100" height="100" /></div> <br>
                            <b>Guest Name:</b> ${coordinate.guest_name}<br>
                            <b>Purpose of Visit:</b> ${coordinate.purpose_of_visit}<br>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="${coordinate.detail_url}" class="btn btn-primary mt-1" target="_blank">Detail</a>
                                </div>
                            </div>
                            <div>
                            `);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    });
                }
            }
        });
    </script>
    <script>
        let selectedRows = [];

        // When a checkbox is checked/unchecked, update selectedRows array
        $(document).on('change', '.select-row', function() {
            const id = $(this).val();

            if ($(this).is(':checked')) {
                selectedRows.push(id); // Add the selected row ID to the array
            } else {
                selectedRows = selectedRows.filter(item => item !==
                    id); // Remove the unselected row ID from the array
            }
        });

        // Handle bulk delete
        $('#deleteSelected').click(function() {
            if (selectedRows.length === 0) {
                alert('No rows selected');
                return;
            }

            if (confirm('Are you sure you want to delete the selected records?')) {
                $.ajax({
                    url: "{{ route('guest-and-visitors.bulkDelete') }}",
                    method: 'POST',
                    data: {
                        ids: selectedRows,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Reload the table and clear the selection array
                        table.ajax.reload();
                        selectedRows = [];
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

        // Handle export to Excel or PDF
        $('#exportSelected').click(function() {
            if (selectedRows.length === 0) {
                alert('No rows selected');
                return;
            }

            window.location.href = "{{ route('guest-and-visitors.export') }}?ids=" + selectedRows.join(',');
        });
    </script>
@endsection
