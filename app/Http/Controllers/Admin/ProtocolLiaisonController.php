<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProtocolLiaisonStoreRequest;
use App\Models\City;
use App\Models\Department;
use App\Models\Government;
use App\Models\Location;
use App\Models\ProtocolLiaison;
use App\Models\ProtocolLiaisonImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProtocolLiaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('All Protocol and Liaison');
        if ($request->ajax()) {

            $protocolLiaisons = ProtocolLiaison::with('user', 'city', 'location')->when(($request->moduleNmae == ProtocolLiaison::OFFICIAL), function ($query) {
                $query->where('protocol_liaisontype_id', 1);
            })->when(($request->moduleNmae == ProtocolLiaison::NOTABLE), function ($query) {
                $query->where('protocol_liaisontype_id', 2);
            })->when(($request->moduleNmae ==  ProtocolLiaison::COMPANY), function ($query) {
                $query->where('protocol_liaisontype_id', 3);
            })->when(($request->moduleNmae == ProtocolLiaison::PROJECT), function ($query) {
                $query->where('protocol_liaisontype_id', 4);
            })->when(($request->moduleNmae == ProtocolLiaison::PROPERTY), function ($query) {
                $query->where('protocol_liaisontype_id', 5);
            })->when($request->government_id != null, function ($query) use ($request) {
                $departmentIds = Department::where('government_id', $request->government_id)->pluck('id');
                $query->whereIN('department_id', $departmentIds);
            })->latest();
            return DataTables::of($protocolLiaisons)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View Protocol and Liaison')) {
                        $btn .= '<a href=' . route('protocol-and-liaisons.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a>';
                    }
                    if (Auth::user()->can('Edit Protocol and Liaison')) {
                        $btn .= ' | <a href=' . route('protocol-and-liaisons.edit', $row->id) . ' title="Edit Record" class="btn bg-info text-light btn-sm"><i class="fa fa-edit"></i></a>';
                    }
                    if (Auth::user()->can('Delete Protocol and Liaison')) {
                        $btn .= ' | <a href=' . route('protocol-and-liaisons.delete', $row->id) . ' title="Delete Record" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i></a>';
                    }
                    if (Auth::user()->can('All Teams')) {
                        $btn .= ' | <a href=' . route('protocol-liaison-teams.index', $row->id) . ' title="Add Team Member" class="btn save-btn btn-sm edit"><i class="fa fa-users"></i></a>';
                    }
                    if (Auth::user()->can('All Protocol and Liaison Contact')) {
                        $btn .= ' | <a href=' . route('protocol-liaison-contact-numbers.index', $row->id) . ' title="Add Contact Detail" class="btn btn-dark-black btn-sm edit"><i class="fa fa-address-book"></i></a>';
                    }
                    if ($request->moduleNmae == ProtocolLiaison::PROJECT) {
                        $btn .= ' | <a href=' . route('project-attachments.index', $row->id) . ' title="Add Attachment" class="btn btn-gray btn-sm edit"><i class="fa fa-file"></i></a>';
                    }

                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                    $status = '';
                    // if($row->status == 0){
                    //     $status = '<span class="badge badge-info">Active</span>';
                    // }else if($row->status == 1){
                    //     $status = '<span class=""badge badge-danger">Closed</span>';
                    // }

                    return $status;
                })
                ->addColumn('department_id', function ($row) {
                    return ucfirst(optional($row->department)->name);
                })->addColumn('created_by', function ($row) {
                    return ucfirst(optional($row->user)->full_name);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        $data['allstate'] = ProtocolLiaison::allState();
        $data['todayAllstate'] = ProtocolLiaison::todayAllState();

        $data['allStateOfficial'] = ProtocolLiaison::paiChartAllData(1);
        $data['todayStateOfficial'] = ProtocolLiaison::paiCHartTodayData(1);

        $data['allStateNotable'] = ProtocolLiaison::paiChartAllData(2);
        $data['todayStateNotable'] = ProtocolLiaison::paiCHartTodayData(2);

        $data['allStateCompany'] = ProtocolLiaison::paiChartAllData(3);
        $data['todayStateCompany'] = ProtocolLiaison::paiCHartTodayData(3);

        $data['allStateProject'] = ProtocolLiaison::paiChartAllData(4);
        $data['todayStateProject'] = ProtocolLiaison::paiCHartTodayData(4);

        $data['allStateProperty'] = ProtocolLiaison::paiChartAllData(5);
        $data['todayStateProperty'] = ProtocolLiaison::paiCHartTodayData(5);

        $data['governments'] = Government::where('status', 1)->get();


        if ($request->module_name == ProtocolLiaison::OFFICIAL) {
            $this->authorize('View By Official');
            $data['moduleName'] = ProtocolLiaison::OFFICIAL;
            return view('admin.protocol_liaisons/index_Officials', $data);
        } elseif ($request->module_name == ProtocolLiaison::NOTABLE) {
            $this->authorize('View By Notable');
            $data['moduleName'] = ProtocolLiaison::NOTABLE;
            return view('admin.protocol_liaisons/index_notable', $data);
        } elseif ($request->module_name == ProtocolLiaison::COMPANY) {
            $this->authorize('View By Company');
            $data['moduleName'] = ProtocolLiaison::COMPANY;
            return view('admin.protocol_liaisons/index_company', $data);
        } elseif ($request->module_name == ProtocolLiaison::PROJECT) {
            $this->authorize('View By Project');
            $data['moduleName'] = ProtocolLiaison::PROJECT;
            return view('admin.protocol_liaisons/index_projects', $data);
        } elseif ($request->module_name == ProtocolLiaison::PROPERTY) {
            $this->authorize('View By Property');
            $data['moduleName'] = ProtocolLiaison::PROPERTY;
            return view('admin.protocol_liaisons/index_property', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module)
    {
        $this->authorize('Add Protocol and Liaison');
        $data['department'] = Department::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['cities'] = City::whereStatus(1)->get();
        if ($module == ProtocolLiaison::OFFICIAL) {
            $module = 1;
        } elseif ($module == ProtocolLiaison::NOTABLE) {
            $module = 2;
        } elseif ($module == ProtocolLiaison::COMPANY) {
            $module = 3;
        } elseif ($module == ProtocolLiaison::PROJECT) {
            $module = 4;
        } elseif ($module == ProtocolLiaison::PROPERTY) {
            $module = 5;
        }
        $data['module'] = $module;
        return view('admin.protocol_liaisons/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProtocolLiaisonStoreRequest $request)
    {
        $this->authorize('Add Protocol and Liaison');
        if ($request->protocol_liaisontype_id == 1) {
            $official = $this->_storeOfficialData($request);

            if ($request->has('official_photo')) {
                $this->_storeSignleAttachment($request->official_photo, $official, ProtocolLiaison::OFFICIAL, 'official_photo');
            }

            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::OFFICIAL])->with('success', 'Official Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 2) {

            $notable = $this->_storeNotbleData($request);

            if ($request->has('notable_photo')) {
                $this->_storeSignleAttachment($request->notable_photo, $notable, ProtocolLiaison::NOTABLE, 'notable_photo');
            }


            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::NOTABLE])->with('success', 'Notable Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 3) {

            $company = $this->_storeCompanyData($request);
            if ($request->has('company_photos')) {
                $this->_storeAttachments($request->company_photos, $company, ProtocolLiaison::COMPANY, 'company_photos');
            }

            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::COMPANY])->with('success', 'Company Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 4) {
            $project = $this->_storeProjectData($request);
            if ($request->has('project_photos')) {
                $this->_storeAttachments($request->project_photos, $project, ProtocolLiaison::PROJECT, 'project_photo');
            }

            if ($request->has('project_feture_photo')) {
                $extension = $request->project_feture_photo->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $request->project_feture_photo->move(public_path('project_feture_photo'), $fileName);
                $url = asset('/project_feture_photo/' . $fileName);
                $project->project_feature_image_name = $fileName;
                $project->project_feature_image_url = $url;
                $project->update();
            }
            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::PROJECT])->with('success', 'Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 5) {
            $property = $this->_storePropertyData($request);
            if ($request->has('property_photos')) {
                $this->_storeAttachments($request->property_photos, $property, ProtocolLiaison::PROPERTY, 'property_photos');
            }

            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::PROPERTY])->with('success', 'Data stored successfully.');
        }

        return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::OFFICIAL])->with('error', 'Something went wrong.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View Protocol and Liaison');
        $data['protocolLiaison'] = ProtocolLiaison::with('visits')->findOrFail($id);

        return view('admin.protocol_liaisons/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit Protocol and Liaison');
        $data['departments'] = Department::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['protocolLiaison'] = ProtocolLiaison::findOrFail($id);
        $data['cities'] = City::whereStatus(1)->get();

        return view('admin.protocol_liaisons/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProtocolLiaisonStoreRequest $request, $id)
    {
        $this->authorize('Edit Protocol and Liaison');
        if ($request->protocol_liaisontype_id == 1) {
            $officialRecord = $this->_updateOfficialData($request, $id);
            if ($request->has('official_photo')) {
                $this->_storeSignleAttachment($request->official_photo, $officialRecord, ProtocolLiaison::OFFICIAL, 'official_photo');
            }
            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::OFFICIAL])->with('success', 'Official Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 2) {
            $notable = $this->_updateNotableData($request, $id);

            if ($request->has('notable_photo')) {
                $this->_storeSignleAttachment($request->notable_photo, $notable, ProtocolLiaison::NOTABLE, 'notable_photo');
            }
            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::NOTABLE])->with('success', 'Notable Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 3) {
            $company = $this->_updateCompanyData($request, $id);
            if ($request->has('company_photos')) {
                $this->_storeAttachments($request->company_photos, $company, ProtocolLiaison::COMPANY, 'company_photos');
            }
            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::COMPANY])->with('success', 'Company Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 4) {
            $project = $this->_updateProjectData($request, $id);
            if ($request->has('project_photos')) {
                $this->_storeAttachments($request->project_photos, $project, ProtocolLiaison::PROJECT, 'project_photos');
            }
            if ($request->has('project_feture_photo')) {
                $extension = $request->project_feture_photo->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $request->project_feture_photo->move(public_path('project_feture_photo'), $fileName);
                $url = asset('/project_feture_photo/' . $fileName);
                $project->project_feature_image_name = $fileName;
                $project->project_feature_image_url = $url;
                $project->update();
            }
            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::PROJECT])->with('success', 'Project Data stored successfully.');
        } elseif ($request->protocol_liaisontype_id == 5) {
            $property = $this->_updatePropertyData($request, $id);
            if ($request->has('property_photos')) {
                $this->_storeAttachments($request->property_photos, $property, ProtocolLiaison::PROPERTY, 'property_photos');
            }
            return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::PROPERTY])->with('success', 'Property Data stored successfully.');
        }

        return redirect()->route('protocol-and-liaisons.index', ['module_name' => ProtocolLiaison::OFFICIAL])->with('error', 'Something went wrong.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Protocol and Liaison');
        ProtocolLiaison::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data deleted successfully.');
    }

    private function _storeOfficialData(Request $request)
    {

        return ProtocolLiaison::Create([
            'official_name' => $request->official_name,
            'city_id' => $request->official_city_id,
            'phone' => $request->official_phone,
            'official_designation' => $request->official_designation,
            'protocol_liaisontype_id' => $request->protocol_liaisontype_id,
            'department_id' => $request->department_id,
            'official_email' => $request->official_email,
            'official_google_map_lat' => $request->official_google_map_lat,
            'official_google_map_lng' => $request->official_google_map_lng,
            'official_biography' => $request->official_biography,
            'official_address' => $request->official_address,
            'user_id' => Auth::id(),
        ]);
    }

    private function _storeNotbleData(Request $request)
    {
        return ProtocolLiaison::Create([
            'protocol_liaisontype_id' => $request->protocol_liaisontype_id,
            'notable_name' => $request->notable_name,
            'city_id' => $request->notable_city_id,
            'phone' => $request->notable_phone,
            'notable_email' => $request->notable_email,
            'notable_google_map_lat' => $request->notable_google_map_lat,
            'notable_google_map_lng' => $request->notable_google_map_lng,
            'notable_biography' => $request->notable_biography,
            'notable_address' => $request->notable_address,
            'user_id' => Auth::id(),
        ]);
    }

    private function _storeCompanyData(Request $request)
    {
        return ProtocolLiaison::Create([
            'protocol_liaisontype_id' => $request->protocol_liaisontype_id,
            'company_name' => $request->company_name,
            'company_city' => $request->company_city,
            'company_email' => $request->company_email,
            'company_google_map_lat' => $request->company_google_map_lat,
            'company_google_map_lng' => $request->company_google_map_lng,
            'company_website' => $request->company_website,
            'company_about' => $request->company_about,
            'company_address' => $request->company_address,
            'user_id' => Auth::id(),
        ]);
    }

    private function _storeProjectData(Request $request)
    {
        return ProtocolLiaison::Create([
            'protocol_liaisontype_id' => $request->protocol_liaisontype_id,
            'project_name' => $request->project_name,
            'city_id' => $request->city_id,
            'location_id' => $request->location_id,
            'project_email' => $request->project_email,
            'project_google_map_lat' => $request->project_google_map_lat,
            'project_google_map_lng' => $request->project_google_map_lng,
            'project_website' => $request->project_website,
            'project_company_about' => $request->project_company_about,
            'project_address' => $request->project_address,
            'project_description' => $request->project_description,
            'user_id' => Auth::id(),
        ]);
    }

    private function _storePropertyData(Request $request)
    {
        return ProtocolLiaison::Create([
            'protocol_liaisontype_id' => $request->protocol_liaisontype_id,
            'property_name' => $request->property_name,
            'property_city' => $request->property_city,
            'property_google_map_lat' => $request->property_google_map_lat,
            'property_google_map_lng' => $request->property_google_map_lng,
            'property_company_about' => $request->property_company_about,
            'property_address' => $request->property_address,
            'property_description' => $request->property_description,
            'user_id' => Auth::id(),
        ]);
    }

    private function _updateOfficialData(Request $request, $id)
    {

        $protocolLiaison = ProtocolLiaison::findOrFail($id);
        $protocolLiaison->update([
            'official_name' => $request->official_name,
            'official_designation' => $request->official_designation,
            'department_id' => $request->department_id,
            'city_id' => $request->official_city_id,
            'phone' => $request->official_phone,
            'official_email' => $request->official_email,
            'official_google_map_lat' => $request->official_google_map_lat,
            'official_google_map_lng' => $request->official_google_map_lng,
            'official_biography' => $request->official_biography,
            'official_address' => $request->official_address,
        ]);

        return $protocolLiaison;
    }

    private function _updateNotableData(Request $request, $id)
    {

        $protocolLiaison = ProtocolLiaison::findOrFail($id);
        $protocolLiaison->update([

            'notable_name' => $request->notable_name,
            'city_id' => $request->notable_city_id,
            'phone' => $request->notable_phone,
            'notable_email' => $request->notable_email,
            'notable_google_map_lat' => $request->notable_google_map_lat,
            'notable_google_map_lng' => $request->notable_google_map_lng,
            'notable_biography' => $request->notable_biography,
            'notable_address' => $request->notable_address,
        ]);

        return $protocolLiaison;
    }

    private function _updateCompanyData(Request $request, $id)
    {

        $protocolLiaison = ProtocolLiaison::findOrFail($id);
        $protocolLiaison->update([
            'company_name' => $request->company_name,
            'company_city' => $request->company_city,
            'company_email' => $request->company_email,
            'company_google_map_lat' => $request->company_google_map_lat,
            'company_google_map_lng' => $request->company_google_map_lng,
            'company_website' => $request->company_website,
            'company_about' => $request->company_about,
            'company_address' => $request->company_address,
        ]);

        return $protocolLiaison;
    }

    private function _updateProjectData(Request $request, $id)
    {

        $protocolLiaison = ProtocolLiaison::findOrFail($id);
        $protocolLiaison->update([
            'project_name' => $request->project_name,
            'city_id' => $request->city_id,
            // 'project_id' => $request->project_id,
            'project_email' => $request->project_email,
            'project_google_map_lat' => $request->project_google_map_lat,
            'project_google_map_lng' => $request->project_google_map_lng,
            'project_website' => $request->project_website,
            'project_company_about' => $request->project_company_about,
            'project_address' => $request->project_address,
            'project_description' => $request->project_description,
        ]);

        return $protocolLiaison;
    }

    private function _updatePropertyData(Request $request, $id)
    {

        $protocolLiaison = ProtocolLiaison::findOrFail($id);
        $protocolLiaison->update([
            'property_name' => $request->property_name,
            'property_city' => $request->property_city,
            'property_google_map_lat' => $request->property_google_map_lat,
            'property_google_map_lng' => $request->property_google_map_lng,
            'property_company_about' => $request->property_company_about,
            'property_address' => $request->property_address,
            'property_description' => $request->property_description,
        ]);

        return $protocolLiaison;
    }



    private function _storeAttachments($attchments, $model, $moduleType, $attachmentType)
    {
        // dd($attchments,$model,$moduleType,$attachmentType);
        foreach ($attchments as $attchment) {
            $extension = $attchment->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $attchment->move(public_path($attachmentType), $fileName);
            $url = asset('/' . $attachmentType . '/' . $fileName);

            ProtocolLiaisonImage::create([
                'file_name' => $fileName,
                'orignal_file_name' => $attchment->getClientOriginalName(),
                'file_type' => $extension,
                'file_url' => $url,
                'module_type' => $moduleType,
                'module_type_id' => $model->id,
                'attachment_type_name' => $attachmentType
            ]);
        }
    }

    private function _storeSignleAttachment($attchment, $model, $moduleType, $attachmentType)
    {
        $extension = $attchment->getClientOriginalExtension();
        $fileName = rand(1, 100000) . time() . '.' . $extension;
        $attchment->move(public_path($attachmentType), $fileName);
        $url = asset('/' . $attachmentType . '/' . $fileName);

        ProtocolLiaisonImage::where('module_type_id', $model->id)
            ->where('module_type', $moduleType)
            ->where('attachment_type_name', $attachmentType)
            ->delete();

        ProtocolLiaisonImage::create([
            'file_name' => $fileName,
            'orignal_file_name' => $attchment->getClientOriginalName(),
            'file_type' => $extension,
            'file_url' => $url,
            'module_type' => $moduleType,
            'module_type_id' => $model->id,
            'attachment_type_name' => $attachmentType
        ]);
    }

    public function getMainMapCoordinates($moduleType)
    {
        $coordinates = [];
        if ($moduleType == ProtocolLiaison::OFFICIAL) {
            $protcolLiaisons = $this->_getCoordinates(1);
            $index = 0;

            foreach ($protcolLiaisons as $protocol) {
                $coordinates[$index]['lat'] = (float)$protocol->official_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->official_google_map_lng;
                $coordinates[$index]['address'] = $protocol->official_address;
                $coordinates[$index]['email'] = $protocol->official_email;
                $coordinates[$index]['name'] = $protocol->official_name;
                $coordinates[$index]['designation'] = $protocol->official_designation;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $index++;
            }
        } elseif ($moduleType == ProtocolLiaison::NOTABLE) {
            $protcolLiaisons = $this->_getCoordinates(2);
            $index = 0;

            foreach ($protcolLiaisons as $protocol) {
                $coordinates[$index]['lat'] = (float)$protocol->notable_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->notable_google_map_lng;
                $coordinates[$index]['email'] = $protocol->notable_email;
                $coordinates[$index]['name'] = $protocol->notable_name;
                $coordinates[$index]['city'] = $protocol->notable_city;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $index++;
            }
        } elseif ($moduleType == ProtocolLiaison::COMPANY) {
            $protcolLiaisons = $this->_getCoordinates(3);
            $index = 0;

            foreach ($protcolLiaisons as $protocol) {
                $coordinates[$index]['lat'] = (float)$protocol->company_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->company_google_map_lng;
                $coordinates[$index]['name'] = $protocol->company_name;
                $coordinates[$index]['email'] = $protocol->company_email;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $index++;
            }
        } elseif ($moduleType == ProtocolLiaison::PROJECT) {
            $protcolLiaisons = $this->_getCoordinates(4);
            $index = 0;

            foreach ($protcolLiaisons as $protocol) {
                $coordinates[$index]['lat'] = (float)$protocol->project_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->project_google_map_lng;
                $coordinates[$index]['name'] = $protocol->project_name;
                $coordinates[$index]['email'] = $protocol->project_email;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $index++;
            }
        } elseif ($moduleType == ProtocolLiaison::PROPERTY) {
            $protcolLiaisons = $this->_getCoordinates(5);
            $index = 0;

            foreach ($protcolLiaisons as $protocol) {
                $coordinates[$index]['lat'] = (float)$protocol->property_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->property_google_map_lng;
                $coordinates[$index]['name'] = $protocol->property_name;
                $coordinates[$index]['city'] = $protocol->property_city;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $index++;
            }
        }

        // dd($coordinates);
        return response()->json([
            'status' => true,
            'cooridnates' => $coordinates
        ], 200);
    }

    private function _getCoordinates($id)
    {
        return ProtocolLiaison::with('officialImage', 'primaryNumber')->where('protocol_liaisontype_id', $id)->get();
    }
}
