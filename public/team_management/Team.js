$("#team_add_form").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        team_name: "required",
        team_name_urdu: "required",
        team_color: "required",
        team_city: "required",
        team_country: "required",
        //file: "required",
    },
    messages: {
        team_name: "Please enter your team name",
        team_name_urdu: "Please enter your team name in arabic",
        team_color: "Please Select team color",
        team_city: "Please Select city",
        team_country: "Please Select country",
        //file: "Please Select team symbol",
    }
});

$('#submitFormButtonTeam').click(function () {
    var formElement = document.getElementById('team_add_form'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid

        $.ajax({
            type: "POST",
            url: teamUrl,
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
                    $('#teamModal input, #teamModal select, #teamModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Team',
                        'Team Addedd Successfully');
                    $('#teamModal').modal('hide');

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


$('.team_edit_button').click(function () {
    var team_id = $(this).data('id');
    var team_name = $(this).data('team_name');
    var team_name_urdu = $(this).data('team_name_urdu');
    var team_color = $(this).data('team_color');
    var team_city = $(this).data('team_city');
    var team_country = $(this).data('team_country');
    var team_status = $(this).data('team_status');

    $('#edit_team_id').val(team_id);
    $('#edit_team_name').val(team_name);
    $('#edit_team_name_urdu').val(team_name_urdu);
    $('#edit_team_color').val(team_color);
    $('#edit_team_city').val(team_city).trigger('change');
    $('#edit_team_country').val(team_country).trigger('change');
    $('#edit_team_status').val(team_status).trigger('change');

    $("#editTeamModal").modal('show');
});


$("#team_edit_form").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        team_name: "required",
        team_name_urdu: "required",
        team_color: "required",
        team_city: "required",
        team_country: "required",
        team_status: "required",
    },
    messages: {
        team_name: "Please enter your team name",
        team_name_urdu: "Please enter your team name in arabic",
        team_color: "Please Select team color",
        team_city: "Please Select city",
        team_country: "Please Select country",
        team_status: "Please Select status",
    }
});

$('#submitFormButtonTeamEdit').click(function () {
    var formElement = document.getElementById('team_edit_form'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#team_edit_form').attr('action');
        var method = $('#team_edit_form').attr('method');
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
                    $('#teamModal input, #teamModal select, #teamModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Team',
                        'Team Addedd Successfully');
                    $('#teamModal').modal('hide');

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
