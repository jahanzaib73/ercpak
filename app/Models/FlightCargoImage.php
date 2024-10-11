<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class FlightCargoImage extends Model
{
    use HasFactory,LogsActivity;
    protected $guarded = [];

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
        return "Flight and Cargo Attachment has been {$eventName} by ".optional(Auth::user())->full_name;
    }
}
