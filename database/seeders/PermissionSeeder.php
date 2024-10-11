<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['module_name' => 'Document Control', 'name' => 'All Document', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control', 'name' => 'Add Document', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control', 'name' => 'View Document', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control', 'name' => 'Edit Document', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control', 'name' => 'Delete Document', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control', 'name' => 'Mark Close Document', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Document Control Attachment', 'name' => 'All Document Control Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control Attachment', 'name' => 'Add Document Control Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control Attachment', 'name' => 'Edit Document Control Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Control Attachment', 'name' => 'Delete Document Control Attachment', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Document Type', 'name' => 'All Document Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Type', 'name' => 'Add Document Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Type', 'name' => 'Edit Document Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Document Type', 'name' => 'Delete Document Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Government', 'name' => 'All Government', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Government', 'name' => 'Add Government', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Government', 'name' => 'Edit Government', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Government', 'name' => 'Delete Government', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Department', 'name' => 'All Department', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Department', 'name' => 'Add Department', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Department', 'name' => 'Edit Department', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Department', 'name' => 'Delete Department', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Complaint Type', 'name' => 'All Complaint Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint Type', 'name' => 'Add Complaint Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint Type', 'name' => 'Edit Complaint Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint Type', 'name' => 'Delete Complaint Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Complaint', 'name' => 'All Complaint', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint', 'name' => 'Add Complaint', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint', 'name' => 'View Complaint', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint', 'name' => 'Edit Complaint', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint', 'name' => 'Delete Complaint', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint', 'name' => 'Mark Complete Complaint', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Complaint Attachment', 'name' => 'All Complaint Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint Attachment', 'name' => 'Add Complaint Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint Attachment', 'name' => 'Edit Complaint Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Complaint Attachment', 'name' => 'Delete Complaint Attachment', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Flight Type', 'name' => 'All Flight Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight Type', 'name' => 'Add Flight Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight Type', 'name' => 'Edit Flight Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight Type', 'name' => 'Delete Flight Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Aircraft Type', 'name' => 'All Aircraft Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Aircraft Type', 'name' => 'Add Aircraft Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Aircraft Type', 'name' => 'Edit Aircraft Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Aircraft Type', 'name' => 'Delete Aircraft Type', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'All Flight and Cargo', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'Add Flight and Cargo', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'View Flight and Cargo', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'Edit Flight and Cargo', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'Delete Flight and Cargo', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'Mark Close Flight and Cargo', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'Mark Canclled Flight and Cargo', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'View By Flight', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'View By Sea', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Flight and Cargo', 'name' => 'View By Road', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'All Protocol and Liaison', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'Add Protocol and Liaison', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'View Protocol and Liaison', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'Edit Protocol and Liaison', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'Delete Protocol and Liaison', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'View By Official', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'View By Notable', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'View By Company', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'View By Project', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison', 'name' => 'View By Property', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Teams', 'name' => 'All Teams', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Teams', 'name' => 'Add Teams', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Teams', 'name' => 'Edit Teams', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Teams', 'name' => 'Delete Teams', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Protocol and Liaison Contact', 'name' => 'All Protocol and Liaison Contact', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison Contact', 'name' => 'Add Protocol and Liaison Contact', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison Contact', 'name' => 'Edit Protocol and Liaison Contact', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison Contact', 'name' => 'Delete Protocol and Liaison Contact', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Protocol and Liaison Attachment', 'name' => 'All Protocol and Liaison Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison Attachment', 'name' => 'Add Protocol and Liaison Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison Attachment', 'name' => 'Edit Protocol and Liaison Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Protocol and Liaison Attachment', 'name' => 'Delete Protocol and Liaison Attachment', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Meeting', 'name' => 'All Meeting', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Meeting', 'name' => 'Add Meeting', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Meeting', 'name' => 'View Meeting', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Meeting', 'name' => 'Edit Meeting', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Meeting', 'name' => 'Delete Meeting', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Meeting', 'name' => 'Meeting Clander View', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Meeting Remainder', 'name' => 'All Meeting Remainder', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Meeting Remainder', 'name' => 'Add Meeting Remainder', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Meeting Remainder', 'name' => 'Delete Meeting Remainder', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Remainder Type', 'name' => 'All Remainder Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder Type', 'name' => 'Add Remainder Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder Type', 'name' => 'Edit Remainder Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder Type', 'name' => 'Delete Remainder Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Issuing Authority', 'name' => 'All Issuing Authority', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Issuing Authority', 'name' => 'Add Issuing Authority', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Issuing Authority', 'name' => 'Edit Issuing Authority', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Issuing Authority', 'name' => 'Delete Issuing Authority', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Remainder', 'name' => 'All Remainder', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder', 'name' => 'Add Remainder', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder', 'name' => 'View Remainder', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder', 'name' => 'Edit Remainder', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder', 'name' => 'Delete Remainder', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Remainder', 'name' => 'Mark as Complete Remainder', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Country', 'name' => 'All Country', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Country', 'name' => 'Add Country', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Country', 'name' => 'Edit Country', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Country', 'name' => 'Delete Country', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Province', 'name' => 'All Province', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Province', 'name' => 'Add Province', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Province', 'name' => 'Edit Province', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Province', 'name' => 'Delete Province', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'City', 'name' => 'All City', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'City', 'name' => 'Add City', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'City', 'name' => 'Edit City', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'City', 'name' => 'Delete City', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Location', 'name' => 'All Location', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Location', 'name' => 'Add Location', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Location', 'name' => 'Edit Location', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Location', 'name' => 'Delete Location', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Designation', 'name' => 'All Designation', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Designation', 'name' => 'Add Designation', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Designation', 'name' => 'Edit Designation', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Designation', 'name' => 'Delete Designation', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'User Management', 'name' => 'All User Management', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'User Management', 'name' => 'Add User Management', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'User Management', 'name' => 'View User Management', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'User Management', 'name' => 'Edit User Management', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'User Management', 'name' => 'Delete User Management', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'User Management', 'name' => 'Assign Permission', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'User Management', 'name' => 'Change User Status', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Guest and Visitors', 'name' => 'View By Guest', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest and Visitors', 'name' => 'View By Visitors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest and Visitors', 'name' => 'All Guest and Visitors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest and Visitors', 'name' => 'Add Guest and Visitors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest and Visitors', 'name' => 'View Guest and Visitors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest and Visitors', 'name' => 'Edit Guest and Visitors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest and Visitors', 'name' => 'Delete Guest and Visitors', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Purpose of Visit', 'name' => 'All Purpose of Visit', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purpose of Visit', 'name' => 'Add Purpose of Visit', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purpose of Visit', 'name' => 'Edit Purpose of Visit', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purpose of Visit', 'name' => 'Delete Purpose of Visit', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Guest & Visitor Attachment', 'name' => 'All Guest & Visitor Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest & Visitor Attachment', 'name' => 'Add Guest & Visitor Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest & Visitor Attachment', 'name' => 'View Guest & Visitor Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest & Visitor Attachment', 'name' => 'Edit Guest & Visitor Attachment', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Guest & Visitor Attachment', 'name' => 'Delete Guest & Visitor Attachment', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Task Category', 'name' => 'All Task Category', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Category', 'name' => 'Add Task Category', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Category', 'name' => 'Edit Task Category', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Category', 'name' => 'Delete Task Category', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Tasks', 'name' => 'Approve Task', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Tasks', 'name' => 'Cancel Task', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Tasks', 'name' => 'Add Task List', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Tasks', 'name' => 'All Tasks', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Tasks', 'name' => 'Add Tasks', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Tasks', 'name' => 'View Tasks', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Tasks', 'name' => 'Edit Tasks', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Tasks', 'name' => 'Delete Tasks', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Task Lists', 'name' => 'All Task Lists', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Lists', 'name' => 'Add Task Lists', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Lists', 'name' => 'View Task Lists', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Lists', 'name' => 'Edit Task Lists', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Lists', 'name' => 'Delete Task Lists', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Courier', 'name' => 'All Courier', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Courier', 'name' => 'Add Courier', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Courier', 'name' => 'View Courier', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Courier', 'name' => 'Edit Courier', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Courier', 'name' => 'Delete Courier', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Courier', 'name' => 'Received Item', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Vehicle Make', 'name' => 'All Vehicle Make', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Make', 'name' => 'Add Vehicle Make', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Make', 'name' => 'Edit Vehicle Make', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Make', 'name' => 'Delete Vehicle Make', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Vehicle Model', 'name' => 'All Vehicle Model', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Model', 'name' => 'Add Vehicle Model', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Model', 'name' => 'Edit Vehicle Model', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Model', 'name' => 'Delete Vehicle Model', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Vehicle Type', 'name' => 'All Vehicle Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Type', 'name' => 'Add Vehicle Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Type', 'name' => 'Edit Vehicle Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicle Type', 'name' => 'Delete Vehicle Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Fuel Type', 'name' => 'All Fuel Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuel Type', 'name' => 'Add Fuel Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuel Type', 'name' => 'Edit Fuel Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuel Type', 'name' => 'Delete Fuel Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Vehicles', 'name' => 'All Vehicles', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicles', 'name' => 'Add Vehicles', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicles', 'name' => 'Edit Vehicles', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicles', 'name' => 'Delete Vehicles', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vehicles', 'name' => 'Upload File Vehicles', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Trips', 'name' => 'All Trips', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'Add Trips', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'View Trips', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'Close Trips', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'Edit Trips', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'Cancel Trips', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'Delete Trips', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'Generate Trip Report', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Trips', 'name' => 'View Report Attachment', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Fuels', 'name' => 'All Fuels Slip', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuels', 'name' => 'Add Fuels Slip', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuels', 'name' => 'View Fuels Slip', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuels', 'name' => 'Edit Fuel Slip', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuels', 'name' => 'Delete Fuel Slip', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuels', 'name' => 'Print Fuel Slip', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Fuels', 'name' => 'View Fuel Attachment', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Inspection Check List', 'name' => 'All Inspection Check List', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inspection Check List', 'name' => 'Add Inspection Check List', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inspection Check List', 'name' => 'Edit Inspection Check List', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inspection Check List', 'name' => 'Delete Inspection Check List', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Vendors', 'name' => 'All Vendors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vendors', 'name' => 'Add Vendors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vendors', 'name' => 'Edit Vendors', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Vendors', 'name' => 'Delete Vendors', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Task Workorders', 'name' => 'All Task Workorders', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Workorders', 'name' => 'Add Task Workorders', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Workorders', 'name' => 'Edit Task Workorders', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task Workorders', 'name' => 'Delete Task Workorders', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Inspection', 'name' => 'All Inspection', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inspection', 'name' => 'Add Inspection', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inspection', 'name' => 'Show Inspection', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inspection', 'name' => 'Approve Inspection', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Work Orders', 'name' => 'All Work Orders', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Work Orders', 'name' => 'View Work Orders', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Work Orders', 'name' => 'Edit Work Orders', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Work Orders', 'name' => 'Close Work Orders', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Item Type', 'name' => 'All Item Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Type', 'name' => 'Add Item Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Type', 'name' => 'Edit Item Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Type', 'name' => 'Delete Item Type', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Item Make', 'name' => 'All Item Make', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Make', 'name' => 'Add Item Make', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Make', 'name' => 'Edit Item Make', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Make', 'name' => 'Delete Item Make', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Item Category', 'name' => 'All Item Category', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Category', 'name' => 'Add Item Category', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Category', 'name' => 'Edit Item Category', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Item Category', 'name' => 'Delete Item Category', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Unit Type', 'name' => 'All Unit Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Unit Type', 'name' => 'Add Unit Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Unit Type', 'name' => 'Edit Unit Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Unit Type', 'name' => 'Delete Unit Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Warehouses', 'name' => 'All Warehouses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Warehouses', 'name' => 'Add Warehouses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Warehouses', 'name' => 'Edit Warehouses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Warehouses', 'name' => 'Delete Warehouses', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Inventories', 'name' => 'All Inventories', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inventories', 'name' => 'Add Inventories', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inventories', 'name' => 'View Inventories', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inventories', 'name' => 'Edit Inventories', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inventories', 'name' => 'Delete Inventories', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Inventories', 'name' => 'Upload Attachment Inventories', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'All Purchase Orders', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Add Requisition', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Invoices List', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Upload Attachment Purchase Order', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Print Requisition', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Comparative Approved', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Purchase Order Print', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Purchase Order Close PO', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Purchase Order Delivery Note', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Shift Warehouses', 'name' => 'All Shift Warehouses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Shift Warehouses', 'name' => 'Add Shift Warehouses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Shift Warehouses', 'name' => 'Edit Shift Warehouses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Shift Warehouses', 'name' => 'Delete Shift Warehouses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Shift Warehouses', 'name' => 'View Shift Warehouses', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'View Purchase Order', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Purchase Orders', 'name' => 'Delete Purchase Order', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Report', 'name' => 'Fuel Summary Report', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Report', 'name' => 'Vehicle Movement', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Report', 'name' => 'Guest and Customer Report', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Report', 'name' => 'Guest and Customer Monthly Report', 'guard_name' => 'web']);

        //new permission
        Permission::create(['module_name' => 'Area Management', 'name' => 'All Area', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Area Management', 'name' => 'Create Area', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Area Management', 'name' => 'Assign Area', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Area Management', 'name' => 'View Area', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Area Management', 'name' => 'Edit Area', 'guard_name' => 'web']);


        Permission::create(['module_name' => 'Team', 'name' => 'Add Team', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Team', 'name' => 'View Team', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Team', 'name' => 'Edit Team', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Member', 'name' => 'Add Member', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Member', 'name' => 'View Member', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Member', 'name' => 'Edit Member', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Project Management', 'name' => 'All Project', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Project Management', 'name' => 'Add Project', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Project Management', 'name' => 'View Project', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Project Management', 'name' => 'Edit Project', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Project Management', 'name' => 'Delete Project', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Task', 'name' => 'Add Task', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task', 'name' => 'View Task', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task', 'name' => 'Edit Task', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task', 'name' => 'Delete Task', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task', 'name' => 'Start Task', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Task', 'name' => 'Task Percentage', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Expenses', 'name' => 'Add Expenses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Expenses', 'name' => 'Edit Expenses', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Expenses', 'name' => 'Delete Expenses', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Request Management', 'name' => 'All Request', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Request Management', 'name' => 'New Request', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Request Management', 'name' => 'View Request', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Request Management', 'name' => 'Edit Request', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Request Management', 'name' => 'Upload Attechment', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Request Type', 'name' => 'All Request Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Request Type', 'name' => 'Add Request Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Request Type', 'name' => 'Edit Request Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Request Type', 'name' => 'Delete Request Type', 'guard_name' => 'web']);

        Permission::create(['module_name' => 'Project Task Type', 'name' => 'All Project Task Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Project Task Type', 'name' => 'Add Project Task Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Project Task Type', 'name' => 'Edit Project Task Type', 'guard_name' => 'web']);
        Permission::create(['module_name' => 'Project Task Type', 'name' => 'Delete Project Task Type', 'guard_name' => 'web']);

        $superAdmin = User::where('role_id', 1)->first();

        $superAdmin->syncPermissions(Permission::all());
    }
}
