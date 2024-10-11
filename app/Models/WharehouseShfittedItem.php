<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WharehouseShfittedItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Inventory::class, 'item_id', 'id');
    }
}
