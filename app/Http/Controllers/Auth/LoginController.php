<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Attandance;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Check if the user has already marked attendance for the previous day
        $existingAttendance = Attandance::where('user_id', $user->id)
            ->whereDate('date_time', Carbon::yesterday()->toDateString())
            ->first();

        if (!$existingAttendance) {
            // If attendance is not marked, mark the user as absent for the previous day
            Attandance::create([
                'user_id' => $user->id,
                'date_time' => Carbon::yesterday(),
                'attandance_status' => Attandance::ABESNET
            ]);
        }

        return redirect()->intended($this->redirectPath());
    }
}
