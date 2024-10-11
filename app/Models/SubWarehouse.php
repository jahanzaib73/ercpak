<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SubWarehouse extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = [];

    public function mainWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'main_warehosue_id', 'id');
    }
    public function mainLocation()
    {
        return $this->belongsTo(Location::class, 'main_location_id', 'id');
    }

    public function newWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'new_warehosue_id', 'id');
    }
    public function newLocation()
    {
        return $this->belongsTo(Location::class, 'new_location_id', 'id');
    }

    public function recommandedBy()
    {
        return $this->belongsTo(User::class, 'recommanded_by', 'id');
    }
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function shifttedItems()
    {
        return $this->hasMany(WharehouseShfittedItem::class, 'subwarehouse_id', 'id');
    }
}
