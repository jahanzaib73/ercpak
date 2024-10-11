<?php

namespace App\Http\Controllers\Admin\RequestManagement;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Province;
use App\Models\RequestAttachment;
use App\Models\RequestManagement;
use App\Models\RequestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RequestManagementController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('All Request');
        if ($request->ajax()) {
            $requestManagements = RequestManagement::with('requestType', 'currency', 'country', 'province', 'city')->latest();
            return DataTables::eloquent($requestManagements)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = '';

                    if (RequestManagement::NOTSTARTED === $row->status) {
                        $status = '<span class="badge badge-info">Waiting to Start</span>';
                    } elseif (RequestManagement::INPROGRESS === $row->status) {
                        $status = '<span class="badge badge-primary">Inprogress</span>';
                    } elseif (RequestManagement::COMPLETED === $row->status) {
                        $status = '<a href="#" class="btn btn-success w-100"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>';
                    }

                    return $status;
                })
                ->addColumn('requestType', function ($row) {
                    return optional($row->requestType)->name;
                })->addColumn('currency', function ($row) {
                    return optional($row->currency)->name;
                })->addColumn('country', function ($row) {
                    return optional($row->country)->name;
                })->addColumn('province', function ($row) {
                    return optional($row->province)->name;
                })->addColumn('city', function ($row) {
                    return optional($row->city)->name;
                })->addColumn('attachments', function ($row) {
                    return $row->attachments()->count();
                })->addColumn('action', function ($row) {
                    $btn = '';
                    if (Auth::user()->can('View Request')) {
                        $btn .= '<a href=' . route('requests.show', ['id' => $row]) . ' data-toggle="tooltip" data-original-title="Show" class="btn btn-eye-icon btn-sm"><i class="fa fa-eye"></i></a>';
                    }
                    if (Auth::user()->can('Edit Request')) {
                        $btn .= ' | <a href="javascript:void(0)" data-id=' . $row->id . '  class="editRequest btn bg-info text-white btn-sm"><i class="fa fa-pencil"></i></a>';
                    }
                    if (Auth::user()->can('Upload Attechment')) {
                        $btn .= ' | <a href="javascript:void(0)" data-id=' . $row->id . '  class="uploadImages btn btn-gray btn-sm"><i class="fa fa-upload"></i></a>';
                    }


                    return $btn;
                })
                ->rawColumns(['action', 'status', 'startDate', 'complatedDate'])
                ->make(true);
        }
        $data['countries'] = Country::whereStatus(1)->get();
        $data['cities'] = City::whereStatus(1)->get();
        $data['provinces'] = Province::whereStatus(1)->get();
        $data['currencies'] = Currency::whereStatus(1)->get();
        $data['requestTypes'] = RequestType::whereStatus(1)->get();
        $data['requets'] = RequestManagement::latest()->get();
        return view('admin.request_management.index', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('New Request');

        try {
            DB::beginTransaction();
            $url = null;
            $fileName = null;
            $type = null;
            if ($request->has('featured_image')) {
                $extension = $request->featured_image->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $request->featured_image->move(public_path('project'), $fileName);
                $url = asset('/project/' . $fileName);
                $type = $extension;
            }

            RequestManagement::create([
                "request_type_id" => $request->request_type_id,
                "request_date" => $request->request_date,
                "requestee_name" => $request->requestee_name,
                "age" => $request->age,
                "gender" => $request->gender,
                "country_id" => $request->country_id,
                "province_id" => $request->province_id,
                "city_id" => $request->city_id,
                "contact" => $request->contact,
                "email" => $request->email,
                "funds_requested" => $request->funds_requested,
                "currency_id" => $request->currency_id,
                "notes" => $request->notes,
                "notesarabic" => $request->notes_arabic,
                "featured_image" => $fileName,
                "status" => 0,
                'featured_image_url' =>  $url
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Project Added Successfully',
            ], 200);
        } catch (\Exception $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function show($id)
    {
        $this->authorize('View Request');

        $request = RequestManagement::findOrFail($id);
        return view('admin.request_management.show', compact('request'));
    }

    public function requestById(Request $request)
    {
        $requestData = RequestManagement::findOrFail($request->requestId);
        return response()->json([
            'status' => true,
            'data' => $requestData
        ], 200);
    }


    public function update(Request $request)
    {
        $this->authorize('Edit Request');

        try {
            DB::beginTransaction();
            $requestData = RequestManagement::findOrFail($request->id);
            $url = null;
            $fileName = null;
            $type = null;
            if ($request->has('featured_image')) {
                $extension = $request->featured_image->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $request->featured_image->move(public_path('project'), $fileName);
                $url = asset('/project/' . $fileName);
                $type = $extension;
            }

            $requestData->update([
                "request_type_id" => $request->request_type_id,
                "request_date" => $request->request_date,
                "requestee_name" => $request->requestee_name,
                "age" => $request->age,
                "gender" => $request->gender,
                "country_id" => $request->country_id,
                "province_id" => $request->province_id,
                "city_id" => $request->city_id,
                "contact" => $request->contact,
                "email" => $request->email,
                "funds_requested" => $request->funds_requested,
                "currency_id" => $request->currency_id,
                "notes" => $request->notes,
                "notesarabic" => $request->notes_arabic,
                "featured_image" => $fileName ?: $requestData->featured_image,
                "status" => $request->status,
                'featured_image_url' =>  $url ?: $requestData->featured_image_url
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Project Updated Successfully',
            ], 200);
        } catch (\Exception $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function uploadAttachment(Request $request)
    {
        // $this->authorize('Upload Attechment');

        $url = null;
        $fileName = null;
        if ($request->has('file')) {
            $extension = $request->file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $request->file->move(public_path('project'), $fileName);
            $url = asset('/project/' . $fileName);
            $type = $extension;
        }
        RequestAttachment::create([
            'request_id' => $request->id,
            'title' => $request->title,
            'description' => $request->notes,
            'file_type' => $type,
            'file_url' => $url,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'File Uploaded Successfully',
        ], 200);
    }
}
