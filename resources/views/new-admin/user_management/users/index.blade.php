@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Users')

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
                    <h4 class="card-title">Users</h4>
                </div>
                <div class="table-responsive width-95-per mx-auto">
                    <table class="table ajax-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Created By</th>
                                <th>Picture</th>
                                <th>Employee#</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Employee Type</th>
                                <th>Wages/Rate</th>
                                {{--  <th>Country</th>  --}}
                                <th>Status</th>
                                <th style="width: 270px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
    var table = $('.ajax-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('users.index') }}",
            data: function(d) {
                {{--  d.moduleNmae = "{{ $moduleName }}"  --}}
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
                name: 'created_by',
                defaultContent: 'N/A'
            },
            {
                data: 'profile_pic_url',
                name: 'profile_pic_url',
                defaultContent: 'N/A'
            },
            {
                data: 'id',
                name: 'id',
                defaultContent: 'N/A'
            },
            {
                data: 'email',
                name: 'email',
                defaultContent: 'N/A'
            },
            {
                data: 'full_name',
                name: 'full_name',
                defaultContent: 'N/A'
            },
            {
                data: 'designation.name',
                name: 'designation.name',
                defaultContent: 'N/A'
            },
            {
                data: 'department.name',
                name: 'department.name',
                defaultContent: 'N/A'
            },
            {
                data: 'employee_type',
                name: 'employee_type',
                defaultContent: 'N/A'
            },
            {
                data: 'wages_type',
                name: 'wages_type',
                defaultContent: 'N/A'
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

    plotSingleGrophForUser('all_state_pai_chart', {{ $allusers }});
    plotSingleGrophForUser('active_state_pai_chart', {{ $activeUser }});
    plotSingleGrophForUser('inactive_state_pai_chart', {{ $inactiveUser }});

    function plotSingleGrophForUser(containerId, graphData) {

        var graphColor = "#ff5450";
        var graphLalbel = 'All';
        if (containerId == 'active_state_pai_chart') {
            graphColor = "#fdc107";
            var graphLalbel = 'Active';

        } else if (containerId == 'inactive_state_pai_chart') {
            graphColor = "#00bcd2";
            var graphLalbel = 'Inactive';

        }

        var data = [{
            label: graphLalbel,
            data: graphData,
            color: graphColor
        }];



    }

    function filterCards(searchTerm) {
        console.log(searchTerm);
        searchTerm = searchTerm.toLowerCase();
        const cards = document.querySelectorAll("#cards-row #card-col");

        cards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            const match = cardText.includes(searchTerm);
            card.style.display = match ? "block" : "none";
        });
    }
</script>
