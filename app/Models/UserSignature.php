<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSignature extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'file_name',
        'file_type',
        'file_url',
    ];
}
