<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeApiController extends Controller
{
    public function index() {
        $employees = User::where('role_id', '!=', 1)->with('designation')->get();
        $response = EmployeeResource::collection($employees);
        return response()->json(['employees' => $response]);
    }
}
