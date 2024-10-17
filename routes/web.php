<?php

use App\Events\CarMoved;
use App\Http\Controllers\Admin\AirCraftTypeController;
use App\Http\Controllers\Admin\AuthorizationController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ComplaintAttachmentController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\ComplaintTypeController;
use App\Http\Controllers\Admin\ContactNumberProtocolLiaisonController;
use App\Http\Controllers\Admin\CostCenterController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CourierAttachmentController;
use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\DeliveryNoteController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesiginationController;
use App\Http\Controllers\Admin\DocumentAttachmentController;
use App\Http\Controllers\Admin\FlightCargoTypeController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\DocumentControlController;
use App\Http\Controllers\Admin\EmployeManagement\AttandanceController;
use App\Http\Controllers\Admin\EmployeManagement\LeaveController;
use App\Http\Controllers\Admin\ERC\AreaController;
use App\Http\Controllers\Admin\ERC\TeamController;
use App\Http\Controllers\Admin\ERC\TeamManagementController;
use App\Http\Controllers\Admin\ERC\TeamMemberController;
use App\Http\Controllers\Admin\FlightCargoController;
use App\Http\Controllers\Admin\FlightTypeController;
use App\Http\Controllers\Admin\FuelController;
use App\Http\Controllers\Admin\FuelTypeController;
use App\Http\Controllers\Admin\GovernmentController;
use App\Http\Controllers\Admin\GuestVisitController;
use App\Http\Controllers\Admin\GuestVisitorAttachmentController;
use App\Http\Controllers\Admin\InspectionChecklistController;
use App\Http\Controllers\Admin\InspectionController;
use App\Http\Controllers\Admin\InventroyController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\IssueOrderController;
use App\Http\Controllers\Admin\IssuingAuthorityController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\ItemMakeController;
use App\Http\Controllers\Admin\ItemTypeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\MeetingRemainderController;
use App\Http\Controllers\Admin\ProjectAttachmentController;
use App\Http\Controllers\Admin\ProjectManagement\ActivityController;
use App\Http\Controllers\Admin\ProjectManagement\ExpenseController;
use App\Http\Controllers\Admin\ProjectManagement\ProjectController;
use App\Http\Controllers\Admin\ProjectManagement\ProjectManagementController;
use App\Http\Controllers\Admin\ProjectManagement\TaskController as ProjectManagementTaskController;
use App\Http\Controllers\Admin\ProjectTaskTypeController;
use App\Http\Controllers\Admin\ProtocolLiaisonController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\PurposeOfVisitController;
use App\Http\Controllers\Admin\RemainderController;
use App\Http\Controllers\Admin\RemainderTypeController;
use App\Http\Controllers\Admin\Reports\ReportController;
use App\Http\Controllers\Admin\RequestManagement\RequestManagementController;
use App\Http\Controllers\Admin\RequestTypeController;
use App\Http\Controllers\Admin\ShiftWarehouseController;
use App\Http\Controllers\Admin\SubDepartmentController;
use App\Http\Controllers\Admin\TaskCategoryController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TaskListController;
use App\Http\Controllers\Admin\TaskWorkOrderController;
use App\Http\Controllers\Admin\TeamProtocolLiaisonController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\UnitTypeController;
use App\Http\Controllers\Admin\UserAllowanceController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleMakeController;
use App\Http\Controllers\Admin\VehicleModelController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VisaController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\WorkOrderController;
use App\Http\Controllers\Api\TripPositionApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Payments\AlfaController;
use App\Http\Controllers\Payments\EasypaisaController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/get-layout-settings/{user}', [App\Http\Controllers\HomeController::class, 'getLayoutSettings'])->name('layout.settings');
Route::get('/store-layout-settings/{user}/{settings}', [App\Http\Controllers\HomeController::class, 'storeLayoutSettings'])->name('layout.settings.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('complaint-types/{id?}', [ComplaintTypeController::class, 'index'])->name('complaint-types.index');
    Route::get('complaint-types/delete/{id}', [ComplaintTypeController::class, 'destroy'])->name('complaint-types.delete');
    Route::post('complaint-types/store', [ComplaintTypeController::class, 'store'])->name('complaint-types.store');
    Route::post('complaint-types/update/{id}', [ComplaintTypeController::class, 'update'])->name('complaint-types.update');

    Route::get('document-types/{id?}', [DocumentCategoryController::class, 'index'])->name('document-types.index');
    Route::get('document-types/delete/{id}', [DocumentCategoryController::class, 'destroy'])->name('document-types.delete');
    Route::post('document-types/store', [DocumentCategoryController::class, 'store'])->name('document-types.store');
    Route::post('document-types/update/{id}', [DocumentCategoryController::class, 'update'])->name('document-types.update');

    Route::resource('complaints', ComplaintController::class)->except('destroy');
    Route::get('complaint/delete/{id}', [ComplaintController::class, 'destroy'])->name('complaint.delete');
    Route::get('complaint/mark/completed/{id}', [ComplaintController::class, 'markCompletd'])->name('complaint.mark.completed');

    Route::get('complaint-attachments/{id}', [ComplaintAttachmentController::class, 'index'])->name('complaint-attachments.index');
    Route::get('complaint-attachments/create/{id}', [ComplaintAttachmentController::class, 'create'])->name('complaint-attachments.create');
    Route::post('complaint-attachments/store', [ComplaintAttachmentController::class, 'store'])->name('complaint-attachments.store');
    Route::get('complaint-attachments/edit/{id}/{complaint_id}', [ComplaintAttachmentController::class, 'edit'])->name('complaint-attachments.edit');
    Route::post('complaint-attachments/update/{id}', [ComplaintAttachmentController::class, 'update'])->name('complaint-attachments.update');
    Route::get('complaint-attachments/delete/{id}/{complaint_id}', [ComplaintAttachmentController::class, 'destroy'])->name('complaint-attachments.delete');


    Route::get('departments/{id?}', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('departments/delete/{id}', [DepartmentController::class, 'destroy'])->name('departments.delete');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::post('departments/update/{id}', [DepartmentController::class, 'update'])->name('departments.update');

    Route::get('sub-departments/{id?}', [SubDepartmentController::class, 'index'])->name('subdepartments.index');
    Route::get('sub-departments/delete/{id}', [SubDepartmentController::class, 'destroy'])->name('subdepartments.delete');
    Route::post('sub-departments/store', [SubDepartmentController::class, 'store'])->name('subdepartments.store');
    Route::post('sub-departments/update/{id}', [SubDepartmentController::class, 'update'])->name('subdepartments.update');

    Route::get('government/{id?}', [GovernmentController::class, 'index'])->name('government.index');
    Route::get('government/delete/{id}', [GovernmentController::class, 'destroy'])->name('government.delete');
    Route::post('government/store', [GovernmentController::class, 'store'])->name('government.store');
    Route::post('government/update/{id}', [GovernmentController::class, 'update'])->name('government.update');



    Route::resource('documents-control', DocumentControlController::class)->except('destroy');
    Route::get('documents-control/create/{taskId?}', [DocumentControlController::class, 'create'])->name('documents-control.create');
    Route::get('document-controle/delete/{id}', [DocumentControlController::class, 'destroy'])->name('document-control.delete');
    Route::get('complaint/mark/closed/{id}', [DocumentControlController::class, 'markClosed'])->name('complaint.mark.closed');

    Route::get('document-control-attachments/{id}', [DocumentAttachmentController::class, 'index'])->name('document-control-attachments.index');
    Route::get('document-control-attachments/create/{id}', [DocumentAttachmentController::class, 'create'])->name('document-control-attachments.create');
    Route::post('document-control-attachments/store', [DocumentAttachmentController::class, 'store'])->name('document-control-attachments.store');
    Route::get('document-control-attachments/edit/{id}/{document_id}', [DocumentAttachmentController::class, 'edit'])->name('document-control-attachments.edit');
    Route::post('document-control-attachments/update/{id}', [DocumentAttachmentController::class, 'update'])->name('document-control-attachments.update');
    Route::get('document-control-attachments/delete/{id}/{document_id}', [DocumentAttachmentController::class, 'destroy'])->name('document-control-attachments.delete');



    Route::get('flight-cargo-type/{id?}', [FlightCargoTypeController::class, 'index'])->name('flight-cargo-type.index');
    Route::get('flight-cargo-type/delete/{id}', [FlightCargoTypeController::class, 'destroy'])->name('flight-cargo-type.delete');
    Route::post('flight-cargo-type/store', [FlightCargoTypeController::class, 'store'])->name('flight-cargo-type.store');
    Route::post('flight-cargo-type/update/{id}', [FlightCargoTypeController::class, 'update'])->name('flight-cargo-type.update');

    Route::get('flight-type/{id?}', [FlightTypeController::class, 'index'])->name('flight-type.index');
    Route::get('flight-type/delete/{id}', [FlightTypeController::class, 'destroy'])->name('flight-type.delete');
    Route::post('flight-type/store', [FlightTypeController::class, 'store'])->name('flight-type.store');
    Route::post('flight-type/update/{id}', [FlightTypeController::class, 'update'])->name('flight-type.update');



    Route::get('aircraft-type/{id?}', [AirCraftTypeController::class, 'index'])->name('aircraft-type.index');
    Route::get('aircraft-type/delete/{id}', [AirCraftTypeController::class, 'destroy'])->name('aircraft-type.delete');
    Route::post('aircraft-type/store', [AirCraftTypeController::class, 'store'])->name('aircraft-type.store');
    Route::post('aircraft-type/update/{id}', [AirCraftTypeController::class, 'update'])->name('aircraft-type.update');

    Route::resource('flight-and-cargos', FlightCargoController::class)->except('destroy', 'create');
    Route::get('flight-and-cargos/create/{module}', [FlightCargoController::class, 'create'])->name('flight-and-cargos.create');
    Route::get('flight-and-cargos/delete/{id}', [FlightCargoController::class, 'destroy'])->name('flight-and-cargos.delete');
    Route::post('flight-and-cargos/canceled/flight', [FlightCargoController::class, 'flightCanceled'])->name('flight-and-cargos.flightCanceled');
    Route::post('flight-and-cargos/status/complete/flight', [FlightCargoController::class, 'flightComplete'])->name('flight-and-cargos.complete');
    Route::get('flight-and-cargos/closed/{id}/{type}', [FlightCargoController::class, 'flightclosed'])->name('flight-and-cargos.flightclosed');
    Route::post('flight-and-cargos/closed/store', [FlightCargoController::class, 'flightclosedStore'])->name('flight-and-cargos.flightclosed.store');


    Route::resource('protocol-and-liaisons', ProtocolLiaisonController::class)->except('destroy', 'create');
    Route::get('protocol-and-liaisons/create/{module}', [ProtocolLiaisonController::class, 'create'])->name('protocol-and-liaisons.create');
    Route::get('protocol-and-liaisons/delete/{id}', [ProtocolLiaisonController::class, 'destroy'])->name('protocol-and-liaisons.delete');
    Route::post('protocol-and-liaisons/canceled/flight', [ProtocolLiaisonController::class, 'flightCanceled'])->name('protocol-and-liaisons.flightCanceled');
    Route::post('protocol-and-liaisons/status/complete/flight', [ProtocolLiaisonController::class, 'flightComplete'])->name('protocol-and-liaisons.complete');
    Route::get('protocol-and-liaisons/closed/{id}/{type}', [ProtocolLiaisonController::class, 'flightclosed'])->name('protocol-and-liaisons.flightclosed');
    Route::post('protocol-and-liaisons/closed/store', [ProtocolLiaisonController::class, 'flightclosedStore'])->name('protocol-and-liaisons.flightclosed.store');

    Route::get('protocol-liaison-teams/{id}', [TeamProtocolLiaisonController::class, 'index'])->name('protocol-liaison-teams.index');
    Route::get('protocol-liaison-teams/create/{id}', [TeamProtocolLiaisonController::class, 'create'])->name('protocol-liaison-teams.create');
    Route::post('protocol-liaison-teams/store', [TeamProtocolLiaisonController::class, 'store'])->name('protocol-liaison-teams.store');
    Route::get('protocol-liaison-teams/edit/{id}/{protocol_liaison_id}', [TeamProtocolLiaisonController::class, 'edit'])->name('protocol-liaison-teams.edit');
    Route::post('protocol-liaison-teams/update/{id}', [TeamProtocolLiaisonController::class, 'update'])->name('protocol-liaison-teams.update');
    Route::get('protocol-liaison-teams/delete/{id}/{protocol_liaison_id}', [TeamProtocolLiaisonController::class, 'destroy'])->name('protocol-liaison-teams.delete');

    Route::get('protocol-liaison-contact-numbers/{id}', [ContactNumberProtocolLiaisonController::class, 'index'])->name('protocol-liaison-contact-numbers.index');
    Route::get('protocol-liaison-contact-numbers/create/{id}', [ContactNumberProtocolLiaisonController::class, 'create'])->name('protocol-liaison-contact-numbers.create');
    Route::post('protocol-liaison-contact-numbers/store', [ContactNumberProtocolLiaisonController::class, 'store'])->name('protocol-liaison-contact-numbers.store');
    Route::get('protocol-liaison-contact-numbers/edit/{id}/{protocol_liaison_id}', [ContactNumberProtocolLiaisonController::class, 'edit'])->name('protocol-liaison-contact-numbers.edit');
    Route::post('protocol-liaison-contact-numbers/update/{id}', [ContactNumberProtocolLiaisonController::class, 'update'])->name('protocol-liaison-contact-numbers.update');
    Route::get('protocol-liaison-contact-numbers/delete/{id}/{protocol_liaison_id}', [ContactNumberProtocolLiaisonController::class, 'destroy'])->name('protocol-liaison-contact-numbers.delete');
    Route::get('protocol-and-liaisons/main_map/{moduleName}', [ProtocolLiaisonController::class, 'getMainMapCoordinates'])->name('protocol-and-liaisons.main.map');

    Route::get('project-attachments/{id}', [ProjectAttachmentController::class, 'index'])->name('project-attachments.index');
    Route::get('project-attachments/create/{id}', [ProjectAttachmentController::class, 'create'])->name('project-attachments.create');
    Route::post('project-attachments/store', [ProjectAttachmentController::class, 'store'])->name('project-attachments.store');
    Route::get('project-attachments/edit/{id}/{project_id}', [ProjectAttachmentController::class, 'edit'])->name('project-attachments.edit');
    Route::post('project-attachments/update/{id}', [ProjectAttachmentController::class, 'update'])->name('project-attachments.update');
    Route::get('project-attachments/delete/{id}/{project_id}', [ProjectAttachmentController::class, 'destroy'])->name('project-attachments.delete');


    Route::get('meetings', [MeetingController::class, 'index'])->name('meetings.index');
    Route::get('meetings/clander-view', [MeetingController::class, 'clanderView'])->name('meetings.clanderView');
    Route::get('meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
    Route::post('meetings/store', [MeetingController::class, 'store'])->name('meetings.store');
    Route::get('meetings/show/{id}', [MeetingController::class, 'show'])->name('meetings.show');
    Route::get('meetings/edit/{id}', [MeetingController::class, 'edit'])->name('meetings.edit');
    Route::post('meetings/update/{id}', [MeetingController::class, 'update'])->name('meetings.update');
    Route::get('meetings/delete/{id}', [MeetingController::class, 'delete'])->name('meetings.delete');

    Route::get('meetings/remainders/{id}', [MeetingRemainderController::class, 'index'])->name('meetings.remainder.index');
    Route::post('meetings/remainders/store', [MeetingRemainderController::class, 'store'])->name('meetings.remainder.store');
    Route::post('meetings/remainders/update/{id}', [MeetingRemainderController::class, 'update'])->name('meetings.remainder.update');
    Route::get('meetings/remainders/delete/{id}', [MeetingRemainderController::class, 'destroy'])->name('meetings.remainder.delete');

    Route::get('remainders-types/{id?}', [RemainderTypeController::class, 'index'])->name('remainders-types.index');
    Route::get('remainders-types/delete/{id}', [RemainderTypeController::class, 'destroy'])->name('remainders-types.delete');
    Route::post('remainders-types/store', [RemainderTypeController::class, 'store'])->name('remainders-types.store');
    Route::post('remainders-types/update/{id}', [RemainderTypeController::class, 'update'])->name('remainders-types.update');

    Route::get('issuing-authorities/{id?}', [IssuingAuthorityController::class, 'index'])->name('issuing-authorities.index');
    Route::get('issuing-authorities/delete/{id}', [IssuingAuthorityController::class, 'destroy'])->name('issuing-authorities.delete');
    Route::post('issuing-authorities/store', [IssuingAuthorityController::class, 'store'])->name('issuing-authorities.store');
    Route::post('issuing-authorities/update/{id}', [IssuingAuthorityController::class, 'update'])->name('issuing-authorities.update');

    Route::get('remainders', [RemainderController::class, 'index'])->name('remainders.index');
    Route::get('remainders/create', [RemainderController::class, 'create'])->name('remainders.create');
    Route::post('remainders/store', [RemainderController::class, 'store'])->name('remainders.store');
    Route::get('remainders/show/{id}', [RemainderController::class, 'show'])->name('remainders.show');
    Route::get('remainders/edit/{id}', [RemainderController::class, 'edit'])->name('remainders.edit');
    Route::post('remainders/update/{id}', [RemainderController::class, 'update'])->name('remainders.update');
    Route::get('remainders/delete/{id}', [RemainderController::class, 'destroy'])->name('remainders.delete');
    Route::get('remainders/mark-completed/{id}', [RemainderController::class, 'markCompleted'])->name('remainders.mark.completed');


    Route::get('locations/{id?}', [LocationController::class, 'index'])->name('locations.index');
    Route::get('locations/delete/{id}', [LocationController::class, 'destroy'])->name('locations.delete');
    Route::post('locations/store', [LocationController::class, 'store'])->name('locations.store');
    Route::post('locations/update/{id}', [LocationController::class, 'update'])->name('locations.update');

    Route::get('desiginations/{id?}', [DesiginationController::class, 'index'])->name('desiginations.index');
    Route::get('desiginations/delete/{id}', [DesiginationController::class, 'destroy'])->name('desiginations.delete');
    Route::post('desiginations/store', [DesiginationController::class, 'store'])->name('desiginations.store');
    Route::post('desiginations/update/{id}', [DesiginationController::class, 'update'])->name('desiginations.update');


    Route::get('countries/{id?}', [CountryController::class, 'index'])->name('countries.index');
    Route::get('countries/delete/{id}', [CountryController::class, 'destroy'])->name('countries.delete');
    Route::post('countries/store', [CountryController::class, 'store'])->name('countries.store');
    Route::post('countries/update/{id}', [CountryController::class, 'update'])->name('countries.update');

    Route::get('cost-centers/{id?}', [CostCenterController::class, 'index'])->name('cost-centers.index');
    Route::get('cost-centers/delete/{id}', [CostCenterController::class, 'destroy'])->name('cost-centers.delete');
    Route::post('cost-centers/store', [CostCenterController::class, 'store'])->name('cost-centers.store');
    Route::post('cost-centers/update/{id}', [CostCenterController::class, 'update'])->name('cost-centers.update');

    Route::get('user-allowances/{id}', [UserAllowanceController::class, 'index'])->name('user-allowances.index');
    Route::get('user-allowances/delete/{id}', [UserAllowanceController::class, 'destroy'])->name('user-allowances.delete');
    Route::post('user-allowances/store', [UserAllowanceController::class, 'store'])->name('user-allowances.store');
    Route::post('user-allowances/update/{id}', [UserAllowanceController::class, 'update'])->name('user-allowances.update');

    Route::get('provinces/{id?}', [ProvinceController::class, 'index'])->name('provinces.index');
    Route::get('provinces/delete/{id}', [ProvinceController::class, 'destroy'])->name('provinces.delete');
    Route::post('provinces/store', [ProvinceController::class, 'store'])->name('provinces.store');
    Route::post('provinces/update/{id}', [ProvinceController::class, 'update'])->name('provinces.update');

    Route::get('cities/{id?}', [CityController::class, 'index'])->name('cities.index');
    Route::get('cities/delete/{id}', [CityController::class, 'destroy'])->name('cities.delete');
    Route::post('cities/store', [CityController::class, 'store'])->name('cities.store');
    Route::post('cities/update/{id}', [CityController::class, 'update'])->name('cities.update');

    Route::get('users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserManagementController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserManagementController::class, 'store'])->name('users.store');
    Route::get('users/show/{id}', [UserManagementController::class, 'show'])->name('users.show');
    Route::get('users/edit/{id}', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::post('users/update/{id}', [UserManagementController::class, 'update'])->name('users.update');
    Route::get('users/delete/{id}', [UserManagementController::class, 'destroy'])->name('users.delete');
    Route::get('users/change/status/{id}', [UserManagementController::class, 'changeStatus'])->name('users.change.status');
    Route::post('users/signature/store', [UserManagementController::class, 'signature'])->name('users.signature');
    Route::post('users/signature/update', [UserManagementController::class, 'updateSignature'])->name('users.signature.update');
    Route::get('profile', [UserManagementController::class, 'getProfile'])->name('users.get.profile');
    Route::get('profile/edit', [UserManagementController::class, 'editProfile'])->name('users.edit.profile');
    Route::post('update/profile', [UserManagementController::class, 'updateProfile'])->name('users.update.profile');


    Route::get('permissions/index/{id}', [AuthorizationController::class, 'index'])->name('permissions.index');
    Route::post('permissions/assign', [AuthorizationController::class, 'assignPermissions'])->name('permissions.assign');

    Route::get('recent/activities', [HomeController::class, 'getRecentActivities'])->name('recent.activitise');
    Route::get('fetch/protocol-liaison/dashboard/data', [HomeController::class, 'fetchProtocolLiaisonDashboardData'])->name('fetch.protocol.liaison.dashboard.data');

    Route::get('/guest-visitor/check-cnic/{cnic}', [GuestVisitController::class, 'checkCnic'])->name('guest.visitors.checkCnic');
    Route::resource('guest-and-visitors', GuestVisitController::class)->except('destroy', 'create');
    Route::get('/guest-visitor/bulk-upload-form', [GuestVisitController::class, 'bulkUpload'])->name('guest-and-visitors.bulk');
    Route::get('/download-sample', [GuestVisitController::class, 'downloadSample'])->name('guest-visitors.download-sample');
    Route::post('/bulk-upload', [GuestVisitController::class, 'bulkUploadPost'])->name('guest-visitors.bulk-upload');


    Route::get('/visa/{guestVisitor}', [VisaController::class, 'index'])->name('visa.index');
    Route::get('/visa/create/{guestVisitId}', [VisaController::class, 'create'])->name('visa.create');
    Route::post('/visa/store', [VisaController::class, 'store'])->name('visa.store');
    Route::get('/visa/edit/{id}', [VisaController::class, 'edit'])->name('visa.edit');
    Route::put('/visa/update/{id}', [VisaController::class, 'update'])->name('visa.update');
    Route::get('/visa/delete/{id}', [VisaController::class, 'destroy'])->name('visa.delete');


    Route::POST('guest-and-visitors/bulk/delete', [GuestVisitController::class, 'bulkDelete'])->name('guest-and-visitors.bulkDelete');
    Route::get('guest-and-visitors/bulk/export', [GuestVisitController::class, 'export'])->name('guest-and-visitors.export');
    Route::get('guest-and-visitors/create/counts', [GuestVisitController::class, 'updateCardCounts'])->name('guest-and-visitors.counts');
    Route::get('guest-and-visitors/create/{module}/{oldRecordCnic?}', [GuestVisitController::class, 'create'])->name('guest-and-visitors.create');
    Route::get('guest-and-visitors/delete/{id}', [GuestVisitController::class, 'destroy'])->name('guest-and-visitors.delete');
    Route::get('guest-and-visitors/main_map/{moduleName}', [GuestVisitController::class, 'getMainMapCoordinates'])->name('guest-and-visitors.main.map');
    Route::get('/guest-visitors/generate/report/{id}', [GuestVisitController::class, 'generateReport'])->name('guest.visitor.generate.report');
    Route::get('guest-and-visitors/filter-visits/ajax', [GuestVisitController::class, 'filterVisits'])->name('guest-and-visitors.filter-visits.ajax');
    Route::get('search-suggestion', [GuestVisitController::class, 'searchSuggestion'])->name('guest-and-visitors.searchSuggestion');
    Route::get('/guest-and-visitors/details/ajax', [GuestVisitController::class, 'getDetails'])->name('guest-and-visitors.getDetails');
    //Route for oficail create and update 
    Route::get('/guest-and-visitors-edit/{id}', [GuestVisitController::class, 'createOfficailForm'])->name('official.edit.form');
    Route::put('guest-and-visitors/{id}/update', [GuestVisitController::class, 'updateForm'])->name('guest-and-visitors.update');

    Route::get('guest-visitor-attachment/{id}', [GuestVisitorAttachmentController::class, 'index'])->name('guest-visitor-attachment.index');
    Route::get('guest-visitor-attachment/create/{id}', [GuestVisitorAttachmentController::class, 'create'])->name('guest-visitor-attachment.create');
    Route::post('guest-visitor-attachment/store', [GuestVisitorAttachmentController::class, 'store'])->name('guest-visitor-attachment.store');
    Route::get('guest-visitor-attachment/edit/{id}', [GuestVisitorAttachmentController::class, 'edit'])->name('guest-visitor-attachment.edit');
    Route::post('guest-visitor-attachment/update/{id}', [GuestVisitorAttachmentController::class, 'update'])->name('guest-visitor-attachment.update');
    Route::get('guest-visitor-attachment/delete/{id}', [GuestVisitorAttachmentController::class, 'destroy'])->name('guest-visitor-attachment.delete');
    Route::post('guest-and-visitors/details', [GuestVisitController::class, 'getCnicDetails'])->name('guest-and-visitors.details');



    Route::get('/take/backup', [BackupController::class, 'takeBackup'])->name('take.backup');

    Route::get('task-categories/{id?}', [TaskCategoryController::class, 'index'])->name('task-categories.index');
    Route::get('task-categories/delete/{id}', [TaskCategoryController::class, 'destroy'])->name('task-categories.delete');
    Route::post('task-categories/store', [TaskCategoryController::class, 'store'])->name('task-categories.store');
    Route::post('task-categories/update/{id}', [TaskCategoryController::class, 'update'])->name('task-categories.update');

    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/show/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('tasks/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::get('tasks/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
    Route::get('tasks/mark/cancel/{id}', [TaskController::class, 'markCancel'])->name('tasks.mark.cancel');
    Route::get('tasks/approve/page/{id}', [TaskController::class, 'taskApprovePage'])->name('tasks.approve.page');
    Route::post('tasks/approve', [TaskController::class, 'tasApprove'])->name('tasks.approve');

    Route::get('task-list/{id}', [TaskListController::class, 'index'])->name('task-list.index');
    Route::get('task-list/create/{id}', [TaskListController::class, 'create'])->name('task-list.create');
    Route::post('task-list/store', [TaskListController::class, 'store'])->name('task-list.store');
    Route::get('task-list/edit/{id}', [TaskListController::class, 'edit'])->name('task-list.edit');
    Route::post('task-list/update/{id}', [TaskListController::class, 'update'])->name('task-list.update');
    Route::get('task-list/delete/{id}', [TaskListController::class, 'destroy'])->name('task-list.delete');


    Route::get('purpose-of-visits/{id?}', [PurposeOfVisitController::class, 'index'])->name('purpose-of-visits.index');
    Route::get('purpose-of-visits/delete/{id}', [PurposeOfVisitController::class, 'destroy'])->name('purpose-of-visits.delete');
    Route::post('purpose-of-visits/store', [PurposeOfVisitController::class, 'store'])->name('purpose-of-visits.store');
    Route::post('purpose-of-visits/update/{id}', [PurposeOfVisitController::class, 'update'])->name('purpose-of-visits.update');


    Route::get('couriers', [CourierController::class, 'index'])->name('couriers.index');
    Route::get('couriers/create', [CourierController::class, 'create'])->name('couriers.create');
    Route::post('couriers/store', [CourierController::class, 'store'])->name('couriers.store');
    Route::get('couriers/show/{id}', [CourierController::class, 'show'])->name('couriers.show');
    Route::get('couriers/edit/{id}', [CourierController::class, 'edit'])->name('couriers.edit');
    Route::post('couriers/update/{id}', [CourierController::class, 'update'])->name('couriers.update');
    Route::get('couriers/delete/{id}', [CourierController::class, 'destroy'])->name('couriers.delete');
    Route::post('couriers/add/protocl', [CourierController::class, 'addProtocol'])->name('couriers.protocol.add');

    Route::get('courier-attachments/{id}', [CourierAttachmentController::class, 'index'])->name('courier-attachments.index');
    Route::get('courier-attachments/create/{id}', [CourierAttachmentController::class, 'create'])->name('courier-attachments.create');
    Route::post('courier-attachments/store', [CourierAttachmentController::class, 'store'])->name('courier-attachments.store');
    Route::get('courier-attachments/edit/{id}/{courier_id}', [CourierAttachmentController::class, 'edit'])->name('courier-attachments.edit');
    Route::post('courier-attachments/update/{id}', [CourierAttachmentController::class, 'update'])->name('courier-attachments.update');
    Route::get('courier-attachments/delete/{id}/{courier_id}', [CourierAttachmentController::class, 'destroy'])->name('courier-attachments.delete');

    Route::get('couriers/change/status/{key}/{id}', [CourierController::class, 'changeStatus'])->name('change.status');


    Route::get('permissions/all', [PermissionController::class, 'index'])->name('permissions.all.index');
    Route::get('permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permissions.delete');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');

    Route::group(['prefix' => 'fleet'], function () {
        Route::get('/vehicle-makes', [VehicleMakeController::class, 'index'])->name('vehicle.make');
        Route::post('/vehicle-makes/store', [VehicleMakeController::class, 'store'])->name('vehicle.make.store');
        Route::get('/vehicle-makes/delete/{id}', [VehicleMakeController::class, 'delete'])->name('vehicle.make.delete');
        Route::get('/vehicle-makes/edit', [VehicleMakeController::class, 'edit'])->name('vehicle.make.edit');
        Route::post('/vehicle-makes/update', [VehicleMakeController::class, 'update'])->name('vehicle.make.update');

        Route::get('/vehicle-models', [VehicleModelController::class, 'index'])->name('vehicle.models');
        Route::post('/vehicle-models/store', [VehicleModelController::class, 'store'])->name('vehicle.models.store');
        Route::get('/vehicle-models/delete/{id}', [VehicleModelController::class, 'delete'])->name('vehicle.models.delete');
        Route::get('/vehicle-models/edit', [VehicleModelController::class, 'edit'])->name('vehicle.models.edit');
        Route::post('/vehicle-models/update', [VehicleModelController::class, 'update'])->name('vehicle.models.update');

        Route::get('/vehicle-type', [VehicleTypeController::class, 'index'])->name('vehicle.type');
        Route::post('/vehicle-type/store', [VehicleTypeController::class, 'store'])->name('vehicle.type.store');
        Route::get('/vehicle-type/delete/{id}', [VehicleTypeController::class, 'delete'])->name('vehicle.type.delete');
        Route::get('/vehicle-type/edit', [VehicleTypeController::class, 'edit'])->name('vehicle.type.edit');
        Route::post('/vehicle-type/update', [VehicleTypeController::class, 'update'])->name('vehicle.type.update');

        Route::get('/fuel-type', [FuelTypeController::class, 'index'])->name('fuel.type');
        Route::post('/fuel-type/store', [FuelTypeController::class, 'store'])->name('fuel.type.store');
        Route::get('/fuel-type/delete/{id}', [FuelTypeController::class, 'delete'])->name('fuel.type.delete');
        Route::get('/fuel-type/edit', [FuelTypeController::class, 'edit'])->name('fuel.type.edit');
        Route::post('/fuel-type/update', [FuelTypeController::class, 'update'])->name('fuel.type.update');

        Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
        Route::get('/vehicles/show/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
        Route::get('/vehicles/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::post('/vehicles/update', [VehicleController::class, 'update'])->name('vehicles.update');
        Route::post('/vehicles/store/attachment', [VehicleController::class, 'storeAttachment'])->name('vehicles.store.attachment');
        Route::get('/vehicles/delete/{id}', [VehicleController::class, 'delete'])->name('vehicles.delete');


        Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
        Route::get('/trips/vehicle/by/id', [TripController::class, 'vehicleById'])->name('trips.vehicle.by.id.index');
        Route::get('/trips/get/user', [TripController::class, 'getUser'])->name('trips.get.user.index');
        Route::post('/trips/store', [TripController::class, 'store'])->name('trips.store');
        Route::get('/trips/show/{id}', [TripController::class, 'show'])->name('trips.show');
        Route::get('/trips/edit', [TripController::class, 'edit'])->name('trips.edit');
        Route::post('/trips/update', [TripController::class, 'update'])->name('trips.update');
        Route::get('/trips/delete/{id}', [TripController::class, 'delete'])->name('trips.delete');
        Route::get('/trip/report/{id}', [TripController::class, 'generateReport'])->name('trip.report');

        Route::get('/trips/close/form', [TripController::class, 'closeForm'])->name('trips.close.form');
        Route::post('/trips/close', [TripController::class, 'tripClose'])->name('trips.close');
        Route::post('/trips/cancel', [TripController::class, 'tripCancel'])->name('trips.cancel');

        Route::get('/tracking', [TripController::class, 'tracking'])->name('tracking');
        Route::get('/tracking/show/{id}', [TripController::class, 'tracker'])->name('tracking.show');
        Route::get('/get-latest-location/{id?}', [TripPositionApiController::class, 'latestLocation'])->name('latestLocation');

        Route::get('/fuels', [FuelController::class, 'index'])->name('fuels.index');
        Route::get('/fuels/vehicle/by/id', [FuelController::class, 'vehicleById'])->name('fuels.vehicle.by.id.index');
        Route::get('/fuels/get/user', [FuelController::class, 'getUser'])->name('fuels.get.user.index');
        Route::post('/fuels/store', [FuelController::class, 'store'])->name('fuels.store');
        Route::get('/fuels/show/{id}', [FuelController::class, 'show'])->name('fuels.show');
        Route::get('/fuels/edit', [FuelController::class, 'edit'])->name('fuels.edit');
        Route::post('/fuels/update', [FuelController::class, 'update'])->name('fuels.update');
        Route::get('/fuels/delete/{id}', [FuelController::class, 'delete'])->name('fuels.delete');
        Route::get('/get/fuel/summery/ajax', [FuelController::class, 'getFuelSummery'])->name('fuel.summery.data');
        Route::get('/fuel/slip/report/{id}', [FuelController::class, 'generateReport'])->name('fuel.slip.report');

        Route::get('/inspections', [InspectionController::class, 'index'])->name('inspections.index');
        Route::get('/inspections/vehicle/by/id', [InspectionController::class, 'vehicleById'])->name('inspections.vehicle.by.id.index');
        Route::get('/inspections/get/user', [InspectionController::class, 'getUser'])->name('inspections.get.user.index');
        Route::get('/inspections/create', [InspectionController::class, 'create'])->name('inspections.create');
        Route::post('/inspections/store', [InspectionController::class, 'store'])->name('inspections.store');
        Route::get('/inspections/show/{id}', [InspectionController::class, 'show'])->name('inspections.show');
        Route::get('/inspections/edit', [InspectionController::class, 'edit'])->name('inspections.edit');
        Route::post('/inspections/update', [InspectionController::class, 'update'])->name('inspections.update');
        Route::get('/inspections/delete/{id}', [InspectionController::class, 'delete'])->name('inspections.delete');
        // Route::post('/inspections/approved', [InspectionController::class, 'inspectionApproved'])->name('inspection.approved');

        Route::get('/inspection-checklist', [InspectionChecklistController::class, 'index'])->name('inspection-checklist');
        Route::post('/inspection-checklist/store', [InspectionChecklistController::class, 'store'])->name('inspection-checklist.store');
        Route::get('/inspection-checklist/delete/{id}', [InspectionChecklistController::class, 'delete'])->name('inspection-checklist.delete');
        Route::get('/inspection-checklist/edit', [InspectionChecklistController::class, 'edit'])->name('inspection-checklist.edit');
        Route::post('/inspection-checklist/update', [InspectionChecklistController::class, 'update'])->name('inspection-checklist.update');

        Route::get('/vendors', [VendorController::class, 'index'])->name('vendors');
        Route::post('/vendors/store', [VendorController::class, 'store'])->name('vendors.store');
        Route::get('/vendors/delete/{id}', [VendorController::class, 'delete'])->name('vendors.delete');
        Route::get('/vendors/edit', [VendorController::class, 'edit'])->name('vendors.edit');
        Route::get('/get/vendors/by/id', [VendorController::class, 'getVendorById'])->name('get.vendor.by.id');
        Route::post('/vendors/update', [VendorController::class, 'update'])->name('vendors.update');

        Route::get('/task-workorders', [TaskWorkOrderController::class, 'index'])->name('task-workorders');
        Route::post('/task-workorders/store', [TaskWorkOrderController::class, 'store'])->name('task-workorders.store');
        Route::get('/task-workorders/delete/{id}', [TaskWorkOrderController::class, 'delete'])->name('task-workorders.delete');
        Route::get('/task-workorders/edit', [TaskWorkOrderController::class, 'edit'])->name('task-workorders.edit');
        Route::post('/task-workorders/update', [TaskWorkOrderController::class, 'update'])->name('task-workorders.update');

        Route::get('/work-orders', [WorkOrderController::class, 'index'])->name('work-orders.index');
        Route::get('/work-orders/vehicle/by/id', [WorkOrderController::class, 'vehicleById'])->name('work-orders.vehicle.by.id.index');
        Route::get('/work-orders/get/user', [WorkOrderController::class, 'getUser'])->name('work-orders.get.user.index');
        Route::get('/work-orders/create', [WorkOrderController::class, 'create'])->name('work-orders.create');
        Route::post('/work-orders/store', [WorkOrderController::class, 'store'])->name('work-orders.store');
        Route::get('/work-orders/show/{id}', [WorkOrderController::class, 'show'])->name('work-orders.show');
        Route::get('/work-orders/edit', [WorkOrderController::class, 'edit'])->name('work-orders.edit');
        Route::post('/work-orders/update', [WorkOrderController::class, 'update'])->name('work-orders.update');
        Route::get('/work-orders/delete/{id}', [WorkOrderController::class, 'delete'])->name('work-orders.delete');
        Route::post('/work-orders/close', [WorkOrderController::class, 'workOrderClosed'])->name('work-orders.close');


        Route::get('get/realtime/dashbaord/data', [HomeController::class, 'getRealTimeDataForPurposeOfVisitsAjax'])->name('dashbaord.realtime.data..of.purposeofvisitajax');
        Route::get('get/realtime/dashbaord/for/fleet/data', [HomeController::class, 'getRealTimeDataFleetAjax'])->name('dashbaord.realtime.data.of.fleet.ajax');

        Route::get('/get/linechart/data/for/cases', [HomeController::class, 'lineChartDataForCases'])->name('line.chart.data.cases');
    });

    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/item-type', [ItemTypeController::class, 'index'])->name('item.type');
        Route::post('/item-type/store', [ItemTypeController::class, 'store'])->name('item.type.store');
        Route::get('/item-type/delete/{id}', [ItemTypeController::class, 'delete'])->name('item.type.delete');
        Route::get('/item-type/edit', [ItemTypeController::class, 'edit'])->name('item.type.edit');
        Route::post('/item-type/update', [ItemTypeController::class, 'update'])->name('item.type.update');

        Route::get('/item-makes', [ItemMakeController::class, 'index'])->name('item.make');
        Route::post('/item-makes/store', [ItemMakeController::class, 'store'])->name('item.make.store');
        Route::get('/item-makes/delete/{id}', [ItemMakeController::class, 'delete'])->name('item.make.delete');
        Route::get('/item-makes/edit', [ItemMakeController::class, 'edit'])->name('item.make.edit');
        Route::post('/item-makes/update', [ItemMakeController::class, 'update'])->name('item.make.update');

        Route::get('/item-category', [ItemCategoryController::class, 'index'])->name('item.category');
        Route::post('/item-category/store', [ItemCategoryController::class, 'store'])->name('item.category.store');
        Route::get('/item-category/delete/{id}', [ItemCategoryController::class, 'delete'])->name('item.category.delete');
        Route::get('/item-category/edit', [ItemCategoryController::class, 'edit'])->name('item.category.edit');
        Route::post('/item-category/update', [ItemCategoryController::class, 'update'])->name('item.category.update');

        Route::get('/unit-type', [UnitTypeController::class, 'index'])->name('unit.type');
        Route::post('/unit-type/store', [UnitTypeController::class, 'store'])->name('unit.type.store');
        Route::get('/unit-type/delete/{id}', [UnitTypeController::class, 'delete'])->name('unit.type.delete');
        Route::get('/unit-type/edit', [UnitTypeController::class, 'edit'])->name('unit.type.edit');
        Route::post('/unit-type/update', [UnitTypeController::class, 'update'])->name('unit.type.update');

        Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouses');
        Route::post('/warehouses/store', [WarehouseController::class, 'store'])->name('warehouses.store');
        Route::get('/warehouses/delete/{id}', [WarehouseController::class, 'delete'])->name('warehouses.delete');
        Route::get('/warehouses/edit', [WarehouseController::class, 'edit'])->name('warehouses.edit');
        Route::post('/warehouses/update', [WarehouseController::class, 'update'])->name('warehouses.update');

        Route::get('/inventories', [InventroyController::class, 'index'])->name('inventories.index');
        Route::get('/inventories/show/{id}', [InventroyController::class, 'show'])->name('inventories.show');
        Route::get('/inventories/edit', [InventroyController::class, 'edit'])->name('inventories.edit');
        Route::post('/inventories/store', [InventroyController::class, 'store'])->name('inventories.store');
        Route::post('/inventories/update', [InventroyController::class, 'update'])->name('inventories.update');
        Route::post('/inventories/store/attachment', [InventroyController::class, 'storeAttachment'])->name('inventories.store.attachment');
        Route::get('/inventories/delete/{id}', [InventroyController::class, 'delete'])->name('inventories.delete');


        Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])->name('purchase-orders.index');
        Route::get('/purchase-orders/show/{id}/{status}', [PurchaseOrderController::class, 'show'])->name('purchase-orders.show');
        Route::get('/purchase-orders/create', [PurchaseOrderController::class, 'create'])->name('purchase-orders.create');
        Route::post('/purchase-orders/store', [PurchaseOrderController::class, 'store'])->name('purchase-orders.store');
        Route::get('/purchase-orders/delete/{id}', [PurchaseOrderController::class, 'delete'])->name('purchase-orders.delete');
        Route::get('/purchase-orders/delivery/note/{id}', [PurchaseOrderController::class, 'deliveryNoteForm'])->name('purchase-orders.delivery.note.form');
        Route::post('/purchase-orders/delivery/note/store', [DeliveryNoteController::class, 'storeDeliveryNoteForPO'])->name('purchase-orders.delivery.note.store');

        Route::get('/purchase-orders/report/{id}', [PurchaseOrderController::class, 'purchaseOrderReport'])->name('purchase-orders.report');
        Route::get('/purchase-orders/approved/{id}', [PurchaseOrderController::class, 'purchaseOrderApproved'])->name('purchase-orders.approved');

        Route::post('comparative/store', [PurchaseOrderController::class, 'storeComparative'])->name('store.comparative');
        Route::post('po/closed', [PurchaseOrderController::class, 'poClosed'])->name('po.closed');

        Route::get('po/get/attachment', [PurchaseOrderController::class, 'getAttachment'])->name('po.get.attachment');
        Route::post('po/upload/attachment', [PurchaseOrderController::class, 'uploadAttachment'])->name('po.upload.attachment');

        Route::get('/invoices/index', [InvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
        Route::post('/invoices/store', [InvoiceController::class, 'store'])->name('invoices.store');
        Route::post('/issue-orders/po/store', [InvoiceController::class, 'issueOrderPoStore'])->name('issueOrderPoStore');
        Route::post('/issue-orders/wo/store', [InvoiceController::class, 'issueOrderWoStore'])->name('issueOrderWoStore');
        Route::get('/invoices/detail/form/{id}/{type}', [InvoiceController::class, 'invoiceDetailForm'])->name('invoices.detail.form');

        Route::get('/shift/warehosue/index', [ShiftWarehouseController::class, 'index'])->name('shift.warehosue.index');
        Route::get('/shift/warehosue', [ShiftWarehouseController::class, 'create'])->name('shift.warehosue.create');
        Route::post('/shift/warehosue/store', [ShiftWarehouseController::class, 'store'])->name('shift.warehosue.store');
        Route::get('/shift/warehosue/show/{id}', [ShiftWarehouseController::class, 'show'])->name('shift.warehosue.show');

        Route::get('/reports/fuel/summery', [ReportController::class, 'fuelSummaryReport'])->name('fuel.summary.report');
        Route::get('/reports/vehicle/movement', [ReportController::class, 'vehicleMovementReport'])->name('vehicle.movement.report');
        Route::get('/reports/guest/customer', [ReportController::class, 'guestCustomerReport'])->name('guest.customer.report');
        Route::get('/reports/monthwise/guest/customer', [ReportController::class, 'guestCustomerMonthWiseReport'])->name('guest.customer.monthwise.report');
    });

    Route::group(['prefix' => 'erc'], function () {
        Route::get('/management', [TeamManagementController::class, 'index'])->name('team.managemant.index');

        Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
        Route::post('/teams/store', [TeamController::class, 'store'])->name('teams.store');
        Route::post('/teams/update', [TeamController::class, 'update'])->name('teams.update');

        Route::get('/teams/members', [TeamMemberController::class, 'index'])->name('teams.members.index');
        Route::get('/teams/member/show/{id}', [TeamMemberController::class, 'show'])->name('teams.members.show');
        Route::post('/team/members/store', [TeamMemberController::class, 'store'])->name('team.members.store');
        Route::post('/teams/members/update', [TeamMemberController::class, 'update'])->name('teams.members.update');
        Route::get('/teams/member/get-areas', [TeamMemberController::class, 'getAllotedAreas'])->name('teams.members.areas.get');
        Route::get('/teams/member/get-map-data', [TeamMemberController::class, 'getMapData'])->name('teams.members.areas.getMapData');

        Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
        Route::get('/areas/detail/{id}', [AreaController::class, 'areaDetail'])->name('areas.detail');
        Route::post('/create/area/store', [AreaController::class, 'store'])->name('create.area.store');
        Route::post('/area/update', [AreaController::class, 'update'])->name('areas.update');


        Route::post('/assign/area/store', [AreaController::class, 'assignArea'])->name('assign.area.store');

        Route::get('/get/all/areas', [AreaController::class, 'getAllAreas'])->name('get.all.areas');
        Route::get('/get/all/teams', [TeamController::class, 'getAllTeams'])->name('get.all.teams');

        Route::post('/get/team/stats', [TeamManagementController::class, 'getStats'])->name('get.team.states');
    });

    Route::group(['prefix' => 'project-management'], function () {
        Route::get('/project/management', [ProjectManagementController::class, 'index'])->name('project.managemant.index');
        Route::get('/project/management/stats', [ProjectManagementController::class, 'getstats'])->name('project.managemant.stats');

        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/project/store', [ProjectController::class, 'store'])->name('projects.store');
        Route::post('/project/update', [ProjectController::class, 'update'])->name('projects.update');
        Route::post('/project/start', [ProjectController::class, 'startProject'])->name('projects.start');
        Route::post('/project/complete', [ProjectController::class, 'completeProject'])->name('projects.complete');
        Route::post('/project/update', [ProjectController::class, 'update'])->name('projects.update');
        Route::get('/project/detail/{id}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('/get/project/by/id', [ProjectController::class, 'projectById'])->name('project.by.id');
        Route::get('/project/delete/{id}', [ProjectController::class, 'delete'])->name('project.delete');

        Route::get('/projects/tasks', [ProjectManagementTaskController::class, 'index'])->name('projects.tasks.index');
        Route::get('/projects/task/detail/{id}', [ProjectManagementTaskController::class, 'taskDetail'])->name('projects.tasks.detail');
        Route::post('/task/store', [ProjectManagementTaskController::class, 'store'])->name('task.store');
        Route::post('/task/store/percentage', [ProjectManagementTaskController::class, 'storePercentage'])->name('task.store.percentage');
        Route::get('/task/delete/{id}', [ProjectManagementTaskController::class, 'delete'])->name('task.delete');
        Route::post('/task/update', [ProjectManagementTaskController::class, 'update'])->name('task.update');
        Route::get('/get/task/by/id', [ProjectManagementTaskController::class, 'taskById'])->name('task.by.id');
        Route::get('/task/report/{id}', [ProjectManagementTaskController::class, 'showReportForm'])->name('task.report.form');

        Route::get('/expenses', [ExpenseController::class, 'index'])->name('expense.index');
        Route::get('/expense/attachment', [ExpenseController::class, 'expenseAttachment'])->name('expense.attachment');
        Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');
        Route::post('/expense/update', [ExpenseController::class, 'update'])->name('expense.update');
        Route::get('/expense/delete/{id}', [ExpenseController::class, 'delete'])->name('expense.delete');
        Route::get('/get/expense/by/id', [ExpenseController::class, 'expenseById'])->name('expense.by.id');

        Route::post('/activity/store', [ActivityController::class, 'store'])->name('activity.store');
    });

    Route::group(['prefix' => 'employee-management'], function () {
        Route::get('/mark/attandance', [AttandanceController::class, 'attandanceForm'])->name('employee.managemant.mark.attandance');
        Route::get('/get/user/attandance', [AttandanceController::class, 'getUserAttandance'])->name('employee.managemant.get.user.attandance');
        Route::post('/store/attandance', [AttandanceController::class, 'attandanceStore'])->name('employee.managemant.store.attandance');

        Route::get('leaves', [LeaveController::class, 'index'])->name('leaves.index');
        Route::get('approve/leave/{id}', [LeaveController::class, 'approveLeave'])->name('leaves.approve');
        Route::post('/store/leaves', [LeaveController::class, 'storeLeave'])->name('store.leave');

        Route::get('requests', [RequestManagementController::class, 'index'])->name('requests.index');
        Route::get('requests/by/id', [RequestManagementController::class, 'requestById'])->name('requests.by.id');
        Route::get('requests/show/{id}', [RequestManagementController::class, 'show'])->name('requests.show');
        Route::post('/store/requests', [RequestManagementController::class, 'store'])->name('request.managemant.store.requests');
        Route::post('/update/requests', [RequestManagementController::class, 'update'])->name('request.managemant.update.requests');
        Route::post('/upload/requests/attachment', [RequestManagementController::class, 'uploadAttachment'])->name('request.managemant.upload.requests.attachment');
    });

    Route::get('project-task-types/{id?}', [ProjectTaskTypeController::class, 'index'])->name('project-task-types.index');
    Route::get('project-task-types/delete/{id}', [ProjectTaskTypeController::class, 'destroy'])->name('project-task-types.delete');
    Route::post('project-task-types/store', [ProjectTaskTypeController::class, 'store'])->name('project-task-types.store');
    Route::post('project-task-types/update/{id}', [ProjectTaskTypeController::class, 'update'])->name('project-task-types.update');

    Route::get('request-types/{id?}', [RequestTypeController::class, 'index'])->name('request-types.index');
    Route::get('request-types/delete/{id}', [RequestTypeController::class, 'destroy'])->name('request-types.delete');
    Route::post('request-types/store', [RequestTypeController::class, 'store'])->name('request-types.store');
    Route::post('request-types/update/{id}', [RequestTypeController::class, 'update'])->name('request-types.update');

    Route::prefix('easypaisa')->name('easypaisa.')->group(function () {
        Route::get('/product/show', [EasypaisaController::class, 'show'])->name('show');
        Route::post('/checkout', [EasypaisaController::class, 'DoCheckout'])->name('DoCheckout');
        Route::get('/checkout-confirm', [EasypaisaController::class, 'checkoutConfirm'])->name('checkoutConfirm');
        Route::get('/paymentStatus', [EasypaisaController::class, 'paymentStatus'])->name('paymentStatus');
    });
    Route::prefix('alfa')->name('alfa.')->group(function () {
        Route::get('/product/show', [AlfaController::class, 'show'])->name('show');
    });

    Route::get('/tutorial', function () {
        return view('admin.tutorials');
    })->name('tutorials.index');
});
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/optimize-clear', function () {
    return Artisan::call('optimize:clear');
});
Route::get('/schedule-run', function () {
    Artisan::call('schedule:run');
    return 'Command executed!';
});
Route::get('/dump-autoload', function () {
    chdir(__DIR__ . '/../');
    return shell_exec('composer dump-autoload -o');
});
