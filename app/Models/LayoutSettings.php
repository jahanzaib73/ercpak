<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayoutSettings extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'settings'];
}
