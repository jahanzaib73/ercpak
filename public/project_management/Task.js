var table = $('#tasKListTbl').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: projectTaskUrl,
        data: function (data) {
            data.project_id = ($('#projectId').text())
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
        data: 'task_name',
        name: 'task_name',
    },
    {
        data: 'project',
        name: 'project',
    },
    {
        data: 'budget',
        name: 'budget',
    },
    {
        data: 'task_date',
        name: 'task_date',
    },
    {
        data: 'startDate',
        name: 'startDate',
    },
    {
        data: 'complatedDate',
        name: 'complatedDate',
    },
    {
        data: 'status',
        name: 'status',
    },
    {
        data: 'doneBy',
        name: 'doneBy',
    },
    {
        data: 'action',
        name: 'action',
    }
    ]
});

$('body').on('click', '.projectStart', function (e) {
    e.preventDefault();
    $('#task_number_id').text($(this).data('id'));
    $('#task_name_id').text($(this).data('name'));
    $('#ProjectTaskId').val($(this).data('id'))
    $('#projectStart').modal('show');
});

$('body').on('click', '.projectCompleted', function (e) {
    e.preventDefault();
    $('#task_number_completed_id').text($(this).data('id'));
    $('#task_name_completed_id').text($(this).data('name'));
    $('#ProjectTaskIdCompleted').val($(this).data('id'))
    $('#projectCompleted').modal('show');
});

$('body').on('click', '.taskPercentage', function (e) {
    e.preventDefault();
    $('#ProjectTaskIdPerecntage').val($(this).data('id'));
    $('#task_percentage').val($(this).data('percentage'));
    console.log($(this).data('percentage'));
    $('#taskPercentage').modal('show');
});

$("#taskPercentageForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        ProjectTaskIdPerecntage: "required",
    }
});

$('#taskPercentageBtn').click(function () {
    var formElement = document.getElementById('taskPercentageForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#taskPercentageForm').attr('action');
        var method = $('#taskPercentageForm').attr('method');
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
                    $('#taskAdd input, #taskAdd select, #taskAdd textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Task',
                        'Task Addedd Successfully');
                    $('#taskAdd').modal('hide');

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





$("#addMemberForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        task_name: "required",
        task_type_id: "required",
        location_id: "required",
        task_date: "required",
        currency_id: "required",
        'member_id[]': "required",
        amount: "required",
    }
});

$('#addMemberBtn').click(function () {
    var formElement = document.getElementById('addMemberForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#addMemberForm').attr('action');
        var method = $('#addMemberForm').attr('method');
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
                    $('#taskAdd input, #taskAdd select, #taskAdd textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Task',
                        'Task Addedd Successfully');
                    $('#taskAdd').modal('hide');

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


$('body').on('click', '.editTask', function (e) {
    var taskId = $(this).data('id');
    $.ajax({
        type: "GET",
        url: taskById,
        data: {
            taskId: taskId
        },
        success: function (response) {
            if (response.status) {
                var task = response.data
                var memberIds = response.memberIds
                console.log(task, memberIds);
                $('#taskIdEdit').val(task.id)
                $('#task_name_edit').val(task.task_name)
                $('#task_type_id_edit').val(task.task_type_id).trigger('change')
                $('#location_id_edit').val(task.location_id).trigger('change');
                $('#member_id_edit').val(memberIds).trigger('change');
                $('#task_date_edit').val(task.task_date)
                $('#amountEdit').val(task.amount)
                $('#currency_id_edit').val(task.currency_id).trigger('change');
                $('#task_description_edit').val(task.task_description)
                $('#task_description_arabic_edit').val(task.task_description_arabic)
                $("#taskEdit").modal('show');
            }
        }
    });
});



$("#taskEditForm").validate({
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
    }
});

$('#taskEditButton').click(function () {
    var formElement = document.getElementById('taskEditForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#taskEditForm').attr('action');
        var method = $('#taskEditForm').attr('method');
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
