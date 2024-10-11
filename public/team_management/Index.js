const showPolygonOnIndexMap = () => {
    $.ajax({
        type: "GET",
        url: getAllAreasUrl,
        data: {
            session: $('#session').val(),
            showAll: false
        },
        success: function (response) {
            if (response.status) {
                var data = response.data;
                // var assignedArea = data.get_signle_assign_area;
                console.log(data);
                var map = new google.maps.Map(document.getElementById('indexMapId'), {
                    center: {
                        lat: 31.561560648568946,
                        lng: 74.31137413872314
                    },
                    zoom: 5,
                });
                // Define a variable to keep track of the currently open InfoWindow
                let openInfoWindow = null;

                $.each(data, function (indexInArray, valueOfElement) {

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

                        const polygon = new google.maps.Polygon({
                            paths: polygonCoordinates,
                            strokeColor: valueOfElement.get_signle_assign_area.team.team_color,
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: valueOfElement.get_signle_assign_area.team.team_color,
                            fillOpacity: 0.35,
                            map: map
                        });
                        // Create an InfoWindow for the polygon
                        const infoWindow = new google.maps.InfoWindow({
                            autoScroll: false,
                            content: `<div class="border border-dark container info-window-content rounded">
                            <div class="row">
                               <div class="col-4">
                                  <div class="border border-dark height"><img src="${valueOfElement.get_signle_assign_area.member.photo_url}" alt="Member image" 
                                    style="width: 130px; height: 157px;"></div>
                               </div>
                               <div class="col-8">
                                  <h6 class="mb-4 text-right">${valueOfElement.get_signle_assign_area.session_year}</h6>
                                  <h6>Name</h6>
                                  <p>${valueOfElement.get_signle_assign_area.member.member_name}</p>
                                  <hr>
                                  <p>${valueOfElement.area_name}</p>
                               </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-8">
                                  <div>
                                    <p>${valueOfElement.get_signle_assign_area.team.team_name}</p>
                                  </div>
                                </div>
                                <div class="col-4">
                                  <div class="height-second text-center">
                                    <img src="${valueOfElement.get_signle_assign_area.team.team_symbol_url}" alt="Team symbol" style="width: 50px;">
                                  </div>
                               </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                  <a href="${valueOfElement.url}" target="_blank" class="btn px-5 border-dark bg-white">View</a>
                                </div>
                                
                            </div>
                            </div>` // Replace with your actual content
                        });


                        // Add a click event listener to the polygon to open the InfoWindow
                        google.maps.event.addListener(polygon, 'click', function (event) {
                            // Close the previously open InfoWindow, if any
                            if (openInfoWindow) {
                                openInfoWindow.close();
                            }

                            // Set the new InfoWindow as the currently open one
                            openInfoWindow = infoWindow;

                            infoWindow.setPosition(event.latLng);
                            infoWindow.open(map);
                        });
                    }
                });

            }
        }
    });
}

showPolygonOnIndexMap();


$(document).on('click', '.team_filter', function (e) {
    $('#filter_team_id').val($(this).data('id'));
    table.draw();
});

$('#session').change(function (e) {
    showPolygonOnIndexMap();
});
