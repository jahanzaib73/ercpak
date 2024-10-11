<?php

use App\Http\Controllers\Api\ActivityApiController;
use App\Http\Controllers\Api\AreaApiController;
use App\Http\Controllers\Api\AttandanceApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use App\Http\Controllers\Api\FuelApiController;
use App\Http\Controllers\Api\InventoryApiController;
use App\Http\Controllers\Api\LeaveApiController;
use App\Http\Controllers\Api\MovementOrderApiController;
use App\Http\Controllers\Api\ProjectManagementApiController;
use App\Http\Controllers\Api\ProjectManagementTaskApiController;
use App\Http\Controllers\Api\PurchaseOrderApiController;
use App\Http\Controllers\Api\TeamManagementApiController;
use App\Http\Controllers\Api\TripPositionApiController;
use App\Http\Controllers\Api\UserManagementApiController;
use App\Http\Controllers\Api\VehicleApiController;
use App\Http\Controllers\Api\WorkOrderApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {

    // Profile
    Route::get('/profile', [UserManagementApiController::class, 'getProfile']);

    //Purchase Orders
    Route::get('/purchase-orders', [PurchaseOrderApiController::class, 'index']);
    Route::get('/purchase-orders/show/{id}/{status}', [PurchaseOrderApiController::class, 'show']);

    Route::get('/purchase-orders/approved/{id}', [PurchaseOrderApiController::class, 'purchaseOrderApproved']);
    Route::get('comparative/approved/{id}', [PurchaseOrderApiController::class, 'approvedComparative']);
    Route::get('po/closed/{id}', [PurchaseOrderApiController::class, 'poClosed']);

    //Movement Orders
    Route::get('/movement-orders', [MovementOrderApiController::class, 'index']);
    Route::get('/movement-orders/{id}', [MovementOrderApiController::class, 'show']);

    //Attendance
    Route::get('/employees', [EmployeeApiController::class, 'index']);

    Route::get('/mark/attandance', [AttandanceApiController::class, 'attandanceForm']);
    Route::get('/get/user/attandance', [AttandanceApiController::class, 'getUserAttandance']);
    Route::post('/store/attandance', [AttandanceApiController::class, 'attandanceStore']);

    Route::get('leaves/{id}', [LeaveApiController::class, 'index']);
    Route::get('user/leaves', [LeaveApiController::class, 'userLeaves']);
    Route::get('approve/leave/{id}', [LeaveApiController::class, 'approveLeave']);
    Route::post('/store/leaves', [LeaveApiController::class, 'storeLeave']);

    //Inventories
    Route::get('/inventories', [InventoryApiController::class, 'index']);
    Route::get('/inventories/show/{id}', [InventoryApiController::class, 'show']);

    //Work Orders
    Route::get('/work-orders', [WorkOrderApiController::class, 'index']);
    Route::get('/work-orders/show/{id}', [WorkOrderApiController::class, 'show']);
    Route::get('/inspections/show/{id}', [WorkOrderApiController::class, 'showInspection']);
    Route::post('/inspection/approve', [WorkOrderApiController::class, 'approveInspection']);
    Route::post('/work-orders/close', [WorkOrderApiController::class, 'closeWorkOrder']);

    //Fuels
    Route::get('/fuels', [FuelApiController::class, 'index']);
    Route::get('/fuels/show/{id}', [FuelApiController::class, 'show']);

    //Vehicles
    Route::get('/vehicles', [VehicleApiController::class, 'index']);
    Route::get('/vehicle/show/{id}', [VehicleApiController::class, 'show']);

    //Project Management
    Route::get('/project/management', [ProjectManagementApiController::class, 'index']);
    Route::get('/project/management/stats', [ProjectManagementApiController::class, 'getstats']);

    Route::get('/projects/tasks/{projectId}', [ProjectManagementTaskApiController::class, 'showTasks']);
    Route::get('/projects/task/detail/{id}', [ProjectManagementTaskApiController::class, 'taskDetail']);
    Route::get('/project/employee/tasks', [ProjectManagementTaskApiController::class, 'employeeTasks']);

    Route::post('/activity/store', [ActivityApiController::class, 'store']);

    //Area Management
    Route::get('/area/management', [TeamManagementApiController::class, 'index']);
    Route::get('/map/all-areas', [AreaApiController::class, 'getAllAreas']);

    Route::get('/teams/member/show/{id}', [TeamManagementApiController::class, 'show']);
    Route::get('/teams/member/get-areas', [TeamManagementApiController::class, 'getAllotedAreas']);
    Route::get('/teams/member/get-map-data', [AreaApiController::class, 'getMapData']);

    Route::get('/areas/detail/{id}', [TeamManagementApiController::class, 'areaDetail']);

    Route::get('/logout', [AuthApiController::class, 'logout']);
});

Route::middleware(['auth:tracking_app'])->group(function () {
    Route::get('/trips', [TripPositionApiController::class, 'getTrips']);
    Route::get('/trip-history/{id}', [TripPositionApiController::class, 'tripHistory']);
    Route::post('/trip-position', [TripPositionApiController::class, 'positionChanged']);
});
