<?php

namespace App\Console\Commands;

use App\Models\Attandance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkAbsent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mark:absent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will mark absent of the user if there is no attendence marked';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('role_id', '!=', 1)->get();
        
        // Check if the previous day was Sunday
        if (Carbon::yesterday()->isSunday()) {
            return 0;
        }

        foreach ($users as $user) {
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
        }
        return 1;
    }
}
