@extends('layouts.app')
@section('task-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Tasks</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.tasks.tasks._partials._pai_chart_state')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="header-title pb-3">Tasks Listing</h5>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->can('Add Tasks'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('tasks.create') }}" class="btn save-btn  btn-sm mr-3"><strong>New Request</strong></a>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="ajax-table table-hover m-b-0" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Job#</th>
                                                <th>Job Type</th>
                                                <th>Job Owner</th>
                                                <th>Department</th>
                                                <th>Created By</th>
                                                <th>Applied Date</th>
                                                <th>Created Date</th>
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
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tasks.index') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'job_type',
                    name: 'job_type'
                },
                {
                    data: 'taskOwner',
                    name: 'taskOwner'
                },
                {
                    data: 'department.name',
                    name: 'department.name'
                },
                {
                    data: 'created_by',
                    name: 'created_by'
                },
                {
                    data: 'date',
                    name: 'date',
                    defaultContent: 'N/A'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    defaultContent: 'N/A'
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
        plotGroph('all_state_pai_chart', {{ $allstate }}, {{ $todayAllstate }});
        plotGroph('pending_state_pai_chart', {{ $allStatePending }}, {{ $todayStatePending }});
        plotGroph('completed_state_pai_chart', {{ $allStateCompleted }}, {{ $todayStateCompleted }});
        plotGroph('cancel_state_pai_chart', {{ $allStateCAncelled }}, {{ $todayStateCAncelled }});
    </script>
@endsection
