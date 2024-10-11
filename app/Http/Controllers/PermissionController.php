<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!isSuperAdmin()){
            abort(401,'You are not Authorize for this action');
        }

        $permissions = Permission::orderBy('id','desc')->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255|min:3',
        ]);

        Permission::create([
            'name' => $request->name,
            'module_name' => $request->moudle_name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('permissions.all.index')->with('success','Permission Created Successfully!');
    }

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->route('permissions.all.index')->with('success','Permission Deleted Successfully!');

    }
}
