<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\GuestVistor;
use App\Models\Visa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class VisaController extends Controller
{
    public function index($guestVisitId)
    {
        $visas = Visa::with('guestVisitor')->where('guest_visitor_id', $guestVisitId)->get();
        return view('new-admin.guest_vistors.visa.index', compact('visas', 'guestVisitId'));
    }
    public function create($guestVisitId)
    {
        $this->authorize('Add Guest & Visitor Attachment');
        $guestVisitId = $guestVisitId;
        $cities = City::orderBy('name', 'asc')->get();
        return view('new-admin.guest_vistors.visa.create', compact('cities', 'guestVisitId'));
    }
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image',
            'name' => 'required|string|max:255',
            'cnic' => 'required|string|max:255',
            'city_id' => 'required',
            'passport' => 'required|string|max:255',
            'attachment' => 'nullable|file',
            'guest_visitor_id' => 'required|exists:guest_vistors,id',
        ]);

        // Return with validation errors if any
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if a record with the same CNIC already exists for today
        $existingVisa = Visa::where('cnic', $request->cnic)
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($existingVisa) {
            return back()->with('error', 'A visa for this CNIC already exists for today.')->withInput();
        }

        // Store the new Visa
        try {
            $visa = new Visa();

            // Save photo to public folder
            if ($request->hasFile('photo')) {
                $visa->photo = $this->saveImageToPublic($request->file('photo'), 'visas/photos');
            }

            $visa->name = $request->name;
            $visa->city_id = $request->city_id;
            $visa->cnic = $request->cnic;
            $visa->passport = $request->passport;

            // Save attachment to public folder if exists
            if ($request->hasFile('attachment')) {
                $visa->attachment = $this->saveImageToPublic($request->file('attachment'), 'visas/attachments');
            }

            $visa->guest_visitor_id = $request->guest_visitor_id;
            $visa->save();

            return redirect()->route('visa.index', ['guestVisitor' => $visa->guest_visitor_id])->with('success', 'Visa added successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'An error occurred while adding the visa. Please try again later.')->withInput();
        }
    }

    public function edit($id)
    {
        $this->authorize('Add Guest & Visitor Attachment');
        $visa = Visa::findOrFail($id);
        return view('new-admin.guest_vistors.visa.edit', compact('visa'));
    }
    public function update(Request $request, $id)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image',
            'name' => 'required|string|max:255',
            'cnic' => 'required|string|max:255',
            'city_id' => 'required',
            'passport' => 'required|string|max:255',
            'attachment' => 'nullable|file',
            'guest_visitor_id' => 'required|exists:guest_vistors,id',
        ]);

        // Return with validation errors if any
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Retrieve the existing visa record
        $visa = Visa::findOrFail($id);

        // Update fields from the form input
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($visa->photo && file_exists(public_path($visa->photo))) {
                unlink(public_path($visa->photo));
            }
            // Store the new photo in public folder
            $visa->photo = $this->saveImageToPublic($request->file('photo'), 'visas/photos');
        }

        $visa->name = $request->name;
        $visa->cnic = $request->cnic;
        $visa->city_id = $request->city_id;
        $visa->passport = $request->passport;

        if ($request->hasFile('attachment')) {
            // Delete the old attachment if it exists
            if ($visa->attachment && file_exists(public_path($visa->attachment))) {
                unlink(public_path($visa->attachment));
            }
            // Store the new attachment in public folder
            $visa->attachment = $this->saveImageToPublic($request->file('attachment'), 'visas/attachments');
        }

        $visa->guest_visitor_id = $request->guest_visitor_id;
        $visa->save();

        return redirect()->route('visa.index', ['guestVisitor' => $visa->guest_visitor_id])->with('success', 'Visa updated successfully.');
    }
    public function destroy($id)
    {
        $this->authorize('Add Guest & Visitor Attachment');
        $visa = Visa::find($id);
        $guest_visitor_id = $visa->guest_visitor_id;
        $visa->delete();
        return redirect()->route('visa.index', ['guestVisitor' => $guest_visitor_id])->with('success', 'Visa delete successfully.');
    }
    private function saveImageToPublic($file, $folder)
    {
        // Define the target directory inside the public folder
        $destinationPath = public_path($folder);

        // Ensure the directory exists or create it
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Generate a unique file name with extension
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Move the file to the public directory
        $file->move($destinationPath, $fileName);

        // Return the relative path to the file
        return $folder . '/' . $fileName;
    }
}
