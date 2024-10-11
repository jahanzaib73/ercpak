@extends('layouts.app')
@section('flight_and_cargo-active-class', 'active')
@section('content')
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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="header-title pb-3">Flight & Cargo Listing</h5>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        @if (Auth::user()->can('View By Flight'))
                                            <a href="{{ route('flight-and-cargos.index', ['module_name' => 'record_by_flight']) }}"
                                                class="btn {{ $moduleName == 'record_by_flight' ? 'afterActiveColor ' : 'save-btn' }}"><i class="gg-airplane"></i>By
                                                Flight</a>
                                        @endif
                                        @if (Auth::user()->can('View By Sea'))
                                            |
                                            <a href="{{ route('flight-and-cargos.index', ['module_name' => 'record_by_sea']) }}"
                                                class="btn {{ $moduleName == 'record_by_sea' ? 'afterActiveColor ' : 'save-btn' }}">By
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
                            <div class="col-md-6 text-right">
                                <a href="{{ route('flight-and-cargos.create', ['module' => 'record_by_sea']) }}"
                                    class="btn save-btn mr-3 btn-sm">Add
                                    New</a>
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
                                                <th>Vessel#</th>
                                                <th>Vessel Type</th>
                                                <th>Origin</th>
                                                <th>Date Time</th>
                                                <th>Destination</th>
                                                <th>Date Time</th>
                                                <th>Cargo Belongs To</th>
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
    <div class="modal fade" id="markClosed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bottom-border p-1 ">
                    <h3 class="modal-title modal-heading text-black" id="exampleModalLabel"><strong>Mark as Close</strong></h3>
                    <button type="button" class="close little-modalclose-btn p-1 px-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    </div>
                <form id="markClosedForm" action="{{ route('flight-and-cargos.complete') }}">
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
                    data: 'sea_vessel_number',
                    name: 'sea_vessel_number'
                },
                {
                    data: 'sea_vessel_type',
                    name: 'sea_vessel_type'
                },
                {
                    data: 'sea_arrival_origin',
                    name: 'sea_arrival_origin'
                },
                {
                    data: 'sea_arrival_date_time',
                    name: 'sea_arrival_date_time'
                },
                {
                    data: 'sea_destination',
                    name: 'sea_destination'
                },
                {
                    data: 'sea_destination_date_time',
                    name: 'sea_destination_date_time'
                },
                {
                    data: 'cargo_belongs_to',
                    name: 'cargo_belongs_to'
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
                $('.closeed').click(function() {
                    $('#markClosed').modal('show')
                    $('#module_id').val($(this).attr('data-id'))
                });

                $('#markClosedForm').submit(function(e) {
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
