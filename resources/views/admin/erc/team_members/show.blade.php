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
            <h4 class="mt-2 mb-2">Member Details</h4>
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
                            <div class="col-sm-12">
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="memberMap"
                                                style="position: relative; overflow: hidden; height: 400px; width: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <img src="{{ $member->photo_url }}" alt="" class="img-fluid">
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="d-flex justify-content-between">
                                                        <h6>Allottee Name</h6>
                                                        <h6 class="arabic red pull-right">اسم المخصص</h6> <br>
                                                    </div>
                                                    {{ $member->member_name }}
                                                    <hr>
                                                    <div class="d-flex justify-content-between">
                                                        <h6>Name in English</h6>

                                                        <h6 class="arabic red">الاسم باللغة الإنجليزية</h6>
                                                    </div>
                                                    {{ $member->member_name }}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <div class="col-4">
                                                    <img src="img/uae.jpg" alt="" width="100%">
                                                </div>

                                                <div class="col-7">
                                                    <div class="d-flex justify-content-between">
                                                        <h6>{{ $member->team->team_name }}</h6>
                                                        <h6 class="arabic red">{{ $member->team->team_name_urdu }} </h6>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </section>

                                <section>

                                    <div class="tab-content mt-3" id="myTabsContent">
                                        <div class="tab-pane fade show active" id="task" role="tabpanel"
                                            aria-labelledby="task-tab">

                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex">
                                                    <h4>Areas Allotted / &nbsp;</h4>
                                                    <h4 class="arabic">المناطق المخصصة</h4>
                                                </div>

                                                <div class="d-flex" style="width: 100px !important">
                                                    <h5>
                                                        <select name="session" id="session" class="form-control">
                                                            @foreach ($session_years as $year)
                                                                <option value="{{ $year }}"
                                                                    {{ $year == Carbon\Carbon::now()->year }}>
                                                                    {{ $year }}</option>
                                                            @endforeach
                                                        </select>
                                                    </h5>
                                                </div>
                                            </div>


                                            <!-- =========================== -->

                                            <div class="tab-content mt-3" id="myTabsContent">
                                                <div class="tab-pane fade show active" id="all" role="tabpanel"
                                                    aria-labelledby="all-tab">

                                                    <table class="table table-hover small pt-3" id="memberAreasTbl">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">
                                                                    <p class="arabic red">رقم التسلسل</p>
                                                                    <p>S.#</p>
                                                                </th>
                                                                <th scope="col">
                                                                    <p class="arabic red"> اسم المنطقة</p>
                                                                    <p>Area Name</p>
                                                                </th>
                                                                @foreach ($provinces as $province)
                                                                    <th scope="col">
                                                                        <p class="arabic red">{{ $province->arabic_name }}
                                                                        </p>
                                                                        <p>{{ $province->name }}</p>
                                                                    </th>
                                                                @endforeach
                                                                {{--  <th scope="col">
                                                                    <p class="arabic red">بلوشستان </p>
                                                                    <p>Baluchistan</p>
                                                                </th>
                                                                <th scope="col">
                                                                    <p class="arabic red">البنجاب</p>
                                                                    <p>Punjab</p>
                                                                </th>
                                                                <th scope="col">
                                                                    <p class="arabic red"> السند </p>
                                                                    <p>Sindh</p>
                                                                </th>
                                                                <th scope="col">
                                                                    <p class="arabic red">خيبر بختونخا </p>
                                                                    <p>Khyber Pk</p>
                                                                </th>  --}}


                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>
                                </section>
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
        var table = $('#memberAreasTbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('teams.members.areas.get') }}",
                data: function(data) {
                    data.session_year = $('#session').val();
                    data.member_id = "{{ $member->id }}";
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'area_name',
                    name: 'area_name',
                },
                {
                    data: 'baluchistan',
                    name: 'baluchistan',
                },
                {
                    data: 'punjab',
                    name: 'punjab',
                },
                {
                    data: 'sindh',
                    name: 'sindh',
                },
                {
                    data: 'kpk',
                    name: 'kpk',
                }
            ]
        });

        function getMapData() {
            $.ajax({
                url: "{{ route('teams.members.areas.getMapData') }}",
                type: "GET",
                data: {
                    'session_year': $('#session').val(),
                    'member_id': "{{ $member->id }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        var data = response.data;
                        console.log(data);
                        var map = new google.maps.Map(document.getElementById('memberMap'), {
                            center: {
                                lat: 31.561560648568946,
                                lng: 74.31137413872314
                            },
                            zoom: 12,
                        });

                        $.each(data, function(indexInArray, valueOfElement) {

                            const polygonData = valueOfElement.polygon_coordinates;

                            if (polygonData) {
                                // Remove parentheses and split the coordinates
                                const coordinates = polygonData.replace(/[()]/g, '').split(',').map(
                                    function(coord) {
                                        return Number(coord);
                                    });

                                const polygonCoordinates = [];
                                for (let i = 0; i < coordinates.length; i += 2) {
                                    polygonCoordinates.push({
                                        lat: coordinates[i],
                                        lng: coordinates[i + 1]
                                    });
                                }

                                const polygon = new google.maps.Polygon({
                                    paths: polygonCoordinates,
                                    strokeColor: valueOfElement.get_signle_assign_area.team
                                        .team_color,
                                    strokeOpacity: 0.8,
                                    strokeWeight: 2,
                                    fillColor: valueOfElement.get_signle_assign_area.team
                                        .team_color,
                                    fillOpacity: 0.35,
                                    map: map
                                });

                                let bounds = new google.maps.LatLngBounds();
                                for (let i = 0; i < polygonCoordinates.length; i++) {
                                    bounds.extend(polygonCoordinates[i]);
                                }
                                map.fitBounds(bounds);
                            }
                        });

                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }

        getMapData()
        $('#session').change(function() {
            table.draw();
            getMapData()
        });
    </script>

    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
@endsection
