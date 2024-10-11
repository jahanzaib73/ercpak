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
        <section>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div id="projectMapId" style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <h6>Project No.</h6>
                        <h4 id="projectId">{{ $project->id }}</h4>
                        <h6 class="arabic red">رقم المشروع</h6>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6>Project Name</h6>
                        <h5>{{ $project->project_name }}</h5>
                        <h6 class="arabic red">اسم المشروع</h6>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="col-5">
                            <h6 class="arabic red">عدد المهام</h6>
                            <h6>Number of Tasks :</h6>

                            <h5>{{ optional($project->tasks)->count() }}</h5>
                        </div>

                        <div class="col-7">
                            <div class="d-flex justify-content-between">
                                <h6>Project Status</h6>
                                <h6 class="arabic red">حالة المشروع</h6>
                            </div>

                            <div class="progress my-3" style="height: 38px;">
                                <div class="progress-bar bg-danger" role="progressbar"
                                    style="width: {{ $project->calculateOverallCompletionPercentage() }}%; color: {{ $project->calculateOverallCompletionPercentage() <= 0 ? 'black' : 'white' }}"
                                    aria-valuenow="{{ $project->calculateOverallCompletionPercentage() }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ $project->calculateOverallCompletionPercentage() }}%</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <h6 class="arabic red">ميزانية المشروع</h6>
                                        <h6>Budget</h6>
                                    </th>
                                    <th scope="col">
                                        <h6 class="arabic red">الأموال المستخدمة</h6>
                                        <h6>Spend</h6>
                                    </th>
                                    <th scope="col">
                                        <h6 class="arabic red">الأموال المتبقية</h6>
                                        <h6>Balance</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $project->budget }}{{ optional($project->currency)->name }}</td>
                                    <td>{{ $project->getSpendAmount() }}</td>
                                    <td>{{ $project->getBalanceAmount() }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>

        <section>
            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active btn btn-outline-danger px-5 my-2 my-sm-0 d-flex" id="task-tab"
                        data-toggle="tab" href="#task" role="tab" aria-controls="task" aria-selected="true">
                        <p>Tasks</p> &nbsp; / &nbsp; <p class="arabic">مهام</p>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-outline-danger my-2 px-5 my-sm-0 d-flex" id="expense-tab"
                        data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="false">
                        <p>Expenses</p> &nbsp; / &nbsp; <p class="arabic">نفقات</p>
                    </button>
                </li>

            </ul>
            <div class="tab-content mt-3" id="myTabsContent">
                <div class="tab-pane fade show active" id="task" role="tabpanel" aria-labelledby="task-tab">

                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h4>All Tasks / &nbsp;</h4>
                            <h4 class="arabic">كل المهام </h4>
                        </div>

                        <div>
                            @if (Auth::user()->can('Add Task'))
                                <a href="#" class="btn btn-secondary d-flex" data-toggle="modal"
                                    data-target="#taskAdd">
                                    <p class="pb-0 mb-0">Add Task</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">إضافة مهمة
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
                                        <p class="pb-0 mb-0">List View</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">عرض
                                            القائمة </p>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link btn btn-outline-danger my-2 px-5 my-sm-0 d-flex"
                                        id="vendors-tab" data-toggle="tab" href="#vendors" role="tab"
                                        aria-controls="vendors" aria-selected="false">
                                        <p class="pb-0 mb-0">Card View</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">عرض
                                            البطاقة </p>
                                    </button>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content mt-3" id="myTabsContent">
                            <div class="tab-pane fade show active" id="inventory" role="tabpanel"
                                aria-labelledby="inventory-tab">

                                <table class="table table-hover small" id="tasKListTbl">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <p class="arabic red">رقم التسلسل</p>
                                                <p>S.#</p>
                                            </th>
                                            <th scope="col">
                                                <p class="arabic red">رقم المهمة </p>
                                                <p>Task #</p>
                                            </th>
                                            <th scope="col">
                                                <p class="arabic red">اسم المهمة</p>
                                                <p>Task Name</p>
                                            </th>
                                            <th scope="col">
                                                <p class="arabic red">اسم المهمة</p>
                                                <p>Project Name</p>
                                            </th>
                                            <th scope="col">
                                                <p class="arabic red"> ميزانية المشروع</p>
                                                <p>Budget</p>
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
                                                <p class="arabic red"> تم بواسطة</p>
                                                <p>Done By</p>
                                            </th>
                                            <th scope="col">
                                                <p class="arabic red"> منظر</p>
                                                <p>View</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3"></th>
                                            <th scope="col">Total</th>
                                            <th scope="col">
                                                {{ number_format(optional($project->tasks())->sum('amount'), 2) }}</th>
                                            <th scope="col">
                                                <p class="arabic red">المجموع</p>
                                            </th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">

                                <div class="row">

                                    @foreach ($projectTasks as $task)
                                        <div class="col-12 col-md-4 col-lg-3 pb-3">
                                            <img src="{{ $task->featured_image_url }}" class="card-img-top"
                                                alt="..." height="150px">
                                            <div class="card-body text-center px-0">

                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">Task #: {{ $task->id }}</h5>
                                                    <p class="card-text mt-0">{{ $task->task_name }}</p>
                                                </div>

                                            </div>
                                            @if ($task->status == App\Models\ProjectTask::NOTSTARTED)
                                                <div
                                                    class="d-flex justify-content-between bg-secondary text-white w-100 px-2 align-items-center">
                                                    <div>
                                                        <a href="#" class="btn w-100">
                                                            <p class="text-white">Waiting to start</p>
                                                        </a>
                                                    </div>
                                                    <a href="#"><i class="fa-solid fa-eye text-white"></i></a>
                                                </div>
                                            @elseif($task->status == App\Models\ProjectTask::COMPLETED)
                                                <div
                                                    class="d-flex justify-content-between bg-success text-white w-100 px-2 align-items-center">
                                                    <div>
                                                        <a href="#" class="btn btn-success w-100"><i
                                                                class="fa-solid fa-thumbs-up"></i></a>
                                                    </div>
                                                    <a href="#"><i class="fa-solid fa-eye text-white"></i></a>
                                                </div>
                                            @elseif($task->status == App\Models\ProjectTask::INPROGRESS)
                                                <div class="progress" style="height: 38px;">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                        style="width: {{ $task->task_percentage }}%; color: {{ $task->task_percentage <= 0 ? 'black' : 'white' }}"
                                                        aria-valuenow="{{ $task->task_percentage }}" aria-valuemin="0"
                                                        aria-valuemax="100">{{ $task->task_percentage }}%</div>
                                                </div>
                                            @endif


                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <hr>
                    </section>


                </div>
                <!-- ==============================        -->


                <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab">
                    <div class="d-flex justify-content-between mb-2">
                        <div class="d-flex">
                            <h4>Expenses / &nbsp;</h4>
                            <h4 class="arabic">نفقات </h4>
                        </div>

                        <div>
                            @if (Auth::user()->can('Add Expenses'))
                                <a href="#" class="btn btn-secondary d-flex" data-toggle="modal"
                                    data-target="#expenseModal">
                                    <p class="pb-0 mb-0">Add Expense</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic">أضف
                                        النفقات </p>
                                </a>
                            @endif
                        </div>

                    </div>
                    <table class="table table-hover small" id="expenseTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <p class="arabic red">رقم التسلسل</p>
                                    <p>S.#</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">تاريخ </p>
                                    <p>Date</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">مهمة </p>
                                    <p>Task</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">تفاصيل </p>
                                    <p>Description</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">رقم الفاتوره </p>
                                    <p>Bill #</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">كمية </p>
                                    <p>Amount</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">بائع </p>
                                    <p>Vendor</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">حالة السداد </p>
                                    <p>Payment Status</p>
                                </th>
                                <th scope="col">
                                    <p class="arabic red">منظر </p>
                                    <p>View</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                                <th scope="col"></th>
                                <th scope="col">Total</th>
                                <th scope="col">
                                    {{ number_format($projectTasks->sum(function ($task) {return $task->expenses()->sum('amount');}),2) }}
                                </th>
                                <th scope="col">
                                    <p class="arabic red">المجموع</p>
                                </th>

                                <th scope="col"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>


        </section>
        <h3>Project Images</h3>
        <hr>
        <div class="row">
            @foreach ($project->attachments as $attachment)
                <div class="col-md-3 mb-3">
                    @if (is_image($attachment->file_url))
                        <img src="{{ asset($attachment->file_url) }}" style="width: 50%" class="img-fluid img-thumbnail"
                            alt="Image" data-toggle="modal" data-target="#imageModal{{ $loop->index }}">
                    @else
                        <a href="#" data-toggle="modal" data-target="#fileModal{{ $loop->index }}">
                            <img src="{{ asset(get_file_icon($attachment->file_url)) }}" style="width: 50%"
                                class="img-fluid img-thumbnail" alt="File Icon">
                        </a>
                        {{--  <a href="{{ asset($attachment->file_url) }}" class="btn btn-primary btn-sm mt-2" download>
                            Download
                        </a>  --}}
                    @endif
                </div>

                <!-- Modal -->
                <div class="modal fade"
                    id="{{ is_image($attachment->file_url) ? 'imageModal' : 'fileModal' }}{{ $loop->index }}"
                    tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $loop->index }}" aria-hidden="true">
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

        <!-- ========MODAL ADD EXPENSES============= -->
        @include('admin.project_managements._models._add_expenses')
        @include('admin.project_managements._models._edit_expenses')

        <!-- ========MODAL NEW TASK+============= -->
        @include('admin.project_managements._models._add_task')
        @include('admin.project_managements._models._edit_task')

        <!-- ========MODAL START PROJECT+============= -->
        @include('admin.project_managements._models._start_task')

        <!-- ========MODAL COMPLETE PROJECT+============= -->
        @include('admin.project_managements._models._complete_task')

        <!-- ========MODAL Add Percentage+============= -->
        @include('admin.project_managements._models._add_task_percentage')

        @include('admin.project_managements._models._expense_attachment')
    </div>
