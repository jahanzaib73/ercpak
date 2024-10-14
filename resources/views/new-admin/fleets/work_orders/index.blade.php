@extends('new-admin/layouts/contentLayoutMaster')

@section('title', 'List of Inspection')

@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <style>
        table {
            counter-reset: section;
        }

        .count:before {
            counter-increment: section;
            content: counter(section);
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem
        }

        .pac-container {
            z-index: 999999;
        }

        .text-right {
            text-align: right;
        }
    </style>
@endsection

@section('content')
    <!-- Basic tabs start -->
    <section id="basic-tabs-components">
        <div class="row match-height">
            <!-- Basic Tabs starts -->
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('fleet/work-orders') ? 'active' : '' }}"
                                    href="/fleet/work-orders">Work Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('fleet/inspections') ? 'active' : '' }}"
                                    href="/fleet/inspections">Inspection</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tabs end -->

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            @include('new-admin.fleets._shareable._states', [
                'states' => $states ?: [],
            ])
            <hr>
            <div class="card">
                <div class="card-header">
                    <div class="col-md-5 py-0 pl-3">
                        <h4 class="card-title">List of Work Orders</h4>
                    </div>
                    <div class="col-md-7 text-right">
                        <a class="btn btn-primary save-btn filter-link activeFilterButton" data-type="-1"
                            href="#">All</a>
                        <a class="btn btn-primary save-btn filter-link" href="#" data-type="0">Open</a>
                        <a class="btn btn-primary save-btn filter-link" href="#" data-type="2">Pending</a>
                        <a class="btn btn-primary save-btn filter-link" href="#" data-type="1">Closed</a>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @php
                    Session::forget('success');
                @endphp
                <div class="table-responsive width-95-per mx-auto">
                    <table class="table ajax-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Inspection Type</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Inspection#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Vehicle#</th>
                                <th scope="col">Model</th>
                                <th scope="col">Meter</th>
                                <th scope="col">Cost Center</th>
                                <th scope="col">Attachment</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>
