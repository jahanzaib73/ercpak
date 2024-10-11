<?php

namespace App\Http\Controllers\Admin\ProjectManagement;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseAttachment;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $taskIds = ProjectTask::where('project_id', $request->project_id)->pluck('id');

            $expenses = Expense::with('vendor', 'task', 'user', 'attachments')->whereIn('task_id', $taskIds)->latest();
            return DataTables::eloquent($expenses)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $status = '';
                    if ($row->pyment_status == 'Paid') {
                        $status = '<span class="badge badge-danger">Paid</span>';
                    } elseif ($row->pyment_status == 'Unpaid') {
                        $status = '<span class="badge badge-danger">Unpaid</span>';
                    } elseif ($row->pyment_status == 'Hold') {
                        $status = '<span class="badge badge-danger">Hold</span>';
                    }
                    return $status;
                })->addColumn('vendor', function ($row) {
                    return optional($row->vendor)->name;
                })->addColumn('action', function ($row) {
                    $btn = '';

                    $btn .= '<button class="btn save-btn btn-sm showAttachments" data-id=' . $row->id . '>Show Attachments</button>';


                    if (Auth::user()->can('Edit Expenses')) {
                        $btn .= ' | <a href="javascript:void(0)" data-id=' . $row->id . '  class="expenseEdit btn bg-info btn-sm edit text-white"><i class="fa fa-pencil"></i></a>';
                    }
                    if (Auth::user()->can('Delete Expenses')) {
                        $btn .= ' | <a href=' . route('expense.delete', ['id' => $row]) . ' onclick="return confirm(\'Are You Sure?\')" data-toggle="tooltip" data-original-title="Show" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                    }


                    return $btn;
                })->addColumn('amount', function ($row) {
                    return $row->amount . ' ' . optional($row->currency)->name;
                })->addColumn('user', function ($row) {
                    return  optional($row->user)->full_name;
                })->addColumn('task', function ($row) {
                    return  optional($row->task)->task_name;
                })->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function update(Request $request)
    {
        $this->authorize('Edit Expenses');

        try {
            DB::beginTransaction();
            $expense = Expense::findOrFail($request->id);

            $expense->update([
                'date' => $request->date,
                'bill_number' => $request->bill_number,
                'vendor_id' => $request->vendor_id,
                'task_id' => $request->task_id,
                'amount' => $request->amount,
                'pyment_status' => $request->payment_status,
                'description' => $request->description,
                'description_arabic' => $request->description_arabic,
            ]);

            if ($request->has('files')) {
                foreach ($request->file('files') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('expense_attachment'), $fileName);
                    $url = asset('/expense_attachment/' . $fileName);
                    $type = $extension;
                    ExpenseAttachment::create([
                        'file_name' => $fileName,
                        'file_type' => $type,
                        'file_url' => $url,
                        'expense_id' => $expense->id,
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Expense Added Successfully',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }
    public function store(Request $request)
    {
        $this->authorize('Add Expenses');

        try {
            DB::beginTransaction();
            $expense = Expense::create([
                'date' => $request->date,
                'bill_number' => $request->bill_number,
                'vendor_id' => $request->vendor_id,
                'task_id' => $request->task_id,
                'amount' => $request->amount,
                'pyment_status' => $request->payment_status,
                'description' => $request->description,
                'description_arabic' => $request->description_arabic,
            ]);

            if ($request->has('files')) {
                foreach ($request->file('files') as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(1, 100000) . time() . '.' . $extension;
                    $file->move(public_path('expense_attachment'), $fileName);
                    $url = asset('/expense_attachment/' . $fileName);
                    $type = $extension;
                    ExpenseAttachment::create([
                        'file_name' => $fileName,
                        'file_type' => $type,
                        'file_url' => $url,
                        'expense_id' => $expense->id,
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Expense Added Successfully',
            ], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function delete($id)
    {
        $this->authorize('Delete Expenses');

        Expense::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Expense Deleted SUccessfully');
    }

    public function expenseById(Request $request)
    {
        $expense = Expense::with('vendor', 'task', 'user', 'attachments')->findOrFail($request->expense_id);
        return response()->json([
            'status' => true,
            'message' => 'Expense Fatched Successfully',
            'data' => $expense
        ], 200);
    }

    public function expenseAttachment(Request $request)
    {
        $expense = Expense::with('vendor', 'task', 'user', 'attachments')->findOrFail($request->expenseId);

        return response()->json([
            'status' => true,
            'message' => 'Expense Fetched Successfully',
            'data' => [
                'expense' => $expense,
                'attachments' => $expense->attachments,
            ],
        ], 200);
    }
}
