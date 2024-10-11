@extends('layouts.app')
@section('project-management-active-class', 'active')

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

        .red {
            color: red;
        }

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
            height: 600px !important;
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

        .active {
            color: white !important;
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
            <div class="d-flex justify-content-between pb-1">
                <h4>Projects</h3>
                    <h3 class="arabic red">المشاريع
                </h4>
            </div>
        </section>




        <section>
            <hr>
            <div class="d-flex justify-content-between mb-2">
                <div class="d-flex">
                    <h4>All Projects / &nbsp;</h4>
                    <h4 class="arabic">جميع المشاريع</h4>
                </div>

                <div>
                    <a href="#" class="btn btn-secondary d-flex" data-toggle="modal" data-target="#projectModal">
                        <p class="pb-0 mb-0">Add Project</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">إضافة مشروع</p>
                    </a>
                </div>

            </div>

            <!-- =========================== -->

            <section>
                <table class="table table-hover small pt-3" id="projectTable">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p class="arabic red">رقم التسلسل</p>
                                <p>S.#</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">رقم المشروع</p>
                                <p>Project #</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">يكتب</p>
                                <p>Type</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">اسم المشروع </p>
                                <p>Project Name</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">مهام</p>
                                <p>Tasks</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"> ميزانية المشروع</p>
                                <p>Budget</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">الأموال المستخدمة </p>
                                <p>Spend</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"> الأموال المتبقية</p>
                                <p>Balance</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">أدخل التاريخ </p>
                                <p>Date</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">بدأ الموعد</p>
                                <p>Started</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"> مكتمل </p>
                                <p>Completed</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"> حالة</p>
                                <p>Status</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"> منظر</p>
                                <p>View</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </section>
            <!-- ==============================        -->


        </section>

        @include('admin.project_managements._models._add_project')
    </div>
@endsection
@section('script')
    <script>
        var projectManagemntIndexUrl = "{{ route('project.managemant.index') }}";
        var projectManagemntStatsUrl = "{{ route('project.managemant.stats') }}";
        var tasks = JSON.parse('{!! addslashes(json_encode($projectTasks)) !!}');
    </script>

    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
    <script src="{{ asset('project_management/Index.js') }}"></script>

@endsection
