<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Meeting extends Model
{
    use HasFactory,LogsActivity;
    protected $guarded = [];


    public function getHostCountAttribute(){
        return MeetingHostParticipant::where('meeting_id',$this->id)
            ->where('member_type','Host')
            ->count();
    }

    public function getHostsAttribute(){
        return MeetingHostParticipant::where('meeting_id',$this->id)
            ->where('member_type','Host')
            ->get();
    }

    public function getHostIdsAttribute(){
        return MeetingHostParticipant::where('meeting_id',$this->id)
            ->where('member_type','Host')
            ->pluck('member_id');
    }

    public function getParticipantIdsAttribute(){
        return MeetingHostParticipant::where('meeting_id',$this->id)
            ->where('member_type','Participant')
            ->pluck('member_id');
    }

    public function getParticipantCountAttribute(){
        return MeetingHostParticipant::where('meeting_id',$this->id)
            ->where('member_type','Participant')
            ->count();
    }

    public function getParticipantsAttribute(){
        return MeetingHostParticipant::where('meeting_id',$this->id)
            ->where('member_type','Participant')
            ->get();
    }

    public function hosts()
    {
        return $this->hasMany(MeetingHostParticipant::class,'meeting_id','id')->where('member_type','Host');
    }

    public function participants()
    {
        return $this->hasMany(MeetingHostParticipant::class,'meeting_id','id')->where('member_type','Participant');
    }


    public static function totalMeetings()
    {
        return Meeting::count();
    }

    public static function todayMeetings()
    {
        return Meeting::whereRaw("DATE_FORMAT(meeting_date_time, '%Y-%m-%d') = ?", [Carbon::today()->toDateString()])->count();
    }


    public static function totalPastMeetings()
    {
        return Meeting::whereRaw("DATE_FORMAT(meeting_date_time, '%Y-%m-%d') < ?", [Carbon::today()->toDateString()])->count();
    }

    public static function totalUpcommingMeetings()
    {
        return Meeting::whereRaw("DATE_FORMAT(meeting_date_time, '%Y-%m-%d') >= ?", [Carbon::today()->toDateString()])->count();
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

    public function location()
    {
        return $this->belongsTo(Location::class, 'meeting_location','id');
    }

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Meeting has been {$eventName} by ".optional(Auth::user())->full_name;
    }
}
