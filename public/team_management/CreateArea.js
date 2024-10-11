
$("#createAreaModelForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        area_name: "required",
        city_id: "required",
        province_id: "required",
    },
    messages: {
        area_name: "Please enter your city name",
        city_id: "Please Select city",
        province_id: "Please Select province",
    }
});

$('#createAreaModelBtn').click(function () {
    var formElement = document.getElementById('createAreaModelForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid

        $.ajax({
            type: "POST",
            url: createAreaUrl,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status) {
                    $('#createAreaModel input, #createAreaModel select, #createAreaModel textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Team',
                        'Area added Successfully');
                    $('#createAreaModel').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 800);
                }
            },
            error: function (error) {
                console.log(error);
                $.Notification.autoHideNotify('error', 'top right', 'Team',
                    'Something went wrong');
            }
        });

    }
});




$('#createAreaModelBtnId').click(function () {

    $.ajax({
        type: "GET",
        url: getAllAreasUrl,
        data: {
            showAll: true
        },
        success: function (response) {
            if (response.status) {
                $('#createAreaModel').modal('show');
                // debugger;
                console.log(response);
                var data = response.data;

                var map = new google.maps.Map(document.getElementById('mapCreateArea'), {
                    center: {
                        lat: 31.561560648568946,
                        lng: 74.31137413872314
                    },
                    zoom: 12,
                });

                drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControl: true,  // Set to true to show the drawing control
                    drawingControlOptions: {
                        position: google.maps.ControlPosition.TOP_CENTER,
                        drawingModes: ['polygon']
                    },
                });

                drawingManager.setMap(map);

                google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
                    if (event.type === 'polygon') {
                        let polygon = event.overlay;
                        coordinates = polygon.getPath().getArray();
                        $('#polygon').val(coordinates);
                        console.log('Polygon Coordinates:', coordinates);
                    }
                });
                console.log(data);
                $.each(data, function (indexInArray, valueOfElement) {
                    console.log(valueOfElement);

                    const polygonData = valueOfElement.polygon_coordinates;

                    if (polygonData) {
                        // Remove parentheses and split the coordinates
                        const coordinates = polygonData.replace(/[()]/g, '').split(',').map(function (coord) {
                            return Number(coord);
                        });

                        const polygonCoordinates = [];
                        for (let i = 0; i < coordinates.length; i += 2) {
                            polygonCoordinates.push({
                                lat: coordinates[i],
                                lng: coordinates[i + 1]
                            });
                        }

                        polygon = new google.maps.Polygon({
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
                });

                showPolygonOnIndexMap();

            }
        }
    });
});


function filterCities(provinceId) {
    // Clear existing options in the member select
    $('#city_id,#edit_city_id').empty();

    // Add the default option
    $('#city_id,#edit_city_id').append('<option value="">Choose...</option>');

    // Filter members based on the selected team ID
    var filteredCities = cities.filter(function (city) {
        return city.province_id == provinceId;
    });

    // Add the filtered members to the member select
    $.each(filteredCities, function (key, city) {
        $('#city_id,#edit_city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
    });
}

// On change of the team select
$('#province_id, #edit_aera_province_id').change(function () {
    // Get the selected province ID
    var provinceId = $(this).val();
    console.log(provinceId);
    // Call the function to filter and populate cities based on the selected province
    filterCities(provinceId);
});


$('.area_edit_button').click(function () {
    var id = $(this).data('id');
    var area_name = $(this).data('area_name');
    var province = $(this).data('province');
    var city = $(this).data('city');
    var polygon = $(this).data('polygon');
    var status = $(this).data('status');

    $('#area_id').val(id);
    $('#edit_polygon').val(polygon);
    $('#edit_area_name').val(area_name);
    $('#edit_aera_province_id').val(province).trigger('change');

    $('#edit_city_id').val(city).trigger('change');
    $('#edit_status').val(status).trigger('change');


    var map = new google.maps.Map(document.getElementById('mapEditArea'), {
        center: {
            lat: 31.561560648568946,
            lng: 74.31137413872314
        },
        zoom: 12,
    });

    drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: true,  // Set to true to show the drawing control
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
        },
    });

    drawingManager.setMap(map);
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
        if (event.type === 'polygon') {
            let polygon = event.overlay;
            coordinates = polygon.getPath().getArray();
            $('#edit_polygon').val('');
            $('#edit_polygon').val(coordinates);
            console.log('Polygon Coordinates:', coordinates);
        }
    });
    const polygonData = polygon;

    if (polygonData) {
        // Remove parentheses and split the coordinates
        const coordinates = polygonData.replace(/[()]/g, '').split(',').map(function (coord) {
            return Number(coord);
        });

        const polygonCoordinates = [];
        for (let i = 0; i < coordinates.length; i += 2) {
            polygonCoordinates.push({
                lat: coordinates[i],
                lng: coordinates[i + 1]
            });
        }

        polygon = new google.maps.Polygon({
            paths: polygonCoordinates,
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            // editable: true
        });

        // google.maps.event.addListener(polygon.getPath(), 'set_at', function () {
        //     // This event is triggered when a vertex is set to a new location
        //     $('#polygon').val(polygon.getPath().getArray());
        //     console.log('Vertex set at:', polygon.getPath().getArray());
        // });

        let bounds = new google.maps.LatLngBounds();
        for (let i = 0; i < polygonCoordinates.length; i++) {
            bounds.extend(polygonCoordinates[i]);
        }
        map.fitBounds(bounds);
    }

    $("#updateAreaModel").modal('show');
});


$("#updateAreaModelForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        area_name: "required",
        city_id: "required",
        province_id: "required",
        status: "required",
    },
    messages: {
        area_name: "Please enter your city name",
        city_id: "Please Select city",
        province_id: "Please Select province",
        status: "Please Select status",
    }
});

$('#updateAreaModelBtn').click(function () {
    var formElement = document.getElementById('updateAreaModelForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#updateAreaModelForm').attr('action');
        var method = $('#updateAreaModelForm').attr('method');
        $.ajax({
            type: method,
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status) {
                    $('#createAreaModel input, #createAreaModel select, #createAreaModel textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Team',
                        'Area added Successfully');
                    $('#createAreaModel').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 800);
                }
            },
            error: function (error) {
                console.log(error);
                $.Notification.autoHideNotify('error', 'top right', 'Team',
                    'Something went wrong');
            }
        });

    }
});
