<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InpectionItemChecklist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inspectionItem()
    {
        return $this->belongsTo(InspectionChecklist::class, 'inspection_checklist_id','id');
    }
}
