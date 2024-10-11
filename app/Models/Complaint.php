<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Complaint extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;

    protected $guarded = [];


    public function complaintType()
    {
        return $this->belongsTo(ComplaintType::class, 'complaint_type_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function totalComplaints()
    {
        return Complaint::whereNull('deleted_at')->count();
    }

    public static function todayComplaints()
    {
        return Complaint::whereDate('complaint_date',Carbon::today()->toDateString())->whereNull('deleted_at')->count();
    }

    public static function totalCompletedComplaints()
    {
        return Complaint::whereStatus(1)->whereNull('deleted_at')->count();
    }

    public static function todayCompletedComplaints()
    {
        return Complaint::whereStatus(1)->whereDate('completed_date',Carbon::today()->toDateString())->whereNull('deleted_at')->count();
    }

    public static function totalPendingComplaints()
    {
        return Complaint::whereStatus(0)->whereNull('deleted_at')->count();
    }

    public static function todayPendingComplaints()
    {
        return Complaint::whereStatus(0)->whereDate('complaint_date',Carbon::today()->toDateString())->whereNull('deleted_at')->count();
    }

    public function complaintName()
    {
        if($this->complaint_person_type == 'EMPLOYEE'){
            return $this->belongsTo(User::class, 'complaint_person_id', 'id');
        }else{

            return $this->belongsTo(ProtocolLiaison::class, 'complaint_person_id', 'id');
        }
    }

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Complaint has been {$eventName} by ".optional(Auth::user())->full_name;
    }
}
