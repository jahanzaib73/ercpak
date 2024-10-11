@extends('layouts.app')
@section('shiftwarehouse-active-class', 'active')
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
        <div class=" ml-1 rounded topbar-header  text-white mb-3 row" style="padding: 15px">
            <div class="col-md-4">
                <h3 class="mb-0 pt-1">List of Shifted Warehouse</h3>
            </div>

            <div class="col-md-8 text-right">
                @if (Auth::user()->can('Add Shift Warehouses'))

                <a href="{{ route('shift.warehosue.create') }}"
                    class="btn save-btn ">
                    Shift Warehosue</a>
                @endif

            </div>
        </div>

        <div class="table-responsive">
            <table class="table-hover ajax-table" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Main Warehouse</th>
                        <th scope="col">Main Warehouse Location</th>
                        <th scope="col">Sub Warehouse</th>
                        <th scope="col">Sub Warehouse Location</th>
                        <th scope="col">Recommanded BY</th>
                        <th scope="col">Approved BY</th>
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
                url: "{{ route('shift.warehosue.index') }}",
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
                    data: 'createdBy',
                    name: 'createdBy'
                },
                {
                    data: 'mainWarehouse',
                    name: 'mainWarehouse'
                },
                {
                    data: 'mainLocation',
                    name: 'mainLocation'
                },
                {
                    data: 'newWarehouse',
                    name: 'newWarehouse'
                },
                {
                    data: 'newLocation',
                    name: 'newLocation'
                },
                {
                    data: 'recommandedBy',
                    name: 'recommandedBy'
                }, {
                    data: 'approvedBy',
                    name: 'approvedBy'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    </script>
@endsection
