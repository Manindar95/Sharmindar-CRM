<?php

namespace Sharmindar\Core\Department\Models;

use Illuminate\Database\Eloquent\Model;

class ReportingStructure extends Model
{
    protected $table = 'reporting_structures';

    protected $fillable = [
        'designation_id',
        'reports_to_designation_id',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class , 'designation_id');
    }

    public function reportsTo()
    {
        return $this->belongsTo(Designation::class , 'reports_to_designation_id');
    }
}
