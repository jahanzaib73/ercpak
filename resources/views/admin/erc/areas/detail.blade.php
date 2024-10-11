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

        /* Default color for tab text */
        .nav-tabs .nav-link {
            color: red;
        }

        /* Active tab color */
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: white !important;

            /* Optionally, you can set a border color for the active tab */
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
                                            <div class="row d-flex justify-content-between">
                                                <div>
                                                    <h5>Current Allotment</h5>
                                                </div>
                                                <div class="arabic red">
                                                    <h5>التخصيص الحالي</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            @foreach ($currentMembers as $member)
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <img src="{{ $member->photo_url }}" alt=""
                                                            class="img-fluid">
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="d-flex justify-content-between">
                                                            <h6>Allottee Name</h6>
                                                            <h6 class="arabic red">اسم المخصص</h6>
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
                                            @endforeach
                                            <div class="d-flex justify-content-between">
                                                <div class="col-4">
                                                    <img src="{{ optional($currentTeam)->team_symbol_url }}" alt=""
                                                        width="100%">
                                                </div>

                                                <div class="col-8">
                                                    <div class="d-flex justify-content-between">
                                                        <h6>{{ optional($currentTeam)->team_name }}</h6>
                                                        <h6 class="arabic red"> {{ optional($currentTeam)->team_name_urdu }}
                                                        </h6>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </section>

                                <section>

                                    <hr>
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn-outline-danger active" id="pills-history-tab"
                                                data-toggle="pill" data-target="#pills-home" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">
                                                <div class="d-flex">
                                                    <p>Allotment History / &nbsp;</p>
                                                    <p class="arabic">تاريخ التخصيص</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn-outline-danger" id="pills-photo-tab" data-toggle="pill"
                                                data-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">
                                                <div class="d-flex">
                                                    <p>Area Photos</p>
                                                    <p class="arabic">صور المنطقة</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn-outline-danger" id="pills-official-tab"
                                                data-toggle="pill" data-target="#pills-contact" type="button"
                                                role="tab" aria-controls="pills-contact" aria-selected="false">
                                                <div class="d-flex">
                                                    <p>Area Notables & Officials</p>
                                                    <p class="arabic">أعيان ومسؤولي المنطقة</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                            aria-labelledby="pills-home-tab">
                                            <div class="d-flex justify-content-end">
                                                <div class="d-flex">
                                                    <h4>History of Allotment / &nbsp;</h4>
                                                    <h4 class="arabic">تاريخ التخصيص</h4>
                                                </div>
                                            </div>
                                            <table class="table table-hover small pt-3">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            <p class="arabic red">رقم التسلسل</p>
                                                            <p>S.#</p>
                                                        </th>
                                                        <th scope="col">
                                                            <p class="arabic red">صورة </p>
                                                            <p>Photo</p>
                                                        </th>
                                                        <th scope="col">
                                                            <p class="arabic red">اسم المخصص</p>
                                                            <p>Allottee Name</p>
                                                        </th>
                                                        <th scope="col">
                                                            <p class="arabic red"> السنة / الموسم </p>
                                                            <p>Year/Season</p>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($assignAreas as $assignArea)
                                                        <tr>
                                                            <th scope="row">1</th>
                                                            <td>
                                                                <img width="100"
                                                                    src="{{ optional($assignArea->member)->photo_url }}"
                                                                    alt="" class="img-fluid">
                                                            </td>
                                                            <td>
                                                                <p>{{ optional($assignArea->member)->member_name }}</p>
                                                                <label class="red">
                                                                    {{ optional($assignArea->team)->name }}</label>
                                                            </td>
                                                            <td>
                                                                {{ $assignArea->session_year }}
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                            aria-labelledby="pills-profile-tab">
                                            <div class="d-flex justify-content-between">
                                                <h3>Area Photos</h3>
                                                <h3 class="arabic red">صور المنطقة</h3>
                                            </div>

                                            <div class="row">
                                                @foreach ($area->photos as $photo)
                                                    <div class="col-6 col-md-3 py-1">
                                                        <img src="{{ $photo->attachment_url }}" alt=""
                                                            width="100%">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                            aria-labelledby="pills-contact-tab">
                                            <section class="container">
                                                <hr>
                                                <div class="d-flex justify-content-between">
                                                    <h4>Area Notables & Officials</h4>
                                                    <h4 class="arabic red text-right">أعيان ومسؤولي المنطقة</h4>
                                                </div>



                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link active btn-outline-danger"
                                                            id="pills-notables-tab" data-toggle="pill"
                                                            data-target="#pills-notables" type="button" role="tab"
                                                            aria-controls="pills-notables" aria-selected="true">
                                                            <div class="d-flex">Notables / &nbsp;<p class="arabic">وجهاء
                                                                </p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link btn-outline-danger" id="pills-Officials-tab"
                                                            data-toggle="pill" data-target="#pills-Officials"
                                                            type="button" role="tab" aria-controls="pills-Officials"
                                                            aria-selected="false">
                                                            <div class="d-flex">Officials / &nbsp;<p class="arabic">
                                                                    المسؤولين</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-notables"
                                                        role="tabpanel" aria-labelledby="pills-notables-tab">
                                                        <div class="row">
                                                            @foreach ($officials as $official)
                                                                <?php
                                                                $officialPhoto = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::OFFICIAL, $official->id, 'official_photo');
                                                                $url = $officialPhoto->first() ? $officialPhoto->first()->file_url : '';
                                                                ?>
                                                                <div class="card col-4 col-md-2">
                                                                    <img src="{{ $url }}" class="card-img-top"
                                                                        alt="...">
                                                                    <div class="card-body">
                                                                        <p class="card-title text-center">
                                                                            <strong>{{ $official->official_name }}</strong>
                                                                        </p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <a href="https://wa.me/{{ $official->phone }}"
                                                                                class="btn btn-success" target="_blank">
                                                                                <i class="fab fa-whatsapp"></i>
                                                                            </a>

                                                                            <a href="tel:+{{ $official->phone }}"
                                                                                class="btn btn-secondary">
                                                                                <i class="fas fa-phone"></i>
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="pills-Officials" role="tabpanel"
                                                        aria-labelledby="pills-Officials-tab">
                                                        <div class="row">
                                                            @foreach ($notables as $notable)
                                                                <?php
                                                                $officialPhoto = getProtocolLiaisonAttchments(App\Models\ProtocolLiaison::NOTABLE, $notable->id, 'notable_photo');
                                                                $url = $officialPhoto->first() ? $officialPhoto->first()->file_url : '';
                                                                ?>
                                                                <div class="card col-4 col-md-2">
                                                                    <img src="{{ $url }}" class="card-img-top"
                                                                        alt="...">
                                                                    <div class="card-body">
                                                                        <p class="card-title text-center">
                                                                            <strong>{{ $notable->notable_name }}</strong>
                                                                        </p>
                                                                        <div class="d-flex justify-content-between">
                                                                            <a href="https://wa.me/{{ $notable->phone }}"
                                                                                class="btn btn-success" target="_blank">
                                                                                <i class="fab fa-whatsapp"></i>
                                                                            </a>

                                                                            <a href="tel:+{{ $notable->phone }}"
                                                                                class="btn btn-secondary">
                                                                                <i class="fas fa-phone"></i>
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach


                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
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
    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY&libraries=drawing&callback=initMap"
        type="text/javascript"></script>
    <script>
        var table = $('#memberAreasTbl').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('teams.members.areas.get') }}",
                data: function(data) {
                    data.session_year = $('#session').val();
                    data.member_id = 1;
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

        var polygonData = "{{ $area->polygon_coordinates }}";

        var map = new google.maps.Map(document.getElementById('memberMap'), {
            center: {
                lat: 31.561560648568946,
                lng: 74.31137413872314
            },
            zoom: 12,
        });
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
            console.log(polygonCoordinates);
            const polygon = new google.maps.Polygon({
                paths: polygonCoordinates,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map
            });

            let bounds = new google.maps.LatLngBounds();
            for (let i = 0; i < polygonCoordinates.length; i++) {
                bounds.extend(polygonCoordinates[i]);
            }
            map.fitBounds(bounds);
        }
    </script>


@endsection
