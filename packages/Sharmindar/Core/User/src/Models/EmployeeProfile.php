<?php

namespace Sharmindar\Core\User\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\UserProxy;

class EmployeeProfile extends Model
{
    protected $table = 'employee_profiles';

    protected $fillable = [
        'user_id',
        'job_title',
        'department_id',
        'reporting_manager_id',
        'joining_date',
        'skills',
        'experience_years',
        'salary_type',
        'salary_amount',
        'contact_number',
        'address',
    ];

    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }

    /**
     * Get the reporting manager.
     */
    public function manager()
    {
        return $this->belongsTo(UserProxy::modelClass(), 'reporting_manager_id');
    }
}
