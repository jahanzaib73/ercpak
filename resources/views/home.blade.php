@extends('layouts.app')
@section('dashboard-active-class', 'active')
@section('content')

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato&display=swap");

        html {
            font-size: 62.5%;
        }

        .body-h {
            font-family: "Lato", sans-serif;
            background: #707070;
            color: #ffd868;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
        }


        .display-date {
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.6rem;
            font-weight: 600;
        }

        .display-time {
            font-size: 5rem;
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

        .chart__wrapper {
            position: relative;
            height: 200px;
            width: 200px;
            cursor: pointer;
        }

        .pie {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            -ms-backface-visibility: hidden;
        }

        .wrapperchart {
            position: absolute;
            background: transparent;
            z-index: 11;
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .wrapperchart .pie {
            width: 50%;
            height: 100%;
            transform-origin: 100% 50%;
            position: absolute;
            background: transparent;
            border: 15px solid #253c78;
            /* $color_benchmarkChart */
        }

        .wrapperchart .spinner {
            border-top-left-radius: 100% 50%;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
            border-bottom-left-radius: 100% 50%;
            z-index: 200;
            border-right: none;
            border-right-color: #ffffff;
            transform: rotate(270deg);
        }

        .wrapperchart .filler {
            border-top-left-radius: 0px;
            border-top-right-radius: 100% 50%;
            border-bottom-right-radius: 100% 50%;
            border-bottom-left-radius: 0px;
            left: 50%;
            z-index: 100;
            border-left: none;
            opacity: 1;
        }

        .wrapperchart .mask {
            width: 50%;
            height: 100%;
            position: absolute;
            background: #ffffff;
            z-index: 300;
            opacity: 0;
        }

        .wrapperchart,
        .wrapperchart * {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .sub__wrapper {
            position: absolute;
            background: transparent;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .sub__wrapper .pie {
            width: 50%;
            height: 100%;
            transform-origin: 100% 50%;
            position: absolute;
            background: transparent;
            border: 15px solid #00a5ff;
            /* $color_groupChart */
        }

        .sub__wrapper .spinner {
            border-top-left-radius: 100% 50%;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
            border-bottom-left-radius: 100% 50%;
            z-index: 10;
            border-right: none;
            border-right-color: #ffffff;
            transform: rotate(230deg);
        }

        .sub__wrapper .filler {
            border-top-left-radius: 0px;
            border-top-right-radius: 100% 50%;
            border-bottom-right-radius: 100% 50%;
            border-bottom-left-radius: 0px;
            left: 50%;
            z-index: 9;
            border-left: none;
            opacity: 1;
        }

        .sub__wrapper .mask {
            width: 50%;
            height: 100%;
            position: absolute;
            background: #ffffff;
            z-index: 12;
            opacity: 0;
        }

        .value {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 500;
            transform: translate(-50%, -50%);
            font-size: 36px;
            text-align: center;
        }

        .value .progress__label {
            font-size: 16px;
            /* $font_lgFontSize */
        }

        .sub__wrapper,
        .sub__wrapper * {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
    </style>
    <div class="container-fluid">
        @if (isSuperAdmin())
            <div class="page-head">
                <div class="row body-h py-4 d-flex justify-content-between">

                    <div class="col-md-6 text-white">
                        <div class="container">
                            <div class="display-date">
                                <span id="day">day</span>,
                                <span id="daynum">00</span>
                                <span id="month">month</span>
                                <span id="year">0000</span>
                            </div>
                            <div class="display-time"></div>
                        </div>
                    </div>
                    <div class="col-md-6 text-white text-right d-flex justify-content-end">
                        <div id="reportrange" style=cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="row" id="card-container">
                    </div>
                </div>
            </div><!--end row-->
            <hr>

            <h1>Fleet</h1>
            <hr>
            <div class="row d-flex flex-row">
                <div class="col-lg-3 col-sm-12 col-md-6 bg-gradient">
                    <div class="widget-box bg-grad-1 m-b-30 ">
                        <div class="row d-flex align-items-center" style="padding-bottom: 10px">
                            <div class="col-4">
                                <div class=""><i class="fa fa-automobile"></i></div>
                            </div>
                            <div class="col-4 align-items-center">
                                <p class="m-0 text-white text-center  font-weight-bold">تصريح خروج<br>Gate Pass</p>
                            </div>
                            <div class="col-4 align-self-end">
                                <h2 class="m-0 counter text-right" id="gate_pass_count">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-6 bg-gradient">
                    <div class="widget-box bg-grad-2 m-b-30" style="height: 110px">
                        <div class="row d-flex align-items-center" style="padding-bottom: 10px">

                            <div class="col-4">
                                <p class="m-0 text-white text-center font-weight-bold">كمية بترول<br>Fuel QTY</p>
                                <h2 class="m-0 counter text-center" id="fuel_entry_count">0</h2>
                            </div>
                            <div class="col-3 align-items-center">
                                <img src="{{ asset('img/gas.png') }}" width="40" style="margin-top: -40px">
                            </div>
                            <div class="col-5 align-items-center">
                                <p class="m-0 text-white text-center  font-weight-bold">مصاريف البترول<br>Fuel Amount</p>
                                <h2 class="m-0 counter text-center" id="fuel_entry_price">0.00</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-6 bg-gradient">
                    <div class="widget-box bg-grad-3 m-b-30">
                        <div class="row d-flex align-items-center" style="padding-bottom: 10px">
                            <div class="col-4">
                                <div class=""><i class="mdi mdi-settings"></i></div>
                            </div>
                            <div class="col-4 align-items-center">
                                <p class="m-0 text-white text-center  font-weight-bold">طلبات العمل<br>Work Orders</p>
                            </div>
                            <div class="col-4 align-self-end">
                                <h2 class="m-0 counter text-right" id="work_order_count">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-12 col-md-6 bg-gradient">
                    <div class="widget-box bg-grad-4 m-b-30">
                        <div class="row d-flex align-items-center" style="padding-bottom: 10px">
                            <div class="col-4">
                                <div class=""><i class="fa fa-automobile"></i></div>
                            </div>
                            <div class="col-4 align-items-center">
                                <p class="m-0 text-white text-center text-nowrap  font-weight-bold">حركة السيارات<br>Vehicle
                                    Movement</p>
                            </div>
                            <div class="col-4 align-self-end">
                                <h2 class="m-0 counter text-right" id="vehicle_movement_count">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
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
                <div class="col-md-6">
                    <div class="card m-b-30">
                        <div class="card-body">
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

            <div class="row">
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
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="header-title pb-3">Recent Activities</h5>
                                <h4 class="header-title pb-3"> أنشطة الحالية </h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="recent-activity-table table-hover m-b-0" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Action By</th>
                                                    <th>Module Name</th>
                                                    <th>Description</th>
                                                    <th>Created At</th>
                                                    {{--  <th>Action</th>  --}}
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-5">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">My Couriers</h5>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="myCourierTable table-hover m-b-0" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Received By</th>
                                                    <th>Courier#</th>
                                                    <th>Date</th>
                                                    <th>Item Received</th>
                                                    <th>Item QTY</th>
                                                    <th>Sender</th>
                                                    <th>Receiver</th>
                                                    <th>Handover To</th>
                                                    <th>Remarks</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($myCouries as $myCourier)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $myCourier->type }}
                                                        </td>
                                                        <td>{{ optional(optional($myCourier->courier)->user)->full_name }}
                                                        </td>
                                                        <td>{{ optional($myCourier->courier)->id }}</td>
                                                        <td>{{ optional($myCourier->courier)->date_time }}</td>
                                                        <td>{{ optional($myCourier->courier)->item_received }}</td>
                                                        <td>{{ optional($myCourier->courier)->item_quantity }}</td>
                                                        <td>{{ optional(optional($myCourier->courier)->sender)->official_name ? optional(optional($myCourier->courier)->sender)->official_name . ' (Official)' : optional(optional($myCourier->courier)->sender)->notable_name . ' (Notable)' }}
                                                        </td>
                                                        <td>{{ optional(optional($myCourier->courier)->receiverUser)->full_name }}
                                                        </td>
                                                        <td>{{ optional(optional($myCourier->courier)->handoverTo)->full_name }}
                                                        </td>
                                                        <td>{{ optional($myCourier->courier)->remarks }}</td>
                                                        <td>
                                                            @if (optional($myCourier->courier)->status == App\Models\Courier::ONGATE)
                                                                <span class="badge badge-info">GATE</span>
                                                            @elseif(optional($myCourier->courier)->status == App\Models\Courier::HANDOVER)
                                                                <span class=""badge badge-danger">With HANDOVER:
                                                                    {{ optional(optional($myCourier->courier)->handoverTo)->full_name }}</span>
                                                            @elseif(optional($myCourier->courier)->status == App\Models\Courier::RECEIVED)
                                                                <span class=""badge badge-danger">Delivered</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (optional($myCourier->courier)->status == App\Models\Courier::HANDOVER)
                                                                <a onclick="return confirm('Are you sure?')"
                                                                    title="Accept To Received"
                                                                    href="{{ route('change.status', ['id' => optional($myCourier->courier)->id ?: 0, 'key' => 'RECEIVED']) }}"
                                                                    class="btn btn-success btn-sm"><i
                                                                        class="fa fa-envelope-open"></i></a>
                                                            @endif
                                                        </td>
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

            <div class="row mt-5">
                <div class="col-lg-12 col-sm-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h5 class="header-title pb-3">Handovers</h5>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="myCourierTable table-hover m-b-0" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Received By</th>
                                                    <th>Courier#</th>
                                                    <th>Date</th>
                                                    <th>Item Received</th>
                                                    <th>Item QTY</th>
                                                    <th>Sender</th>
                                                    <th>Receiver</th>
                                                    <th>Handover To</th>
                                                    <th>Remarks</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($handovers as $myCourier)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $myCourier->type }}
                                                        </td>
                                                        <td>{{ optional(optional($myCourier->courier)->user)->full_name }}
                                                        </td>
                                                        <td>{{ optional($myCourier->courier)->id }}</td>
                                                        <td>{{ optional($myCourier->courier)->date_time }}</td>
                                                        <td>{{ optional($myCourier->courier)->item_received }}</td>
                                                        <td>{{ optional($myCourier->courier)->item_quantity }}</td>
                                                        <td>{{ optional(optional($myCourier->courier)->sender)->official_name ? optional(optional($myCourier->courier)->sender)->official_name . ' (Official)' : optional(optional($myCourier->courier)->sender)->notable_name . ' (Notable)' }}
                                                        </td>
                                                        <td>{{ optional(optional($myCourier->courier)->receiverUser)->full_name }}
                                                        </td>
                                                        <td>{{ optional(optional($myCourier->courier)->handoverTo)->full_name }}
                                                        </td>
                                                        <td>{{ optional($myCourier->courier)->remarks }}</td>
                                                        <td>
                                                            @if (optional($myCourier->courier)->status == App\Models\Courier::ONGATE)
                                                                <span class="badge badge-info">GATE</span>
                                                            @elseif(optional($myCourier->courier)->status == App\Models\Courier::HANDOVER)
                                                                <span class=""badge badge-danger">With HANDOVER:
                                                                    {{ optional(optional($myCourier->courier)->handoverTo)->full_name }}</span>
                                                            @elseif(optional($myCourier->courier)->status == App\Models\Courier::RECEIVED)
                                                                <span class=""badge badge-danger">Delivered</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (optional($myCourier->courier)->status == App\Models\Courier::ONGATE)
                                                                <a onclick="return confirm('Are you sure?')"
                                                                    title="Accept to Handover"
                                                                    href="{{ route('change.status', ['id' => optional($myCourier->courier)->id ?: 0, 'key' => 'HANDOVER']) }}"
                                                                    class="btn btn-success btn-sm"><i
                                                                        class="fa fa-envelope-open"></i></a>
                                                            @endif

                                                        </td>
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
        @endif

        <input type="hidden" id="map_url" value="{{ route('fetch.protocol.liaison.dashboard.data') }}">
    </div>
    <!--end container-->
@endsection

@section('script')

    <script src="{{ asset('assets/plugins/fullcalendar2/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart-js/Chart.bundle.js') }}"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY" type="text/javascript">
    </script>
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
                }
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
