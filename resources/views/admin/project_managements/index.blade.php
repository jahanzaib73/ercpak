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
        {{--  <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand" href="project-index.html"><img src="{{ asset('img/logo.png') }}" alt=""
                    width="30%"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a type="button" class="btn text-white bg-danger d-flex my-2 my-sm-0" href="project-index.html"
                            type="submit">
                            <p>Home</p>&nbsp;&nbsp;<p class="arabic">الصفحة الرئيسية</p> <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a type="button" class="btn btn-outline-danger d-flex my-2 my-sm-0" href="employee.html"
                            type="submit">
                            <p>Employees</p>&nbsp;&nbsp;<p class="arabic">موظفين </p> <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a type="button" class="btn btn-outline-danger d-flex my-2 my-sm-0" href="requests.html"
                            type="submit">
                            <p>Requests</p>&nbsp;&nbsp;<p class="arabic">طلبات </p> <span class="sr-only"></span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>  --}}
        <section>
            <div class="row">
                <div id="indexProjectMapId" style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                </div>
            </div>
            <hr>
        </section>
        <section>
            <div class="d-flex justify-content-between pb-1">
                <h4>Projects</h3>
                    <h3 class="arabic red">المشاريع
                </h4>
            </div>
            <div class="row">
                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic">جميع المشاريع &nbsp;</h6>
                                <h6>All Projects</h6>
                            </div>
                            <div>
                                <h1 id="allProjects"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>

                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic"> مكتمل &nbsp;</h6>
                                <h6> Completed </h6>
                                <h6 class="card-title"></h6>
                            </div>
                            <div>
                                <h1 id="completedProjects"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>
                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic"> في تَقَدم &nbsp;</h6>
                                <h6> In Progress </h6>
                                <h6 class="card-title"></h6>
                            </div>
                            <div>
                                <h1 id="inprogressProjects"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>
                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic">لم يبدأ &nbsp;</h6>
                                <h6> Not Started </h6>
                                <h6 class="card-title"></h6>
                            </div>
                            <div>
                                <h1 id="notStartedProject"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>
            </div>
            <hr>
        </section>
        <section>
            <div class="d-flex justify-content-between pb-1">
                <h4>Tasks</h3>
                    <h3 class="arabic red">المهام
                </h4>
            </div>
            <div class="row">
                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic">كل المهام &nbsp;</h6>
                                <h6> All Tasks </h6>
                            </div>
                            <div>
                                <h1 id="allTasks"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>

                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic"> مكتمل &nbsp;</h6>
                                <h6> Completed </h6>
                                <h6 class="card-title"></h6>
                            </div>
                            <div>
                                <h1 id="completedTasks"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>
                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic"> في تَقَدم &nbsp;</h6>
                                <h6> In Progress </h6>
                                <h6 class="card-title"></h6>
                            </div>
                            <div>
                                <h1 id="inprogressTasks"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>
                <div class="card col-12 col-lg-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="arabic">لم يبدأ &nbsp;</h6>
                                <h6> Not Started </h6>
                                <h6 class="card-title"></h6>
                            </div>
                            <div>
                                <h1 id="notStartedTasks"></h1>
                            </div>
                        </div>
                        <a href="#" class="btn save-btn w-100 d-flex justify-content-between align-items-center">
                            <p>View</p><i class="fa-solid fa-eye"></i>
                            <p class="arabic">منظر</p>
                        </a>
                    </div>
                </div>
            </div>

        </section>

        <section>
            <hr>
            <div class="row mb-3">
                <div class="col-md-4">
                    <h4 class="d-inline">All Projects / &nbsp;</h4>
                    <h4 class="d-inline arabic">جميع المشاريع</h4>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="filter_button" class="btn save-btn">Filter</button> |
                            <button type="button" id="clear_filter_button" class="btn save-btn">Clear</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    @if (Auth::user()->can('Add Project'))
                        <a href="#" class="btn save-btn align-items-center  d-flex justify-content-center" data-toggle="modal"
                            data-target="#projectModal">
                            <p class="pb-0 mb-0">Add Project</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">إضافة مشروع
                            </p>
                        </a>
                    @endif
                </div>

            </div>

            <!-- =========================== -->

            <section>
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active btn btn-outline-danger px-5 my-2 my-sm-0 d-flex"
                                id="inventory-tab" data-toggle="tab" href="#inventory" role="tab"
                                aria-controls="inventory" aria-selected="true">
                                <p class="pb-0 mb-0">List View</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">عرض القائمة
                                </p>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link btn btn-outline-danger my-2 px-5 my-sm-0 d-flex" id="vendors-tab"
                                data-toggle="tab" href="#vendors" role="tab" aria-controls="vendors"
                                aria-selected="false">
                                <p class="pb-0 mb-0">Card View</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">عرض البطاقة
                                </p>
                            </button>
                        </li>

                    </ul>
                </div>
                <div class="tab-content mt-3" id="myTabsContent">
                    <div class="tab-pane fade show active" id="inventory" role="tabpanel"
                        aria-labelledby="inventory-tab">

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
                                    <th scope="col" style="width: 120px !important">
                                        <p class="arabic red"> منظر</p>
                                        <p>View</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Total</th>
                                    <th scope="col">
                                        total budget
                                    </th>
                                    <th scope="col">total spend</th>

                                    <th scope="col">total balance</th>

                                    <th scope="col">
                                        <p class="arabic red">المجموع</p>
                                    </th>

                                    <th scope="col"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">

                        <div class="row">
                            @foreach ($projects as $project)
                                <div class="col-12 col-md-4 col-lg-3 pb-3">
                                    <img src="{{ $project->featured_image_url }}" class="card-img-top" alt="..."
                                        height="150px">
                                    <div class="card-body text-center px-0">

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="arabic red">رقم المشروع</p>
                                                <p class="mx-0 px-0 text-left">Project No.</p>
                                            </div>
                                            <h4>{{ $project->id }}</h4>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <h6>Project Name</h6>
                                            <h6 class="arabic red">اسم المشروع</h6>
                                        </div>

                                        <h6 class="card-text mt-0">{{ $project->project_name }}</h6>
                                    </div>
                                    @if ($project->status == App\Models\Project::NOTSTARTED)
                                        <div
                                            class="d-flex justify-content-between bg-secondary text-white w-100 px-2 align-items-center">
                                            <div>
                                                <a href="{{ route('projects.show', ['id' => $project->id]) }}"
                                                    class="btn w-100">
                                                    <p class="text-white">Waiting to start</p>
                                                </a>
                                            </div>
                                            <a href="{{ route('projects.show', ['id' => $project->id]) }}"><i
                                                    class="fa-solid fa-eye text-white"></i></a>
                                        </div>
                                    @elseif($project->status == App\Models\Project::COMPLETED)
                                        <div
                                            class="d-flex justify-content-between bg-success text-white w-100 px-2 align-items-center">
                                            <div>
                                                <a href="{{ route('projects.show', ['id' => $project->id]) }}"
                                                    class="btn btn-success w-100"><i
                                                        class="fa-solid fa-thumbs-up"></i></a>
                                            </div>
                                            <a href="{{ route('projects.show', ['id' => $project->id]) }}"><i
                                                    class="fa-solid fa-eye text-white"></i></a>
                                        </div>
                                    @elseif($project->status == App\Models\Project::INPROGRESS)
                                        <a href="{{ route('projects.show', ['id' => $project->id]) }}">
                                            <div class="progress" style="height: 38px;">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $project->calculateOverallCompletionPercentage() }}%; color: {{ $project->calculateOverallCompletionPercentage() <= 0 ? 'black' : 'white' }}"
                                                    aria-valuenow="{{ $project->calculateOverallCompletionPercentage() }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $project->calculateOverallCompletionPercentage() }}%
                                                </div>

                                            </div>
                                        </a>
                                    @endif


                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>

            </section>
            <!-- ==============================        -->


        </section>

        @include('admin.project_managements._models._add_project')
        @include('admin.project_managements._models._edit_project')
    </div>
@endsection
@section('script')
    <script>
        var projectManagemntIndexUrl = "{{ route('project.managemant.index') }}";
        var projectManagemntStatsUrl = "{{ route('project.managemant.stats') }}";
        var projectByIdUrl = "{{ route('project.by.id') }}";
        var tasks = JSON.parse('{!! addslashes(json_encode($projectTasks)) !!}');
    </script>

    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
    <script src="{{ asset('project_management/Index.js') }}"></script>

@endsection
