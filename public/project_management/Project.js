
$("#startProjectForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        date: "required",
        latitude: "required",
        longitude: "required",
        start_description: "required",
        start_description_arabic: "required",
    }
});

$('#startProjectBtn').click(function () {
    var formElement = document.getElementById('startProjectForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#startProjectForm').attr('action');
        var method = $('#startProjectForm').attr('method');
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

                    // Clear input values
                    $('#projectStart input, #projectStart select, #projectStart textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Task',
                        'Task Addedd Successfully');
                    $('#projectStart').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 500);

                } else {
                    $.Notification.autoHideNotify('error', 'top right', 'Task',
                        response.message);
                }
            },
            error: function (error) {
                console.log(error);
                $.Notification.autoHideNotify('error', 'top right', 'Task',
                    'Something went wrong');
            }
        });

    }
});

$("#completeProjectForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        completed_date: "required",
        completed_description: "required",
        completed_description_arabic: "required",
    }
});

$('#completeProjectBtn').click(function () {
    var formElement = document.getElementById('completeProjectForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#completeProjectForm').attr('action');
        var method = $('#completeProjectForm').attr('method');
        // debugger;
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

                    // Clear input values
                    $('#projectStart input, #projectStart select, #projectStart textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Project',
                        'Project Mark as Completed');
                    $('#projectStart').modal('hide');

                    setTimeout(() => {
                        window.location.reload();
                    }, 500);

                } else {
                    $.Notification.autoHideNotify('error', 'top right', 'Task',
                        response.message);
                }
            },
            error: function (error) {
                console.log(error);
                $.Notification.autoHideNotify('error', 'top right', 'Task',
                    'Something went wrong');
            }
        });

    }
});


$('#member_id').change(function () {
    // Clear previous images
    $('#memebr_image_container').empty();

    // Get selected option(s)
    $('#member_id option:selected').each(function () {
        // Get the data-profile_pic_url attribute
        var profilePicUrl = $(this).data('profile_pic_url');

        // Append image to the container
        if (profilePicUrl) {
            $('#memebr_image_container').append('<div class="col-6 col-md-3"><img src="' + profilePicUrl + '" alt="" width="100%"></div>');
        }
    });
});



var map = new google.maps.Map(document.getElementById('projectMapId'), {
    center: { lat: 31.561560648568946, lng: 74.31137413872314 },
    zoom: 5,
});

// Variable to store the currently open info window
var openInfoWindow = null;

// Loop through tasks and add a marker for each task
tasks.forEach(function (task) {
    // Check if task has valid lat and lng properties
    if (task.latitude !== undefined && task.longitude !== undefined && !isNaN(task.latitude) && !isNaN(task.longitude)) {
        var marker = new google.maps.Marker({
            position: { lat: parseFloat(task.latitude), lng: parseFloat(task.longitude) },
            map: map,
            title: 'Task Marker',
        });

        var contentString = '<div style="text-align: center;">' +
            '<div style="border-radius: 10px; overflow: hidden; width: 200px; margin: 0 auto; position: relative;">' +
            '<img src="' + task.featured_image_url + '" alt="Task Image" style="width: 50%; height: auto; border-top-left-radius: 10px; border-top-right-radius: 10px;">' +
            '</div>' +
            '<div style="text-align: left; padding: 10px;">' +
            '<h5>Task: ' + task.task_name + '</h5>' +
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



