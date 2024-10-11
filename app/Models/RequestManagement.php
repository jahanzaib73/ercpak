<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestManagement extends Model
{
    use HasFactory;

    const NOTSTARTED = 0;
    const INPROGRESS = 1;

    const COMPLETED = 2;

    protected $guarded = [];

    public function requestType()
    {
        return $this->belongsTo(RequestType::class, 'request_type_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(RequestAttachment::class, 'request_id', 'id');
    }
}
