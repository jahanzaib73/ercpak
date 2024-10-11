<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AuthorizationController extends Controller
{
    public function index($userId)
    {
        $this->authorize('Assign Permission');
        $data['user'] = User::findOrFail($userId);
        $moduleNames = Permission::distinct()->pluck('module_name');
        $groupByPermission = [];
        $index = 0;
        foreach ($moduleNames as $moduleName) {
            $permissions = Permission::where('module_name',$moduleName)->get();
            $groupByPermission[$moduleName][$index] = $permissions;
            $index++;
        }
        $data['groupByPermission'] = $groupByPermission;
        $data['hasAllPermisison'] = $data['user']->hasAllPermissions(Permission::pluck('name'));
        return view('admin.user_management.authorizations.index',$data);
    }

    public function assignPermissions(Request $request){
        $this->authorize('Assign Permission');
        $user = User::findOrFail($request->user_id);
        $user->syncPermissions($request->permissions);
        return redirect()->back()->with('success','Permission Assign Successfully');
    }
}
