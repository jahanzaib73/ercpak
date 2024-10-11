<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InspectionChecklist;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\SubWarehouse;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WharehouseShfittedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ShiftWarehouseController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('All Shift Warehouses');
        if ($request->ajax()) {
            $subWarehouses = SubWarehouse::with('mainWarehouse', 'mainLocation', 'newWarehouse', 'newLocation', 'recommandedBy', 'approvedBy', 'createdBy')->latest();

            return DataTables::of($subWarehouses)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';

                    if (Auth::user()->can('View Shift Warehouses')){
                    $btn .= '<a href=' . route('shift.warehosue.show', $row->id) . ' title="Show Detail" class="btn btn-eye-icon btn-sm show"><i class="fa fa-eye"></i></a>';
                    }
                    return $btn;
                })
                ->addColumn('mainWarehouse', function ($row) {
                    return optional($row->mainWarehouse)->name;
                })->addColumn('mainLocation', function ($row) {
                    return optional($row->mainLocation)->name;
                })->addColumn('newWarehouse', function ($row) {
                    return optional($row->newWarehouse)->name;
                })->addColumn('newLocation', function ($row) {
                    return optional($row->newLocation)->name;
                })->addColumn('recommandedBy', function ($row) {
                    return optional($row->recommandedBy)->full_name;
                })->addColumn('approvedBy', function ($row) {
                    return optional($row->approvedBy)->full_name;
                })->addColumn('createdBy', function ($row) {
                    return optional($row->createdBy)->full_name;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.shiftwarehouses.index');
    }

    public function create()
    {
        $this->authorize('Add Shift Warehouses');

        $data = [];
        $data['warehouses'] = Warehouse::whereStatus(1)->get();
        $data['locations'] = Location::whereStatus(1)->get();
        $data['inventories'] = Inventory::whereStatus(1)->get();
        $data['users'] = User::whereStatus(1)->get();
        $data['items'] = Inventory::whereStatus(1)->get();
        return view('admin.shiftwarehouses.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Add Shift Warehouses');

        $request->validate([
            'inspection_items.*' => ['required'],
            'qty.*' => ['required'],
            'store_qty.*' => ['required'],
            'remarks.*' => ['required'],
        ]);
        try {
            DB::beginTransaction();

            $subwareHouse = SubWarehouse::create([
                'main_warehosue_id' => $request->main_warehouse_id,
                'main_location_id' => $request->main_location_id,
                'new_warehosue_id' => $request->sub_warehouse_id,
                'new_location_id' => $request->sub_location_id,
                'recommanded_by' => $request->recommanded_by,
                'approved_by' => $request->approved_by,
                'date' => $request->date,
                'notes' => $request->notes,
                'user_id' => Auth::id(),
            ]);

            for ($i = 0; $i < count($request->inspection_items); $i++) {
                WharehouseShfittedItem::create([
                    'item_id' => $request['inspection_items'][$i],
                    'item_assigned_qty' => $request['store_qty'][$i],
                    'item_remarks' => $request['remarks'][$i],
                    'subwarehouse_id' => $subwareHouse->id,
                ]);
            }


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Item Shiftted Successfully!',
                'url' => route('shift.warehosue.index')
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            // dd($exception);
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'stack' => $exception
            ], 500);
        }
    }

    public function show($id)
    {
        $this->authorize('View Shift Warehouses');
        $data = [];
        $data['subwarehosue'] = SubWarehouse::with('shifttedItems.item', 'mainWarehouse', 'mainLocation', 'newWarehouse', 'newLocation', 'recommandedBy', 'approvedBy', 'createdBy')->findOrFail($id);

        return view('admin.shiftwarehouses.show', $data);
    }
}
