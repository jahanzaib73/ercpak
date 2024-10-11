@extends('layouts.app')
@section('protocol-liaison-active-class', 'active')
@section('content')
    <div class="container-fluid">
        <div class="page-head">
            <h4 class="mt-2 mb-2">Protocol & Liaisons</h4>
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="map" id="main_map"></div>
                </div>
            </div>
        </div>
        @include('admin.protocol_liaisons/_partials/_pai_chart_state')
        <!--end row-->
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="header-title pb-3">Protocol & Liaisons Listing</h5>
                                    </div>
                                    @include('admin.protocol_liaisons/_partials/_module_button')
                                </div>
                            </div>
                            @if (Auth::user()->can('Add Protocol and Liaison'))
                                <div class="col-4 text-right">
                                    <a href="{{ route('protocol-and-liaisons.create', ['module' => App\Models\ProtocolLiaison::COMPANY]) }}"
                                        class="btn save-btn mr-3 btn-sm">Add
                                        New</a>
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
                                                <th>Created By</th>
                                                <th>Case#</th>
                                                <th>Company Name</th>
                                                <th>Company City/Town</th>
                                                <th>Company Email</th>
                                                <th>Company Website</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
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
    <input type="hidden" id="map_url"
        value="{{ route('protocol-and-liaisons.main.map', ['moduleName' => $moduleName]) }}">
@endsection

@section('script')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCpDlhP8_4Ha6VKghpaMfpRQFn7fcqisKY" type="text/javascript">
    </script>
    <script src="{{ asset('app_js_functions/protocol_map.js') }}"></script>
    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('protocol-and-liaisons.index') }}",
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
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'company_city',
                    name: 'company_city'
                },
                {
                    data: 'company_email',
                    name: 'company_email'
                },
                {
                    data: 'company_website',
                    name: 'company_website'
                },
                {
                    data: 'company_google_map_lat',
                    name: 'company_google_map_lat'
                },
                {
                    data: 'company_google_map_lng',
                    name: 'company_google_map_lng'
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
        plotGroph('offical_state_pai_chart', "{{ $allStateOfficial }}", "{{ $todayStateOfficial }}");
        plotGroph('notable_state_pai_chart', "{{ $allStateNotable }}", "{{ $todayStateNotable }}");
        plotGroph('company_state_pai_chart', "{{ $allStateCompany }}", "{{ $todayStateCompany }}");
        plotGroph('project_state_pai_chart', "{{ $allStateProject }}", "{{ $todayStateProject }}");
        plotGroph('property_state_pai_chart', "{{ $allStateProperty }}", "{{ $todayStateProperty }}");

        // Show marker and detail on map
        $.ajax({
            type: "GET",
            url: $('#map_url').val(),
            data: {
                'modeuleName': "{{ $moduleName }}"
            },
            success: function(response) {
                if (response.status) {
                    var infowindow = new google.maps.InfoWindow();
                    var cooridnates = response.cooridnates;
                    console.log(cooridnates);
                    var lat = 30.3753;
                    var lng = 69.3451;

                    {{--  if (cooridnates.length > 0) {
                        lat = cooridnates[0].lat;
                        lng = cooridnates[0].lng;
                    }  --}}

                    var map = new google.maps.Map(document.getElementById('main_map'), {
                        zoom: 5,
                        center: new google.maps.LatLng(lat, lng),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    cooridnates.forEach((coordinate, i) => {

                        const markerOptions = {
                            position: new google.maps.LatLng(coordinate.lat, coordinate.lng),
                            map: map,
                        };

                        // Check if image_url is available
                        if (coordinate.image_url) {
                            const markerImage = {
                                url: `${coordinate.image_url}`, // URL of the image
                                scaledSize: new google.maps.Size(32,
                                32), // scaled size (width, height in pixels)
                            };
                            markerOptions.icon = markerImage;
                        }

                        // Create the marker with the specified options
                        const marker = new google.maps.Marker(markerOptions);

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent(`
                                <div class="margin-bottom: 10px !important">
                                <div class="text-center" style="margin-bottom: -20px;"><img src="${coordinate.image_url}" width="100" height="100" /></div> <br>
                                <b>Name:</b> ${coordinate.name}<br>
                                <b>Email:</b> ${coordinate.email}<br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="${coordinate.detail_url}" class="btn btn-primary mt-1" target="_blank">Detail</a>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="tel:+92${coordinate.primary_number}" class="btn btn-danger mt-1"><i class="mdi mdi-phone"></i></a>
                                    </div>
                                </div>
                                <div>
                                `);
                                infowindow.open(map, marker);
                            }
                        })(marker, i));
                    });
                }
            }
        });
    </script>
@endsection
