<?php

namespace Sharmindar\Core\Activity\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\User\Models\User;

class LoginHistory extends Model
{
    protected $table = 'login_history';

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
        'status',
    ];

    /**
     * Get the user that owns the login history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
