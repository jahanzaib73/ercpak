

$("#activityAddForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        name: "required",
        location_id: "required",
        date: "required",
        latitude: "required",
        longitude: "required",
    }
});

$('#activityAddBtn').click(function () {
    var formElement = document.getElementById('activityAddForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#activityAddForm').attr('action');
        var method = $('#activityAddForm').attr('method');
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

                    $('#activityModal input, #activityModal select, #activityModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Activity',
                        'Activity Addedd Successfully');
                    $('#activityModal').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);

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


var map = new google.maps.Map(document.getElementById('projectTaskMapId'), {
    center: {
        lat: 31.561560648568946,
        lng: 74.31137413872314
    },
    zoom: 5,
});


// Variable to store the currently open info window
var openInfoWindow = null;

// Loop through tasks and add a marker for each task
activities.forEach(function (activity) {
    // Check if task has valid lat and lng properties
    if (activity.latitude !== undefined && activity.longitude !== undefined && !isNaN(activity.latitude) && !isNaN(activity.longitude)) {
        var marker = new google.maps.Marker({
            position: { lat: parseFloat(activity.latitude), lng: parseFloat(activity.longitude) },
            map: map,
            title: 'Activity Marker',
        });

        // var contentString = 'here is a task';

        var contentString = '<div style="text-align: center;">' +
            '<div style="border-radius: 10px; overflow: hidden; width: 200px; margin: 0 auto; position: relative;">' +
            '<img src="' + task.featured_image_url + '" alt="Task Image" style="width: 50%; height: auto; border-top-left-radius: 10px; border-top-right-radius: 10px;">' +
            '</div>' +
            '<hr><div style="text-align: left; padding: 10px;">' +
            '<h5>Activity: ' + activity.name + '</h5>' +
            '<p>Task: ' + task.task_name + '</p>' +
            '<p>Project: ' + task.project.project_name + '</p>' +
            '</div>' +
            '</div>';

        var infoWindow = new google.maps.InfoWindow({
            content: contentString,
        });

        // Attach click event listener to marker
        marker.addListener('click', function () {
            // Close the currently open info window, if any
            if (openInfoWindow) {
                openInfoWindow.close();
            }

            // Open the new info window
            infoWindow.open(map, marker);

            // Update the currently open info window variable
            openInfoWindow = infoWindow;
        });
    } else {
        console.error('Invalid lat/lng values for a task:', task);
    }
});


function toggleDescription(button) {
    var shortDescription = button.parentElement.querySelector('.short-description');
    var fullDescription = button.parentElement.querySelector('.full-description');

    if (shortDescription.style.display === 'none') {
        shortDescription.style.display = 'inline';
        fullDescription.style.display = 'none';
        button.innerHTML = 'See More';
    } else {
        shortDescription.style.display = 'none';
        fullDescription.style.display = 'inline';
        button.innerHTML = 'See Less';
    }
}



var reportTaskMap = new google.maps.Map(document.getElementById('reportTaskMap'), {
    center: {
        lat: 31.561560648568946,
        lng: 74.31137413872314
    },
    zoom: 5,
});


// Loop through tasks and add a marker for each task
if (task.latitude !== undefined && task.longitude !== undefined && !isNaN(task.latitude) && !isNaN(task.longitude)) {
    var marker = new google.maps.Marker({
        position: { lat: parseFloat(task.latitude), lng: parseFloat(task.longitude) },
        map: reportTaskMap,
        title: 'Task Marker',
    });
} else {
    console.error('Invalid lat/lng values for a task:', task);
}
