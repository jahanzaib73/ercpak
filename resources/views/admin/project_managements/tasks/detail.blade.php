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

        html body .print-tab {
            background: rgb(255, 255, 255);

        }



        .title-page {
            width: 100vh;
            height: 135vh;
            position: relative;
            background-image: url("{{ asset('img/ERC_Report.png') }}");
            background-size: cover;
        }

        .overlay_class {
            width: 100%;
            height: 95%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-top: 170px;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);

        }

        @media print {
            page {
                size: A4;
                background: white;
                width: max-content;
                margin: 0 auto;
                margin-bottom: 0.5cm;


            }


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
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        {{--  <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand" href="project-index.html"><img src="img/logo.png" alt="" width="30%"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-lg-0">
                    <input class="form-control mr-sm-2 arabic px-4" type="search" placeholder="ابحث هنا"
                        aria-label="Search">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"><i
                            class="fa-solid fa-magnifying-glass fa-xl"></i></button>
                </form>
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
        <div class="no-print">


            <section>
                {{--  <hr>  --}}
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between">
                            <h6>Task # :</h6>
                            <h5> &nbsp;&nbsp;&nbsp; {{ $task->id }}</h5>
                            <h6 class="arabic red">: رقم المهمة</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6>Task Name :</h6>
                            <h5> &nbsp;&nbsp;&nbsp; {{ $task->task_name }}</h5>
                            <h6 class="arabic red">: اسم المهمة</h6>
                        </div>

                        <hr>
                        <div class="row ">
                            <div class="col-12 col-md-6 w-100">
                                <h4>Description of Task</h4>
                                <p>{{ $task->task_description }}</p>
                            </div>
                            <div class="col-12 col-md-6">
                                <h4 class="arabic red text-right">وصف المهمة </h4>
                                <p class="arabic text-right">{{ $task->task_description_arabic }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div>
                            <div id="projectTaskMapId"
                                style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between pt-3">
                                <h6>Project Status</h6>
                                <h6 class="arabic red">حالة المشروع</h6>
                            </div>

                            <div class="progress mb-3" style="height: 38px;">
                                <div class="progress-bar bg-danger" role="progressbar"
                                    style="width: {{ $task_percentage }}%;" aria-valuenow="{{ $task_percentage }}"
                                    aria-valuemin="0" aria-valuemax="100">{{ $task_percentage }}%</div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
            </section>
            <section>
                <div class="d-flex justify-content-around">
                    <h4>Team Members</h4>
                    <h4 class="arabic red">أعضاء الفريق</h4>
                </div>
                <hr>
                <div class="row d-flex justify-content-center">
                    @foreach ($task->members as $member)
                        <div class="col-12 col-md-3">
                            <div class="text-center">
                                <img src="{{ optional($member->user)->profile_pic_url ? optional($member->user)->profile_pic_url : asset('img/emp1.png') }}"
                                    class="card-img-top w-50" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ optional($member->user)->full_name }}</h5>
                                    <p class="card-text">{{ optional(optional($member->user)->designation)->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
            <section>
                <div class="d-flex justify-content-around">
                    <h4>Project Attachments</h4>
                    <h4 class="arabic red">أعضاء الفريق</h4>
                </div>
                <hr>
                <div class="row d-flex">
                    @foreach ($task->attachments as $attachment)
                        <div class="col-md-3 mb-3">
                            @if (is_image($attachment->file_url))
                                <img src="{{ asset($attachment->file_url) }}" style="width: 50%"
                                    class="img-fluid img-thumbnail" alt="Image" data-toggle="modal"
                                    data-target="#imageModal{{ $loop->index }}">
                            @else
                                <a href="#" data-toggle="modal" data-target="#fileModal{{ $loop->index }}">
                                    <img src="{{ asset(get_file_icon($attachment->file_url)) }}" style="width: 50%"
                                        class="img-fluid img-thumbnail" alt="File Icon">
                                </a>
                            @endif
                        </div>

                        <!-- Modal -->
                        <div class="modal fade"
                            id="{{ is_image($attachment->file_url) ? 'imageModal' : 'fileModal' }}{{ $loop->index }}"
                            tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $loop->index }}"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $loop->index }}">
                                            {{ is_image($attachment->file_url) ? 'Image' : 'File' }}
                                            Popup</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        @if (is_image($attachment->file_url))
                                            <img src="{{ asset($attachment->file_url) }}" class="img-fluid" alt="Image">
                                        @else
                                            <p>This is a non-image file.</p>
                                            <a href="{{ asset($attachment->file_url) }}" class="btn btn-primary" download>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <section>
                <hr>
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active d-flex" id="inventory-tab" data-toggle="tab" href="#inventory"
                            role="tab" aria-controls="inventory" aria-selected="true">Activity &nbsp; / &nbsp; <p
                                class="arabic red">نشاط</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" id="vendors-tab" data-toggle="tab" href="#vendors" role="tab"
                            aria-controls="vendors" aria-selected="false">Report &nbsp; / &nbsp;<p class="arabic red">
                                تقرير</p></a>
                    </li>

                </ul>
                <div class="tab-content mt-3" id="myTabsContent">
                    <div class="tab-pane fade show active" id="inventory" role="tabpanel"
                        aria-labelledby="inventory-tab">
                        <div class="d-flex justify-content-between mb-2">
                            <div class="d-flex">
                                <h4>All Activities &nbsp; / &nbsp;</h4>
                                <h4 class="arabic red">كل الأنشطة</h4>
                            </div>

                            <div>
                                <a href="#" class="btn btn-secondary d-flex" data-toggle="modal"
                                    data-target="#activityModal">Add Activity &nbsp; / &nbsp;<p class="arabic">أضف نشاط
                                    </p>
                                </a>
                            </div>

                        </div>
                        <table class="table table-hover small">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <p class="arabic red">رقم التسلسل</p>
                                        <p>#</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">اسم النشاط</p>
                                        <p>Activity Name</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">تاريخ</p>
                                        <p>Date</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">موقع</p>
                                        <p>Location</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">خط العرض</p>
                                        <p>latitude</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">خط الطول</p>
                                        <p>Longitude</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">ملاحظات</p>
                                        <p>Remarks</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">المرفقات</p>
                                        <p>Attachments</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $activity)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $activity->name }}</td>
                                        <td>{{ $activity->date }}</td>
                                        <td>{{ optional($activity->location)->name }}</td>
                                        <td>{{ $activity->latitude }}</td>
                                        <td>{{ $activity->longitude }}</td>
                                        <td>
                                            <span
                                                class="short-description">{{ substr($activity->description, 0, 30) }}....</span>
                                            <span class="full-description"
                                                style="display: none;">{{ $activity->description }}</span>
                                            <a href="javascript:void(0)" class="text-danger"
                                                onclick="toggleDescription(this)">See More</a>
                                        </td>
                                        <td><i class="fa-solid fa-paperclip"></i></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="tab-pane fade" style="display: inline-block !important; text-center" id="vendors"
                        role="tabpanel" aria-labelledby="vendors-tab">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('task.report.form', ['id' => $task->id]) }}" target="_blank"
                                class="btn btn-info">Print</a>
                            {{--  <h4>Report</h4>  --}}

                        </div>
                        {{--  <div class="print-tab page">
                            <page size="A4">

                                <div class="row m-0 p-0 align-items-center justify-content-between print-tab page">
                                    <div class="title-page">
                                        <div>
                                            <a onclick="window.print();" class="btn btn-secondary">Print</a>
                                        </div>
                                        <div class="overlay_class">
                                            <table class="table table-bordered w-50">

                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <p class="arabic red">المشاريع المهمة #</p>
                                                            <p>Project & Task #</p>
                                                        </th>
                                                        <td>{{ optional($task->project)->id }} / {{ $task->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <p class="arabic red">اسم المشروع</p>
                                                            <p>Project Name</p>
                                                        </th>
                                                        <td>{{ optional($task->project)->project_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <p class="arabic red">موقع</p>
                                                            <p>Location</p>
                                                        </th>
                                                        <td>{{ optional($task->location)->name }}</td>
                                                    </tr>
                                                </tbody>


                                            </table>

                                        </div>
                                    </div>

                                </div>

                            </page>
                        </div>
                        <div class="print-tab page">
                            <page size="A4">
                                <div class="px-5 py-0">
                                    <div class="m-0 p-0">
                                        <img src="{{ asset('img/ERC-Header.png') }}" alt="" width="100%">
                                    </div>
                                    <div class="text-center">
                                        <h4>Project Name Here</h4>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Project #</th>
                                                <th scope="col">Task #</th>
                                                <th scope="col">Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">{{ optional($task->project)->id }}</th>
                                                <td>{{ $task->id }}</td>
                                                <td>{{ optional($task->location)->name }}</td>
                                            </tr>

                                        </tbody>
                                    </table>


                                    <div>
                                        <div id="reportTaskMap"
                                            style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                                        </div>
                                    </div>
                                    <div class="text-center pt-3">
                                        <h5>Project Images</h5>
                                    </div>
                                    <div>
                                        <img src="{{ optional($task->project)->featured_image_url }}" alt=""
                                            width="100%" height="250px">
                                    </div>
                                    <hr>
                                    <div class="row pt-2">
                                        @if (optional($task->project)->attachments)
                                            @foreach ($task->project->attachments as $attachment)
                                                <div class="col-2">
                                                    <img src="{{ $attachment->file_url }}" alt=""
                                                        width="100%">
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <div class="p-0 m-0 pt-2">
                                    <img src="{{ asset('img/ERC-Footer.png') }}" alt="" width="100%">
                                </div>
                            </page>

                        </div>  --}}

                    </div>
                </div>


                <hr>

            </section>


            <!-- ========MODAL ADD PRINT============= -->
            @include('admin.project_managements._models._print')

            <!-- ========MODAL NEW ACTIVITY+============= -->
            @include('admin.project_managements._models._activity')

        </div>
    </div>
@endsection
@section('script')

    <script>
        var activities = JSON.parse('{!! addslashes(json_encode($activities)) !!}');
        var task = JSON.parse('{!! addslashes(json_encode($task)) !!}');
    </script>

    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
    <script src="{{ asset('project_management/Activity.js') }}"></script>
@endsection
