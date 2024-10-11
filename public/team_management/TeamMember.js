$("#team_member_add_form").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        team_member_name: "required",
        team_id: "required",
        member_photo: "required",
    },
    messages: {
        team_member_name: "Please enter member name",
        team_id: "Please Select team",
        member_photo: "Please Select image",
    }
});

$('#teamMemberAddBtn').click(function () {
    var formElement = document.getElementById('team_member_add_form'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form
    if ($(formElement).valid()) { // Check if the form is valid

        $.ajax({
            type: "POST",
            url: teamMemberUrl,
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
                    $('#memberModal input, #memberModal select, #memberModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right',
                        'Team Members',
                        'Team Member Addedd Successfully');
                    $('#memberModal').modal('hide');

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

$('.team_member_edit_button').click(function () {
    var team_member_id = $(this).data('id');
    var team_member_name = $(this).data('member_name');
    var edit_team_id = $(this).data('member_city');
    var edit_status = $(this).data('member_status');

    $('#edit_member_id').val(team_member_id);
    $('#edit_team_member_name').val(team_member_name);
    $('#edit_team_id').val(edit_team_id).trigger('change');
    $('#edit_status').val(edit_status).trigger('change');

    $("#editMemberModal").modal('show');
});


$("#team_member_edit_form").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        team_member_name: "required",
        team_id: "required",
        status: "required",
    },
    messages: {
        team_member_name: "Please enter member name",
        team_id: "Please Select team",
        status: "Please Select staus",
    }
});

$('#teamMemberEditBtn').click(function () {
    var formElement = document.getElementById('team_member_edit_form'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form
    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#team_member_edit_form').attr('action');
        var method = $('#team_member_edit_form').attr('method');
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
                    $('#memberModal input, #memberModal select, #memberModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right',
                        'Team Members',
                        'Team Member Addedd Successfully');
                    $('#memberModal').modal('hide');

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
