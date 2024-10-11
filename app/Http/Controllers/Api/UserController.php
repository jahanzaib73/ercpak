<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;

class UserController extends Controller



{
   public function  index()
   {
    $user = user::all();

    if($user->count() > 0) {
        return response()->json([
            'status' => 200,
            'user' => $user
        ], 200);
    }else{
        return response()->json([
            'status' => 404,
            'message' => 'No Records Found'
        ], 404);
    }
   
}
public function store(Request $request)
{
  $validator = validator ::make($request->all(),[
    'first_name' => 'required|strring|max:191',
    'last_name' => 'required|string|max:191',
    'designation' => 'required|string|max:191',
    'user' => 'required|email|max:191',
    'allowances' => 'required|string|max:191',
  ]);
  if($validator->fails())
  {
    return response()->json([
        'status' => 422,
        'errors' => $validator->messages()
    ],422);
  }else{
    $user = user::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'designation' => $request->designation,
        'user' => $request->user,
        'allowances' => $request->allowances,
    ]);
    if($user){
        return response()->json([
            'status' => 200,
        'message' => "User added successfully"
        ],200);
        
    }else{
        return response()->json([
            'status' => 500,
        'message' => "Something went wrong"
        ],500);
    }
  }
}
}