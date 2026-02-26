<?php

namespace Webkul\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'client_id',
        'project_type',
        'status',
        'start_date',
        'end_date',
        'expected_end_date',
        'actual_end_date',
        'manager_id',
        'owner_id',
        'priority',
        'team_type',
    ];

    protected $casts = [
        'start_date'        => 'date',
        'end_date'          => 'date',
        'expected_end_date' => 'date',
        'actual_end_date'   => 'date',
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Webkul\Contact\Models\Person::class, 'client_id');
    }

    public function manager(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Webkul\User\Models\User::class, 'manager_id');
    }

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Webkul\User\Models\User::class, 'owner_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }
}
