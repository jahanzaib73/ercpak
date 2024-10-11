@extends('layouts.app')
@section('guest-vistor-active-class', 'active')
@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-end pt-4">
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active btn btn-outline-danger px-5 my-2 my-sm-0 d-flex" id="inventory-tab"
                        data-toggle="tab" href="#inventory" role="tab" aria-controls="inventory" aria-selected="true">
                        <p class="pb-0 mb-0">Listing</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-outline-danger my-2 px-5 my-sm-0 d-flex" id="vendors-tab"
                        data-toggle="tab" href="#vendors" role="tab" aria-controls="vendors" aria-selected="false">
                        <p class="pb-0 mb-0">Region</p>
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" id="myTabsContent">
            <div class="tab-pane fade show active" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">


                <div class="page-head">
                    <h4 class="mt-2 mb-2">Guest & Customers</h4>
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="map" id="main_map"></div>
                        </div>
                    </div>
                </div>
                {{-- @include('admin.guest_vistors._partials._pai_chart_state') --}}

                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 class="header-title pb-3">Customers Listing</h5>
                                            </div>
                                            @include('admin.guest_vistors._partials._module_button')
                                        </div>
                                    </div>
                                    @if (Auth::user()->can('Add Guest and Visitors'))
                                        <div class="col-md-5 text-right">
                                            <a href="{{ route('guest-and-visitors.create', ['module' => App\Models\GuestVistor::VISTORS]) }}"
                                                class="btn save-btn mr-3 btn-sm">Add
                                                New</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="ajax-table table-hover m-b-0" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Created By</th>
                                                        <th>Customer#</th>
                                                        {{--  <th>Date & Time</th>  --}}
                                                        <th>Customer Name</th>
                                                        <th>Customer Contact</th>
                                                        <th>Customer Email</th>
                                                        {{--  <th>Host Name</th>
                                                        <th>Department</th>  --}}
                                                        <th>Passport#</th>
                                                        <th>Purpose of Visit</th>
                                                        <th>Fee</th>
                                                        <th>Attachment</th>
                                                        <th>Time In</th>
                                                        <th>Time Out</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
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

                                        @include('admin.guest_vistors._partials._regional_map')

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
                                                        <a class="nav-link active" data-toggle="tab"
                                                            href="#all">All <span id="allCount"
                                                                class="badge badge-info">{{ (array_key_exists('protocolLiaisons', $allData) ? count($allData['protocolLiaisons']) : 0) + (array_key_exists('customerVisits', $allData) ? count($allData['customerVisits']) : 0) }}</span></a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#official">Official <span id="officialCount"
                                                                class="badge badge-info">{{ count($officials) }}</span></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#notables">Notables <span id="notableCount"
                                                                class="badge badge-info">{{ count($notables) }}</span></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#business">Business <span id="businessCount"
                                                                class="badge badge-info">{{ count($businesses) }}</span></a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#customers">Customers <span id="customerCount"
                                                                class="badge badge-info">{{ count($customerVisits) }}</span></a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content" style="overflow: auto;">
                                                    <!-- All Tab -->
                                                    <div id="all" class="tab-pane fade show active">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label><input type="checkbox" id="exportFilter"> Count
                                                                    check</label>
                                                                <table id="allTable"
                                                                    class="table table-bordered table-responsive-sm small">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Photo</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">Designation</th>
                                                                            <th scope="col">Department</th>
                                                                            <th scope="col">Office</th>
                                                                            <th scope="col">Residence</th>
                                                                            <th scope="col">Contact Numbers</th>
                                                                            <th scope="col">Visits</th>
                                                                            <th scope="col">View</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php $counter = 1; @endphp
                                                                        @if (array_key_exists('protocolLiaisons', $allData))
                                                                            @foreach ($allData['protocolLiaisons'] as $item)
                                                                                <tr>
                                                                                    <td>{{ $counter++ }}</td>
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
                                                                                    <td>{{ $item->visits_count }}</td>
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
                                                                                    <td>{{ $counter++ }}</td>
                                                                                    <td><a href="{{ $item->image_url ?? '' }}"
                                                                                            target="_blank"><img
                                                                                                width="50"
                                                                                                src="{{ $item->image_url ?? '' }}"
                                                                                                alt="user profile picture"></a>
                                                                                        <p class="d-none">
                                                                                            {{ $item->image_url ?? '' }}
                                                                                        </p>
                                                                                    </td>
                                                                                    <td>{{ $item->vistor_name }}</td>
                                                                                    <td></td>
                                                                                    <td>{{ optional($item->department)->name }}
                                                                                    </td>
                                                                                    <td>{{ $item->address }}</td>
                                                                                    <td>{{ optional($item->city)->name }}
                                                                                    </td>
                                                                                    <td>{{ $item->vistor_contact }}</td>
                                                                                    <td>{{ $item->customer_visits }}</td>
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
                                                                    <option value="0">All Departments</option>
                                                                    @foreach ($departments as $department)
                                                                        <option value="{{ $department->id }}"
                                                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                                                            {{ $department->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12">
                                                                <label><input type="checkbox" id="exportFilter"> Count
                                                                    check</label>
                                                                <table id="officialTable"
                                                                    class="table table-bordered table-responsive-sm small">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Photo</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">Designation</th>
                                                                            <th scope="col">Department</th>
                                                                            <th scope="col">Office</th>
                                                                            <th scope="col">Residence</th>
                                                                            <th scope="col">Contact Numbers</th>
                                                                            <th scope="col">Visits</th>
                                                                            <th scope="col">View</th>
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
                                                                                <td>{{ $official->official_name }}</td>
                                                                                <td>{{ $official->official_designation }}
                                                                                </td>
                                                                                <td>{{ optional($official->department)->name }}
                                                                                </td>
                                                                                <td>{{ $official->official_address }}</td>
                                                                                <td>{{ optional($official->city)->name }}
                                                                                </td>
                                                                                <td>{{ $official->phone ?? '' }}</td>
                                                                                <td>{{ $official->visits_count }}</td>
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
                                                        <label><input type="checkbox" id="exportFilter"> Count
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
                                                                    <th scope="col">Contact Numbers</th>
                                                                    <th scope="col">Visits</th>
                                                                    <th scope="col">View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($notables as $notable)
                                                                    <tr>
                                                                        <td><a href="{{ optional($notable->officialImage)->file_url ?? '' }}"
                                                                                target="_blank"><img width="50"
                                                                                    src="{{ optional($notable->officialImage)->file_url ?? '' }}"
                                                                                    alt="user profile picture"></a>
                                                                            <p class="d-none">
                                                                                {{ optional($notable->officialImage)->file_url ?? '' }}
                                                                            </p>
                                                                        </td>
                                                                        <td>{{ $notable->notable_name }}</td>
                                                                        <td></td>
                                                                        <td>{{ optional($notable->department)->name ?? '' }}
                                                                        </td>
                                                                        <td>{{ $notable->notable_address }}</td>
                                                                        <td>{{ optional($notable->city)->name ?? '' }}</td>
                                                                        <td>{{ $notable->phone }}</td>
                                                                        <td>{{ $notable->visits_count }}</td>
                                                                        <td><a href="{{ route('protocol-and-liaisons.show', $notable->id) }}"
                                                                                title="Show Detail"
                                                                                class="btn btn-eye-icon btn-sm edit"><i
                                                                                    class="fa fa-eye"></i></a></td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Business Tab -->
                                                    <div id="business" class="tab-pane fade">
                                                        <label><input type="checkbox" id="exportFilter"> Count
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
                                                                    <th scope="col">Contact Numbers</th>
                                                                    <th scope="col">Visits</th>
                                                                    <th scope="col">View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($businesses as $business)
                                                                    <tr>
                                                                        <td><a href="{{ optional($business->officialImage)->file_url ?? '' }}"
                                                                                target="_blank"><img width="50"
                                                                                    src="{{ optional($business->officialImage)->file_url ?? '' }}"
                                                                                    alt="user profile picture"></a>
                                                                            <p class="d-none">
                                                                                {{ optional($business->officialImage)->file_url ?? '' }}
                                                                            </p>
                                                                        </td>
                                                                        <td>{{ $business->company_name }} (COMPANY)</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>{{ $business->company_address ?? '' }}</td>
                                                                        <td>{{ $business->company_city }}</td>
                                                                        <td>{{ $business->company_email ?? '' }}</td>
                                                                        <td>{{ $business->visits_count }}</td>
                                                                        <td><a href="{{ route('protocol-and-liaisons.show', $business->id) }}"
                                                                                title="Show Detail"
                                                                                class="btn btn-eye-icon btn-sm edit"><i
                                                                                    class="fa fa-eye"></i></a></td>
                                                                    </tr>
                                                                    @foreach ($business->members as $member)
                                                                        <tr>
                                                                            <td><a href="{{ $member->photo_url ?? '' }}"
                                                                                    target="_blank"><img width="50"
                                                                                        src="{{ $member->photo_url ?? '' }}"
                                                                                        alt="user profile picture"></a>
                                                                                <p class="d-none">
                                                                                    {{ $member->photo_url ?? '' }}
                                                                                </p>
                                                                            </td>
                                                                            <td>{{ $member->name }} (MEMBER)</td>
                                                                            <td>{{ $member->Designation }}</td>
                                                                            <td>{{ $business->company_name ?? '' }}
                                                                            </td>
                                                                            <td>{{ $business->company_address ?? '' }}</td>
                                                                            <td>{{ $business->company_city }}</td>
                                                                            <td>{{ $member->contact_number ?? '' }}</td>
                                                                            <td>{{ $business->visits_count }}</td>
                                                                            <td><a href="{{ route('protocol-and-liaisons.show', $business->id) }}"
                                                                                    title="Show Detail"
                                                                                    class="btn btn-eye-icon btn-sm edit"><i
                                                                                        class="fa fa-eye"></i></a></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <!-- Customers Tab -->
                                                    <div id="customers" class="tab-pane fade">
                                                        <label><input type="checkbox" id="exportFilter"> Count
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
                                                                    <th scope="col">Contact Numbers</th>
                                                                    <th scope="col">Visits</th>
                                                                    <th scope="col">View</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($customerVisits as $visit)
                                                                    <tr>
                                                                        <td><a href="{{ $visit->image_url ?? '' }}"
                                                                                target="_blank"><img width="50"
                                                                                    src="{{ $visit->image_url ?? '' }}"
                                                                                    alt="user profile picture"></a>
                                                                            <p class="d-none">
                                                                                {{ $visit->image_url ?? '' }}
                                                                            </p>
                                                                        </td>
                                                                        <td>{{ $visit->vistor_name }}</td>
                                                                        <td></td>
                                                                        <td>{{ optional($visit->department)->name }}</td>
                                                                        <td>{{ $visit->address }}</td>
                                                                        <td>{{ optional($visit->city)->name }}</td>
                                                                        <td>{{ $visit->vistor_contact }}</td>
                                                                        <td>{{ $item->customer_visits }}</td>
                                                                        <td><a href="{{ route('guest-and-visitors.show', $visit->id) }}"
                                                                                title="Show Detail"
                                                                                class="btn btn-eye-icon btn-sm edit"><i
                                                                                    class="fa fa-eye"></i></a></td>
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

    <input type="hidden" id="map_url"
        value="{{ route('guest-and-visitors.main.map', ['moduleName' => $moduleName]) }}">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
@endsection
@section('script')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY" type="text/javascript">
    </script>
    <script>
        const allVisits = {!! json_encode($allData) !!};
        const moduleName = {!! json_encode($moduleName) !!};
        const guests = {!! json_encode($guests ?? '') !!};
        const visitors = {!! json_encode($visitors ?? '') !!};
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('guest-and-visitors.index') }}",
                data: function(d) {
                    d.moduleNmae = "{{ $moduleName }}"
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {{--  {
                    data: 'time_in',
                    name: 'time_in'
                },  --}} {
                    data: 'vistor_name',
                    name: 'vistor_name'
                },
                {
                    data: 'vistor_contact',
                    name: 'vistor_contact'
                },
                {
                    data: 'vistor_email',
                    name: 'vistor_email'
                },
                {{--  {
                    data: 'host',
                    name: 'host'
                },
                {
                    data: 'department.name',
                    name: 'department.name'
                },  --}} {
                    data: 'passport_number',
                    name: 'passport_number'
                },
                {
                    data: 'pyrposeOfVisit',
                    name: 'pyrposeOfVisit'
                },
                {
                    data: 'fee',
                    name: 'fee'
                },
                {
                    data: 'attachments',
                    name: 'attachments'
                },
                {
                    data: 'time_in',
                    name: 'time_in'
                },
                {
                    data: 'time_out',
                    name: 'time_out'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(document).ready(function() {

            const stateLinks = document.querySelectorAll('#map .model-green .state');
            const selectedDistricts = new Set();
            const districtMap = new Map();

            // Add event listener for department dropdown
            $('#department_id').on('change', function() {
                const selectedDepartment = $(this).val();
                const activeProvinceName = $('#pills-tab button.active').data('name');
                updateFilterVisits(activeProvinceName,
                    selectedDepartment); // Pass selected department to the update function
            });

            $('#pills-tab button').on('click', function() {
                var provinceName = $(this).data('name');
                clearSelectedStates();
                updateFilterVisits(provinceName, $('#department_id')
                    .val()); // Pass selected department to the update function
            });

            function clearSelectedStates() {
                stateLinks.forEach(link => {
                    $(link).removeClass('selected');
                });
                selectedDistricts.clear();
            }

            // Function to filter visits based on selected provinces
            function filterVisits(provinceName = null, selectedCities = [], selectedDepartment = null) {
                $.ajax({
                    url: '{{ route('guest-and-visitors.filter-visits.ajax') }}',
                    method: 'GET',
                    data: {
                        cities: selectedCities,
                        province: provinceName,
                        department: selectedDepartment // Include department in request
                    },
                    success: function(response) {
                        let allCount = (response.allData ? response.allData.length : 0);
                        let officialCount = response.officials ? response.officials.length : 0;
                        let notableCount = response.notables ? response.notables.length : 0;
                        let businessCount = response.businesses ? response.businesses.length : 0;
                        let customerCount = response.customers ? response.customers.length : 0;

                        // Update the badge text
                        $('#allCount').text(allCount);
                        $('#officialCount').text(officialCount);
                        $('#notableCount').text(notableCount);
                        $('#businessCount').text(businessCount);
                        $('#customerCount').text(customerCount);
                        $('.table').DataTable().destroy();
                        // Clear existing data
                        $('.table tbody').empty();
                        // Populate new data
                        $.each(response.allData, function(key, item) {
                            if (item.vistor_name) {
                                $('#allTable tbody').append(
                                    '<tr>' +
                                    '<td>' + (key + 1) + '</td>' +
                                    '<td><a href="' + (item.image_url ?? '') +
                                    '" target="_blank">' +
                                    '<img width="50" src="' + (item.image_url ?? '') +
                                    '" alt="user profile picture"></a></td>' +
                                    '<td>' + item.vistor_name + ' (CUSTOMER)' + '</td>' +
                                    '<td>' + '' + '</td>' +
                                    '<td>' + (item.department ? item.department.name :
                                        '') +
                                    '</td>' +
                                    '<td>' + item.address + '</td>' +
                                    '<td>' + (item.city ? item.city.name : '') + '</td>' +
                                    '<td>' + item.vistor_contact + '</td>' +
                                    '<td>' + item.customer_visits + '</td>' +
                                    '<td><a href="{{ route('guest-and-visitors.show', '') }}/' +
                                    item.id +
                                    '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
                                    '</tr>'
                                );
                            } else {
                                $('#allTable tbody').append(
                                    '<tr>' +
                                    '<td>' + (key + 1) + '</td>' +
                                    '<td><a href="' + (item.official_image ?
                                        item.official_image.file_url :
                                        '') + '" target="_blank">' +
                                    '<img width="50" src="' + (item.official_image ? item
                                        .official_image.file_url :
                                        '') +
                                    '" alt="user profile picture"></a></td>' +
                                    '<td>' + (item.official_name ?? (item.notable_name ?? (
                                        item
                                        .company_name ?? ''))) + '</td>' +
                                    '<td>' + (item.official_designation ?? '') +
                                    '</td>' +
                                    '<td>' + (item.department ? item.department.name :
                                        '') + '</td>' +
                                    '<td>' + (item.official_address ?? (item
                                        .notable_address ??
                                        (item.company_address ?? ''))) + '</td>' +
                                    '<td>' + (item.city ? item.city.name : item
                                        .company_city ??
                                        '') +
                                    '</td>' +
                                    '<td>' + (item.phone ?? (item.company_email ?? '')) +
                                    '</td>' +
                                    '<td>' + (item.visits_count ?? '') + '</td>' +
                                    '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
                                    item.id +
                                    '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
                                    '</tr>'
                                );
                            }
                        });

                        $.each(response.officials, function(key, official) {
                            $('#officialTable tbody').append(
                                '<tr>' +
                                '<td><a href="' + (official.official_image ?
                                    official.official_image.file_url :
                                    '') + '" target="_blank">' +
                                '<img width="50" src="' + (official.official_image ?
                                    official.official_image.file_url :
                                    '') +
                                '" alt="user profile picture"></a></td>' +
                                '<td>' + official.official_name + '</td>' +
                                '<td>' + (official.official_designation ?? '') +
                                '</td>' +
                                '<td>' + (official.department ? official.department.name :
                                    '') + '</td>' +
                                '<td>' + (official.official_address ?? '') + '</td>' +
                                '<td>' + (official.city ? official.city.name : '') +
                                '</td>' +
                                '<td>' + official.phone + '</td>' +
                                '<td>' + (official.visits_count ?? '') + '</td>' +
                                '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
                                official.id +
                                '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
                                '</tr>'
                            );
                        });
                        $.each(response.notables, function(key, notable) {
                            $('#notablesTable tbody').append(
                                '<tr>' +
                                '<td><a href="' + (notable.official_image ?
                                    notable.official_image.file_url :
                                    '') + '" target="_blank">' +
                                '<img width="50" src="' + (notable.official_image ? notable
                                    .official_image.file_url :
                                    '') +
                                '" alt="user profile picture"></a></td>' +
                                '<td>' + notable.notable_name + '</td>' +
                                '<td>' + '' + '</td>' +
                                '<td>' + (notable.department ? notable.department.name :
                                    '') + '</td>' +
                                '<td>' + (notable.notable_address ?? '') + '</td>' +
                                '<td>' + (notable.city ? notable.city.name : '') + '</td>' +
                                '<td>' + notable.phone + '</td>' +
                                '<td>' + (notable.visits_count ?? '') + '</td>' +
                                '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
                                notable.id +
                                '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
                                '</tr>'
                            );
                        });
                        $.each(response.businesses, function(key, business) {
                            $('#businessesTable tbody').append(
                                '<tr>' +
                                '<td><a href="' + (business.official_image ?
                                    business.official_image.file_url :
                                    '') + '" target="_blank">' +
                                '<img width="50" src="' + (business.official_image ?
                                    business
                                    .official_image.file_url :
                                    '') +
                                '" alt="user profile picture"></a></td>' +
                                '<td>' + business.company_name + ' (COMPANY)</td>' +
                                '<td>' + '' + '</td>' +
                                '<td>' + '' + '</td>' +
                                '<td>' + business.company_address + '</td>' +
                                '<td>' + business.company_city + '</td>' +
                                '<td>' + (business.company_email ?? '') + '</td>' +
                                '<td>' + business.visits_count + '</td>' +
                                '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
                                business.id +
                                '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
                                '</tr>'
                            );
                            if (business.members) {
                                $.each(business.members, function(key, member) {
                                    $('#businessesTable tbody').append(
                                        '<tr>' +
                                        '<td><a href="' + (member.photo_url ?? '') +
                                        '" target="_blank">' +
                                        '<img width="50" src="' + (member
                                            .photo_url ?? '') +
                                        '" alt="user profile picture"></a></td>' +
                                        '<td>' + member.name + ' (MEMBER)</td>' +
                                        '<td>' + member.Designation + '</td>' +
                                        '<td>' + business.company_name + '</td>' +
                                        '<td>' + business.company_address +
                                        '</td>' +
                                        '<td>' + business.company_city + '</td>' +
                                        '<td>' + (member.contact_number ?? '') +
                                        '</td>' +
                                        '<td>' + business.visits_count + '</td>' +
                                        '<td><a href="{{ route('protocol-and-liaisons.show', '') }}/' +
                                        business.id +
                                        '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
                                        '</tr>'
                                    );
                                });
                            }

                        });
                        $.each(response.customers, function(key, visit) {
                            $('#customersTable tbody').append(
                                '<tr>' +
                                '<td><a href="' + (visit.image_url ?? '') +
                                '" target="_blank">' +
                                '<img width="50" src="' + (visit.image_url ?? '') +
                                '" alt="user profile picture"></a></td>' +
                                '<td>' + visit.vistor_name + ' (CUSTOMER)' + '</td>' +
                                '<td>' + '' + '</td>' +
                                '<td>' + (visit.department ? visit.department.name : '') +
                                '</td>' +
                                '<td>' + visit.address + '</td>' +
                                '<td>' + (visit.city ? visit.city.name : '') + '</td>' +
                                '<td>' + visit.vistor_contact + '</td>' +
                                '<td>' + visit.customer_visits + '</td>' +
                                '<td><a href="{{ route('guest-and-visitors.show', '') }}/' +
                                visit.id +
                                '/" title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a></td>' +
                                '</tr>'
                            );
                        });
                        // Reinitialize DataTable
                        $('.table').DataTable();
                    }
                });
            }

            function updateFilterVisits(provinceName = null, selectedDepartment = null) {
                const selectedCities = Array.from(document.querySelectorAll('#map .model-green .state.selected'))
                    .map(link => link.id.split("_").filter(part => part !== "state").join(" "));

                // Use a Set to filter out duplicate cities
                const uniqueSelectedCities = [...new Set(selectedCities)];

                filterVisits(provinceName, uniqueSelectedCities, selectedDepartment);
            }

            // Highlight the selected districts
            stateLinks.forEach(link => {
                const districtName = link.id.split("_").filter(part => part !== "state").join(" ");

                if (!districtMap.has(districtName)) {
                    districtMap.set(districtName, []);
                }
                districtMap.get(districtName).push(link);

                link.addEventListener('click', (event) => {
                    event.preventDefault();

                    const selected = !selectedDistricts.has(districtName);

                    districtMap.get(districtName).forEach(districtLink => {
                        if (selected) {
                            selectedDistricts.add(districtName);
                            $(districtLink).addClass('selected');
                        } else {
                            selectedDistricts.delete(districtName);
                            $(districtLink).removeClass('selected');
                        }
                    });

                    updateFilterVisits(null, $('#department_id')
                        .val()); // Pass selected department to the update function
                });
            });
        });

        // Show marker and detail on map
        $.ajax({
            type: "GET",
            url: $('#map_url').val(),
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
                                <b>Visitor Name:</b> ${coordinate.vistor_name}<br>
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
@endsection
