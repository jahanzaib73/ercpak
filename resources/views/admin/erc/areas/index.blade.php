@extends('layouts.app')
@section('erc-active-class', 'active')
@section('css')
    {{--  <link href="https://db.onlinewebfonts.com/c/02f502e5eefeb353e5f83fc5045348dc?family=GE+SS+Two+Light" rel="stylesheet">  --}}
    <style>
        @font-face {
            font-family: "GE SS Two Light";
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot");
            src: url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.eot?#iefix")format("embedded-opentype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff2")format("woff2"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.woff")format("woff"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.ttf")format("truetype"),
                url("https://db.onlinewebfonts.com/t/02f502e5eefeb353e5f83fc5045348dc.svg#GE SS Two Light")format("svg");
        }

        .arabic {
            font-family: "GE SS Two Light";
        }

        .red {
            color: red;
        }

        p {
            margin-block: 0;
        }

        #map {
            height: 400px;
        }

        body>section>div.body-content>div.container-fluid.mt-5>section:nth-child(4)>div.d-flex.justify-content-between.pb-1>div>h5>span {
            margin-left: 10px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Areas</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>

        <div class="row">

            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="header-title pb-3">Area List</h5>
                            </div>
                            <div class="col-md-6">
                                @if (Auth::user()->can('Create Area'))
                                    <button type="button" id="createAreaModelBtnId"
                                        class="btn save-btn mr-3 m-b-10 pull-right">Add
                                        Area</button>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover m-b-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Created By</th>
                                                <th>Name</th>
                                                <th>City</th>
                                                <th>Province</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($areas as $area)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ optional($area->user)->full_name }}</td>
                                                    <td>{{ $area->area_name }}</td>
                                                    <td>{{ optional($area->city)->name }}</td>
                                                    <td>{{ optional($area->province)->name }}</td>
                                                    <td><span
                                                            class="badge badge-{{ $area->status == 1 ? 'success' : 'danger' }}">
                                                            {{ $area->status == 1 ? 'Active' : 'In-active' }}</span></td>
                                                    <td class="text-center">
                                                        @if (Auth::user()->can('Edit Area'))
                                                            <button class="btn save-btn btn-sm area_edit_button"
                                                                data-id="{{ $area->id }}"
                                                                data-area_name="{{ $area->area_name }}"
                                                                data-province="{{ $area->province_id }}"
                                                                data-city="{{ $area->city_id }}"
                                                                data-polygon="{{ $area->polygon_coordinates }}"
                                                                data-status="{{ $area->status }}" type="button"><i
                                                                    class="fa fa-edit"></i></button>
                                                        @endif
                                                        {{--  @if (Auth::user()->can('Delete Complaint Type'))
                                                            |
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')"
                                                                href="{{ route('complaint-types.delete', ['id' => $team->id]) }}"><i
                                                                    class="fa fa-trash-o"></i></a>
                                                        @endif  --}}
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
        <!-- ========MODAL ADD  TEAM============= -->
        @include('admin.erc._models._create_area')
        @include('admin.erc._models._update_area')
    </div>
@endsection
@section('script')
    <script>
        const createAreaUrl = "{{ route('create.area.store') }}";
        const getAllAreasUrl = "{{ route('get.all.areas') }}";

        const cities = {!! json_encode($cities) !!};
    </script>

    <script src="{{ asset('team_management/CreateArea.js') }}"></script>
    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
@endsection
