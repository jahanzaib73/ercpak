<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;

class UserManagementApiController extends Controller
{
    public function getProfile()
    {
        $user = auth()->user()->load('designation');
        $response = new ProfileResource($user);
        return response()->json($response, 200);
    }
}
