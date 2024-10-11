@extends('layouts.app')
@section('courier-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">COURIERS</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.couriers._partials._pai_chart_state')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="header-title pb-3">Couriers Listing</h5>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->can('Received Item'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('couriers.create') }}" class="btn save-btn mr-3 btn-sm"><strong>Receive
                                        Item</strong></a>
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
                                                <th>Received By</th>
                                                <th>Courier#</th>
                                                <th>Date</th>
                                                <th>Item Received</th>
                                                <th>Item QTY</th>
                                                <th>Sender</th>
                                                <th>Receiver</th>
                                                {{--  <th>Received By</th>  --}}
                                                <th>Handover To</th>
                                                <th>Remarks</th>
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
                url: "{{ route('couriers.index') }}",
            },

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_by',
                    name: 'created_by',
                    defaultContent: 'N/A'
                },
                {
                    data: 'id',
                    name: 'id',
                    defaultContent: 0
                },
                {
                    data: 'date_time',
                    name: 'date_time',
                    defaultContent: 'N/A'
                },
                {
                    data: 'item_received',
                    name: 'item_received',
                    defaultContent: 'N/A'
                },
                {
                    data: 'item_quantity',
                    name: 'item_quantity',
                    defaultContent: 0
                },
                {
                    data: 'sender_id',
                    name: 'sender_id',
                    defaultContent: 'N/A'
                },
                {
                    data: 'receiver',
                    name: 'receiver',
                    defaultContent: 'N/A'
                },
                {{--  {
                    data: 'received_by',
                    name: 'received_by',
                    defaultContent: 'N/A'
                },  --}} {
                    data: 'handover_to',
                    name: 'handover_to',
                    defaultContent: 'N/A'
                },
                {
                    data: 'remarks',
                    name: 'remarks',
                    defaultContent: 'N/A'
                },
                {
                    data: 'status',
                    name: 'status',
                    defaultContent: 'N/A'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        plotGroph('all_courier_pai_chart', {{ $allstate }}, {{ $todayAllstate }});
        plotGroph('pending_courier_pai_chart', {{ $allStatePending }}, {{ $todayStatePending }});
        plotGroph('received_courier_pai_chart', {{ $allStateReceived }}, {{ $todayStateReceived }});
        plotGroph('handover_courier_pai_chart', {{ $allStateHandover }}, {{ $todayStateHandover }});
    </script>
@endsection
