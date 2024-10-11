<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Inspection extends Model
{
    use HasFactory, LogsActivity;

    const VEHICLE = 0;
    const ASSET = 1;

    const OPEN = 0;
    const CLOSED = 1;

    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function attachments()
    {
        return $this->hasMany(InspectionPhoto::class, 'inspection_id','id');
    }

    public function inspectionChecklistItems()
    {
        return $this->hasMany(InpectionItemChecklist::class, 'inspection_id','id');
    }

    public function inspectionBies()
    {
        return $this->hasMany(InspectionBy::class, 'inspection_id','id');
    }

    public function assignedTehnicians()
    {
        return $this->hasMany(Technician::class, 'inspection_id','id');
    }

    public function property()
    {
        return $this->belongsTo(ProtocolLiaison::class, 'property_id','id');
    }
}
