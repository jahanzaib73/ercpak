@extends('layouts.app')
@section('erc-active-class', 'active')

@section('css')
    {{--  <link href="https://db.onlinewebfonts.com/c/02f502e5eefeb353e5f83fc5045348dc?family=GE+SS+Two+Light" rel="stylesheet">  --}}
    <style>
        @font-face {
            font-family: "GE SS Two Light";
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot");
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot?#iefix")format("embedded-opentype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff2")format("woff2"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff")format("woff"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.ttf")format("truetype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.svg#GE SS Two Light")format("svg");
        }

        .arabic {
            font-family: "GE SS Two Light";
        }

        /* .red {
            color: red;
        } */

        p {
            margin-block: 0;
        }

        #map {
            height: 400px;
        }

        body>section>div.body-content>div.container-fluid.mt-5>section:nth-child(4)>div.d-flex.justify-content-between.pb-1>div>h5>span {
            margin-left: 10px !important;
        }

        /* Add styles for the InfoWindow content */
        .info-window-content {
            width: 480px !important;
            padding: 10px;
            /* height: 600px !important; */
        }

        /* Styles for the heading */
        .info-window-content h5 {
            margin: 0;
            color: #333;
            /* Adjust the color as needed */
        }

        /* Styles for the member information */
        .info-window-content .member-info {
            margin-bottom: 10px;
        }

        /* Styles for the team information */
        .info-window-content .team-info {
            margin-top: 10px;
        }

        /* Styles for the button */
        .info-window-content .btn-primary {
            display: block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            /* Adjust the color as needed */
            color: #fff;
            /* Adjust the text color as needed */
            text-decoration: none;
            text-align: center;
        }

        /* Ensure the button is visible in the InfoWindow */
        .gm-style-iw .btn-primary {
            white-space: nowrap;
            /* Prevent button from being hidden */
        }

        /* Default color for tab text */
        .nav-tabs .nav-link {
            color: red;
        }

        /* Active tab color */
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: white !important;

            /* Optionally, you can set a border color for the active tab */
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">

        <section>
            <div class="d-flex justify-content-between">
                @if (Auth::user()->can('Add Team'))
                    <a href="#" class="btn save-btn      d-flex" data-toggle="modal" data-target="#teamModal">
                        <p class="pb-0 mb-0">Add Team</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">إضافة فريق </p>
                    </a>
                @endif
                @if (Auth::user()->can('Add Member'))
                    <a href="#" class="btn save-btn  d-flex" data-toggle="modal" data-target="#memberModal">
                        <p class="pb-0 mb-0">Add Member</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">إضافة عضو</p>
                    </a>
                @endif
                @if (Auth::user()->can('Create Area'))
                    <a href="#" class="btn save-btn  d-flex" id="createAreaModelBtnId">
                        <p class="pb-0 mb-0">Create Area</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">إنشاء منطقة </p>
                    </a>
                @endif
                @if (Auth::user()->can('Assign Area'))
                    <a href="#" class="btn save-btn  d-flex" data-toggle="modal" data-target="#assignModal">
                        <p class="pb-0 mb-0">Assign Area</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">تخصيص المنطقة</p>
                    </a>
                @endif
            </div>

        </section>
        <hr>
        <section>

            <div class="row mt-3 mb-3">
                <div class="col-md-12">
                    <div id="indexMapId" style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                    </div>
                </div>
            </div><!--end row-->
            <hr>
        </section>

        <section>
            <div class="d-flex justify-content-between pb-1">
                <h5>Countries/Cities</h5>
                <h5 class="arabic red">البلدان/المدن</h5>
                <div class="d-flex" style="width: 100px !important">
                    <h5>
                        <select name="session" id="session" class="form-control">
                            @foreach ($session_years as $year)
                                <option value="{{ $year }}" {{ $year == Carbon\Carbon::now()->year }}>
                                    {{ $year }}</option>
                            @endforeach
                            {{--  <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2024">2024</option>  --}}
                        </select>
                    </h5>
                </div>
            </div>
            <div class="row" id="cardContainer"></div>
        </section>

        <section>
            <hr>
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <h4>All Allotments / &nbsp;</h4>
                    <h4 class="arabic">جميع المخصصات </h4>
                </div>
            </div>
            <hr>

            <section>
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <button data-id="0"
                                class="nav-link active btn btn-outline-danger px-5 my-2 my-sm-0 d-flex team_filter"
                                id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all"
                                aria-selected="true">
                                <p class="pb-0 mb-0">All</p>
                            </button>
                        </li>
                        @foreach ($teams as $team)
                            <li class="nav-item">
                                <button data-id="{{ $team->id }}"
                                    class="nav-link btn team_filter btn-outline-danger my-2 px-5 my-sm-0 d-flex"
                                    id="ad-tab2" data-toggle="tab" href="#ad" role="tab" aria-controls="ad"
                                    aria-selected="false">
                                    <p class="pb-0 mb-0">{{ $team->team_name }}</p>
                                </button>
                            </li>
                        @endforeach
                        <input type="hidden" name="filter_team_id" id="filter_team_id">
                    </ul>
                </div>
                <div class="tab-content mt-3" id="myTabsContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

                        <table class="table table-hover small pt-3" id="teammanagementTable">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <p class="arabic red">رقم التسلسل</p>
                                        <p>S.#</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">صورة </p>
                                        <p>Photo</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">المخصص </p>
                                        <p>Allottee</p>
                                    </th>
                                    @foreach ($provinces as $province)
                                        <th scope="col">
                                            <p class="arabic red">{{ $province->arabic_name }} </p>
                                            <p>{{ $province->name }}</p>
                                        </th>
                                    @endforeach
                                    {{--  <th scope="col">
                                        <p class="arabic red">بلوشستان </p>
                                        <p>Baluchistan</p>
                                    </th>  --}}
                                    {{--  <th scope="col">
                                        <p class="arabic red">البنجاب</p>
                                        <p>Punjab</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red"> السند </p>
                                        <p>Sindh</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">خيبر بختونخا </p>
                                        <p>Khyber Pk</p>
                                    </th>  --}}

                                    <th scope="col">
                                        <p class="arabic red"> منظر</p>
                                        <p>View</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- ========MODAL ADD  TEAM============= -->
            @include('admin.erc._models._add_team')

            <!-- ========MODAL ADD  MEMBER============= -->
            @include('admin.erc._models._add_team_member')

            <!-- ========MODAL ADD  AREA============= -->
            @include('admin.erc._models._create_area')

            <!-- ========MODAL ASSIGN  AREA============= -->
            @include('admin.erc._models._add_assign_area')
    </div>
@endsection
@section('script')

    <script>
        const teamUrl = "{{ route('teams.store') }}";
        const teamMemberUrl = "{{ route('team.members.store') }}";
        const createAreaUrl = "{{ route('create.area.store') }}";
        const assignAreaUrl = "{{ route('assign.area.store') }}";
        const getAllAreasUrl = "{{ route('get.all.areas') }}";
        const getTeamStatsUrl = "{{ route('get.team.states') }}";
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const teams = {!! json_encode($teams) !!};
        const members = {!! json_encode($members) !!};
        const cities = {!! json_encode($cities) !!};

        var table = $('#teammanagementTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('team.managemant.index') }}",
                data: function(data) {
                    data.session_year = $('#session').val();
                    data.filter_team_id = $('#filter_team_id').val();
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'image',
                    name: 'image',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'baluchistan',
                    name: 'baluchistan',
                },
                {
                    data: 'punjab',
                    name: 'punjab',
                },
                {
                    data: 'sindh',
                    name: 'sindh',
                },
                {
                    data: 'kpk',
                    name: 'kpk',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    </script>







    <script src="{{ asset('team_management/Index.js') }}"></script>
    <script src="{{ asset('team_management/Team.js') }}"></script>
    <script src="{{ asset('team_management/TeamMember.js') }}"></script>
    <script src="{{ asset('team_management/CreateArea.js') }}"></script>
    <script src="{{ asset('team_management/AssignArea.js') }}"></script>
    <script src="{{ asset('team_management/ShowStates.js') }}"></script>
    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>

@endsection
