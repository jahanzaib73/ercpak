<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GuestVisitorAttachment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    protected static function booted()
    {
        if(!isSuperAdmin()){
            static::addGlobalScope('filterData', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            });
        }

    }
}
