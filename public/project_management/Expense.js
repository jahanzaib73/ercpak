var tableExpense = $('#expenseTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: expenseUrl,
        data: {
            project_id: project_id
        }
    },
    columns: [{
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        orderable: false,
        searchable: false
    },
    {
        data: 'date',
        name: 'date',
    },
    {
        data: 'task',
        name: 'task',
    },
    {
        data: 'description',
        name: 'description',
    },
    {
        data: 'bill_number',
        name: 'bill_number',
    },
    {
        data: 'amount',
        name: 'amount',
    },
    {
        data: 'vendor',
        name: 'vendor',
    },
    {
        data: 'status',
        name: 'status',
    },
    {
        data: 'action',
        name: 'action',
    }
    ]
});

$("#addExpenseForm").validate({
    errorPlacement: function (error, element) {
        if (element.is('select')) {
            error.insertAfter(element); // Place error message below select
        } else {
            error.insertAfter(element); // Default placement for other fields
        }
    },
    rules: {
        date: "required",
        bill_number: "required",
        vendor_id: "required",
        task_id: "required",
        amount: "required",
        payment_status: "required",
    }
});

$('#addExpenseBtn').click(function () {
    var formElement = document.getElementById('addExpenseForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#addExpenseForm').attr('action');
        var method = $('#addExpenseForm').attr('method');
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

                    $('#expenseModal input, #expenseModal select, #expenseModal textarea')
                        .val('');

                    $.Notification.autoHideNotify('success', 'top right', 'Expense',
                        'Expense Addedd Successfully');
                    $('#expenseModal').modal('hide');
                    tableExpense.draw()

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



$('body').on('click', '.expenseEdit', function (e) {
    var expense_id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: expenseById,
        data: {
            expense_id: expense_id
        },
        success: function (response) {
            if (response.status) {
                var expense = response.data
                console.log(expense);
                $('#expenseId').val(expense.id)
                $('#date_edit').val(expense.date)
                $('#bill_number_edit').val(expense.bill_number)
                $('#vendor_id_edit').val(expense.vendor_id).trigger('change');
                $('#task_id_edit').val(expense.task_id).trigger('change');
                $('#amount_edit').val(expense.amount)
                $('#payment_status_edit').val(expense.pyment_status).trigger('change');
                $('#description_edit').val(expense.description)
                $('#description_arabic_edit').val(expense.description_arabic)
                $("#expenseEditModal").modal('show');
            }
        }
    });
});



$("#editExpenseForm").validate({
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

$('#editExpenseBtn').click(function () {
    var formElement = document.getElementById('editExpenseForm'); // Get the form element
    var formData = new FormData(formElement); // Create FormData from the form

    if ($(formElement).valid()) { // Check if the form is valid
        var url = $('#editExpenseForm').attr('action');
        var method = $('#editExpenseForm').attr('method');
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

                    $.Notification.autoHideNotify('success', 'top right', 'Expense',
                        'Expense Updated Successfully');
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