@endsection
@section('script')
    <script>
        var projectTaskUrl = "{{ route('projects.tasks.index') }}";
        var expenseUrl = "{{ route('expense.index') }}";
        var taskById = "{{ route('task.by.id') }}";
        var expenseById = "{{ route('expense.by.id') }}";
        var project_id = "{{ $project->id }}"
        var tasks = JSON.parse('{!! addslashes(json_encode($projectTasks)) !!}');

        $('body').on('click', '.showAttachments', function(e) {
            var expenseId = $(this).data('id');
            $.ajax({
                url: "{{ route('expense.attachment') }}",
                type: 'GET',
                data: {
                    expenseId: expenseId
                },
                success: function(data) {
                    if (data.status) {
                        var attachments = data.data.attachments;
                        var container = $('.attachments-container').empty();

                        // Add Bootstrap row
                        var row = $('<div class="row"></div>');
                        container.append(row);

                        attachments.forEach(function(attachment) {
                            // Create a Bootstrap column for each attachment
                            var attachmentDiv = $('<div class="col-md-4 mb-3"></div>');

                            var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                            var fileType = attachment.file_type.toLowerCase();

                            if (imageExtensions.includes(fileType)) {
                                // If it's an image, display the image
                                attachmentDiv.append('<img width="100%" src="' + attachment
                                    .file_url +
                                    '" alt="' + attachment.file_name + '">');
                            } else {
                                // If it's not an image, display an icon and a download button
                                //attachmentDiv.append(
                                //  '<img width="150" src="{{ asset('icons/pdf.png') }}"><br>'
                                //);
                                var iconMap = {
                                    'pdf': '{{ asset('icons/pdf.png') }}',
                                    'doc': '{{ asset('icons/doc.webp') }}',
                                    'xlsx': '{{ asset('icons/xls.png') }}',
                                    // Add more file types and corresponding icon paths as needed
                                };
                                if (iconMap[fileType]) {
                                    // If there's a dynamic icon for the file type, display it
                                    attachmentDiv.append('<img width="150" src="' + iconMap[
                                        fileType] + '"><br>');
                                } else {
                                    // If there's no dynamic icon, display a default icon
                                    attachmentDiv.append('<i class="fa fa-file-o"></i><br>');
                                }

                                attachmentDiv.append('<a class="btn btn-info" href="' +
                                    attachment.file_url +
                                    '" download="' + attachment.file_name + '">Download</a>'
                                );
                            }

                            // Append the attachment column to the row
                            row.append(attachmentDiv);
                        });

                        // Show the modal after adding all attachments
                        $('#expenseAttachmentsModal').modal('show');
                    }
                },

                error: function(error) {
                    console.error('Error fetching attachments:', error);
                }
            });

        });
    </script>

    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
    <script src="{{ asset('project_management/Project.js') }}"></script>
    <script src="{{ asset('project_management/Task.js') }}"></script>
    <script src="{{ asset('project_management/Expense.js') }}"></script>

@endsection
