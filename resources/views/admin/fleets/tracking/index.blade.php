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
            <div class="d-flex">
                <h4><strong>Tracking / </strong>&nbsp;</h4>
                <h4 class="arabic">تتبع</h4>
            </div>


        </div>

        <!-- =========================== -->

        <section class="container">

            <div class="table-responsive">

                <table class=" small pt-3 ajax-table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <p class="arabic red">رقم التسلسل</p>
                                <p>S.#</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"># لوحة السيارة </p>
                                <p>Vehicle #</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">نموذج السيارة</p>
                                <p>Model</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">نوع السيارة</p>
                                <p>Type</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"> رقم الرحلة </p>
                                <p>Trip #</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">التاريخ والوقت البدء</p>
                                <p>Date & Time Start</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red"> اسم السائق </p>
                                <p>Driver</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">أصل</p>
                                <p>Origin</p>
                            </th>
                            <th scope="col">
                                <p class="arabic red">وجهة </p>
                                <p>Destination</p>
                            </th>

                            <th scope="col">
                                <p class="arabic red"> منظر</p>
                                <p>View</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
    </style>

@endsection

@section('script')

    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('tracking') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'vehicle_number',
                    name: 'vehicle_number'
                },
                {
                    data: 'vehicle_model',
                    name: 'vehicle_model'
                },
                {
                    data: 'vehicle_type',
                    name: 'vehicle_type'
                },
                {
                    data: 'trip_number',
                    name: 'trip_number'
                },
                {
                    data: 'exit_datetime_out',
                    name: 'exit_datetime_out'
                },
                {
                    data: 'driver',
                    name: 'driver'
                },
                {
                    data: 'origin',
                    name: 'origin'
                },
                {
                    data: 'destination',
                    name: 'destination'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        function initMap() {
            const rykLatLng = {
                lat: 28.4147380,
                lng: 70.305503
            };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: rykLatLng,
            });
            var infoWindow = new google.maps.InfoWindow();

            // Declare gmarkers outside the updateMap function
            var gmarkers = [];
            // Function to update the map with the latest location
            function updateMap() {
                // Make an AJAX request to get the latest location
                $.ajax({
                    url: '{{ route('latestLocation') }}', // Update the URL based on your route
                    method: 'GET',
                    success: function(response) {
                        // Clear existing markers before adding new ones
                        removeMarkers();
                        response.trips.forEach(trip => {
                            if (trip.coordinates) {
                                position = JSON.parse(trip.coordinates);
                                lastElement = position.pop();
                                var lat = lastElement.lat ?? '';
                                var lng = lastElement.lng ?? '';
                                var coordinates = {
                                    lat: lat,
                                    lng: lng,
                                }
                                var marker = new google.maps.Marker({
                                    position: coordinates,
                                    map: map,
                                    icon: "{{ asset('img/auto.png') }}"
                                });
                                gmarkers.push(marker);
                            } else {
                                geocoder = new google.maps.Geocoder();
                                geocoder.geocode({
                                    'address': trip.origin
                                }, function(results, status) {
                                    if (status === 'OK') {
                                        map.setCenter(results[0].geometry.location);
                                        var marker = new google.maps.Marker({
                                            map: map,
                                            position: results[0].geometry.location,
                                            icon: "{{ asset('img/auto.png') }}"
                                        });
                                        gmarkers.push(marker);
                                    } else {
                                        alert('Geocode was not successful for the following reason: ' +
                                            status);
                                    }
                                });
                            }
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching location:', error);
                        // Handle errors if needed
                    }
                });
            }
            // Call updateMap immediately and then every 10 seconds
            updateMap();
            setInterval(function() {
                updateMap();
            }, 10000);

            function removeMarkers() {
                for (var i = 0; i < gmarkers.length; i++) {
                    gmarkers[i].setMap(null);
                }
                gmarkers = []; // Clear the array
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation.",
            );
            infoWindow.open(map);
        }

        window.initMap = initMap;
    </script>
    <!--gmap-->
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&loading=async">
    </script>

@endsection
