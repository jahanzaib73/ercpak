<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GuestVisitorsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuestVisitorStoreRequest;
use App\Http\Requests\GuestVisitorUpdateRequest;
use App\Models\City;
use App\Models\Department;
use App\Models\GuestVistor;
use App\Models\Location;
use App\Models\ProtocolLiaison;
use App\Models\Province;
use App\Models\PurposeOfVisit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuestVisitorsImport;
use App\Models\SubDepartment;
use App\Models\Visa;
use Illuminate\Support\Facades\Response;

class GuestVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('All Guest and Visitors');
        if ($request->ajax()) {
            $latestRecords = GuestVistor::select('cnic', \DB::raw('MAX(created_at) as latest_created_at'))
                ->groupBy('cnic');
            $guestVisitors = GuestVistor::with('user', 'department', 'subdepartment', 'guest', 'city.province', 'attachments', 'visas')
                ->joinSub($latestRecords, 'latest_records', function ($join) {
                    $join->on('guest_vistors.cnic', '=', 'latest_records.cnic')
                        ->on('guest_vistors.created_at', '=', 'latest_records.latest_created_at');
                })
                ->when($request->moduleNmae == GuestVistor::GUEST, function ($query) {
                    $query->where('guest_vistors.type', GuestVistor::GUEST);
                })
                ->when($request->moduleNmae == GuestVistor::VISTORS, function ($query) {
                    $query->where('guest_vistors.type', GuestVistor::VISTORS);
                })
                ->when($request->daterange, function ($query) use ($request) {
                    $dates = explode(' to ', $request->daterange);
                    if (count($dates) === 2) {
                        $query->whereBetween('guest_vistors.created_at', [$dates[0], $dates[1]]);
                    }
                })
                ->when($request->sub_department, function ($query) use ($request) {
                    $query->where('guest_vistors.sub_department_id', $request->sub_department);
                })
                ->when($request->department, function ($query) use ($request) {
                    $query->where('guest_vistors.department_id', $request->department);
                })
                ->when($request->districts, function ($query) use ($request) {
                    $query->whereHas('city', function ($query) use ($request) {
                        $query->whereIn('name', $request->districts);
                    });
                })
                ->when($request->province, function ($query) use ($request) {
                    $query->whereHas('city.province', function ($query) use ($request) {
                        $query->where('name', $request->province);
                    });
                })
                ->when($request->category, function ($query) use ($request) {
                    $query->where('guest_vistors.category', $request->category);
                })
                ->orderBy('guest_vistors.created_at', 'desc')
                ->get();
            return DataTables::of($guestVisitors)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="select-row" value="' . $row->id . '">';
                })
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View Guest and Visitors')) {
                        $btn .= '<div class="d-flex align-items-center"><a href=' . route('guest-and-visitors.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a>';
                    }
                    if (Auth::user()->can('Edit Guest and Visitors')) {
                        $btn .= ' | <a href=' . route('guest-and-visitors.edit', $row->id) . ' title="Edit Record" class="btn bg-info btn-sm edit text-white"><i class="fa fa-edit"></i></a>';
                    }
                    if (Auth::user()->can('All Guest & Visitor Attachment')) {
                        $btn .= ' | <a href=' . route('guest-visitor-attachment.index', $row->id) . ' title="Add Attachments" class="btn btn-gray btn-sm edit"><i class="fa fa-file"></i></a>';
                    }
                    if (Auth::user()->can('Delete Guest and Visitors')) {
                        $btn .= ' | <a href=' . route('guest-and-visitors.delete', $row->id) . ' onclick="return confirm(\'Are you sure?\')" title="Delete Record" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i></a></div>';
                    }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                    $status = 'N/A';
                    if (count($row->attachments)) {
                        $status = 'Inprogress';
                        // Check if all attachments have status 1 (Closed)
                        if (
                            $row->attachments->every(function ($attachment) {
                                return $attachment->status == 1;
                            })
                        ) {
                            $status = 'Closed';
                        }

                        return '<span class="badge badge-' . ($status == 'Closed' ? 'success' : 'info') . '">' . $status . '</span>';
                    }
                    return $status;
                })
                ->addColumn('host', function ($row) {
                    return ucfirst(optional($row->host)->full_name) ?: 'N/A';
                })->addColumn('photo', function ($row) use ($request) {
                    return '<a href=' . $row->image_url . ' target="_blank"><img width="50" src=' . $row->image_url . ' /></a>';
                })->addColumn('date_time', function ($row) use ($request) {
                    return Carbon::parse($row->date_time)->format('d-m-Y h:i') ?? 'N/A';
                })->addColumn('sub_department', function ($row) {
                    return ucfirst(optional($row->subdepartment)->name) ?: 'N/A';
                })->addColumn('department', function ($row) {
                    return ucfirst(optional($row->department)->name) ?: 'N/A';
                })->addColumn('city', function ($row) {
                    return ucfirst(optional($row->city)->name) ?: 'N/A';
                })->addColumn('guest', function ($row) {

                    if (optional($row->guest)->official_name)
                        return ucfirst(optional($row->guest)->official_name) . '(Official)';
                    else
                        return ucfirst(optional($row->guest)->notable_name) . '(Notable)';
                })->addColumn('created_by', function ($row) {
                    return ucfirst(optional($row->user)->full_name);
                })->addColumn('pyrposeOfVisit', function ($row) {
                    return ucfirst(optional($row->pyrposeOfVisit)->name);
                })->addColumn('department', function ($row) {
                    return ucfirst(optional($row->department)->name);
                })->addColumn('gender', function ($row) {
                    return ucfirst($row->gender);
                })->addColumn('dob', function ($row) {
                    return Carbon::parse($row->dob)->format('d-m-Y') ?? 'N/A';
                })->addColumn('no_visa', function ($row) {
                    return count($row->visas) + 1;
                })->addColumn('attachments', function ($row) {
                    return count($row->attachments) + 1;
                })
                ->addColumn('details', function ($row) {
                    // Create an empty container for details
                    return '';
                })
                ->addColumn('expandable_cnic', function ($row) {
                    // Check if there are multiple records for this CNIC
                    $count = GuestVistor::where('cnic', $row->cnic)->count();
                    if ($count > 1) {
                        return '<button class="btn btn-primary btn-sm toggle-details" id="' . $row->cnic . '" data-cnic="' . $row->cnic . '">+</button>';
                    }
                    return '<button class="btn btn-primary btn-sm toggle-details" disabled data-cnic="' . $row->cnic . '">+</button>';
                })
                ->addColumn('action', function ($row) {
                    $count = Visa::where('guest_visitor_id', $row->id)->count();

                    $btn = '<div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu">
                            <line x1="4" x2="20" y1="12" y2="12"/>
                            <line x1="4" x2="20" y1="6" y2="6"/>
                            <line x1="4" x2="20" y1="18" y2="18"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="' . route('official.edit.form', $row->id) . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                            <span>Edit</span>
                        </a>
                        <a class="dropdown-item" href="' . route('guest-and-visitors.delete', $row->id) . '" onclick="return confirm(\'Are you sure?\')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                            <span>Delete</span>
                        </a>
                        <a class="dropdown-item" href="' . route('guest-visitor-attachment.index', $row->id) . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <span>View Attachments</span>
                        </a>';

                    if ($count > 0) {
                        $btn .= '<a class="dropdown-item" href="' . route('visa.index', $row->id) . '">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <span>View Visa</span>
                            </a>';
                    } else {
                        $btn .= '<a class="dropdown-item" href="' . route('visa.create', ['guestVisitId' => $row->id]) . '">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <span>Add Visa</span>
                            </a>';
                    }

                    $btn .= '</div>
                </div>';


                    return $btn;
                })
                ->rawColumns(['checkbox', 'expandable_cnic', 'details', 'action', 'photo'])
                ->make(true);
        }

        $data['allstate'] = GuestVistor::allState();
        $data['todayAllstate'] = GuestVistor::todayAllState();

        $data['allStateVisitor'] = GuestVistor::paiChartAllData(GuestVistor::VISTORS);
        $data['todayStateVisitor'] = GuestVistor::paiCHartTodayData(GuestVistor::VISTORS);

        $data['allStateGuest'] = GuestVistor::paiChartAllData(GuestVistor::GUEST);
        $data['todayStateGuest'] = GuestVistor::paiCHartTodayData(GuestVistor::GUEST);

        $data['departments'] = Department::whereStatus(1)->get();
        $data['subdepartments'] = SubDepartment::whereStatus(1)->get();
        $data['cities'] = City::whereStatus(1)->get();
        $data['provinces'] = Province::whereStatus(1)->get();

        $protocolLiaisons = ProtocolLiaison::whereIn('protocol_liaisontype_id', [1, 2, 3])
            ->with('officialImage', 'department:id,name', 'city')
            ->withCount('visits')->get();

        $data['officials'] = ProtocolLiaison::where('protocol_liaisontype_id', 1)
            ->with('officialImage', 'department:id,name', 'city:id,name')
            ->withCount('visits')->get();

        $data['notables'] = ProtocolLiaison::where('protocol_liaisontype_id', 2)
            ->with('officialImage', 'department:id,name', 'city:id,name')
            ->withCount('visits')->get();

        $data['businesses'] = ProtocolLiaison::where('protocol_liaisontype_id', 3)
            ->with('officialImage', 'department:id,name', 'city:id,name', 'members')
            ->withCount('visits')->get();

        $data['purposeOfVisits'] = PurposeOfVisit::orderBy('id', 'desc')->get();
        // Fetch the data with relationships
        $visitors = GuestVistor::where('type', $request->module_name)
            ->with('guest.officialImage', 'department:id,name', 'city:id,name')
            ->get();

        $data['Male'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')->where('gender', 'Male')->count();  // Filter by province_id

        $data['Female'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')->where('gender', 'Female')->count();  // Filter by province_id

        $data['baluchistanVisitor'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 1)  // Filter by province_id
            ->count();
        $data['baluchistanMale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 1)->where('gender', 'Male')  // Filter by province_id
            ->count();
        $data['baluchistanFemale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 1)->where('gender', 'Female')  // Filter by province_id
            ->count();

        $data['punjabVisitor'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 2)  // Filter by province_id
            ->count();
        $data['punjabMale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 2)->where('gender', 'Male')  // Filter by province_id
            ->count();
        $data['punjabFemale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 2)->where('gender', 'Female')  // Filter by province_id
            ->count();

        $data['sindhVisitor'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 3)  // Filter by province_id
            ->count();
        $data['sindhMale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 3)->where('gender', 'Male')  // Filter by province_id
            ->count();
        $data['sindhFemale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 3)->where('gender', 'Female')  // Filter by province_id
            ->count();

        $data['khyberVisitor'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 4)  // Filter by province_id
            ->count();
        $data['khyberMale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 4)->where('gender', 'Male')  // Filter by province_id
            ->count();
        $data['khyberFemale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 4)->where('gender', 'Female')  // Filter by province_id
            ->count();

        $data['capitalVisitor'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 5)  // Filter by province_id
            ->count();
        $data['capitalMale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 5)->where('gender', 'Male')  // Filter by province_id
            ->count();
        $data['capitalFemale'] = GuestVistor::join('cities', 'guest_vistors.city_id', '=', 'cities.id')  // Join the cities table based on city_id
            ->where('cities.province_id', 5)->where('gender', 'Female')  // Filter by province_id
            ->count();

        // Group by CNIC and count the visits
        $data['customerVisits'] = $visitors->groupBy('cnic')->map(function ($group) {
            // Take the first record of the group
            $visitor = $group->first();
            // Add the customer_visits count
            $visitor->customer_visits = $group->count();
            return $visitor;
        })->values();

        // <--------------  COUNT BY PROVINCES  -------------->
        $data['punjabCount'] = $data['customerVisits']->where('province_id', 2)->count()
            + $protocolLiaisons->filter(function ($protocolLiaison) {
                if ($protocolLiaison->city) {
                    return in_array($protocolLiaison->city->province_id, [2]);
                } else {
                    return false;
                }
            })->count();
        $data['sindhCount'] = $data['customerVisits']->where('province_id', 3)->count()
            + $protocolLiaisons->filter(function ($protocolLiaison) {
                if ($protocolLiaison->city) {
                    return in_array($protocolLiaison->city->province_id, [3]);
                } else {
                    return false;
                }
            })->count();
        $data['baluchistanCount'] = $data['customerVisits']->where('province_id', 1)->count()
            + $protocolLiaisons->filter(function ($protocolLiaison) {
                if ($protocolLiaison->city) {
                    return in_array($protocolLiaison->city->province_id, [1]);
                } else {
                    return false;
                }
            })->count();
        $data['kpkCount'] = $data['customerVisits']->where('province_id', 4)->count()
            + $protocolLiaisons->filter(function ($protocolLiaison) {
                if ($protocolLiaison->city) {
                    return in_array($protocolLiaison->city->province_id, [4]);
                } else {
                    return false;
                }
            })->count();
        // <--------------------------->

        // Merge the customer visits into protocol liaisons
        $data['allData'] = [
            'protocolLiaisons' => $protocolLiaisons,
            'customerVisits' => $data['customerVisits'],
        ];

        // $data['protocolLiaisons'] = ProtocolLiaison::with('user', 'city', 'location')
        //     ->whereIn('protocol_liaisontype_id', [1, 2, 3, 5])
        //     ->latest()->get();

        if ($request->module_name == GuestVistor::GUEST) {
            // $this->authorize('View By Guest');
            $data['guests'] = GuestVistor::where('type', 'GUEST')
                ->with('city:id,name')
                ->get();
            $data['moduleName'] = GuestVistor::GUEST;
            return view('new-admin.guest_vistors.index_guests', $data);
        } elseif ($request->module_name == GuestVistor::VISTORS) {
            // $this->authorize('View By Visitors');
            $data['visitors'] = GuestVistor::where('type', 'VISTORS')
                ->with('city:id,name')
                ->get();
            $data['moduleName'] = GuestVistor::VISTORS;
            return view('admin.guest_vistors.index_visitors', $data);
        }
    }
    public function updateCardCounts(Request $request)
    {
        $latestRecords = GuestVistor::select('cnic', \DB::raw('MAX(created_at) as latest_created_at'))
            ->groupBy('cnic');
        $guestVisitors = GuestVistor::with('city', 'user', 'department', 'subdepartment', 'guest', 'city.province', 'attachments', 'visas')
            ->joinSub($latestRecords, 'latest_records', function ($join) {
                $join->on('guest_vistors.cnic', '=', 'latest_records.cnic')
                    ->on('guest_vistors.created_at', '=', 'latest_records.latest_created_at');
            })
            ->when($request->moduleNmae == GuestVistor::GUEST, function ($query) {
                $query->where('guest_vistors.type', GuestVistor::GUEST);
            })
            ->when($request->moduleNmae == GuestVistor::VISTORS, function ($query) {
                $query->where('guest_vistors.type', GuestVistor::VISTORS);
            })
            ->when($request->daterange, function ($query) use ($request) {
                $dates = explode(' to ', $request->daterange);
                if (count($dates) === 2) {
                    $query->whereBetween('guest_vistors.created_at', [$dates[0], $dates[1]]);
                }
            })
            ->when($request->sub_department, function ($query) use ($request) {
                $query->where('guest_vistors.sub_department_id', $request->sub_department);
            })
            ->when($request->department, function ($query) use ($request) {
                $query->where('guest_vistors.department_id', $request->department);
            })
            ->when($request->districts, function ($query) use ($request) {
                $query->whereHas('city', function ($query) use ($request) {
                    $query->whereIn('name', $request->districts);
                });
            })
            ->when($request->province, function ($query) use ($request) {
                $query->whereHas('city.province', function ($query) use ($request) {
                    $query->where('name', $request->province);
                });
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('guest_vistors.category', $request->category);
            })
            ->orderBy('guest_vistors.created_at', 'desc');
        $data['allMale'] = (clone $guestVisitors)->where('gender', 'Male')->count();
        $data['allFemale'] = (clone $guestVisitors)->where('gender', 'Female')->count();
        $data['baluchistanVisitor'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 1); // Baluchistan
        })->count();
        $data['baluchistanMale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 1); // Baluchistan
        })->where('gender', 'Male')->count();
        $data['baluchistanFemale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 1); // Baluchistan
        })->where('gender', 'Female')->count();

        $data['punjabVisitor'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 2); // Punjab
        })->count();
        $data['punjabMale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 2);
        })->where('gender', 'Male')->count();
        $data['punjabFemale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 2);
        })->where('gender', 'Female')->count();

        $data['sindhVisitor'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 3); // Sindh
        })->count();
        $data['sindhMale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 3);
        })->where('gender', 'Male')->count();
        $data['sindhFemale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 3);
        })->where('gender', 'Female')->count();

        $data['khyberVisitor'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 4); // Khyber PK
        })->count();
        $data['khyberMale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 4);
        })->where('gender', 'Male')->count();
        $data['khyberFemale'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 4);
        })->where('gender', 'Female')->count();

        $data['capitalVisitor'] = (clone $guestVisitors)->whereHas('city', function ($query) {
            $query->where('province_id', 5); // Capital
        })->count();


        $counts = [
            'totalGuests' => $guestVisitors->count(),
            'allMale' => $data['allMale'],
            'allFemale' => $data['allFemale'],
            'baluchistanVisitor' => $data['baluchistanVisitor'],
            'baluchistanMale' => $data['baluchistanMale'],
            'baluchistanFemale' => $data['baluchistanFemale'],
            'khyberVisitor' => $data['khyberVisitor'],
            'khyberMale' => $data['khyberMale'],
            'khyberFemale' => $data['khyberFemale'],
            'punjabVisitor' => $data['punjabVisitor'],
            'punjabMale' => $data['punjabMale'],
            'punjabFemale' => $data['punjabFemale'],
            'sindhVisitor' => $data['sindhVisitor'],
            'sindhMale' => $data['sindhMale'],
            'sindhFemale' => $data['sindhFemale'],
            // Add other necessary counts here
        ];
        return ['counts' => $counts];
    }
    public function getCnicDetails(Request $request)
    {
        $details = GuestVistor::with('user', 'department', 'subdepartment', 'guest', 'city.province', 'attachments', 'visas', 'pyrposeOfVisit')->where('cnic', $request->cnic)
            ->get();

        return response()->json($details);
    }
    public function filterVisits(Request $request)
    {
        $provinceName = $request->input('province');
        $departmentId = $request->input('department');
        $cityNames = $request->input('cities', []); // City names input

        // Get city IDs from city names
        $cityIds = [];
        if (!empty($cityNames)) {
            $cityIds = City::whereIn('name', $cityNames)->pluck('id')->toArray();
        }

        $provinceId = [];
        if (!empty($provinceName)) {
            $provinceId = Province::where('name', $provinceName)->pluck('id')->toArray();
        }

        $officialsQuery = ProtocolLiaison::where('protocol_liaisontype_id', 1);

        $notablesQuery = ProtocolLiaison::where('protocol_liaisontype_id', 2);

        $businessesQuery = ProtocolLiaison::where('protocol_liaisontype_id', 3);

        $customersQuery = GuestVistor::where('type', 'VISTORS');

        if (!empty($cityNames)) {
            $officialsQuery->whereIn('city_id', $cityIds);

            $notablesQuery->whereIn('city_id', $cityIds);

            $businessesQuery->whereIn('company_city', $cityNames);

            $customersQuery->whereIn('city_id', $cityIds);
        }
        if (!empty($provinceId)) {
            $officialsQuery->whereHas('city', function ($query) use ($provinceId) {
                $query->whereIn('province_id', $provinceId);
            });

            $notablesQuery->whereHas('city', function ($query) use ($provinceId) {
                $query->whereIn('province_id', $provinceId);
            });

            $customersQuery->whereIn('province_id', $provinceId);
        }
        if ($departmentId > 0) {
            $officialsQuery->where('department_id', $departmentId);
        }

        $officials = $officialsQuery->with('officialImage', 'department:id,name', 'city:id,name')
            ->withCount('visits')->get();
        $notables = $notablesQuery->with('officialImage', 'department:id,name', 'city:id,name')
            ->withCount('visits')->get();
        $businesses = $businessesQuery->with('officialImage', 'department:id,name', 'city:id,name', 'members')
            ->withCount('visits')->get();
        $visitors = $customersQuery->with('guest.officialImage', 'department:id,name', 'city:id,name')->get();

        // Group by CNIC and count the visits
        $customers = $visitors->groupBy('cnic')->map(function ($group) {
            // Take the first record of the group
            $visitor = $group->first();
            // Add the customer_visits count
            $visitor->customer_visits = $group->count();
            return $visitor;
        })->values();

        // Combine all data into a single collection
        $allData = $officials->merge($notables)->merge($businesses)->merge($customers);

        return response()->json([
            'success' => true,
            'message' => 'Data Fetched Successfully',
            'officials' => $officials,
            'notables' => $notables,
            'businesses' => $businesses,
            'customers' => $customers,
            'allData' => $allData,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module, $oldRecordCnic = null)
    {
        Cookie::queue('start_time_for_creating_guest_visit', Carbon::now());

        if ($oldRecordCnic) {
            $data['guestVisitors'] = GuestVistor::where('cnic', $oldRecordCnic)->where('type', $module)->first();
        }
        $this->authorize('Add Guest and Visitors');
        $data['departments'] = Department::whereStatus(1)->get();
        $data['purposeOfVisitors'] = PurposeOfVisit::whereStatus(1)->get();
        $data['provinces'] = Province::whereStatus(1)->get();
        $data['cities'] = City::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['guests'] = ProtocolLiaison::where('protocol_liaisontype_id', 1)->orWhere('protocol_liaisontype_id', 2)->get();
        $data['hosts'] = User::whereStatus(1)->where('role_id', '<>', 1)->where('employee_type', 'Regular')->get();
        if ($module == GuestVistor::GUEST) {
            $module = GuestVistor::GUEST;
        } elseif ($module == GuestVistor::VISTORS) {
            $module = GuestVistor::VISTORS;
        }

        $data['module'] = $module;
        return view('admin.guest_vistors.create', $data);
    }

    public function searchSuggestion(Request $request)
    {
        $cnic = $request->get('cnic');
        $category = $request->get('category');
        $guestVisitors = GuestVistor::where('category', $category)->where('cnic', 'LIKE', "%{$cnic}%")->pluck('cnic')->unique();

        return response()->json($guestVisitors);
    }

    public function getDetails(Request $request)
    {
        $cnic = $request->input('cnic');

        // Fetch the guest visitor details based on CNIC
        $visitor = GuestVistor::where('cnic', $cnic)->first();

        if ($visitor) {
            // Return the visitor details as JSON
            return response()->json([
                'cnic' => $visitor->cnic,
                'passport_number' => $visitor->passport_number,
                'vistor_name' => $visitor->vistor_name,
                'specialField' => $visitor->special_field,
                'address' => $visitor->address,
                'city_id' => $visitor->city_id,
                'vistor_contact' => $visitor->vistor_contact,
                'vistor_email' => $visitor->vistor_email,
                'date_time' => $visitor->date_time,
                'visitor_photo_url' => $visitor->image_url // Adjust if necessary
            ]);
        } else {
            // Return an error response if no visitor is found
            return response()->json(['error' => 'Visitor not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestVisitorStoreRequest $request)
    {

        $this->authorize('Add Guest and Visitors');
        $guest = $this->_storeGuestData($request);

        $croppedImage = $request->input('croppedImage');
        $fileName = null;

        if (filter_var($croppedImage, FILTER_VALIDATE_URL)) {
            // If the image is a URL, directly store it
            $guest->image_url = $croppedImage;
        } else {
            // If the image is a base64 string, process it
            $fileName = rand(1, 100000) . time() . '.' . 'png';
            $path = public_path('/visitor_photo/' . $fileName); // Define the path to save the image

            // Create an image instance from base64 and save it to the path
            $image = \Intervention\Image\Facades\Image::make($croppedImage)->save($path);

            $guest->image_name = $fileName;
            $guest->image_url = asset('/visitor_photo/' . $fileName);
        }

        $guest->update();

        return redirect()->route('guest-and-visitors.index', ['module_name' => GuestVistor::GUEST])->with('success', 'Data stored successfully.');
        // if ($request->type == GuestVistor::GUEST) {
        // } elseif ($request->type == GuestVistor::VISTORS) {

        //     $visitor = $this->_storeVisitorData($request);
        //     if ($request->has('visitor_photo')) {
        //         $extension = $request->visitor_photo->getClientOriginalExtension();
        //         $fileName = rand(1, 100000) . time() . '.' . $extension;
        //         $request->visitor_photo->move(public_path('visitor_photo'), $fileName);
        //         $url = asset('/visitor_photo/' . $fileName);
        //         $visitor->image_name = $fileName;
        //         $visitor->image_url = $url;
        //         $visitor->update();
        //     }
        //     return redirect()->route('guest-and-visitors.index', ['module_name' => GuestVistor::VISTORS])->with('success', 'Visitor Data stored successfully.');
        // }

        // return redirect()->route('guest-and-visitors.index')->with('error', 'Something went wrong.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View Guest and Visitors');
        $data['guest_visitor'] = GuestVistor::with('user', 'host', 'department', 'guest')->findOrFail($id);

        return view('admin.guest_vistors.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit Guest and Visitors');
        $data['departments'] = Department::whereStatus(1)->get();
        $data['provinces'] = Province::whereStatus(1)->get();
        $data['cities'] = City::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['guests'] = ProtocolLiaison::where('protocol_liaisontype_id', 1)->orWhere('protocol_liaisontype_id', 2)->get();
        $data['hosts'] = User::whereStatus(1)->where('role_id', '<>', 1)->where('employee_type', 'Regular')->get();
        $data['guest_visitor'] = GuestVistor::findOrFail($id);
        $data['purposeOfVisitors'] = PurposeOfVisit::whereStatus(1)->get();

        return view('admin.guest_vistors.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuestVisitorUpdateRequest $request, $id)
    {
        $this->authorize('Edit Guest and Visitors');
        if ($request->type == GuestVistor::GUEST) {
            $this->_updateGuestData($request, $id);
            return redirect()->route('guest-and-visitors.index', ['module_name' => GuestVistor::GUEST])->with('success', 'Guest Data stored successfully.');
        } elseif ($request->type == GuestVistor::VISTORS) {
            $visitor = $this->_updateVistorData($request, $id);
            if ($request->has('visitor_photo')) {
                $extension = $request->visitor_photo->getClientOriginalExtension();
                $fileName = rand(1, 100000) . time() . '.' . $extension;
                $request->visitor_photo->move(public_path('visitor_photo'), $fileName);
                $url = asset('/visitor_photo/' . $fileName);
                $visitor->image_name = $fileName;
                $visitor->image_url = $url;
                $visitor->update();
            }
            return redirect()->route('guest-and-visitors.index', ['module_name' => GuestVistor::VISTORS])->with('success', 'Visitor Data stored successfully.');
        }

        return redirect()->route('guest-and-visitors.index', ['module_name' => GuestVistor::GUEST])->with('error', 'Something went wrong.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete Guest and Visitors');
        GuestVistor::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data deleted successfully.');
    }

    private function _storeGuestData(Request $request)
    {
        $no_visa = GuestVistor::where('cnic', $request->cnic)->count();
        $data = GuestVistor::Create([
            'category' => $request->category,
            'cnic' => $request->cnic,
            'passport_number' => $request->passport_number,
            'vistor_name' => $request->vistor_name,
            'special_field' => $request->specialField,      //
            'address' => $request->address,
            'city_id' => $request->city_id,
            'vistor_contact' => $request->vistor_contact,
            'vistor_email' => $request->vistor_email,
            'date_time' => $request->date_time,     //
            'no_visa' => $no_visa + 1,
            // 'guest_id' => $request->guest_id,
            'purpose_of_visit_id' => ($request->purpose_of_visit_id != 'Please Select') ? $request->purpose_of_visit_id : null,
            'department_id' => ($request->department_id != 'Select Department') ? $request->department_id : null,
            'sub_department_id' => ($request->sub_department_id != 'Select Sub Department') ? $request->sub_department_id : null,
            'gender' => ($request->gender != 'Select Gender') ? $request->gender : null,
            'dob' => $request->dob,
            // 'location_id' => $request->location_id,
            // 'lat' => $request->lat,
            // 'lng' => $request->lng,
            // 'host_id' => $request->host_id,
            // 'time_in' => Cookie::get('start_time_for_creating_guest_visit'),
            // 'time_out' => Carbon::now(),
            // 'notes' => $request->notes,
            // 'user_id' => Auth::id(),
            // 'currency' => $request->currency,
            // 'fee' => $request->fee ?: 0,
        ]);

        Cookie::forget('start_time_for_creating_guest_visit');

        return $data;
    }

    private function _storeVisitorData(Request $request)
    {
        $data = GuestVistor::Create([
            'cnic' => $request->cnic,
            'type' => $request->type,
            'purpose_of_visit_id' => ($request->purpose_of_visit_id != 'Please Select') ? $request->purpose_of_visit_id : 0,
            'passport_number' => $request->passport_number,
            'vistor_name' => $request->vistor_name,
            'vistor_email' => $request->vistor_email,
            'vistor_contact' => $request->vistor_contact,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'department_id' => $request->department_id,
            'location_id' => $request->location_id,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'host_id' => $request->host_id,
            'time_in' => Cookie::get('start_time_for_creating_guest_visit'),
            'time_out' => Carbon::now(),
            'notes' => $request->notes,
            'user_id' => Auth::id(),
            'currency' => $request->currency,
            'fee' => $request->fee ?: 0,
        ]);

        Cookie::forget('start_time_for_creating_guest_visit');

        return $data;
    }

    private function _updateGuestData(Request $request, $id)
    {

        return GuestVistor::findOrFail($id)->update([
            'category' => $request->category,
            'cnic' => $request->cnic,
            'passport_number' => $request->passport_number,
            'vistor_name' => $request->vistor_name,
            'special_field' => $request->specialField,      //
            'address' => $request->address,
            'city_id' => $request->city_id,
            'vistor_contact' => $request->vistor_contact,
            'vistor_email' => $request->vistor_email,
            'date_time' => $request->date_time,     //
            // 'guest_id' => $request->guest_id,
            'purpose_of_visit_id' => ($request->purpose_of_visit_id != 'Please Select') ? $request->purpose_of_visit_id : null,
            'department_id' => ($request->department_id != 'Select Department') ? $request->department_id : null,
            'sub_department_id' => ($request->sub_department_id != 'Select Sub Department') ? $request->sub_department_id : null,
            'gender' => ($request->gender != 'Select Gender') ? $request->gender : null,
            'dob' => $request->dob,
            // 'location_id' => $request->location_id,
            // 'lat' => $request->lat,
            // 'lng' => $request->lng,
            // 'host_id' => $request->host_id,
            // 'time_in' => Cookie::get('start_time_for_creating_guest_visit'),
            // 'time_out' => Carbon::now(),
            // 'notes' => $request->notes,
            // 'user_id' => Auth::id(),
            // 'currency' => $request->currency,
            // 'fee' => $request->fee ?: 0,
        ]);
    }

    private function _updateVistorData(Request $request, $id)
    {
        $data = GuestVistor::findOrFail($id);
        $data->update([
            'category' => $request->category,
            'cnic' => $request->cnic,
            'passport_number' => $request->passport_number,
            'vistor_name' => $request->vistor_name,
            'special_field' => $request->specialField,      //
            'address' => $request->address,
            'city_id' => $request->city_id,
            'vistor_contact' => $request->vistor_contact,
            'vistor_email' => $request->vistor_email,
            'date_time' => $request->date_time,     //
            // 'guest_id' => $request->guest_id,
            'purpose_of_visit_id' => ($request->purpose_of_visit_id != 'Please Select') ? $request->purpose_of_visit_id : null,
            'department_id' => ($request->purpose_of_visit_id != 'Select Department') ? $request->purpose_of_visit_id : null,
            'gender' => ($request->gender != 'Select Gender') ? $request->gender : null,
            'dob' => $request->dob,
            // 'location_id' => $request->location_id,
            // 'lat' => $request->lat,
            // 'lng' => $request->lng,
            // 'host_id' => $request->host_id,
            // 'time_in' => Cookie::get('start_time_for_creating_guest_visit'),
            // 'time_out' => Carbon::now(),
            // 'notes' => $request->notes,
            // 'user_id' => Auth::id(),
            // 'currency' => $request->currency,
            // 'fee' => $request->fee ?: 0,
        ]);

        return $data;
    }

    public function getMainMapCoordinates($moduleType)
    {
        $coordinates = [];
        if ($moduleType == GuestVistor::GUEST) {
            $guestVisitors = $this->_getCoordinates(GuestVistor::GUEST);
            $index = 0;
            foreach ($guestVisitors as $guestData) {
                $coordinates[$index]['lat'] = (float) $guestData->lat;
                $coordinates[$index]['lng'] = (float) $guestData->lng;
                $coordinates[$index]['guest_name'] = (optional($guestData->guest)->official_name) ? ucfirst(optional($guestData->guest)->official_name) . '(Official)' : ucfirst(optional($guestData->guest)->notable_name) . '(Notable)';
                $coordinates[$index]['guest_email'] = (optional($guestData->guest)->official_email) ? ucfirst(optional($guestData->guest)->official_email) : ucfirst(optional($guestData->guest)->notable_email);
                $coordinates[$index]['host_name'] = optional($guestData->host)->full_name;
                $coordinates[$index]['host_email'] = optional($guestData->host)->email;
                $coordinates[$index]['department_name'] = optional($guestData->department)->name;
                $coordinates[$index]['purpose_of_visit'] = $guestData->purpose_of_visit;
                $coordinates[$index]['image_url'] = optional(optional($guestData->guest)->officialImage)->file_url;
                $coordinates[$index]['detail_url'] = route('guest-and-visitors.show', $guestData->id);

                $index++;
            }
        } elseif ($moduleType == GuestVistor::VISTORS) {
            $visitors = $this->_getCoordinates(GuestVistor::VISTORS);
            $index = 0;

            foreach ($visitors as $visitor) {
                $coordinates[$index]['lat'] = (float) $visitor->lat;
                $coordinates[$index]['lng'] = (float) $visitor->lng;
                $coordinates[$index]['id'] = $visitor->id;
                $coordinates[$index]['vistor_name'] = $visitor->vistor_name;
                $coordinates[$index]['vistor_contact'] = $visitor->vistor_contact;
                $coordinates[$index]['vistor_email'] = $visitor->vistor_email;
                $coordinates[$index]['purpose_of_visit'] = $visitor->purpose_of_visit;
                $coordinates[$index]['image_url'] = $visitor->image_url;
                $coordinates[$index]['detail_url'] = route('guest-and-visitors.show', $visitor->id);

                $index++;
            }
        }


        return response()->json([
            'status' => true,
            'cooridnates' => $coordinates
        ], 200);
    }

    private function _getCoordinates($type)
    {
        return GuestVistor::with('user', 'department', 'guest')->where('type', $type)->get();
    }

    public function report($guestVisitorId)
    {
        $data['guest_visitor'] = GuestVistor::with('user', 'host', 'department', 'guest')
            ->findOrFail($guestVisitorId);
        return view('admin.guest_vistors.report', $data);
    }

    public function generateReport($id)
    {
        $data['guest_visitor'] = GuestVistor::with('user', 'host', 'department', 'guest')->findOrFail($id);
        return view('admin.guest_vistors.print_report', $data);
    }
    public function checkCnic($cnic)
    {
        $guestVisitor = GuestVisitor::where('cnic', $cnic)->first();

        if ($guestVisitor) {
            return response()->json([
                'success' => true,
                'data' => $guestVisitor
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No visitor found with this CNIC.'
            ]);
        }
    }
    public function bulkUpload()
    {
        return view('new-admin.guest_vistors.bulkUpload');
    }
    public function downloadSample()
    {
        $sampleFile = public_path('sample/guest_visitors_sample.csv');
        return Response::download($sampleFile, 'guest_visitors_sample.csv');
    }
    public function bulkUploadPost(Request $request)
    {
        // Validate file type
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx',
        ]);

        try {
            // Process the uploaded file
            $data = Excel::import(new GuestVisitorsImport, $request->file('file'));

            return back()->with('success', 'Guest and Visitor data has been uploaded successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'There was an error uploading the file: ' . $e->getMessage());
        }
    }
    public function createOfficailForm($id)
    {
        // Retrieve the guest/visitor record by ID
        $guestVisitor = GuestVistor::findOrFail($id);

        // Retrieve the list of cities
        $cities = City::all();

        // Retrieve the purposes of the visit (assuming you have a PurposeOfVisit model)
        $purposes = PurposeOfVisit::all();

        // Retrieve the list of departments (assuming you have a Department model)
        $departments = Department::all();

        $subdepartments = SubDepartment::whereStatus(1)->get();


        // Pass guest/visitor, cities, purposes, and departments data to the view
        return view('new-admin.guest_vistors.create_form', compact('guestVisitor', 'cities', 'purposes', 'departments', 'subdepartments'));
    }
    public function updateForm(Request $request, $id)
    {
        $guestVisitor = GuestVistor::findOrFail($id);
        $guestVisitor->update($request->all());

        // Handle file upload (if any)
        if ($request->hasFile('photo')) {
            $guestVisitor->photo = $request->file('photo')->store('photos', 'public');
            $guestVisitor->save();
        }

        return back()->with('success', 'Record updated successfully!');
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        // Perform the bulk deletion
        GuestVistor::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Records deleted successfully.']);
    }
    public function export(Request $request)
    {
        $ids = $request->input('ids');
        $ids = explode(',', $ids);

        $guestVisitors = GuestVistor::whereIn('id', $ids)->get();

        // Use a package like Maatwebsite Excel or DOMPDF to handle export
        return Excel::download(new GuestVisitorsExport($guestVisitors), 'guest_visitors.xlsx');
    }
}
