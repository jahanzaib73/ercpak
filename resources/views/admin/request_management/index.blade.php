@extends('layouts.app')
@section('request-management-active-class', 'active')

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
            <div class="d-flex justify-content-center mb-3">
                <div class="d-flex">
                    <h4>All Requests / &nbsp;</h4>
                    <h4 class="arabic">جميع الطلبات </h4>
                </div>
            </div>

            <!-- =========================== -->

            <section>
                <div class="d-flex justify-content-between">

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
                    <div>
                        @if (Auth::user()->can('New Request'))
                            <a href="#" class="btn save-btn mr-3 align-items-center d-flex" data-toggle="modal"
                                data-target="#addRequestModal">
                                <p class="pb-0 mb-0">New Request</p>&nbsp; / &nbsp; <p class="pb-0 mb-0 arabic"> طلب جديد
                                </p>
                            </a>
                        @endif

                    </div>
                </div>
                <div class="tab-content mt-2" id="myTabsContent">
                    <div class="tab-pane fade show active" id="inventory" role="tabpanel" aria-labelledby="inventory-tab">

                        <table class="table table-hover small pt-3" id="requestTbl">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <p class="arabic red">رقم التسلسل</p>
                                        <p>S.#</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">رقم الطلب </p>
                                        <p>Request #</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">تاريخ </p>
                                        <p>Date</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">نوع الطلب </p>
                                        <p>Request Type</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red"> اسم الطالب</p>
                                        <p>Requestee Name</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red">الأموال المطلوبة</p>
                                        <p>Funds Requested</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red"> اسم المدينة </p>
                                        <p>City Name</p>
                                    </th>
                                    <th scope="col">
                                        <p class="arabic red"> رقم الاتصال </p>
                                        <p>Contact #</p>
                                    </th>

                                    <th scope="col">
                                        <p class="arabic red"> المرفقات</p>
                                        <p>Attachments</p>
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
                    </div>
                    <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">

                        <div class="row">
                            @foreach ($requets as $request)
                                <div class="col-12 col-md-4 col-lg-3 pb-3">
                                    <img src="{{ $request->featured_image_url }}" class="card-img-top"
                                        alt="..."height="150px">
                                    <div class="card-body text-center">
                                        <h5 class="card-title mb-0">Request #: {{ $request->id }}</h5>
                                        <p class="card-text mt-0">{{ $request->requestee_name }}</p>
                                    </div>
                                    @if ($request->status == App\Models\RequestManagement::NOTSTARTED)
                                        <a href="{{ route('requests.show', ['id' => $request->id]) }}">
                                            <div class="progress" style="height: 38px;">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 92%;"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                    style="color: white">Waiting to Start
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($request->status == App\Models\RequestManagement::INPROGRESS)
                                        <a href="{{ route('requests.show', ['id' => $request->id]) }}">
                                            <div class="progress" style="height: 38px;">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 92%;"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                                    style="color: white">INROGRESS
                                                </div>
                                            </div>
                                        </a>
                                    @elseif($request->status == App\Models\RequestManagement::COMPLETED)
                                        <a href="{{ route('requests.show', ['id' => $request->id]) }}">
                                            <div class="progress" style="height: 38px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 92%;" aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100" style="color: white">COMPLETED
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <hr>
            </section>
            <!-- ==============================        -->


        </section>


        <!-- ========MODAL NEW PROJECT+============= -->
        @include('admin.request_management._modals._add_request')
        @include('admin.request_management._modals._edit_request')
        @include('admin.request_management._modals._upload')
    </div>
