@extends('layouts.app')
@section('meeting-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">
                <a href="{{ route('meetings.clanderView') }}">Clander View</a> /
                All Mettings
            </h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.meetings_remainders/meetings/_partials/_meetings_pai_char')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Meetings Listing</h5>
                            </div>
                            @if (Auth::user()->can('Add Meeting'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('meetings.create') }}" class="btn save-btn mr-3 btn-sm">Add New
                                        Meeting</a>
                                </div>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="meetingTable table-hover m-b-0" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created by</th>
                                                <th>Title</th>
                                                <th>Start Date Time</th>
                                                <th>End Date Time</th>
                                                <th>Location</th>
                                                <th>Number of Participent</th>
                                                <th>Number of Host</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            var table = $('.meetingTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('meetings.index') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: 'meeting_title',
                        name: 'meeting_title'
                    },
                    {
                        data: 'meeting_date_time',
                        name: 'meeting_date_time'
                    },
                    {
                        data: 'meeting_end_date_time',
                        name: 'meeting_end_date_time'
                    },
                    {
                        data: 'location.name',
                        name: 'location.name'
                    },
                    {
                        data: 'number_of_participent',
                        name: 'number_of_participent'
                    },
                    {
                        data: 'number_of_host',
                        name: 'number_of_host'
                    },
                    {
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

        plotGrophForMeetings('all_state_pai_chart', "{{ $totalMeeting }}", "{{ $todayMeeting }}");


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

        plotGrophForPastUpcommingMeetings('past_meetings_state_pai_chart', "{{ $totalPastMeeting }}");
        plotGrophForPastUpcommingMeetings('upcomming_meetings_state_pai_chart', "{{ $totalUpcommingMeeting }}");
    </script>
@endsection
