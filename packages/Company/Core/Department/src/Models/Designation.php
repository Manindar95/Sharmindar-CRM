<?php

namespace Company\Core\Department\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $table = 'designations';

    protected $fillable = [
        'name',
        'code',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
