@extends('layouts.app')
@section('meeting-active-class', 'active')

@section('content')
    <div class="container">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Meetings States</h4>
            @if (session()->has('success'))
                <div class="alert alert-info" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.meetings_remainders/meetings/_partials/_meetings_pai_char')
        <hr>
        <div class="page-head">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mt-2 mb-2">Meetings</h4>
                </div>
                <div class="col-md-6 text-right">
                    @if (Auth::user()->can('All Meeting'))
                        <a href="{{ route('meetings.index') }}" class="btn save-btn btn-sm">Meetings List View</a>
                    @endif
                    @if (Auth::user()->can('Add Meeting'))
                        |
                        <a href="{{ route('meetings.create') }}" class="btn save-btn btn-sm">Add New Meeing</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div id='calendar' class="col-sm-12 col-lg-12  m-b-30"></div>
        </div>
        <input type="hidden" id="clander_index_url" value="{{ route('meetings.clanderView') }}">
        <!--end row-->
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/fullcalendar2/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar2/fullcalendar.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            /**
             * Theme: Syntra Admin Template
             * Author: Mannat-themes
             * Calendar
             */

            $.ajax({
                type: "GET",
                url: $('#clander_index_url').val(),
                success: function(response) {
                    if (response.status) {

                        clandarData = response.clandarData
                        chartData = response.chartData

                        plotGrophForMeetings('all_state_pai_chart', chartData.totalMeeting,
                            chartData.todayMeeting);

                        plotGrophForPastUpcommingMeetings('past_meetings_state_pai_chart',
                            chartData.totalPastMeeting);

                        plotGrophForPastUpcommingMeetings(
                            'upcomming_meetings_state_pai_chart',
                            chartData.totalUpcommingMeeting);

                        addMeetingOnClander(clandarData);
                    }

                }
            });
        });

        function plotGrophForMeetings(containerId, all, today) {
            var data = [{
                label: "All",
                data: all,
                color: "#ff5450"
            }, {
                label: "Today",
                data: today,
                color: "#00bcd2"
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

        function plotGrophForPastUpcommingMeetings(containerId, all) {
            var data = [{
                label: "TOTAL",
                data: all,
                color: (containerId == 'upcomming_meetings_state_pai_chart') ? '#00bcd2' : "#ff5450"
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
    </script>
@endsection
