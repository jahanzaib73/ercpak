@extends('layouts.app')
@section('tracking-active-class', 'active')

@section('content')

    <section class="container">
        <div class="row">
            {{-- <iframe id="map"
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7057392.021568126!2d69.08183160298552!3d30.603807259815564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1694794616243!5m2!1sen!2s&callback=initMap"
                width="1200" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
            <div id="map" style="height: 300px; width: 1200px;"></div>
        </div><!--end row-->

    </section>

    <section class="container">
        <hr>
        <div class="d-flex justify-content-between">
            <div>
                <a href="tracking.html" class="d-flex">
                    <h4 class="text-dark"><strong>Tracking /</strong> &nbsp;</h4>
                    <h4 class="arabic red">تتبع</h4>
                </a>
            </div>
            <div style="width:70px;">
                <select id="inputVehicle" class="form-control">
                    @if ($trip->vehicle->trips)
                        @foreach ($trip->vehicle->trips as $vehicleTrip)
                            <option value="{{ $vehicleTrip->id }}" {{ $vehicleTrip->id == $trip->id ? 'selected' : '' }}>
                                {{ $vehicleTrip->id }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>



        <!-- =========================== -->

        <section class="container">

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <hr>
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ optional($trip->vehicle)->image_url }}" class="card-img-top w-75"
                                        alt="image not found">
                                    <hr>
                                    <div class="card-body">
                                        <h5>{{ optional($trip->vehicle)->vehicle_number }}</h5>
                                        <h6>{{ optional(optional($trip->vehicle)->model)->name }}</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <img src="{{ optional($trip->driver)->profile_pic_url ?: 'http://placehold.it/180' }}"
                                        class="card-img-top w-50" alt="image not found">
                                    <hr>
                                    <div class="card-body">
                                        <h5>{{ optional($trip->driver)->full_name }}</h5>
                                        <p>{{ optional(optional($trip->driver)->designation)->name }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-lg-5">
                        <p class="mb-3">Timeline / &nbsp; <span class="arabic red">الجدول الزمني</span> </p>
                        <div class="p-4 block mb-4">
                            <div class="tl-item {{ !$stops && !$trip->return_datetime_out ? 'active' : '' }}">
                                <div class="tl-dot b-warning"></div>
                                <div class="tl-content">
                                    <div class="">Start</div>
                                    <div class="tl-date text-muted mt-1">
                                        {{ Carbon\Carbon::parse($trip->exit_datetime_out)->format('d M y @ h:i A') }}
                                    </div>
                                </div>
                            </div>
                            @foreach ($stops as $key => $stop)
                                @if ($stop['minutes'] < 40)
                                    <div
                                        class="tl-item {{ $key == array_key_last($stops) && !$trip->return_datetime_out ? 'active' : '' }}">
                                        <div class="tl-dot b-danger"></div>
                                        <div class="tl-content">
                                            <div class="">Stop</div>
                                            <div class="tl-date text-muted mt-1">{{ $stop['minutes'] }} minutes</div>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="tl-item {{ $key == array_key_last($stops) && !$trip->return_datetime_out ? 'active' : '' }}">
                                        <div class="tl-dot b-primary"></div>
                                        <div class="tl-content">
                                            <div class="">Stop</div>
                                            <div class="tl-date text-muted mt-1">{{ $stop['minutes'] }} minutes</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if ($trip->return_datetime_out)
                                <div class="tl-item active">
                                    <div class="tl-dot b-warning"></div>
                                    <div class="tl-content">
                                        <div class="">End</div>
                                        <div class="tl-date text-muted mt-1">
                                            {{ Carbon\Carbon::parse($trip->return_datetime_out)->format('d M y @ h:i A') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>



                </div>
            </div>

            <hr>
        </section>
        <!-- ==============================        -->


    </section>

@endsection

@section('css')

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

        /* Timeline======= */

        @media (min-width:992px) {
            .page-container {
                max-width: 1140px;
                margin: 0 auto
            }

            .page-sidenav {
                display: block !important
            }
        }

        .padding {
            padding: 2rem
        }

        .w-32 {
            width: 32px !important;
            height: 32px !important;
            font-size: .85em
        }

        .tl-item .avatar {
            z-index: 2
        }

        .circle {
            border-radius: 500px
        }

        .gd-warning {
            color: #fff;
            border: none;
            background: #f4c414 linear-gradient(45deg, #f4c414, #f45414)
        }

        .timeline {
            position: relative;
            border-color: rgba(160, 175, 185, .15);
            padding: 0;
            margin: 0
        }

        .p-4 {
            padding: 1.5rem !important
        }

        .block,
        .card {
            background: #fff;
            border-width: 0;
            border-radius: .25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
            margin-bottom: 1.5rem
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important
        }

        .tl-item {
            border-radius: 3px;
            position: relative;
            display: -ms-flexbox;
            display: flex
        }

        .tl-item>* {
            padding: 10px
        }

        .tl-item .avatar {
            z-index: 2
        }

        .tl-item:last-child .tl-dot:after {
            display: none
        }

        .tl-item.active .tl-dot:before {
            border-color: #448bff;
            box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
        }

        .tl-item:last-child .tl-dot:after {
            display: none
        }

        .tl-item.active .tl-dot:before {
            border-color: #448bff;
            box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
        }

        .tl-dot {
            position: relative;
            border-color: rgba(160, 175, 185, .15)
        }

        .tl-dot:after,
        .tl-dot:before {
            content: '';
            position: absolute;
            border-color: inherit;
            border-width: 2px;
            border-style: solid;
            border-radius: 50%;
            width: 10px;
            height: 10px;
            top: 15px;
            left: 50%;
            transform: translateX(-50%)
        }

        .tl-dot:after {
            width: 0;
            height: auto;
            top: 25px;
            bottom: -15px;
            border-right-width: 0;
            border-top-width: 0;
            border-bottom-width: 0;
            border-radius: 0
        }

        tl-item.active .tl-dot:before {
            border-color: #448bff;
            box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
        }

        .tl-dot {
            position: relative;
            border-color: rgba(160, 175, 185, .15)
        }

        .tl-dot:after,
        .tl-dot:before {
            content: '';
            position: absolute;
            border-color: inherit;
            border-width: 2px;
            border-style: solid;
            border-radius: 50%;
            width: 10px;
            height: 10px;
            top: 15px;
            left: 50%;
            transform: translateX(-50%)
        }

        .tl-dot:after {
            width: 0;
            height: auto;
            top: 25px;
            bottom: -15px;
            border-right-width: 0;
            border-top-width: 0;
            border-bottom-width: 0;
            border-radius: 0
        }

        .tl-content p:last-child {
            margin-bottom: 0
        }

        .tl-date {
            font-size: .85em;
            margin-top: 2px;
            min-width: 100px;
            max-width: 100px
        }

        .avatar {
            position: relative;
            line-height: 1;
            border-radius: 500px;
            white-space: nowrap;
            font-weight: 700;
            border-radius: 100%;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-negative: 0;
            flex-shrink: 0;
            border-radius: 500px;
            box-shadow: 0 5px 10px 0 rgba(50, 50, 50, .15)
        }

        .b-warning {
            border-color: #f4c414 !important;
        }

        .b-primary {
            border-color: #448bff !important;
        }

        .b-danger {
            border-color: #f54394 !important;
        }
    </style>

@endsection

@section('script')

    <script>
        function initMap() {
            const rykLatLng = {
                lat: 28.4147380,
                lng: 70.305503
            };
            const AdvancedMarkerElement = google.maps.importLibrary("marker");
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer({
                suppressMarkers: true,
                // preserveViewport: true
            });
            const directionsRendererCompleted = new google.maps.DirectionsRenderer({
                suppressMarkers: true,
                // preserveViewport: true
                polylineOptions: {
                    strokeColor: '#300060', // red 
                    strokeWeight: 5,
                    strokeOpacity: 0.8
                },
            });
            const vehicleIcon = document.createElement("img");
            vehicleIcon.src = "{{ asset('img/auto.png') }}";
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 20,
                center: rykLatLng,
                mapId: '62e3ddc4bd42a278'
            });

            var gmarkers = [];
            var previousCoordinates = null;
            // Function to update the map with the latest location
            function updateMap() {
                // Make an AJAX request to get the latest location
                $.ajax({
                    url: '{{ route('latestLocation', ['id' => $trip->id]) }}', // Update the URL based on your route
                    method: 'GET',
                    success: function(response) {
                        // Clear existing markers before adding new ones
                        removeMarkers();
                        if (response.trip.coordinates) {
                            positions = JSON.parse(response.trip.coordinates);
                            lastElement = positions.pop();
                            var lat = lastElement.lat ?? '';
                            var lng = lastElement.lng ?? '';
                            var coordinates = {
                                lat: lat,
                                lng: lng
                            }
                            var marker = new google.maps.marker.AdvancedMarkerElement({
                                position: coordinates,
                                map,
                                title: '#',
                                content: vehicleIcon
                            });
                            directionsService.route({
                                    origin: "{{ $trip->origin }}",
                                    destination: coordinates,
                                    travelMode: google.maps.TravelMode.DRIVING,
                                },
                                (response, status) => {
                                    //program got here without error
                                    directionsRendererCompleted.setDirections(response);
                                    directionsRendererCompleted.setMap(map);
                                }
                            );
                            map.setCenter(marker.position);
                            gmarkers.push(marker);
                        } else {
                            geocoder = new google.maps.Geocoder();
                            geocoder.geocode({
                                'address': response.trip.origin
                            }, function(results, status) {
                                if (status === 'OK') {
                                    map.setCenter(results[0].geometry.location);
                                    var marker = new google.maps.marker.AdvancedMarkerElement({
                                        map: map,
                                        position: results[0].geometry.location,
                                        content: vehicleIcon
                                    });
                                } else {
                                    alert('Geocode was not successful for the following reason: ' +
                                        status);
                                }
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching location:', error);
                        // Handle errors if needed
                    }
                });
            }

            var coordinates;

            function coordinatesHistory() {
                // Make an AJAX request to get the latest location
                $.ajax({
                    url: '{{ route('latestLocation', ['id' => $trip->id]) }}', // Update the URL based on your route
                    method: 'GET',
                    success: function(response) {
                        // Clear existing markers before adding new ones
                        removeMarkers();
                        if (response.trip.coordinates) {
                            coordinates = JSON.parse(response.trip.coordinates);
                            // Reduce the number of waypoints if it exceeds 25 because 25 is the limit of waypoints
                            if (coordinates.length > 25) {
                                var filteredCoordinates = [];
                                var step = Math.floor(coordinates.length / 25); // Determine the step size
                                if (step % 2 == 0) {
                                    step = step + 1;
                                }

                                // Always include the start point
                                filteredCoordinates.push(coordinates[0]);

                                // Include intermediate coordinates with the determined step size
                                for (var i = step; i < coordinates.length; i += step) {
                                    filteredCoordinates.push(coordinates[i]);
                                }

                                // Always include the end point
                                filteredCoordinates.push(coordinates[coordinates.length - 1]);

                                // Use filteredCoordinates for the request
                                coordinates = filteredCoordinates;
                            }

                            var request = {
                                origin: {
                                    lat: coordinates[0].lat,
                                    lng: coordinates[0].lng
                                },
                                destination: {
                                    lat: coordinates[coordinates.length - 1].lat,
                                    lng: coordinates[coordinates.length - 1].lng
                                },
                                waypoints: coordinates.slice(1, -1).map(waypoint => ({
                                    location: {
                                        lat: waypoint.lat,
                                        lng: waypoint.lng,
                                    }
                                })),
                                travelMode: google.maps.TravelMode.DRIVING,
                            }
                            directionsService.route(request,
                                (response, status) => {
                                    //program got here without error
                                    directionsRenderer.setDirections(response);
                                    directionsRenderer.setMap(map);
                                }
                            );
                        }
                    },
                    error: function(error) {
                        console.error('Error fetching location:', error);
                        // Handle errors if needed
                    }
                });
            };
            if ({{ $trip->status }} == 0) {
                // Call updateMap immediately and then every 10 seconds
                updateMap();
                setInterval(function() {
                    updateMap();
                }, 10000);
                directionsService.route({
                        origin: "{{ $trip->origin }}",
                        destination: "{{ $trip->destination }}",
                        travelMode: google.maps.TravelMode.DRIVING,
                    },
                    (response, status) => {
                        //program got here without error
                        directionsRenderer.setDirections(response);
                        directionsRenderer.setMap(map);
                    }
                );
            } else {
                coordinatesHistory();
                var stopLocations = {!! json_encode($stops) !!};
                if (typeof stopLocations === 'object') {
                    var stopLocations = Object.values(stopLocations);
                }
                for (let i = 0; i < stopLocations.length; i++) {
                    var marker = new google.maps.marker.AdvancedMarkerElement({
                        position: {
                            lat: stopLocations[i]['lat'],
                            lng: stopLocations[i]['lng'],
                        },
                        title: 'Stop',
                        map,
                    });
                }
            }

            function removeMarkers() {
                for (var i = 0; i < gmarkers.length; i++) {
                    gmarkers[i].setMap(null);
                }
                gmarkers = []; // Clear the array
            }


        }

        window.initMap = initMap;

        $(document).ready(function() {
            $('#inputVehicle').change(function() {
                var tripId = $('#inputVehicle').val();
                var uri = "{{ route('tracking.show', ['id' => ':tripId']) }}".replace(':tripId', tripId);
                window.location = uri;
            });
        });
    </script>
    <!--gmap-->
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&loading=async">
    </script>

@endsection
