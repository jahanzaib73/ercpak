<?php

use App\Models\Complaint;
use App\Models\ComplaintAtachment;
use App\Models\CourierReceiverHandover;
use App\Models\DocumentImage;
use App\Models\EmployeeRemainder;
use App\Models\FlightCargoImage;
use App\Models\Inventory;
use App\Models\ProtocolLiaisonImage;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

function getComplaintNumber()
{
    return Complaint::count() + 1;
}

function isSuperAdmin()
{
    return optional(optional(Auth::user())->role)->name == "Super Admin";
}

function isMaintainer()
{
    return optional(optional(Auth::user())->role)->name == "Maintaner";
}

function isDocumentMaintainer()
{
    return optional(optional(Auth::user())->role)->name == "Document Maintainer";
}

function isComplaintMaintainer()
{
    return optional(optional(Auth::user())->role)->name == "Complaint Maintainer";
}

function getDocumentImage($type, $id)
{
    return DocumentImage::where('document_id', $id)->where('certificate_name', $type)->get();
}

function getFlightCargoAttchments($moduleType, $moduleTypeId, $attchmentTypeName)
{
    return FlightCargoImage::where('module_type', $moduleType)
        ->where('module_type_id', $moduleTypeId)
        ->where('attachment_type_name', $attchmentTypeName)
        ->get();
}

function getProtocolLiaisonAttchments($moduleType, $moduleTypeId, $attchmentTypeName)
{
    return ProtocolLiaisonImage::where('module_type', $moduleType)
        ->where('module_type_id', $moduleTypeId)
        ->where('attachment_type_name', $attchmentTypeName)
        ->get();
}

function getRemainderEployesIds($remainderId)
{
    $ids = EmployeeRemainder::where('remainder_id', $remainderId)->pluck('employee_id');
    if (count($ids) > 0) {
        return $ids->toArray();
    }

    return [];
}

function getUserPermissionsIds($userId)
{
    return DB::table('model_has_permissions')->where('model_id', $userId)->pluck('permission_id')->toArray();
}

function getComplaintAttachments($complaintId)
{
    return ComplaintAtachment::where('complaint_id', $complaintId)->get();
}

function hasAllPermissionsCustom()
{
    $permissionsAll = Permission::pluck('name');
    if (Auth::user()->hasAllPermissions($permissionsAll->toArray())) {
        return true;
    }

    return false;
}

function getTypeOfCourier($courier)
{
    return CourierReceiverHandover::where('user_id', Auth::id())->where('courier_id', $courier)->first();
}

function generateItemCode()
{
    $item_code = Str::random(10); // Generate a random 10-character string

    // Check if the generated ASIN already exists in the database
    $exists = Inventory::where('item_code', $item_code)->exists();

    // If it exists, regenerate until a unique ASIN is found
    while ($exists) {
        $item_code = Str::random(10);
        $exists = Inventory::where('item_code', $item_code)->exists();
    }

    return $item_code;
}

function storeImage($request, $folderName)
{

    $image = $request->file('file');
    $input['file'] = time() . '.' . $image->getClientOriginalExtension();
    $destinationPath = public_path('/inventory_images');
    $imgFile = Image::make($image->getRealPath());
    $imgFile->resize(150, 150, function ($constraint) {
        $constraint->aspectRatio();
    })->save($destinationPath . '/' . $input['file']);
    $url = asset('/' . $folderName . '/' . $imgFile->filename . '.' . $imgFile->extension);
    $data['url'] =  $url;
    $data['filename'] =  $imgFile->filename . '.' . $imgFile->extension;
    return $data;
}

function is_image($file)
{
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), $imageExtensions);
}

function get_file_icon($file)
{
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $iconMap = [
        'pdf' => asset('icons/pdf.png'),
        'doc' => asset('icons/doc.webp'),
        'xlsx' => asset('icons/xls.png'),
        // Add more file types and corresponding icon paths as needed
    ];

    return $iconMap[strtolower($extension)] ?? 'path/to/default-icon.png';
}
