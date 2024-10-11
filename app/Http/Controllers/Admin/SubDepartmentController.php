<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\SubDepartment;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $this->authorize('All Department');

        if ($id) {
            $data['department'] = SubDepartment::findOrFail($id);
        }

        $data['departments'] = SubDepartment::latest()->get();
        $data['goverments'] = Department::whereStatus(1)->get();
        // return view('admin.departments/index', compact('data'));
        return view('new-admin.sub-depertments.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Department');
        $request->validate([
            'name' => 'required|unique:departments|max:255|min:3',
            'department_id' => 'required|numeric',
        ], [
            'department_id.required' => 'Government field is required.',
            'department_id.numeric' => 'Government field should be numeric.',
        ]);


        $department_logo = '';
        $department_logo_url = '';
        if ($request->has('department_logo')) {
            $department_logo = rand(1, 100000) . time() . '.' . $request->department_logo->getClientOriginalExtension();
            $request->department_logo->move(public_path('department_logo'), $department_logo);
            $department_logo_url = asset('/department_logo/' . $department_logo);
        }

        $office_picture = '';
        $office_logo_url = '';
        if ($request->has('office_picture')) {
            $office_picture = rand(1, 100000) . time() . '.' . $request->office_picture->getClientOriginalExtension();
            $request->office_picture->move(public_path('office_picture'), $office_picture);
            $office_logo_url = asset('/office_picture/' . $office_picture);
        }

        SubDepartment::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'status' => $request->status,
            'logo_name' => $department_logo,
            'logo_url' => $department_logo_url,
            'office_picture_name' => $office_picture,
            'office_picture_url' => $office_logo_url,
        ]);

        return redirect()->route('subdepartments.index')->with('success', 'Department Created Successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('Edit Department');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:departments,name,' . $id,
            'department_id' => 'required|numeric',
        ], [
            'department_id.required' => 'Government field is required.',
            'department_id.numeric' => 'Government field should be numeric.',
        ]);

        $department_logo = '';
        $department_logo_url = '';
        if ($request->has('department_logo')) {
            $department_logo = rand(1, 100000) . time() . '.' . $request->department_logo->getClientOriginalExtension();
            $request->department_logo->move(public_path('department_logo'), $department_logo);
            $department_logo_url = asset('/department_logo/' . $department_logo);
        }

        $office_picture = '';
        $office_logo_url = '';
        if ($request->has('office_picture')) {
            $office_picture = rand(1, 100000) . time() . '.' . $request->office_picture->getClientOriginalExtension();
            $request->office_picture->move(public_path('office_picture'), $office_picture);
            $office_logo_url = asset('/office_picture/' . $office_picture);
        }


        $department = SubDepartment::findOrFail($id);

        $department->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'status' => $request->status,
            'logo_name' => $department_logo ?: $department->logo_name,
            'logo_url' => $department_logo_url ?: $department->logo_url,
            'office_picture_name' => $office_picture ?: $department->office_picture_name,
            'office_picture_url' => $office_logo_url ?: $department->office_picture_url,
        ]);

        return redirect()->route('subdepartments.index')->with('success', 'Department Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Department');
        SubDepartment::findOrFail($id)->delete();
        return redirect()->route('subdepartments.index')->with('success', 'Department Deleted Successfully!');
    }
}
