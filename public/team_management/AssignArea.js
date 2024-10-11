$("#assignAreaForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        area_id: "required",
        member_id: "required",
        year: {
            required: true,
            digits: true,  // Allows only digits (0-9)
            minlength: 4,  // Minimum length of 4 characters
            maxlength: 4,  // Maximum length of 4 characters
            range: [1900, new Date().getFullYear()]  // Range between 1900 and the current year
        }
    },
    messages: {
        area_name: "Please enter Area",
        city_id: "Please Select City",
        year: {
            required: "Please enter the year.",
            digits: "Please enter only digits.",
            minlength: "Year must be at least 4 characters.",
            maxlength: "Year must not exceed 4 characters.",
            range: "Please enter a valid year between 1900 and the current year."
        }
    }
});

$('#assignAreaBtn').click(function () {
    var formElement = document.getElementById('assignAreaForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid

        $.ajax({
            type: "POST",
            url: assignAreaUrl,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status) {
                    $('#assignModal input, #assignModal select, #assignModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Team',
                        'Area assigned Successfully');
                    $('#assignModal').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 800);
                }
            },
            error: function (error) {
                console.log(error);
                $.Notification.autoHideNotify('error', 'top right', 'Assigned Area',
                    'Someting went wrong');
            }
        });

    }
});


$('#area_id').on('change', function () {
    console.log($(this).val());
    var polygonData = $(this).find('option:selected').data('polygon');
    console.log(polygonData);

});




function initMapForAssignArea() {
    const mapCenter = {
        lat: 31.561560648568946,
        lng: 74.31137413872314
    };

    let mapAssignArea = new google.maps.Map(document.getElementById('mapAssignArea'), {
        center: mapCenter,
        zoom: 12,
    });

    let polygon = null;
    $('#area_id').on('change', function () {

        if (polygon) {
            polygon.setMap(null);
        }

        const polygonData = $(this).find('option:selected').data('polygon');

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
            map: mapAssignArea
        });

        let bounds = new google.maps.LatLngBounds();
        for (let i = 0; i < polygonCoordinates.length; i++) {
            bounds.extend(polygonCoordinates[i]);
        }
        mapAssignArea.fitBounds(bounds);
    });
}

$('#assignModal').on('shown.bs.modal', function () {
    initMapForAssignArea();
});

// Function to filter and populate members based on the selected team
function filterMembersByTeam(teamId) {
    // Clear existing options in the member select
    $('#member_id').empty();

    // Add the default option
    $('#member_id').append('<option value="">Choose...</option>');

    // Filter members based on the selected team ID
    var filteredMembers = members.filter(function (member) {
        return member.team_id == teamId;
    });

    // Add the filtered members to the member select
    $.each(filteredMembers, function (key, member) {
        $('#member_id').append('<option value="' + member.id + '">' + member.member_name + '</option>');
    });
}

// On change of the team select
$('#team_id_assign').change(function () {
    // Get the selected team ID
    var teamId = $(this).val();
    console.log(teamId);
    // Call the function to filter and populate members based on the selected team
    filterMembersByTeam(teamId);
});
