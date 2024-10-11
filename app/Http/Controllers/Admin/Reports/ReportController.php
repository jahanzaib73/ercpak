<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\CostCenter;
use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\GuestVistor;
use App\Models\PurposeOfVisit;
use App\Models\Trip;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function fuelSummaryReport(Request $request)
    {
        $this->authorize('Fuel Summary Report');
        $data['fuelSummaryReport'] = Fuel::with("vehicle", "fuelType", "costCenter", "fuelMan", "driver")
        ->when($request->filled('fuelType'), function ($query) use ($request) {
            $query->where('fuel_type_id', $request->fuelType);
        })
        ->when($request->filled('from_date'), function ($query) use ($request) {
            $query->whereDate('date', '>=', $request->from_date);
        })
        ->when($request->filled('to_date'), function ($query) use ($request) {
            $query->whereDate('date', '<=', $request->to_date);
        })->when($request->filled('vehicle_id'), function ($query) use ($request) {
            $query->where('vehicle_id', $request->vehicle_id);
        })->when($request->filled('costCenter'), function ($query) use ($request) {
            $query->where('cost_center_id', $request->costCenter);
        })
        ->get();

        $data['total'] = Fuel::getQtyPrie($request);
        $data['fuelTypes'] = FuelType::whereStatus(1)->get();
        $data['vehicles'] = Vehicle::get();
        $data['costCenter'] = CostCenter::whereStatus(1)->get();
        return view('admin.reports.fuel_summary_report',$data);
    }

    public function vehicleMovementReport(Request $request)
    {
        $this->authorize('Vehicle Movement');
        $data['tripReport'] = Trip::with("vehicle", "driver", "costCenter",'official')
        ->when($request->filled('driver_id'), function ($query) use ($request) {
            $query->where('driver_id', $request->driver_id);
        })
        ->when($request->filled('from_date'), function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->from_date);
        })
        ->when($request->filled('to_date'), function ($query) use ($request) {
            $query->whereDate('created_at', '<=', $request->to_date);
        })->when($request->filled('vehicle_id'), function ($query) use ($request) {
            $query->where('vehicle_id', $request->vehicle_id);
        })->when($request->filled('costCenter'), function ($query) use ($request) {
            $query->where('cost_center_id', $request->costCenter);
        })
        ->get();

        $data['total'] = Fuel::getQtyPrie($request);
        $data['drivers'] = User::whereIn('id',Trip::pluck('driver_id'))->get();
        $data['vehicles'] = Vehicle::get();
        $data['costCenter'] = CostCenter::whereStatus(1)->get();

        return view('admin.reports.vehicle_movement',$data);
    }

    public function guestCustomerReport(Request $request)
    {
        $this->authorize('Guest and Customer Report');

        $data['purposeOfVisitRecords'] = GuestVistor::with('pyrposeOfVisit')->when(!empty($request->visit), function ($query) use ($request) {
            return $query->where('purpose_of_visit_id', $request->visit);
        })
        ->when(!empty($request->filter), function ($query) use ($request) {
            switch ($request->filter) {
                case 'Today':
                    return $query->whereDate('created_at', today());
                case 'Yesterday':
                    return $query->whereDate('created_at', today()->subDay());
                case 'ThisWeek':
                    return $query->whereBetween('created_at', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                case 'LastWeek':
                    return $query->whereBetween('created_at', [
                        Carbon::now()->subWeek()->startOfWeek(),
                        Carbon::now()->subWeek()->endOfWeek()
                    ]);
                default:
                    return $query;
            }
        })
        ->when(!empty($request->from_date), function ($query) use ($request) {
            return $query->whereDate('created_at', '>=', $request->from_date);
        })
        ->when(!empty($request->to_date), function ($query) use ($request) {
            return $query->whereDate('created_at', '<=', $request->to_date);
        })
        ->select('purpose_of_visit_id',
            DB::raw('COUNT(*) as total_visitors'),
            DB::raw('SUM(fee) as total_fee'))
        ->groupBy('purpose_of_visit_id')
        ->get();


        // $result now contains the total number of visitors and total fee for each purpose_of_visit_id
        // dd($data);

        // $data['purposeOfVisitRecords'] = PurposeOfVisit::with('guestVisitors')->whereHas('guestVisitors', function ($query) use ($request) {
        //     if(!empty($request->visit)){
        //         $query->where('purpose_of_visit_id', $request->visit);
        //     }
        //     if (!empty($request->filter)&&$request->filter=='Today') {
        //         $query->whereDate('created_at', today());
        //     }
        //     if (!empty($request->filter)&&$request->filter=='YesterDay') {
        //         $query->whereDate('created_at', today()->subDay());
        //     }
        //     if (!empty($request->filter)&&$request->filter=='ThisWeek') {
        //         $query->whereBetween('created_at', [
        //             Carbon::now()->startOfWeek(),
        //             Carbon::now()->endOfWeek()
        //         ]);
        //     }
        //     if (!empty($request->filter)&&$request->filter=='LastWeek') {
        //         $query->whereBetween('created_at', [
        //             Carbon::now()->subWeek()->startOfWeek(),
        //             Carbon::now()->subWeek()->endOfWeek()
        //         ]);
        //     }

        //     if (!empty($request->from_date)) {
        //         // dump('in from_date');
        //         $query->whereDate('created_at', '>=', $request->from_date);
        //     }

        //     if (!empty($request->to_date)) {
        //         // dump('in from_date');
        //          $query->whereDate('created_at', '<=', $request->to_date);
        //     }

        // })->get();

        $data['purposOfVisits'] = PurposeOfVisit::whereStatus(1)->get();
        return view('admin.reports.guest_customer_report',$data);
    }

    public function guestCustomerMonthWiseReport(Request $request)
    {
        $this->authorize('Guest and Customer Monthly Report');
        $guestVisitors = GuestVistor::with('user','host','department','location','guest','pyrposeOfVisit')
        ->when($request->filled('customer_id'), function ($query) use ($request) {
            $query->where('purpose_of_visit_id', $request->customer_id);
        })
        ->when($request->filled('from_date'), function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->from_date);
        })
        ->when($request->filled('to_date'), function ($query) use ($request) {
            $query->whereDate('created_at', '<=', $request->to_date);
        })->get();


        // $dropdownData = [];
        // $index = 0;
        // foreach($guestVisitors as $guestRec)
        // {
        //     $dropdownData[$index]['id'] = $guestRec->id;
        //     $dropdownData[$index]['name'] = $this->getGuestName($guestRec);
        //     $index++;
        // }

        $data['purposeOfVisits'] = PurposeOfVisit::whereStatus(1)->get();
        $data['guestVisitorsData'] = $guestVisitors;
        return view('admin.reports.guest_customer_monthwise_report',$data);
    }


    private function getGuestName($guestRecord)
    {
        if($guestRecord->vistor_name){
            return $guestRecord->vistor_name;
        }else{
            if(isset($guestRecord->guest) && $guestRecord->guest->official_name){
                return $guestRecord->guest->official_name;
            }elseif(isset($guestRecord->guest) && $guestRecord->guest->notable_name){
                return $guestRecord->guest->notable_name;
            }
        }

    }
}
