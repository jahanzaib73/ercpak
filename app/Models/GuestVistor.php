<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GuestVistor extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    const GUEST = 'GUEST';
    const VISTORS = 'VISTORS';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function subdepartment()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function guest()
    {
        return $this->belongsTo(ProtocolLiaison::class, 'guest_id', 'id');
    }

    public static function allState()
    {
        return GuestVistor::count();
    }
    public static function blochistan()
    {
        return GuestVistor::where('province_id', 1)->count();;
    }
    public static function punjab()
    {
        return GuestVistor::where('province_id', 2)->count();;
    }
    public static function sindh()
    {
        return GuestVistor::where('province_id', 3)->count();;
    }
    public static function khyber()
    {
        return GuestVistor::where('province_id', 4)->count();;
    }
    public static function capital()
    {
        return GuestVistor::where('province_id', 5)->count();;
    }
    public static function todayAllState()
    {
        return GuestVistor::whereDate('created_at', Carbon::today()->toDateString())->count();
    }

    public static function paiChartAllData($moudleId)
    {
        return GuestVistor::where('type', $moudleId)->count();
    }

    public static function paiCHartTodayData($moudleId)
    {
        return GuestVistor::where('type', $moudleId)->whereDate('created_at', Carbon::today()->toDateString())->count();
    }

    public function pyrposeOfVisit()
    {
        return $this->belongsTo(PurposeOfVisit::class, 'purpose_of_visit_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(GuestVisitorAttachment::class, 'guest_visitor_id', 'id');
    }
    public function visas()
    {
        return $this->hasMany(Visa::class, 'guest_visitor_id', 'id');
    }
}
