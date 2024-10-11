@extends('layouts.app')
@section('leave-active-class', 'active')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <style>
        /* Custom styles to make the calendar full-width */
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        #calendar {
            width: 100%;
            height: 100%;
        }

        .day-text-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }


        .day-text {
            text-align: center;
            font-size: 20px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mb-2 mt-2">
            <div class="col-md-6">
                <h1>Attendance</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="javascript:void(0)" class="btn btn-primary"
                    onclick="document.getElementById('attendanceForm').submit()">Mark Attendance</a> |
                <button class="btn save-btn" data-toggle="modal" data-target="#applyLeaveModal">
                    Apply Leave
                </button>
            </div>
            <form id="attendanceForm" action="{{ route('employee.managemant.store.attandance') }}" method="POST"
                style="display: none">
                @csrf
                <!-- Add your form fields here -->
            </form>

        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="calendar">Select Date:</label>
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    @include('admin.employee_management._modals._apply_leave')
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize the FullCalendar
            $('#calendar').fullCalendar({
                selectable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                dayRender: function(date, cell) {
                    renderDayText(date, cell);
                }
            });
        });

        function renderDayText(date, cell) {
            var attendances = @json($attendances);
            attendances.forEach(function(currentData) {
                {{--  console.log(currentData.date_time, currentData.attandance_status);  --}}

                var currentDateInfo = currentData.date_time;
                var dateAndTimeArray = currentDateInfo.split(" ");
                const specificDate = new Date(dateAndTimeArray[0]);
                const currentDate = new Date(date);

                // Format dates in "Asia/Karachi" time zone
                const specificDateString = specificDate.toLocaleDateString('en-US', {
                    timeZone: 'Asia/Karachi',
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });

                const currentDateString = currentDate.toLocaleDateString('en-US', {
                    timeZone: 'Asia/Karachi',
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });

                if (specificDateString === currentDateString) {
                    if (currentData.attandance_status == 0) {
                        const text = "Absent"; // Set the text content dynamically
                        const dayTextContainer = document.createElement("div");
                        dayTextContainer.className = "day-text-container";

                        const dayText = document.createElement("div");
                        dayText.className = "day-text badge badge-danger";
                        dayText.textContent = text;

                        dayTextContainer.appendChild(dayText);
                        cell.append(dayTextContainer);
                    } else if (currentData.attandance_status == 1) {
                        console.log('present');

                        const text = convertToAMPMFormat(dateAndTimeArray[1]); // Set the text content dynamically
                        const dayTextContainer = document.createElement("div");
                        dayTextContainer.className = "day-text-container";

                        const dayText = document.createElement("div");
                        dayText.className = "day-text badge badge-danger";
                        dayText.textContent = text;

                        dayTextContainer.appendChild(dayText);
                        cell.append(dayTextContainer);
                    } else if (currentData.attandance_status == 2) {
                        const text = "Leave"; // Set the text content dynamically
                        const dayTextContainer = document.createElement("div");
                        dayTextContainer.className = "day-text-container";

                        const dayText = document.createElement("div");
                        dayText.className = "day-text badge badge-info";
                        dayText.textContent = text;

                        dayTextContainer.appendChild(dayText);
                        cell.append(dayTextContainer);
                    }

                }
            });


        }

        function convertToAMPMFormat(time24) {
            const [hours, minutes] = time24.split(':');
            let ampm = 'AM';
            let formattedHours = parseInt(hours, 10);

            if (formattedHours >= 12) {
                ampm = 'PM';
                if (formattedHours > 12) {
                    formattedHours -= 12;
                }
            }

            return `${formattedHours}:${minutes} ${ampm}`;
        }

        $("#applyLeaveForm").validate({
            errorPlacement: function(error, element) {
                if (element.is('select')) {
                    error.insertAfter(element); // Place error message below select
                } else {
                    error.insertAfter(element); // Default placement for other fields
                }
            },
            rules: {
                start_date: {
                    required: true,
                    date: true
                },
                end_date: {
                    required: true,
                    date: true,
                    greaterThanOrEqualTo: "#start_date" // Custom rule for after_or_equal:start_date
                },
                reason: {
                    required: true
                }
            },
            messages: {
                start_date: {
                    required: 'Please enter a valid start date.',
                    date: 'Please enter a valid date.'
                },
                end_date: {
                    required: 'Please enter a valid end date.',
                    date: 'Please enter a valid date.',
                    greaterThanOrEqualTo: 'End date must be equal to or after the start date.'
                },
                reason: {
                    required: 'Please enter a reason for leave.'
                }
            },
        });

        $.validator.addMethod("greaterThanOrEqualTo", function(value, element, param) {
            return this.optional(element) || new Date(value) >= new Date($(param).val());
        }, "End date must be equal to or after the start date.");

        $('#applyLeaveBtn').click(function() {
            var formElement = document.getElementById('applyLeaveForm'); // Get the form element
            var formData = new FormData(formElement); // Create FormData from the form

            if ($(formElement).valid()) { // Check if the form is valid
                var url = $('#applyLeaveForm').attr('action');
                var method = $('#applyLeaveForm').attr('method');
                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status) {

                            // Clear input values
                            $('#taskAdd input, #taskAdd select, #taskAdd textarea')
                                .val('');

                            $.Notification.autoHideNotify('success', 'top right', 'Leave',
                                'Leave Applied Successfully');
                            $('#taskAdd').modal('hide');

                            setTimeout(() => {
                                window.location.reload();
                            }, 500);

                        } else {
                            $.Notification.autoHideNotify('error', 'top right', 'Task',
                                response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $.Notification.autoHideNotify('error', 'top right', 'Task',
                            'Something went wrong');
                    }
                });

            }
        });
    </script>
@endsection
