<?php

namespace Sharmindar\Core\Department\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use \Sharmindar\Core\Activity\Traits\Auditable;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'code',
        'manager_id',
        'parent_id',
    ];
}