@endsection
@section('page-script')
    <script>
        var table = $('.ajax-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('work-orders.index') }}",
                data: function(d) {
                    // Include filter data from the data-type attribute of the active filter link
                    d.status = $('.filter-link.activeFilterButton').data('type');
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'inspection_type',
                    name: 'inspection_type'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'inspection_number',
                    name: 'inspection_number'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'vehicle_number',
                    name: 'vehicle_number'
                },

                {
                    data: 'model',
                    name: 'model'
                },
                {
                    data: 'meter_reading',
                    name: 'meter_reading'
                },
                {
                    data: 'costCenter',
                    name: 'costCenter'
                },
                {
                    data: 'attachments',
                    name: 'attachments'
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

        // Add a click event listener to the filter links
        $('.filter-link').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior

            // Remove the "active" class from all filter links
            $('.filter-link').removeClass('activeFilterButton');

            // Add the "active" class to the clicked link
            $(this).addClass('activeFilterButton');

            // Trigger a DataTable reload with the updated filter criteria
            table.ajax.reload();
        });

        $(document).ready(function() {
            $('#outsourceVehicleForm').validate({
                rules: {
                    vehicle_number: 'required',
                    vehicle_make_id: 'required',
                    vehicle_model_id: 'required',
                    vehicle_type_id: 'required',
                    fuel_type_id: 'required',
                    owner_id: 'required',
                },
                messages: {
                    vehicle_number: 'Please enter vehicle number.',
                    vehicle_make_id: 'Please select a vehicle make.',
                    vehicle_model_id: 'Please select a vehicle model.',
                    vehicle_type_id: 'Please select an vehicle type.',
                    fuel_type_id: 'Please select an fuel type.',
                    owner_id: 'Please select an owner.',
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2')) {
                        error.insertAfter(element.next(
                            '.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        });


        var programmaticChange = false;
        $(document).ready(function() {
            $('#outsourceVehiclebtn').click(function() {
                var formElement = document.getElementById('outsourceVehicleForm'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid
                    $.ajax({
                        type: "POST",
                        url: "{{ route('vehicles.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#outsourceVehicleForm input, #outsourceVehicleForm select, #outsourceVehicleForm textarea')
                                    .val('');

                                var selectElement = $('#vehicle_id');
                                selectElement.empty();
                                selectElement.append('<option selected>Choose...</option>')

                                $.each(response.vehicles, function(index, option) {
                                    selectElement.append($('<option>', {
                                        value: option.id,
                                        text: option.vehicle_number
                                    }));
                                });

                                $('#outsource').modal('hide');


                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        });

        $(document).ready(function() {


            $('#trip_id').on('change', function() {
                console.log(programmaticChange);
                if (!programmaticChange) {
                    programmaticChange = true;

                    // Deselect the option in the other dropdown
                    $('#vehicle_id').val('').trigger('change');

                    var id = $(this).val();
                    var type = $(this).find('option:selected').data('type');
                    if (id && type) {
                        getVehicleTripData(id, type);
                    }

                    programmaticChange = false;
                }
            });

            $('#vehicle_id').on('change', function() {

                if (!programmaticChange) {
                    programmaticChange = true;

                    // Deselect the option in the other dropdown
                    $('#trip_id').val('').trigger('change');

                    var id = $(this).val();
                    var type = $(this).find('option:selected').data('type');
                    if (id && type) {
                        getVehicleTripData(id, type);
                    }

                    programmaticChange = false;
                }
            });
        });

        function getVehicleTripData(id, type) {
            $.ajax({
                type: "GET",
                url: "{{ route('trips.vehicle.by.id.index') }}",
                data: {
                    'id': id,
                    'type': type
                },
                success: function(res) {
                    var data = res.data;
                    var type = res.type;
                    console.log(data);
                    if (type == 'vehicle') {
                        $('#fuel_vehicle_number').text(data.vehicle_number);
                        $('#fuel_vehicle_model').text(data.model.name);
                        $('.fuel_vehicle_image').attr('src', data.image_url)
                        $('#vehicle_meter_reading').val(data.current_meter_reading)

                        $('#driver_id').val('').trigger('change');
                        $('#driver_name').text('');
                        $('#driver_designation').text('');
                        $('.driver_image').attr('src', 'http://placehold.it/180');

                        $('#official_id').val('').trigger('change');
                        $('#official_name').text('');
                        $('#official_designation').text('');
                        $('.official_image').attr('src', 'http://placehold.it/180');
                    } else {
                        $('#fuel_vehicle_number').text(data.vehicle.vehicle_number);
                        $('#fuel_vehicle_model').text(data.vehicle.model.name);
                        $('.fuel_vehicle_image').attr('src', data.vehicle.image_url)
                        $('#vehicle_meter_reading').val(data.vehicle.current_meter_reading)

                        $('#driver_id').val(data.driver_id).trigger('change');
                        $('#driver_name').text(data.driver.first_name + ' ' + data.driver.last_name);
                        $('#driver_designation').text(data.driver.designation.name);
                        $('.driver_image').attr('src', data.driver.profile_pic_url);

                        $('#official_id').val(data.official_id).trigger('change');
                        $('#official_name').text(data.official.first_name + ' ' + data.official.last_name);
                        $('#official_designation').text(data.official.designation.name);
                        $('.official_image').attr('src', data.official.profile_pic_url);
                    }

                }
            });
        }

        $('#driver_id').change(function() {
            getUserDataAjax($(this).val(), 'driver_image', 'driver_name', 'driver_designation');
        });

        $('#official_id').change(function() {
            getUserDataAjax($(this).val(), 'official_image', 'official_name', 'official_designation');
        });

        function getUserDataAjax(elementId, imagePlaceHolder, namePlacehodler, designationPlaceholder) {
            $.ajax({
                type: "GET",
                url: "{{ route('trips.get.user.index') }}",
                data: {
                    'id': elementId
                },
                success: function(res) {
                    var user = res.data;
                    $(`#${designationPlaceholder}`).text(user.designation.name);
                    $(`#${namePlacehodler}`).text(user.first_name + ' ' + user.first_name);
                    $(`.${imagePlaceHolder}`).attr('src', user.profile_pic_url)
                }
            });
        }

        $(document).ready(function() {
            $('#fuel_add_form').validate({
                rules: {
                    trip_id: {
                        required: function(element) {
                            return $('#vehicle_id').val() ===
                                ''; // Require trip_id if vehicle_id is empty
                        }
                    },
                    vehicle_id: {
                        required: function(element) {
                            return $('#trip_id').val() === ''; // Require vehicle_id if trip_id is empty
                        }
                    },
                    driver_id: 'required',
                    official_id: 'required',
                    cost_center_id: 'required',
                    exit_datetime: 'required',
                    fuel_tank_id: {
                        required: function(element) {
                            return $('#notes').val() === ''; // Require vehicle_id if trip_id is empty
                        }
                    },
                    fuel_type_id: 'required',
                    fuel_man_id: 'required',
                    qty: {
                        required: true,
                        digits: true, // Only allow whole numbers
                    },
                    price: {
                        required: true,
                        digits: true, // Only allow whole numbers
                    },
                    vehicle_meter_reading: {
                        required: true,
                        digits: true, // Only allow whole numbers
                    }
                },
                messages: {
                    trip_id: 'Please select a trip.',
                    vehicle_id: 'Please select a vehicle.',
                    driver_id: 'Please select a driver.',
                    official_id: 'Please select an official.',
                    cost_center_id: 'Please select a cost center.',
                    exit_datetime: 'Please select a date and time.',
                    fuel_tank_id: 'If you are not selecting fuel tank please add notes in below notes section',
                    fuel_type_id: 'Please select a fuel type.',
                    fuel_man_id: 'Please select a fuel man.',
                    qty: {
                        required: 'Please enter a quantity.',
                        digits: 'Please enter a valid whole number.',
                    },
                    price: {
                        required: 'Please enter a price.',
                        digits: 'Please enter a valid whole number.',
                    },
                    vehicle_meter_reading: {
                        required: 'Please enter a meter reading.',
                        digits: 'Please enter a valid whole number.',
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    if (element.hasClass('select2')) {
                        error.insertAfter(element.next(
                            '.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
            });
        });



        $(document).ready(function() {
            $('#submitFormButton').click(function() {
                var formElement = document.getElementById('fuel_add_form'); // Get the form element
                var formData = new FormData(formElement); // Create FormData from the form

                if ($(formElement).valid()) { // Check if the form is valid



                    $.ajax({
                        type: "POST",
                        url: "{{ route('fuels.store') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response.status);
                            if (!response.status) {
                                $('.alert_content_fuel').removeClass('d-none');
                                $('#alert_content_fuel').text(response.message)
                            }
                            if (response.status) {
                                location.reload()
                            }
                        },
                        error: function(error) {
                            // Handle error
                        }
                    });
                }
            });
        });


        $('#modChart').on('shown.bs.modal', function(event) {
            var link = $(event.relatedTarget);
            // get data source
            var source = link.attr('data-source').split(',');
            // get title
            var title = link.html();
            // get labels
            var table = link.parents('table');
            var labels = [];
            $('#' + table.attr('id') + '>thead>tr>th').each(function(index, value) {
                // without first column
                if (index > 0) {
                    labels.push($(value).html());
                }
            });
            // get target source
            var target = [];
            $.each(labels, function(index, value) {
                target.push(link.attr('data-target-source'));
            });
            // Chart initialisieren
            var modal = $(this);
            var canvas = modal.find('.modal-body canvas');
            modal.find('.modal-title').html(title);
            var ctx = canvas[0].getContext("2d");
            var chart = new Chart(ctx).Line({
                responsive: true,
                labels: labels,
                datasets: [{
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: source
                }, {
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "#F7464A",
                    pointColor: "#FF5A5E",
                    pointStrokeColor: "#FF5A5E",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "red",
                    data: target
                }]
            }, {});
        }).on('hidden.bs.modal', function(event) {
            // reset canvas size
            var modal = $(this);
            var canvas = modal.find('.modal-body canvas');
            canvas.attr('width', '568px').attr('height', '300px');
            // destroy modal
            $(this).data('bs.modal', null);
        });

        $(document).ready(function() {
            var chart = AmCharts.makeChart("fuelTankChart", {
                "type": "serial",
                "startDuration": 2,
                "dataProvider": [{
                    "fuel": "Diesel",
                    "visits": 14025,
                    "color": "#5A5A5A"
                }, {
                    "fuel": "Super",
                    "visits": 18082,
                    "color": "#228B22"
                }, {
                    "fuel": "HOBC",
                    "visits": 12809,
                    "color": "#FF5733"
                }],
                "valueAxes": [{
                    "position": "left",
                    "axisAlpha": 0,
                    "gridAlpha": 0
                }],
                "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "colorField": "color",
                    "fillAlphas": 0.85,
                    "lineAlpha": 0.1,
                    "type": "column",
                    "topRadius": 1,
                    "valueField": "visits"
                }],
                "depth3D": 40,
                "angle": 30,
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "fuel",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0
                }
            });


            jQuery('.chart-input').off().on('input change', function() {
                var property = jQuery(this).data('property');
                var target = chart;
                chart.startDuration = 0;

                if (property == 'topRadius') {
                    target = chart.graphs[0];
                }

                target[property] = this.value;
                chart.validateNow();
            });
        });

        $(document).ready(function() {
            $('.vehicle_image').click(function(e) {
                $('#vehicle_image_input').trigger('click');
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.vehicle_image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ route('fuel.summery.data') }}",
                success: function(data) {

                    var tableBody = $('#business_ratio tbody');
                    $('#business_ratio > tbody > tr.odd').hide();
                    var numberFormatter = new Intl.NumberFormat('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                    // Populate the table rows with data
                    $.each(data.fuelData, function(index, fuel) {

                        var row = $('<tr>');
                        row.append(
                            `<td><a style="color: #337ab7" href="#" data-toggle="modal" data-target="#modChart" data-source="${fuel.JanTotal},${fuel.FebTotal},${fuel.MarTotal},${fuel.AprTotal},${fuel.MayTotal},${fuel.JuneTotal},${fuel.JulyTotal},${fuel.AugTotal},${fuel.SeptTotal},${fuel.OctTotal},${fuel.NovTotal},${fuel.DecTotal}," data-target-source="50"> <span class="fa fa-signal"></span> ${fuel.fuel_type_name}</a></td>`
                        );
                        row.append('<td>' + numberFormatter.format(fuel.JanTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.FebTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.MarTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.AprTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.MayTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.JuneTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.JulyTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.AugTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.SeptTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.OctTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.NovTotal) + '</td>');
                        row.append('<td>' + numberFormatter.format(fuel.DecTotal) + '</td>');
                        tableBody.append(row);
                    });

                }
            });
        });
    </script>
@endsection
