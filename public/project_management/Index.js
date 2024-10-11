
var table = $('#projectTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: projectManagemntIndexUrl,
        data: function (data) {
            data.session_year = $('#session').val();
            data.start_date = $('#start_date').val();
            data.end_date = $('#end_date').val();
        },
    },
    columns: [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        orderable: false,
        searchable: false
    },
    {
        data: 'id',
        name: 'id',
    },
    {
        data: 'project_name',
        name: 'project_name',
    },
    {
        data: 'projectType',
        name: 'projectType',
    },
    {
        data: 'totalTasks',
        name: 'totalTasks',
    },
    {
        data: 'budget',
        name: 'budget',
    },
    {
        data: 'spend',
        name: 'spend',
    },
    {
        data: 'balance',
        name: 'balance',
    },
    {
        data: 'project_date',
        name: 'project_date',
    },
    {
        data: 'start_project_date',
        name: 'start_project_date',
    },
    {
        data: 'complete_project_date',
        name: 'complete_project_date',
    }, {
        data: 'status',
        name: 'status',
    }, {
        data: 'action',
        name: 'action',
    }
    ],
    footerCallback: function (row, data, start, end, display) {
        var api = this.api();

        // Ensure that there is data in the table
        if (api.rows({ search: 'applied' }).data().length > 0) {
            // Calculate the sum for budget, spend, and balance
            var totalBudget = 0;
            var totalSpend = 0;
            var totalBalance = 0;

            api.column(5, { search: 'applied' }).data().each(function (value) {
                if (value) {
                    var numericValue = parseFloat(value.replace(/,/g, ''));
                    if (!isNaN(numericValue)) {
                        totalBudget += numericValue;
                    }
                } else {
                    return 0.00;
                }
            });

            api.column(6, { search: 'applied' }).data().each(function (value) {
                if (value) {
                    var numericValue = parseFloat(value.replace(/,/g, ''));
                    if (!isNaN(numericValue)) {
                        totalSpend += numericValue;
                    }
                } else {
                    return 0.00;
                }

            });

            api.column(7, { search: 'applied' }).data().each(function (value) {
                if (value) {
                    var numericValue = parseFloat(value.replace(/,/g, ''));
                    if (!isNaN(numericValue)) {
                        totalBalance += numericValue;
                    }
                } else {
                    return 0.00;
                }

            });

            // Display the calculated totals in the footer row
            $(api.column(5).footer()).html(totalBudget.toFixed(2));
            $(api.column(6).footer()).html(totalSpend.toFixed(2));
            $(api.column(7).footer()).html(totalBalance.toFixed(2));
        } else {
            // No data in the table, display default values or an appropriate message
            $(api.column(5).footer()).html('N/A');
            $(api.column(6).footer()).html('N/A');
            $(api.column(7).footer()).html('N/A');
        }
    }



});


$("#projectAddForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        project_name: "required",
        budget: "required",
        currency_id: "required",
        project_date: "required",
        feature_image: "required",
        task_type_id: "required",
    }
});

$('#projectAddBtn').click(function () {
    var formElement = document.getElementById('projectAddForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#projectAddForm').attr('action');
        var method = $('#projectAddForm').attr('method');
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
                    //$('.ajax-table').DataTable().ajax.reload();

                    // Clear input values
                    $('#projectModal input, #projectModal select, #projectModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Project',
                        'Project Addedd Successfully');
                    $('#projectModal').modal('hide');

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

function getStates() {
    $.ajax({
        type: "GET",
        url: projectManagemntStatsUrl,
        success: function (response) {
            if (response.status) {
                var projectStats = response.data.projectStats;
                var taskStats = response.data.taskStats;
                $('#allProjects').text(projectStats.allProjects);
                $('#completedProjects').text(projectStats.completedprojects);
                $('#inprogressProjects').text(projectStats.inprogressProjects);
                $('#notStartedProject').text(projectStats.notStarted);

                $('#allTasks').text(taskStats.allTasks);
                $('#completedTasks').text(taskStats.completedTasks);
                $('#inprogressTasks').text(taskStats.inprogressTasks);
                $('#notStartedTasks').text(taskStats.notStartedTasks);

                $('#projectNumber').val(projectStats.allProjects + 1);


            }
        }
    });
}

getStates();


var map = new google.maps.Map(document.getElementById('indexProjectMapId'), {
    center: { lat: 31.561560648568946, lng: 74.31137413872314 },
    zoom: 5,
});

// Variable to store the currently open info window
var openInfoWindow = null;

// Loop through tasks and add a marker for each task
tasks.forEach(function (task) {
    // Check if task has valid lat and lng properties
    if (task.latitude !== undefined && task.longitude !== undefined && !isNaN(task.latitude) && !isNaN(task.longitude)) {
        var markerColor = task.status === 1 ? 'blue' : 'green';

        var marker = new google.maps.Marker({
            position: { lat: parseFloat(task.latitude), lng: parseFloat(task.longitude) },
            map: map,
            title: 'Task Marker',
            icon: `http://maps.google.com/mapfiles/ms/icons/${markerColor}-dot.png`, // Set marker color based on task status

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


$('#filter_button').click(function () {
    table.draw();
});

$('#clear_filter_button').click(function () {
    $('#start_date, #end_date').val('');
    table.draw();
});


$('body').on('click', '.editProject', function (e) {
    var projectId = $(this).data('id');
    $.ajax({
        type: "GET",
        url: projectByIdUrl,
        data: {
            projectId: projectId
        },
        success: function (response) {
            if (response.status) {
                var project = response.data
                console.log(project);
                $('#projectNumberEdit').val(project.id)
                $('#projectId').val(project.id)
                $('#project_name_edit').val(project.project_name)
                $('#budget_edit').val(project.budget)
                $('#currency_id_edit').val(project.currency_id).trigger('change');
                $('#project_date_edit').val(project.project_date)
                $('#notes_edit').val(project.notes)
                $('#notes_arabic_edit').val(project.notes_arabic)
                $("#projectEditModal").modal('show');
            }
        }
    });
});



$("#projectEditForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        project_name: "required",
        budget: "required",
        currency_id: "required",
        project_date: "required",
        task_type_id: "required",
    }
});

$('#projectEditBtn').click(function () {
    var formElement = document.getElementById('projectEditForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#projectEditForm').attr('action');
        var method = $('#projectEditForm').attr('method');
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
                    //$('.ajax-table').DataTable().ajax.reload();

                    // Clear input values
                    $('#projectModal input, #projectModal select, #projectModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Project',
                        'Project Updated Successfully');
                    $('#projectModal').modal('hide');

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
