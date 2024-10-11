<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attandance extends Model
{
    use HasFactory;
    protected $guarded = [];

    const ABESNET = 0;
    const PRESENT = 1;
    const LEAVE = 2;
}
