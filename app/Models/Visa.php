<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable = ['photo', 'name', 'cnic', 'passport', 'attachment', 'guest_visitor_id','city_id'];

    public function guestVisitor()
    {
        return $this->belongsTo(GuestVistor::class);
    }
}
