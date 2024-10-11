<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'is_vehicle' => ['required', 'boolean'],
        ]);
        if ($request->is_vehicle) {
            $vehicle = Vehicle::where('vehicle_number', $request->username)->first();
            $vehicle && decrypt($vehicle->password) == $request->password ? $authenticated = true : $authenticated = false;
            // Check if authentication is successful
            if ($authenticated) {
                // Check if the user's status is 'ONMOVE'
                $vehicleOnMove = $vehicle->status == Vehicle::ONMOVE;

                if ($vehicleOnMove) {
                    $message = "Vehicle on move, Logged in";
                } else {
                    $authenticated = false;
                    $message = "No Trip Assigned!";
                }
            } else {
                $message = "Invalid Credentials!";
            }
            // Generate token if authenticated
            $token = $authenticated ? $vehicle->createToken('auth_token')->accessToken : null;
            $role = $authenticated ? "vehicle" : "";
        } else {
            $authenticated = Auth::attempt(['email' => $request->username, 'password' => $request->password]);
            $message = $authenticated ? "Logged in" : "Invalid Credentials!";
            $token = $authenticated ? auth()->user()->createToken('auth_token')->accessToken : null;
            $authenticated ? $userRole = auth()->user()->role()->first()->name ?? "Employee" : $userRole = "";
            $role =$userRole;
        }
        // Set status code based on authentication status
        $status = $authenticated ? 200 : 401;
        return response()->json([
            'success' => $authenticated,
            'message' => $message,
            'role' => $role,
            'token' => $token,
        ], $status);
    }

    public function logout()
    {
        $success = auth()->user()->token()->revoke();
        return response()->json(['success' => $success]);
    }
}
