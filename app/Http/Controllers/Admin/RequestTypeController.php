<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestType;
use Illuminate\Http\Request;

class RequestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $this->authorize('All Request Type');

        if ($id) {
            $data['complaintType'] = RequestType::findOrFail($id);
        }

        $data['complaintTypes'] = RequestType::orderBy('id', 'desc')->get();
        return view('admin.request_types.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Request Type');
        $request->validate([
            'name' => 'required|unique:complaint_types|max:255|min:3',
        ]);

        RequestType::create($request->all());

        return redirect()->route('request-types.index')->with('success', 'Request Type Created Successfully!');
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
        $this->authorize('Edit Request Type');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:complaint_types,name,' . $id,
        ]);

        RequestType::findOrFail($id)->update($request->all());

        return redirect()->route('request-types.index')->with('success', 'Request Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Request Type');
        RequestType::findOrFail($id)->delete();
        return redirect()->route('request-types.index')->with('success', 'Request Type Deleted Successfully!');
    }
}
