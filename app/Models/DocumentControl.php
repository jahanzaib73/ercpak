<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class DocumentControl extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function documentTpye()
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id', 'id');
    }


    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public static function allDOcument()
    {
        return DocumentControl::count();
    }

    public static function todayDocuments()
    {
        return DocumentControl::whereDate('date',Carbon::today()->toDateString())->count();
    }

    public static function allExternal()
    {
        return DocumentControl::where('document_type','External')->count();
    }

    public static function todayExternal()
    {
        return DocumentControl::where('document_type','External')->whereDate('date',Carbon::today()->toDateString())->count();
    }

    public static function allInternal()
    {
        return DocumentControl::where('document_type','Internal')->count();
    }

    public static function todayInternal()
    {
        return DocumentControl::where('document_type','Internal')->whereDate('date',Carbon::today()->toDateString())->count();
    }

    // protected static function booted()
    // {
    //     if(!isSuperAdmin()){
    //         static::addGlobalScope('filterData', function (Builder $builder) {
    //             $builder->where('user_id', Auth::id());
    //         });
    //     }

    // }

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Document Control has been {$eventName} by ".optional(Auth::user())->full_name;
    }

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');
    }

}
