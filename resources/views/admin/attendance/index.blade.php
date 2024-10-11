@extends('layouts.app')
@section('tutorial-active-class', 'active')
@section('content')


    <title>Employee Attendance System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <div class="container">
        <h1>Employee Attendance System</h1>
        
        <form method="post" action="record_attendance.php">
            <label for="employee">Select Employee:</label>
            <select class="form-control" name="employee" id="employee">
                <!-- Retrieve and populate employee names from the database here -->
                <option value="1">John Doe</option>
                <option value="2">Jane Smith</option>
                <!-- Add more options for other employees -->
            </select><br>
            
            <label for="time_in">Time In:</label>
            <input type="time" class="form-control" name="time_in" required><br>
            
            <label for="time_out">Time Out:</label>
            <input type="time" class="form-control" name="time_out" required><br>
            
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
        
        <h2>Monthly Attendance Records</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Employee Designation</th>
                    <th>Employee Department</th>
                    <th>Month</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve and display monthly attendance records from the database here
                // Loop through the records and populate the table rows
                ?>
            </tbody>
        </table>
    </div>
    @endsection

    @section('script')
   
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
@endsection
   
