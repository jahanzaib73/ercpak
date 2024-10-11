<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use App\Rules\DocumentNumberRule;
use Illuminate\Http\Request;

class DocumentCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        $this->authorize('All Document Type');
        if($id){
            $data['documentType'] = DocumentCategory::findOrFail($id);
        }

        $data['documentTypes'] = DocumentCategory::orderBy('id','desc')->get();
        return view('admin.document-types/index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('Add Document Type');
        $request->validate([
            'document_number' => ['required','unique:document_categories','max:255','min:3'],
            'name' => 'required|unique:document_categories|max:255|min:3',
        ]);

        DocumentCategory::create($request->all());

        return redirect()->route('document-types.index')->with('success','Document Type Created Successfully!');
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
        $this->authorize('Edit Document Type');
        $request->validate([
            'name' => 'required|max:255|min:3|unique:document_categories,name,'.$id,
        ]);

        DocumentCategory::findOrFail($id)->update($request->all());

        return redirect()->route('document-types.index')->with('success','Document Type Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Document Type');
        DocumentCategory::findOrFail($id)->delete();
        return redirect()->route('document-types.index')->with('success','Document Type Deleted Successfully!');
    }
}
