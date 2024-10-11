@extends('layouts.app')
@section('purchase-orders-active-class', 'active')
@section('css')
    <style>
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            margin: auto;
            /* Center the image horizontally */
        }

        .card-title {
            margin: 10px 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @php
            Session::forget('success');
        @endphp
        <div class=" ml-1 topbar-header text-white mb-3 rounded row" style="padding: 15px">
            <div class="col-6">
                <h3 class="mb-0 pt-1">List of Invoices</h3>
            </div>

            <div class="col-6 text-right">
                <a href="{{ route('invoices.create') }}"  class="btn save-btn">
                    Add Invoice</a>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table-hover ajax-table" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Invoice Number</th>
                        <th scope="col">Request By</th>
                        <th scope="col">Issue By</th>
                        <th scope="col">Location</th>
                        <th scope="col">Warehouse</th>
                        <th scope="col">Cost Center</th>
                        <th scope="col">Is Purchase Order</th>
                        <th scope="col">Is Work Order</th>
                        <th scope="col">Date</th>
                        {{--  <th scope="col">Status</th>  --}}
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')

    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('invoices.index') }}",
                data: function(data) {
                    data.purchase_order_filter = $('#purchase_order_filter').val();
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
                    name: 'id'
                },
                {
                    data: 'request_by',
                    name: 'request_by'
                },
                {
                    data: 'issue_by',
                    name: 'issue_by'
                },
                {
                    data: 'location.name',
                    name: 'location.name'
                },
                {
                    data: 'warehouse.name',
                    name: 'warehouse.name'
                },
                {
                    data: 'costCenter',
                    name: 'costCenter'
                },
                {
                    data: 'is_purchase_order',
                    name: 'is_purchase_order'
                },
                {
                    data: 'is_work_order',
                    name: 'is_work_order'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {{--  {
                    data: 'status',
                    name: 'status'
                },  --}} {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    </script>
@endsection
