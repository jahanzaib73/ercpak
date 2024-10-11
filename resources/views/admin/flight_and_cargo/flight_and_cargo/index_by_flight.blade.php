@extends('layouts.app')
@section('flight_and_cargo-active-class', 'active')
@section('content')
<link href='https://unpkg.com/css.gg@2.0.0/icons/css/airplane.css' rel='stylesheet'>

<style>
    .actionsBtn{
        padding: 6px !important;
    line-height: 33px !important;

    }
</style>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Flight & Cargos</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        @include('admin.flight_and_cargo/flight_and_cargo/_partials/_pai_chart_state')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="header-title pb-3">Flight & Cargo Listing</h5>
                                    </div>
                                    <div class="col-md-8 text-right d-flex justify-content-center align-items-center">
                                        @if (Auth::user()->can('View By Flight'))
                                            <a href="{{ route('flight-and-cargos.index', ['module_name' => 'record_by_flight']) }}"
                                                class="btn {{ $moduleName == 'record_by_flight' ? 'afterActiveColor ' : 'save-btn' }}  d-flex align-items-center">
                                                <i class="gg-airplane"></i>&nbsp;By Flight</a>
                                        @endif
                                        @if (Auth::user()->can('View By Sea'))
                                            |
                                            <a href="{{ route('flight-and-cargos.index', ['module_name' => 'record_by_sea']) }}"
                                                class="btn {{ $moduleName == 'record_by_sea' ? 'afterActiveColor ' : 'save-btn' }}"><i class="fa-solid fa-water"></i></i>By
                                                Sea</a>
                                        @endif
                                        @if (Auth::user()->can('View By Road'))
                                            |
                                            <a href="{{ route('flight-and-cargos.index', ['module_name' => 'record_by_road']) }}"
                                                class="btn {{ $moduleName == 'record_by_road' ? 'afterActiveColor ' : 'save-btn' }}">By
                                                Road</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-right d-flex justify-content-end">
                            @if (Auth::user()->can('Add Flight and Cargo'))
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('flight-and-cargos.create', ['module' => 'record_by_flight']) }}"
                                        class="btn save-btn   btn-sm">Add New</a>
                                </div>
                            @endif
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="ajax-table table-hover m-b-0" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Case#</th>
                                                <th>Flight#</th>
                                                <th>Flight Belongs To</th>
                                                <th>Flight Type</th>
                                                <th>Aircraft</th>
                                                <th>Origin</th>
                                                <th>Date Time</th>
                                                <th>Destination</th>
                                                <th>Date Time</th>
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
    <div class="modal fade" id="markCencelled" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bottom-border p-1 ">
                    <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Mark as Close</strong></h3>
                    <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">�</span>
                    </button>
                    </div>
                <form id="mark_cenclled_form" action="{{ route('flight-and-cargos.flightCanceled') }}">
                    <input type="hidden" name="id" id="module_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Comment</label>
                            <textarea name="comment" id="comment" class="form-control" cols="30" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3 mr-3"><button type="button" class="btn cancel-btn btns-w mr-2" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn save-btn btns-w">Save</button>
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
                url: "{{ route('flight-and-cargos.index') }}",
                data: function(d) {
                    d.moduleNmae = "{{ $moduleName }}"
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
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'flight_number',
                    name: 'flight_number'
                },
                {
                    data: 'flight_belongs_to',
                    name: 'flight_belongs_to'
                },
                {
                    data: 'flight_type_id',
                    name: 'flight_type_id'
                },
                {
                    data: 'aircraft_vessel_id',
                    name: 'aircraft_vessel_id'
                },
                {
                    data: 'arrival_flight_origin',
                    name: 'arrival_flight_origin'
                },
                {
                    data: 'arrival_flight_date_time',
                    name: 'arrival_flight_date_time'
                },
                {
                    data: 'arrival_flight_destination',
                    name: 'arrival_flight_destination'
                },
                {
                    data: 'arrival_flight_destination_date_time',
                    name: 'arrival_flight_destination_date_time'
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

        $(document).ready(function() {
            setTimeout(() => {
                $('.delete').attr('onclick', 'return confirm("Are you sure?")')
                $('.cancelled').click(function() {
                    $('#markCencelled').modal('show')
                    $('#module_id').val($(this).attr('data-id'))
                });

                $('#mark_cenclled_form').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(data) {
                            location.reload();
                        }
                    });
                })
            }, 800)
        });

        plotGroph('all_state_pai_chart', "{{ $allstate }}", "{{ $todayAllstate }}");
        plotGroph('by_air_state_pai_chart', "{{ $allStateByAir }}", "{{ $todayStateByAir }}");
        plotGroph('by_sea_state_pai_chart', "{{ $allStateBySea }}", "{{ $todayStateBySea }}");
        plotGroph('by_road_state_pai_chart', "{{ $allStateByRoad }}", "{{ $todayStateByRoad }}");
    </script>
@endsection