@endsection
@section('script')
    <script>
        var table = $('#requestTbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('requests.index') }}",
                data: function(data) {
                    data.session_year = $('#session').val();
                    data.start_date = $('#start_date').val();
                    data.end_date = $('#end_date').val();
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'request_date',
                    name: 'request_date',
                },
                {
                    data: 'requestType',
                    name: 'requestType',
                },
                {
                    data: 'requestee_name',
                    name: 'requestee_name',
                },
                {
                    data: 'funds_requested',
                    name: 'funds_requested',
                },
                {
                    data: 'city',
                    name: 'city',
                },
                {
                    data: 'contact',
                    name: 'contact',
                },
                {
                    data: 'attachments',
                    name: 'attachments',
                },
                {
                    data: 'status',
                    name: 'status',
                }, {
                    data: 'action',
                    name: 'action',
                }
            ],
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                // Ensure that there is data in the table
                if (api.rows({
                        search: 'applied'
                    }).data().length > 0) {
                    // Calculate the sum for budget, spend, and balance
                    var totalBudget = 0;
                    var totalSpend = 0;
                    var totalBalance = 0;

                    api.column(4, {
                        search: 'applied'
                    }).data().each(function(value) {
                        var numericValue = parseFloat(value.replace(/,/g, ''));
                        if (!isNaN(numericValue)) {
                            totalBudget += numericValue;
                        }
                    });

                    api.column(5, {
                        search: 'applied'
                    }).data().each(function(value) {
                        var numericValue = parseFloat(value.replace(/,/g, ''));
                        if (!isNaN(numericValue)) {
                            totalSpend += numericValue;
                        }
                    });

                    api.column(6, {
                        search: 'applied'
                    }).data().each(function(value) {
                        var numericValue = parseFloat(value.replace(/,/g, ''));
                        if (!isNaN(numericValue)) {
                            totalBalance += numericValue;
                        }
                    });

                    // Display the calculated totals in the footer row
                    $(api.column(4).footer()).html(totalBudget.toFixed(2));
                    $(api.column(5).footer()).html(totalSpend.toFixed(2));
                    $(api.column(6).footer()).html(totalBalance.toFixed(2));
                } else {
                    // No data in the table, display default values or an appropriate message
                    $(api.column(4).footer()).html('N/A');
                    $(api.column(5).footer()).html('N/A');
                    $(api.column(6).footer()).html('N/A');
                }
            }



        });

        $("#addRequestForm").validate({
            errorPlacement: function(error, element) {
                if (element.is('select')) {
                    error.insertAfter(element); // Place error message below select
                } else {
                    error.insertAfter(element); // Default placement for other fields
                }
            },
            rules: {
                request_type_id: {
                    required: true,
                },
                request_date: {
                    required: true,
                },
                requestee_name: {
                    required: true,
                },
                age: {
                    required: true,
                    digits: true,
                },
                gender: {
                    required: true,
                },
                country_id: {
                    required: true,
                },
                province_id: {
                    required: true,
                },
                city_id: {
                    required: true,
                },
                contact: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                funds_requested: {
                    required: true,
                    number: true,
                },
                currency_id: {
                    required: true,
                },
                featured_image: {
                    required: true,
                },
            },
        });

        $('#addRequestBtn').click(function() {
            var formElement = document.getElementById('addRequestForm'); // Get the form element
            var formData = new FormData(formElement); // Create FormData from the form

            if ($(formElement).valid()) { // Check if the form is valid
                var url = $('#addRequestForm').attr('action');
                var method = $('#addRequestForm').attr('method');
                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {

                            // Clear input values
                            $('#addRequestModal input, #addRequestModal select, #addRequestModal textarea')
                                .val('');

                            $.Notification.autoHideNotify('success', 'top right', 'Request',
                                'Request Addedd Successfully');
                            $('#addRequestModal').modal('hide');

                            setTimeout(() => {
                                window.location.reload();
                            }, 500);

                        } else {
                            $.Notification.autoHideNotify('error', 'top right', 'Task',
                                response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $.Notification.autoHideNotify('error', 'top right', 'Task',
                            'Something went wrong');
                    }
                });

            }
        });


        $('body').on('click', '.editRequest', function(e) {
            var requestId = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{ route('requests.by.id') }}",
                data: {
                    requestId: requestId
                },
                success: function(response) {
                    if (response.status) {
                        var request = response.data
                        $('#requeestId').val(request.id)
                        $('#requestEditId').val(request.id)
                        $('#contact_edit').val(request.contact)
                        $('#request_date_edit').val(request.request_date)
                        $('#requestee_name_edit').val(request.requestee_name)
                        $('#age_edit').val(request.age)
                        $('#email_edit').val(request.email)
                        $('#funds_requested_edit').val(request.funds_requested)
                        $('#notes_edit').val(request.notes)
                        $('#notes_arabic_edit').val(request.notesarabic)
                        $('#status').val(request.status).trigger('change')

                        $('#request_type_id_edit').val(request.request_type_id).trigger('change')
                        $('#gende_edit').val(request.gender).trigger('change')
                        $('#country_id_edit').val(request.country_id).trigger('change')
                        $('#province_id_edit').val(request.province_id).trigger('change')
                        $('#city_id_edit').val(request.city_id).trigger('change')
                        $('#currency_id_edit').val(request.currency_id).trigger('change')
                        $("#editRequestModal").modal('show');
                    }
                }
            });
        });



        $("#editRequestForm").validate({
            errorPlacement: function(error, element) {
                if (element.is('select')) {
                    error.insertAfter(element); // Place error message below select
                } else {
                    error.insertAfter(element); // Default placement for other fields
                }
            },
            rules: {
                request_type_id: {
                    required: true,
                },
                request_date: {
                    required: true,
                },
                requestee_name: {
                    required: true,
                },
                age: {
                    required: true,
                    digits: true,
                },
                gender: {
                    required: true,
                },
                country_id: {
                    required: true,
                },
                province_id: {
                    required: true,
                },
                city_id: {
                    required: true,
                },
                contact: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                funds_requested: {
                    required: true,
                    number: true,
                },
                currency_id: {
                    required: true,
                },
            }
        });

        $('#editRequestBtn').click(function() {
            var formElement = document.getElementById('editRequestForm'); // Get the form element
            var formData = new FormData(formElement); // Create FormData from the form

            if ($(formElement).valid()) { // Check if the form is valid
                var url = $('#editRequestForm').attr('action');
                var method = $('#editRequestForm').attr('method');
                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            //$('.ajax-table').DataTable().ajax.reload();

                            // Clear input values
                            $('#editRequestForm input, #editRequestForm select, #editRequestForm textarea')
                                .val('');

                            $.Notification.autoHideNotify('success', 'top right', 'Request',
                                'Request Updated Successfully');
                            $('#editRequestForm').modal('hide');

                            setTimeout(() => {
                                window.location.reload();
                            }, 500);

                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $.Notification.autoHideNotify('error', 'top right', 'Team',
                            'Something went wrong');
                    }
                });

            }
        });


        $('body').on('click', '.uploadImages', function(e) {
            var id = $(this).attr('data-id');
            $('#request_id').val(id);
            $('#uploadModal').modal('show');
        });

        $("#uploadForm").validate({
            errorPlacement: function(error, element) {
                if (element.is('select')) {
                    error.insertAfter(element); // Place error message below select
                } else {
                    error.insertAfter(element); // Default placement for other fields
                }
            },
            rules: {
                title: {
                    required: true,
                },
                notes: {
                    required: true,
                },
                file: {
                    required: true,
                }
            }
        });

        $('#uploadBtn').click(function() {
            var formElement = document.getElementById('uploadForm'); // Get the form element
            var formData = new FormData(formElement); // Create FormData from the form

            if ($(formElement).valid()) { // Check if the form is valid
                var url = $('#uploadForm').attr('action');
                var method = $('#uploadForm').attr('method');
                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {
                            //$('.ajax-table').DataTable().ajax.reload();

                            // Clear input values
                            $('#uploadModal input, #uploadModal select, #uploadModal textarea')
                                .val('');

                            $.Notification.autoHideNotify('success', 'top right', 'Request',
                                'File Uploaded Successfully');
                            {{--  $('#uploadModal').modal('hide');  --}}
                            table.draw()


                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $.Notification.autoHideNotify('error', 'top right', 'Team',
                            'Something went wrong');
                    }
                });

            }
        });
    </script>
@endsection
