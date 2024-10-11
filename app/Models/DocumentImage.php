<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class DocumentImage extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public static function getCount(){
        return  DocumentImage::orderBy('id','desc')->first() ? DocumentImage::orderBy('id','desc')->first()->id+1 : 1;
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
        return "Document Attachment has been {$eventName} by ".optional(Auth::user())->full_name;
    }
}
