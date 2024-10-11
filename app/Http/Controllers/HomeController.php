<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use App\Models\CourierReceiverHandover;
use App\Models\Department;
use App\Models\Fuel;
use App\Models\GuestVistor;
use App\Models\LayoutSettings;
use App\Models\ProtocolLiaison;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $couriers = [];
        $couriers['myCouries'] = CourierReceiverHandover::with('courier')->where('user_id', Auth::user()->id)->where('type', 'RECEIVER')->get();
        $couriers['handovers'] = CourierReceiverHandover::with('courier')->where('user_id', Auth::user()->id)->where('type', 'HANDOVER')->get();

        // return view('home', $couriers);
        return view('new-admin.dashboard.index', $couriers);

    }

    function getRecentActivities(Request $request)
    {
        $recentActivities = Activity::latest();
        return DataTables::of($recentActivities)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($request) {
                // $moduleName = explode('\\',$row->subject_type)[2];
                $url = '';
                // if($moduleName == 'MeetingHostParticipant'){
                //     $url = route('meet')
                // }
                $btn = '';
                // $btn .= '<a href='.route('meetings.show',$row->id).' title="Show Detail" class="btn btn-info btn-sm show"><i class="fa fa-eye"></i></a>';
                return $btn;
            })
            ->addColumn('subject_type', function ($row) {
                $moduleNameArray = explode('\\', $row->subject_type);
                return $moduleNameArray[2];
            })->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->toDateTimeString();
            })->addColumn('causer_id', function ($row) {
                $user = User::whereId($row->causer_id)->first();
                return '<a target="_blank" href=' . route('users.show', $row->causer_id ?: 0) . '>' . optional($user)->full_name . '</a>';
            })->rawColumns(['action', 'causer_id'])
            ->make(true);
    }


    public function fetchProtocolLiaisonDashboardData()
    {
        $coordinates = [];
        $iconArrays = [];
        $protcolLiaisons = $this->_getCoordinates();

        $index = 0;
        foreach ($protcolLiaisons as $protocol) {

            if ($protocol->protocol_liaisontype_id == 1) {

                $coordinates[$index]['lat'] = (float)$protocol->official_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->official_google_map_lng;
                $coordinates[$index]['email'] = $protocol->official_email;
                $coordinates[$index]['name'] = $protocol->official_name;
                $coordinates[$index]['designation'] = $protocol->official_designation;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $coordinates[$index]['type'] = $protocol->protocol_liaisontype_id;
                $coordinates[$index]['created_by'] = optional($protocol->user)->full_name;
                $index++;
            } else if ($protocol->protocol_liaisontype_id == 2) {

                $coordinates[$index]['lat'] = (float)$protocol->notable_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->notable_google_map_lng;
                $coordinates[$index]['email'] = $protocol->notable_email;
                $coordinates[$index]['name'] = $protocol->notable_name;
                $coordinates[$index]['city'] = $protocol->notable_city;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $coordinates[$index]['type'] = $protocol->protocol_liaisontype_id;
                $coordinates[$index]['Created_by'] = optional($protocol->user)->full_name;
                $index++;
            } else if ($protocol->protocol_liaisontype_id == 3) {

                $coordinates[$index]['lat'] = (float)$protocol->company_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->company_google_map_lng;
                $coordinates[$index]['name'] = $protocol->company_name;
                $coordinates[$index]['email'] = $protocol->company_email;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $coordinates[$index]['type'] = $protocol->protocol_liaisontype_id;
                $coordinates[$index]['Created_by'] = optional($protocol->user)->full_name;
                $index++;
            } else if ($protocol->protocol_liaisontype_id == 4) {

                $coordinates[$index]['lat'] = (float)$protocol->project_google_map_lat;
                $coordinates[$index]['lng'] = (float)$protocol->project_google_map_lng;
                $coordinates[$index]['name'] = $protocol->project_name;
                $coordinates[$index]['email'] = $protocol->project_email;
                $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                $coordinates[$index]['type'] = $protocol->protocol_liaisontype_id;
                $coordinates[$index]['Created_by'] = optional($protocol->user)->full_name;
                $index++;
            } else if ($protocol->protocol_liaisontype_id == 5) {

                foreach ($protcolLiaisons as $protocol) {
                    $coordinates[$index]['lat'] = (float)$protocol->property_google_map_lat;
                    $coordinates[$index]['lng'] = (float)$protocol->property_google_map_lng;
                    $coordinates[$index]['name'] = $protocol->property_name;
                    $coordinates[$index]['city'] = $protocol->property_city;
                    $coordinates[$index]['detail_url'] = route('protocol-and-liaisons.show', $protocol->id);
                    $coordinates[$index]['image_url'] = optional($protocol->officialImage)->file_url;
                    $coordinates[$index]['primary_number'] = $protocol->primaryNumber ? $protocol->primaryNumber()->first()->contact_numebr : 0;
                    $coordinates[$index]['type'] = $protocol->protocol_liaisontype_id;
                    $coordinates[$index]['Created_by'] = optional($protocol->user)->full_name;
                    $index++;
                }
            }
        }

        $iconArrays['company_icon'] = asset('dashboard_map_icons/company.png');
        $iconArrays['property_icon'] = asset('dashboard_map_icons/property.png');
        $iconArrays['project_icon'] = asset('dashboard_map_icons/project.png');
        $iconArrays['notable_icon'] = asset('dashboard_map_icons/notable.png');
        $iconArrays['official_icon'] = asset('dashboard_map_icons/official.png');
        return response()->json([
            'status' => true,
            'cooridnates' => $coordinates,
            'iconArrays' => $iconArrays,
        ], 200);
    }

    private function _getCoordinates()
    {
        return ProtocolLiaison::with('officialImage', 'primaryNumber')->get();
    }

    public function getRealTimeDataForPurposeOfVisitsAjax(Request $request)
    {

        $dateRange = request('date');

        [$startDateOld, $endDateOld] = explode(' - ', $dateRange);

        $startDate = Carbon::parse($startDateOld)->startOfDay();
        $endDate = Carbon::parse($endDateOld)->endOfDay();

        $allPurposes = DB::table('purpose_of_visits')
            ->select('id', 'name')
            ->whereStatus(1)
            ->get();

        $updatedData = [];

        foreach ($allPurposes as $purpose) {
            $visitCount = DB::table('guest_vistors')
                ->where('purpose_of_visit_id', $purpose->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();
          
            $maleCount = DB::table('guest_vistors')
                ->where('purpose_of_visit_id', $purpose->id)
                ->where('gender', 'Male')
                ->count();
          
            $femaleCount = DB::table('guest_vistors')
                ->where('purpose_of_visit_id', $purpose->id)
                ->where('gender', 'Female')
                ->count();          

            $feeSum = DB::table('guest_vistors')
                ->where('purpose_of_visit_id', $purpose->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('fee');

            // Create a new data structure with purpose information, visit count, and fee sum
            $updatedData[] = [
                'id' => $purpose->id,
                'name' => $purpose->name,
                'visit_count' => $visitCount,
                'fee_sum' => $feeSum,
                'male_count' => $maleCount,
                'female_count' => $femaleCount,
                'total_counts' => count($allPurposes),
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $updatedData
        ], 200);
    }


    public function getRealTimeDataFleetAjax(Request $request)
    {
        $dateRange = request('date');

        [$startDateOld, $endDateOld] = explode(' - ', $dateRange);

        $startDate = Carbon::parse($startDateOld)->startOfDay();
        $endDate = Carbon::parse($endDateOld)->endOfDay();

        $data['gatePass'] = Trip::whereStatus(Trip::CLOSED)->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('SUM(return_meetr_reading-exit_meetr_reading) as total_mileage,COUNT(*) as total_entries')
            ->first();

        $data['fuel'] = Fuel::whereBetween('date', [$startDate, $endDate])
            ->selectRaw('SUM(qty) as total_quantity, SUM(price*qty) as total_price, COUNT(*) as total_entries')
            ->first();
        $data['workOrders'] = WorkOrder::whereBetween('created_at', [$startDate, $endDate])->count();
        $data['vehicleMovement'] = Vehicle::whereStatus(Vehicle::ONMOVE)->count();

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function lineChartDataForCases()
    {
        // Initialize an array to hold the counts for each month
        $monthCounts = array_fill(0, 12, 0);
        $monthFeeCounts = array_fill(0, 12, 0);
        $currentYear = date("Y");

        // Query the database to get the counts for VISA and ATTESTATION
        $visaCounts = GuestVistor::selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(fee) as total_fee')
            ->whereYear('created_at', $currentYear)
            ->whereHas('pyrposeOfVisit', function ($query) {
                $query->where('type', 'VISA');
            })
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month', 'total_fee')
            ->toArray();

        $attestationCounts = GuestVistor::selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(fee) as total_fee')
            ->whereYear('created_at', $currentYear)
            ->whereHas('pyrposeOfVisit', function ($query) {
                $query->where('type', 'ATTESTATION');
            })
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month', 'total_fee')
            ->toArray();



        $visaFeeCounts = GuestVistor::selectRaw('MONTH(created_at) as month, SUM(fee) as total_fee')
            ->whereYear('created_at', $currentYear)
            ->whereHas('pyrposeOfVisit', function ($query) {
                $query->where('type', 'VISA');
            })
            ->groupBy('month')
            ->get()
            ->pluck('total_fee', 'month')
            ->toArray();

        $attestationFeeCounts = GuestVistor::selectRaw('MONTH(created_at) as month, SUM(fee) as total_fee')
            ->whereYear('created_at', $currentYear)
            ->whereHas('pyrposeOfVisit', function ($query) {
                $query->where('type', 'ATTESTATION');
            })
            ->groupBy('month')
            ->get()
            ->pluck('total_fee', 'month')
            ->toArray();


        $months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        $i = 1;
        foreach ($months as $index => $month) {
            $monthCounts[$i] = [
                'month' => $month,
                'visaCount' => $visaCounts[$i] ?? 0,
                'attestationCount' => $attestationCounts[$i] ?? 0,
            ];
            $i++;
        }

        $j = 1;
        foreach ($months as $index => $month) {
            $monthFeeCounts[$j] = [
                'month' => $month,
                'visaFeeCount' => $visaFeeCounts[$j] ?? 0,
                'attestationFeeCount' => $attestationFeeCounts[$j] ?? 0,
            ];
            $j++;
        }

        // dd( $monthFeeCounts, $monthCounts);
        return response()->json([
            'status' => true,
            'monthCounts' => $monthCounts,
            'monthFeeCounts' => $monthFeeCounts,
        ], 200);
    }

    public function getLayoutSettings(User $user)
    {
        $config = LayoutSettings::where('user_id', $user->id)->first('settings');
        return response()->json(['config' => $config]);
    }
    public function storeLayoutSettings(User $user, $settings)
    {
        $config = ['settings' => $settings];
        $config = json_encode($config);
        $layoutSettings = LayoutSettings::where('user_id', $user->id)->first();
        if ($layoutSettings) {
            $previousSettings = LayoutSettings::where('user_id', $user->id)->first('settings');
            $jsonResponse = json_decode($previousSettings->settings);
            if ($jsonResponse->settings == "2") {
                $myConfig = ['settings' => "1"];
                $myConfig = json_encode($myConfig);
                $response = $layoutSettings->update([
                    'settings' => $myConfig,
                ]);
            } else {
                $response = $layoutSettings->update([
                    'settings' => $config,
                ]);
            }
        } else {
            $response = LayoutSettings::create([
                'user_id' => $user->id,
                'settings' => $config,
            ]);
        }
        return response()->json(['settings' => $response]);
    }
}
