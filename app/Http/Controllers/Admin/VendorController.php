<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{

    public function index()
    {
        $this->authorize('All Vendors');
        $data['vendors'] = Vendor::all();
        return view('admin.fleets.vendors.index', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Vendors');

        $imageLink = '';
        $extension = '';

        if ($request->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->file->move(public_path('vendors_images'), $fileName);
            $imageLink = asset('/vendors_images/' . $fileName);
        }

        Vendor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'image_link' => $imageLink,
            'image_type' => $extension,
            'user_id' => Auth::id(),
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Vendor Added Successfully.'
        ], 200);
    }

    public function edit(Request $request)
    {
        $this->authorize('Edit Vendors');

        $vendor = Vendor::findOrFail($request->id);

        return response()->json([
            'status' => true,
            'message' => 'Vendor Data Fatched.',
            'type' => $vendor
        ], 200);
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Vendors');

        $vendor = Vendor::findOrFail($request->id);
        $vendor->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status
        ]);
        if ($request->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->file->move(public_path('vendors_images'), $fileName);
            $imageLink = asset('/vendors_images/' . $fileName);

            $vendor->update([
                'image_link' => $imageLink,
                'image_type' => $extension,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Item Udated Successfully.'
        ], 200);
    }

    public function delete($id)
    {
        $this->authorize('Delete Vendors');

        Vendor::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Vendor deleted successfully');
    }

    public function getVendorById(Request $request)
    {
        $vendor = Vendor::findOrFail($request->vendorId);

        return response()->json([
            'status' => true,
            'vendor' => $vendor
        ], 200);
    }
}
