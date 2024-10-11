<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Remainders extends Model
{
    use HasFactory,LogsActivity;

    const UPCOMMING = 0;
    const COMPLATED = 1;
    const CANCELED = 2;

    protected $guarded = [];

    public static function totalRemainders()
    {
        return Remainders::count();
    }

    public static function todayRemainders()
    {
        return Remainders::whereDate('created_at',Carbon::today()->toDateString())->count();
    }

    public static function totalCompletedRemainders()
    {
        return Remainders::whereStatus(1)->count();
    }

    public static function todayCompletedRemainders()
    {
        return Remainders::whereStatus(1)->whereDate('updated_at',Carbon::today()->toDateString())->count();
    }

    public static function totalUpcommingRemainders()
    {
        return Remainders::whereStatus(0)->count();
    }

    public static function todayUpcommingRemainders()
    {
        return Remainders::whereStatus(0)->whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d') >= ?", [Carbon::today()->toDateString()])->count();
    }

    public function remainderType()
    {
        return $this->belongsTo(RemainderType::class, 'remainder_type_id','id');
    }

    public function issuingAuthority()
    {
        return $this->belongsTo(IssuingAuthority::class, 'issuing_authority_id','id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    protected static function booted()
    {
        if(!isSuperAdmin()){
            static::addGlobalScope('filterData', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            });
        }

    }

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Remainder has been {$eventName} by ".optional(Auth::user())->full_name;
    }
}
