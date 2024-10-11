@extends('layouts.app')
@section('remainder-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Reminders</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.meetings_remainders/remainders/remainders/_partials/_pai_chart_state')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="header-title pb-3">Reminders Listing</h5>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->can('Add Remainder'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('remainders.create') }}" class="btn save-btn mr-3 btn-sm">Add
                                        Reminder</a>
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
                                                <th>Created By</th>
                                                <th>title</th>
                                                <th>Date</th>
                                                <th>Ref. No</th>
                                                <th>Reminder Type</th>
                                                <th>Issuing Authority</th>
                                                <th>Due Date</th>
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
    <div class="modal fade" id="markCancelled" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Mark as Cancelled</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="GET">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Comment</label>
                            <textarea name="comment" id="comment" class="form-control" cols="30" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn save-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn save-btn">Mark as
                            Close</button>
                    </div>
                </form>
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
                url: "{{ route('remainders.index') }}",
                data: function(d) {
                    {{--  d.moduleNmae = "{{ $moduleName }}"  --}}
                }
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
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'remainder_type_id',
                    name: 'remainder_type_id'
                },
                {
                    data: 'issuing_authority_id',
                    name: 'issuing_authority_id'
                },
                {
                    data: 'date_time',
                    name: 'date_time',
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
        plotGroph('complated_state_pai_chart', {{ $allStateCompleted }}, {{ $todayStateCompleted }});
        plotGroph('upcomming_state_pai_chart', {{ $allStateUpcomming }}, {{ $todayStateUpcomming }});
    </script>
@endsection
