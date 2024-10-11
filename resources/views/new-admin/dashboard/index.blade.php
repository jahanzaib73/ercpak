@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'Dashboard Ecommerce')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link href="{{ asset('assets/plugins/fullcalendar2/fullcalendar.min.css') }}" rel="stylesheet" />


    <style>
        .display-date {
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.6rem;
            font-weight: 600;
        }

        .display-time {
            font-size: 1.6rem;
            font-weight: bold;
            padding: 20px 10px;
            border-radius: 5px;
            transition: .5s;
            transition-property: background, box-shadow, color;
            -webkit-box-reflect: below 2px linear-gradient(transparent, rgba(255, 255, 255, 0.05));
            text-align: center;
        }

        .display-time:hover {
            background: #d4d4d4;
            box-shadow: 0 0 30px#fff6dc;
            color: black;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <div class="col-xl-6 col-md-6 col-6">
                <div class="card card-statistics">
                    <div class="display-date">
                        <span id="day">day</span>,
                        <span id="daynum">00</span>
                        <span id="month">month</span>
                        <span id="year">0000</span>
                    </div>
                    <div class="display-time"></div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-6">
                <div class="card card-statistics">
                    <div id="reportrange" class="display-date" style=cursor: pointer; padding: 5px 10px; border: 1px solid
                        #ccc; width: 30%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <!-- Statistics Card -->
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Fleet</h4>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row">
                            <!-- Gate Pass Widget -->
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-primary me-2 h-100">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-car-front">
                                                <path
                                                    d="m21 8-2 2-1.5-3.7A2 2 0 0 0 15.646 5H8.4a2 2 0 0 0-1.903 1.257L5 10 3 8" />
                                                <path d="M7 14h.01" />
                                                <path d="M17 14h.01" />
                                                <rect width="18" height="8" x="3" y="10" rx="2" />
                                                <path d="M5 18v2" />
                                                <path d="M19 18v2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0" id="gate_pass_count">0</h4>
                                        <p class="card-text font-small-3 mb-0">تصريح خروج<br>Gate Pass</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Fuel Quantity and Amount Widget -->
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                <div class="d-flex flex-row">
                                    <div class="me-4">
                                        <h4 class="fw-bolder mb-0" id="fuel_entry_count">0</h4>
                                        <p class="card-text font-small-3 mb-0">كمية بترول<br>Fuel QTY</p>
                                    </div>
                                    <div class="avatar bg-light-info my-auto h-100">
                                        <div class="avatar-content">
                                            <img src="{{ asset('img/gas.png') }}" alt="Fuel Icon" width="24">
                                        </div>
                                    </div>
                                    <div class="ms-4">
                                        <h4 class="fw-bolder mb-0" id="fuel_entry_price">0.00</h4>
                                        <p class="card-text font-small-3 mb-0">مصاريف البترول<br>Fuel Amount</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Work Orders Widget -->
                            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-danger me-2 h-100">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-workflow">
                                                <rect width="8" height="8" x="3" y="3" rx="2" />
                                                <path d="M7 11v4a2 2 0 0 0 2 2h4" />
                                                <rect width="8" height="8" x="13" y="13" rx="2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0" id="work_order_count">0</h4>
                                        <p class="card-text font-small-3 mb-0">طلبات العمل<br>Work Orders</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vehicle Movement Widget -->
                            <div class="col-xl-3 col-sm-6 col-12">
                                <div class="d-flex flex-row">
                                    <div class="avatar bg-light-success me-2 h-100">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-car">
                                                <path
                                                    d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2" />
                                                <circle cx="7" cy="17" r="2" />
                                                <path d="M9 17h6" />
                                                <circle cx="17" cy="17" r="2" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-auto">
                                        <h4 class="fw-bolder mb-0" id="vehicle_movement_count">0</h4>
                                        <p class="card-text font-small-3 mb-0">حركة السيارات<br>Vehicle Movement</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--/ Statistics Card -->
        </div>

        <div class="row match-height">
            <!--/ Revenue Report Card -->
            <div class="col-lg-12 col-12">
                <div class="row match-height">
                    <!-- Bar Chart - Orders -->

                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body pb-50">
                                <div class="d-flex justify-content-between">
                                    <h5 class="header-title pb-3">Cases</h5>
                                    <h4 class="header-title pb-3">قضايا </h4>
                                </div>
                                <div class="panel-body">
                                    <canvas id="barChart-cases"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body pb-50">
                                <div class="d-flex justify-content-between">
                                    <h5 class="header-title pb-3">Amount</h5>
                                    <h4 class="header-title pb-3">مبلغ </h4>
                                </div>

                                <div class="panel-body">
                                    <canvas id="barChart-amount"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-lg-6 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="header-title pb-3">Protocol and Liaison Map</h5>
                            <h4 class="header-title pb-3">خريطة البروتوكولات والاتصالات </h4>
                        </div>
                        <div class="map" id="main_map" style="height: 471px !important"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="header-title pb-3">Meetings</h5>
                            <h4 class="header-title pb-3"> اجتماعات </h4>
                        </div>
                        <div id='calendar' class="col-sm-12 col-lg-12  m-b-30"></div>
                        <input type="hidden" id="clander_index_url" value="{{ route('meetings.clanderView') }}">
                    </div>
                </div>
            </div>

        </div>
        <div class="row match-height">
            <!-- Company Table Card -->
            <div class="col-lg-12 col-12">
                <div class="card card-company-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="recent-activity-table datatables-basic table table-hover m-b-0"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Action By</th>
                                        <th>Module Name</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/dashboard-ecommerce.js')) }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-js/Chart.bundle.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script async defer src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY"></script>
    <script>
        $(document).ready(function() {
            $('.myCourierTable').dataTable()
            $.ajax({
                type: "GET",
                url: $('#clander_index_url').val(),
                success: function(response) {
                    if (response.status) {

                        clandarData = response.clandarData
                        chartData = response.chartData
                        addMeetingOnClander(clandarData);
                    }

                }
            });

            var table = $('.recent-activity-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('recent.activitise') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'causer_id',
                        name: 'causer_id'
                    },
                    {
                        data: 'subject_type',
                        name: 'subject_type'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {{--  {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },  --}}
                ]
            });

            // Show marker and detail on map
            $.ajax({
                type: "GET",
                url: $('#map_url').val(),
                success: function(response) {
                    console.log(response)
                    if (response.status) {
                        console.log(response);
                        {{--  var iconsArray = [
                    'https://cdn-icons-png.flaticon.com/512/1077/1077114.png', //Officil Or Notable
                    'https://www.freeiconspng.com/thumbs/building-icon/office-building-icon-32.png', //Property
                    'https://icon-library.com/images/icon-company/icon-company-4.jpg', //Company
                    'https://ioms.ac/wp-content/uploads/2018/10/project-management-icon-png-27.png' // Project
                ]  --}}
                        var iconsArray = response.iconArrays

                        var infowindow = new google.maps.InfoWindow();
                        var cooridnates = response.cooridnates;
                        console.log(cooridnates);
                        var lat = 24.8141908;
                        var lng = 67.0482956;
                        var map = new google.maps.Map(document.getElementById('main_map'), {
                            zoom: 5,
                            center: new google.maps.LatLng(lat, lng),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        });

                        cooridnates.forEach((coordinate, i) => {

                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(coordinate.lat,
                                    coordinate.lng),
                                map: map,
                                icon: {
                                    url: (coordinate.type == 1) ? iconsArray[
                                        'official_icon'] : ((
                                            coordinate.type == 2) ? iconsArray[
                                            'notable_icon'] :
                                        ((
                                                coordinate.type == 3) ? iconsArray[
                                                'company_icon'] :
                                            ((coordinate.type == 4) ? iconsArray[
                                                'project_icon'] : ((
                                                    coordinate.type == 5) ?
                                                iconsArray['property_icon'] : ''
                                            )))),
                                    scaledSize: new google.maps.Size(40, 40)
                                }
                            });

                            google.maps.event.addListener(marker, 'click', (function(marker,
                                i) {
                                return function() {
                                    infowindow.setContent(`
                        <div class="margin-bottom: 10px !important">
                        <div class="text-center" style="margin-bottom: -20px;"><img src="${coordinate.image_url}" width="100" height="100" /></div> <br>
                        <b>Name:</b> ${coordinate.name}<br>

                        ${coordinate.email ? `<b>Email:</b> ${coordinate.email}<br>` : ``}
                        <b>Type: ${(coordinate.type == 1) ? 'OFFICIAL' : ((coordinate.type == 2) ? 'NOTABLE' : ((coordinate.type == 3) ? 'COMPANY' : ((coordinate.type == 4) ? 'PROJECT' : ((coordinate.type == 5) ? 'PROPERTY' : ''))))}</b>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="${coordinate.detail_url}" class="btn btn-primary mt-1" target="_blank">Detail</a>
                            </div>

                            <div class="col-md-6">
                                <a href="tel:+92${coordinate.primary_number}" class="btn btn-danger mt-1"><i class="mdi mdi-phone"></i></a>
                            </div>
                        </div>
                        <div>
                        `);
                                    infowindow.open(map, marker);
                                }
                            })(marker, i));
                        });
                    }
                },
            });

        });

        function addMeetingOnClander(meetings) {

            ! function($) {
                "use strict";

                var CalendarPage = function() {};

                CalendarPage.prototype.init = function() {

                        //checking if plugin is available
                        if ($.isFunction($.fn.fullCalendar)) {
                            /* initialize the external events */
                            $('#external-events .fc-event').each(function() {
                                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                                // it doesn't need to have a start or end
                                var eventObject = {
                                    title: $.trim($(this)
                                        .text()) // use the element's text as the event title
                                };

                                // store the Event Object in the DOM element so we can get to it later
                                $(this).data('eventObject', eventObject);

                                // make the event draggable using jQuery UI
                                $(this).draggable({
                                    zIndex: 999,
                                    revert: true, // will cause the event to go back to its
                                    revertDuration: 0 //  original position after the drag
                                });

                            });

                            /* initialize the calendar */

                            var date = new Date();
                            var d = date.getDate();
                            var m = date.getMonth();
                            var y = date.getFullYear();

                            $('#calendar').fullCalendar({
                                header: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'month,basicWeek,basicDay'
                                },
                                customButtons: {
                                    yearFilter: {
                                        text: 'Select Year',
                                        click: function() {
                                            // Your logic to handle the year filter button click
                                            // Open a custom dialog or perform any action you desire
                                            console.log('Year filter button clicked!');
                                        }
                                    },
                                    dateFilter: {
                                        text: 'Select Date Range',
                                        click: function() {
                                            // Your logic to handle the date filter button click
                                            // Open a custom dialog or perform any action you desire
                                            console.log('Date filter button clicked!');
                                        }
                                    }
                                },
                                editable: true,
                                eventLimit: true, // allow "more" link when too many events
                                droppable: true, // this allows things to be dropped onto the calendar !!!
                                eventClick: function(info) {
                                    // Open URL in a new tab

                                    window.open(info.url, '_blank');
                                    return false;
                                },
                                events: meetings
                            });

                        } else {
                            alert("Calendar plugin is not installed");
                        }
                    },
                    //init
                    $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
            }(window.jQuery),

            //initializing
            function($) {
                "use strict";
                $.CalendarPage.init()
            }(window.jQuery);
        }

        var data = [];
        $.ajax({
            type: "GET",
            url: "{{ route('line.chart.data.cases') }}",
            success: function(data) {
                monthData = data.monthCounts
                monthFeeCounts = data.monthFeeCounts

                var labels = monthData.map(function(item) {
                    return item.month;
                });

                var visaData = monthData.map(function(item) {
                    return item.visaCount;
                });

                var attestationData = monthData.map(function(item) {
                    return item.attestationCount;
                });

                var filterLabel = labels.filter(function(element) {
                    return element !== undefined;
                });
                var filterVisa = visaData.filter(function(element) {
                    return element !== undefined;
                });
                var filterAttestation = attestationData.filter(function(element) {
                    return element !== undefined;
                });

                var ctx = document.getElementById("barChart-cases");
                ctx.height = 160;
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: filterLabel,
                        datasets: [{
                            label: "VISA / تأشيرات",
                            data: filterVisa,
                            borderColor: "green",
                            borderWidth: "0",
                            backgroundColor: "green"
                        }, {
                            label: "ATTESTATION / تصديقات",
                            data: filterAttestation,
                            borderColor: "blue",
                            borderWidth: "0",
                            backgroundColor: "blue"
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });



                var labelsFee = monthFeeCounts.map(function(itemFee) {
                    return itemFee.month;
                });

                var visaDataFee = monthFeeCounts.map(function(itemFee) {
                    return itemFee.visaFeeCount;
                });

                var attestationDataFee = monthFeeCounts.map(function(itemFee) {
                    return itemFee.attestationFeeCount;
                });

                var filterLabelFee = labelsFee.filter(function(element) {
                    return element !== undefined;
                });
                var filterVisaFee = visaDataFee.filter(function(element) {
                    return element !== undefined;
                });
                var filterAttestationFee = attestationDataFee.filter(function(element) {
                    return element !== undefined;
                });

                console.log(labelsFee, visaDataFee, attestationDataFee);
                var amount = document.getElementById("barChart-amount");
                amount.height = 160;
                var myChart = new Chart(amount, {
                    type: 'bar',
                    data: {
                        labels: filterLabelFee,
                        datasets: [{
                            label: "VISA / تأشيرات",
                            data: filterVisaFee,
                            borderColor: "green",
                            borderWidth: "0",
                            backgroundColor: "green"
                        }, {
                            label: "ATTESTATION / تصديقات",
                            data: filterAttestationFee,
                            borderColor: "blue",
                            borderWidth: "0",
                            backgroundColor: "blue"
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            }
        });


        $(function() {
            var start = moment();
            var end = moment();

            var selectedDateRange = ''; // Initialize the variable in an accessible scope

            function cb(start, end) {
                var startDate = start.format('YYYY-MM-DD'); // Format in Laravel date format
                var endDate = end.format('YYYY-MM-DD'); // Format in Laravel date format

                selectedDateRange = startDate + ' - ' + endDate;
                $('#reportrange span').html(selectedDateRange);
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            // Update the selectedDateRange variable with today's date by default
            selectedDateRange = moment().format('YYYY-MM-DD') + ' - ' + moment().format(
                'YYYY-MM-DD'); // Format in Laravel date format
            $('#reportrange span').html(selectedDateRange);

            // Call getRealTimeDataOfPurposeOfVisits with the default date
            getRealTimeDataOfPurposeOfVisits(selectedDateRange);
            getRealTimeDataOfFleet(selectedDateRange);
            setInterval(() => {
                getRealTimeDataOfPurposeOfVisits(selectedDateRange);
                getRealTimeDataOfFleet(selectedDateRange);
            }, 2000);

            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                getRealTimeDataOfPurposeOfVisits(selectedDateRange);
                getRealTimeDataOfFleet(selectedDateRange);
            });

            cb(start, end);
        });


        function getRealTimeDataOfPurposeOfVisits(date = null) {
            $.ajax({
                type: "GET",
                url: "{{ route('dashbaord.realtime.data..of.purposeofvisitajax') }}", // Note the corrected route name
                data: {
                    'date': date
                },
                success: function(response) {
                    if (response.status) {
                        $('#card-container').empty();
                        data = response.data
                        for (var i = 0; i < data.length; i++) {
                            var cardData = data[i];
                            var cardHtml = createCard(cardData);
                            $('#card-container').append(cardHtml);
                        }
                    }

                }
            });
        }

        function getRealTimeDataOfFleet(date = null) {
            $.ajax({
                type: "GET",
                url: "{{ route('dashbaord.realtime.data.of.fleet.ajax') }}", // Note the corrected route name
                data: {
                    'date': date
                },
                success: function(response) {
                    if (response.status) {
                        data = response.data
                        console.log(data.workOrders);
                        $('#gate_pass_count').text(data.gatePass.total_entries ? data.gatePass.total_entries :
                            0)
                        $('#fuel_entry_count').text(data.fuel.total_quantity ? data.fuel.total_quantity : 0)
                        $('#fuel_entry_price').text(data.fuel.total_price ? data.fuel.total_price : 0.00)
                        $('#fuel_entry_total').text(data.fuel.total_entries ? data.fuel.total_entries : 0)
                        $('#work_order_count').text(data.workOrders ? data.workOrders : 0)
                        $('#vehicle_movement_count').text(data.gatePass.total_mileage ? data.gatePass
                            .total_mileage : 0)
                    }

                }
            });
        }

        // Function to create a card element based on data
        function createCard(data) {
            var cardHtml = `
        <div class="col-lg-4 col-md-6 col-sm-12 bg-gradient">
<h3>${data.name}</h3>
<div class='chart__wrapper'>
<div class='wrapperchart'>
    <div>
        <div class='spinner pie'></div>
        <div class='filler pie'></div>
        <div class='mask'></div>
    </div>
    <div class='value'>
        <div class='progress__value'>
            ${data.visit_count}
        </div>
        <div class='progress__label'>
            ${data.name}
        </div>
    </div>
</div>
<div class='sub__wrapper'>
    <div>
        <div class='spinner pie'></div>
        <div class='filler pie'></div>
        <div class='mask'></div>
    </div>
        </div>
<div>
<h4>Male: ${data.male_count}<br>
Female: ${data.female_count}</h4>

</div>
    `;
            return cardHtml;
        }
    </script>

    <!-- ============CURRENT  DATE  & TIME AT TOP ================== -->
    <script>
        const displayTime = document.querySelector(".display-time");
        // Time
        function showTime() {
            let time = new Date();
            displayTime.innerText = time.toLocaleTimeString("en-US", {
                hour12: false
            });
            setTimeout(showTime, 1000);
        }

        showTime();

        // Date
        function updateDate() {
            let today = new Date();

            // return number
            let dayName = today.getDay(),
                dayNum = today.getDate(),
                month = today.getMonth(),
                year = today.getFullYear();

            const months = [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ];
            const dayWeek = [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ];
            // value -> ID of the html element
            const IDCollection = ["day", "daynum", "month", "year"];
            // return value array with number as a index
            const val = [dayWeek[dayName], dayNum, months[month], year];
            for (let i = 0; i < IDCollection.length; i++) {
                document.getElementById(IDCollection[i]).firstChild.nodeValue = val[i];
            }
        }

        updateDate();
    </script>
@endsection
