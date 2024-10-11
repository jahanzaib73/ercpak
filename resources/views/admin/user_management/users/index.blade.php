@extends('layouts.app')
@section('user-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Users</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.user_management.users._partials._pai_chart_state')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="header-title pb-3">Users Listing</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active btn btn-outline-danger px-5 my-2 my-sm-0 d-flex"
                                        id="inventory-tab" data-toggle="tab" href="#inventory" role="tab"
                                        aria-controls="inventory" aria-selected="true">
                                        <p class="pb-0 mb-0">List View</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">عرض
                                            القائمة
                                        </p>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link btn btn-outline-danger my-2 px-5 my-sm-0 d-flex"
                                        id="vendors-tab" data-toggle="tab" href="#vendors" role="tab"
                                        aria-controls="vendors" aria-selected="false">
                                        <p class="pb-0 mb-0">Card View</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">عرض
                                            البطاقة
                                        </p>
                                    </button>
                                </li>
                            </ul>

                            @if (Auth::user()->can('Add User Management'))
                                <div>
                                    <a href="{{ route('users.create') }}" class="btn save-btn mr-3 btn-sm">Add User</a>
                                </div>
                            @endif
                        </div>

                        <div class="tab-content mt-2" id="myTabsContent">
                            <div class="tab-pane fade show active" id="inventory" role="tabpanel"
                                aria-labelledby="inventory-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="ajax-table table-hover m-b-0" style="width: 100%">
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
                            <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="input-group input-group-sm mb-3">
                                            <input type="text" id="search-bar" aria-describedby="search-bar" class="form-control"
                                                placeholder="Search Employees" onkeyup="filterCards(this.value)">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="search-bar"><i class="fa-solid fa-magnifying-glass"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="cards-row">
                                    @foreach ($users as $user)
                                        <div class="col-lg-4 col-md-4 col-12   pb-3" id="card-col">
                                            <div class="employee-card">
                                                <div class="d-flex justify-content-center">
                                                    <div>
                                                        <img src="{{ $user->profile_pic_url }}" alt="Profile Picture"
                                                            class="img-fluid" style="margin-right: 25px">
                                                    </div>
                                                    <div>
                                                        <h4>{{ $user->full_name }}</h4>
                                                        <p class="text-muted">{{ $user->designation->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="details">
                                                    <p><strong>Emp No:</strong> {{ $user->id }}</p>
                                                    <p><strong>Joining Date:</strong>
                                                        {{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</p>
                                                    <p><strong>Salary:</strong> Rs. {{ $user->wages_type_value }}</p>
                                                    <p><strong>Contact No:</strong> {{ $user->contact_number }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="markCancelled" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Mark as Cancelled</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="GET">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Comment</label>
                            <textarea name="comment" id="comment" class="form-control" cols="30" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Mark as
                            Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .employee-card {
            border: 1px solid #AF8B45;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            background-color: #f8f9fa;
        }

        .employee-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .employee-card .details {
            margin-top: 15px;
        }

        .employee-card .details p {
            margin: 5px 0;
        }
    </style>
@endsection
@section('script')
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
                {{--  {
                    data: 'country.name',
                    name: 'country.name',
                    defaultContent: 'N/A'
                },  --}} {
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

            var plotObj = $.plot($("#" + containerId), data, {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: function(label, x, y) {
                        return label + ' : ' + y;
                    },
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            });

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
@endsection
