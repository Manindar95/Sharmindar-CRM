<?php

namespace Company\Core\Department\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use \Company\Core\Activity\Traits\Auditable;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'code',
        'manager_id',
        'parent_id',
    ];
}
