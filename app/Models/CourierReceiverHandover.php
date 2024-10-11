<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierReceiverHandover extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id','id');
    }
}
