<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\City;
use App\Models\CostCenter;
use App\Models\Country;
use App\Models\Department;
use App\Models\Desigination;
use App\Models\Location;
use App\Models\Province;
use App\Models\User;
use App\Models\UserSignature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('All User Management');
        if ($request->ajax()) {

            $users = User::with('costCenter', 'designation', 'department', 'location', 'country', 'city', 'province')->latest();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($request) {
                    $btn = '';
                    if (Auth::user()->can('View User Management')) {
                        $btn = '<div class="d-flex align-items-center"><a href=' . route('users.show', $row->id) . ' title="Show Detail" class="btn ml-2 btn-eye-icon btn-sm edit"><i class="fa fa-eye"></i></a>';
                    }
                    if (Auth::user()->can('Edit User Management')) {
                        $btn .= ' | <a href=' . route('users.edit', $row->id) . ' title="Edit Record" class="btn bg-info btn-sm edit text-white_record text-white"><i class="fa fa-edit"></i></a>';
                    }
                    if (Auth::user()->can('Delete User Management')) {
                        $btn .= ' | <a href=' . route('users.delete', $row->id) . ' onclick="return confirm(\'Are you sure?\')" title="Delete Record" class="btn btn-danger my-1 btn-sm delete"><i class="fa fa-trash-o"></i></a>';
                    }
                    if (Auth::user()->can('Assign Permission')) {
                        $btn .= ' | <a href=' . route('permissions.index', $row->id) . ' title="Assign Permissions" class="btn btn-dark btn-sm"><i class=" mdi mdi-google-circles-extended"></i></a>';
                    }
                    if (Auth::user()->can('Assign Permission')) {
                        $btn .= ' | <a href=' . route('user-allowances.index', $row->id) . ' title="Add Allowances" class="btn btn-gray btn-sm"><i class=" mdi mdi-library-plus"></i></a>';
                    }

                    if ($row->status == User::ACTIVE && Auth::user()->can('Change User Status')) {
                        $btn .= ' | <a href=' . route('users.change.status', $row->id) . ' title="Current Status is active click to set inactive" class="btn btn-dark-black btn-sm"><i class=" mdi mdi-account-check"></i></a>';
                    } else if ($row->status == User::INACTIVE && Auth::user()->can('Change User Status')) {
                        $btn .= ' | <a href=' . route('users.change.status', $row->id) . ' title="Current Status is inactive click to set active" class="btn btn-danger btn-sm"><i class=" mdi mdi-close-circle-outline"></i></a></div>';
                    }
                    return $btn;
                })->addColumn('status', function ($row) use ($request) {

                    $status = '';
                    if ($row->status == User::ACTIVE) {
                        $status = '<span class="badge badge-danger">Active</span>';
                    } else if ($row->status == User::INACTIVE) {
                        $status = '<span class="badge badge-danger">Inactive</span>';
                    }

                    return $status;
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->toDateString();
                })
                ->addColumn('profile_pic_url', function ($row) {
                    return '<a href=' . ($row->profile_pic_url ? $row->profile_pic_url : asset('assets/images/users/avatar-1.jpg')) . ' target="_blank"><img width="50" src=' . ($row->profile_pic_url ? $row->profile_pic_url : asset('assets/images/users/avatar-1.jpg')) . ' alt="user profile picture" /></a>';
                })
                ->addColumn('full_name', function ($row) {
                    return $row->full_name;
                })->addColumn('created_by', function ($row) {
                    return optional($row->user)->full_name;
                })
                ->rawColumns(['action', 'status', 'profile_pic_url'])
                ->make(true);
        }

        $data = [];
        $data['allusers'] = User::getAllUsers();

        $data['activeUser'] = User::getAllActiveUsers();

        $data['inactiveUser'] = User::getAllIncativeUsers();

        $data['users'] = User::with('costCenter', 'designation', 'department', 'location', 'country', 'city', 'province')->latest()->get();

        return view('admin.user_management.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('Add User Management');
        $data['departments'] = Department::whereStatus('1')->get();
        $data['locations'] = Location::whereStatus('1')->get();
        $data['countries'] = Country::whereStatus('1')->get();
        $data['provinces'] = Province::whereStatus('1')->get();
        $data['cities'] = City::whereStatus('1')->get();
        $data['designations'] = Desigination::whereStatus('1')->get();
        $data['costCenters'] = CostCenter::whereStatus('1')->get();

        return view('admin.user_management.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->authorize('Add User Management');
        try {
            DB::beginTransaction();
            $data = $request->except('password', 'profile_pic');
            $data['password'] = Hash::make(trim($request->password));
            if ($request->has('profile_pic')) {
                $fileName = rand(1, 100000) . time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(public_path('user_profile'), $fileName);
                $url = asset('/user_profile/' . $fileName);
                $data['profile_pic_name'] = $fileName;
                $data['profile_pic_url'] = $url;
            }
            User::create($data);

            DB::commit();
            return redirect()->route('users.index')->with('success', 'User stored successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View User Management');
        $data['user'] = User::with('assignTaksIds.task', 'timelines', 'designation', 'department', 'location', 'country', 'city', 'province')->findOrFail($id);
        return view('admin.user_management.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('Edit User Management');
        $data['departments'] = Department::whereStatus('1')->get();
        $data['locations'] = Location::whereStatus('1')->get();
        $data['countries'] = Country::whereStatus('1')->get();
        $data['provinces'] = Province::whereStatus('1')->get();
        $data['cities'] = City::whereStatus('1')->get();
        $data['designations'] = Desigination::whereStatus('1')->get();
        $data['user'] = User::findOrFail($id);
        $data['costCenters'] = CostCenter::whereStatus('1')->get();
        return view('admin.user_management.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->authorize('Edit User Management');
        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);

            $data = $request->except('password', 'profile_pic');
            if ($request->has('profile_pic')) {
                $fileName = rand(1, 100000) . time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(public_path('user_profile'), $fileName);
                $url = asset('/user_profile/' . $fileName);
                $data['profile_pic_name'] = $fileName;
                $data['profile_pic_url'] = $url;
            }

            if (!empty($request->password))
                $data['password'] = Hash::make(trim($request->password));
            $user->update($data);

            DB::commit();
            return redirect()->back()->with('success', 'User updated successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('Delete User Management');
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function changeStatus($id)
    {
        $this->authorize('Change User Status');
        $user = User::findOrFail($id);
        $user->update([
            'status' => !$user->status
        ]);
        return redirect()->back()->with('success', 'User Status changed successfully.');
    }
    public function signature(Request $request)
    {
        if ($request->has('file') && !UserSignature::where('user_id', auth()->id())->exists()) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $file->move(public_path('user_signature'), $fileName);
            $url = asset('/user_signature/' . $fileName);
            $type = $extension;
            UserSignature::create([
                'user_id' => auth()->id(),
                'file_name' => $fileName,
                'file_type' => $type,
                'file_url' => $url,
            ]);
            return redirect()->back()->with('success', 'Signature added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
    public function updateSignature(Request $request)
    {
        if ($request->has('file') && UserSignature::where('user_id', auth()->id())->exists()) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = rand(1, 100000) . time() . '.' . $extension;
            $file->move(public_path('user_signature'), $fileName);
            $url = asset('/user_signature/' . $fileName);
            $type = $extension;
            $userSign = UserSignature::where('user_id', auth()->id())->first();
            $userSign->update([
                'file_name' => $fileName,
                'file_type' => $type,
                'file_url' => $url,
            ]);
            return redirect()->back()->with('success', 'Signature updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function getProfile()
    {
        $data['departments'] = Department::whereStatus('1')->get();
        $data['locations'] = Location::whereStatus('1')->get();
        $data['countries'] = Country::whereStatus('1')->get();
        $data['provinces'] = Province::whereStatus('1')->get();
        $data['cities'] = City::whereStatus('1')->get();
        $data['designations'] = Desigination::whereStatus('1')->get();
        $data['costCenters'] = CostCenter::whereStatus('1')->get();
        $data['user'] = User::findOrFail(Auth::id());
        $data['userSignature'] = UserSignature::where('user_id', auth()->id())->first();
        return view('admin.user_management.users.profile', $data);
    }


    public function editProfile()
    {
        $data['departments'] = Department::whereStatus('1')->get();
        $data['locations'] = Location::whereStatus('1')->get();
        $data['countries'] = Country::whereStatus('1')->get();
        $data['provinces'] = Province::whereStatus('1')->get();
        $data['cities'] = City::whereStatus('1')->get();
        $data['designations'] = Desigination::whereStatus('1')->get();
        $data['costCenters'] = CostCenter::whereStatus('1')->get();
        $data['user'] = User::findOrFail(Auth::id());
        return view('admin.user_management.users.editProfileForm', $data);
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail(Auth::id());

            $data = $request->except('password', 'profile_pic');
            if ($request->has('profile_pic')) {
                $fileName = rand(1, 100000) . time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(public_path('user_profile'), $fileName);
                $url = asset('/user_profile/' . $fileName);
                $data['profile_pic_name'] = $fileName;
                $data['profile_pic_url'] = $url;
            }

            if (!empty($request->password))
                $data['password'] = Hash::make(trim($request->password));
            $user->update($data);

            DB::commit();
            return redirect()->route('users.get.profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('users.get.profile')->with('error', $ex->getMessage());
        }
    }
}
