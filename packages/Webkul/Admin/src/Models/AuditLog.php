<?php

namespace Webkul\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\UserProxy;

class AuditLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'action',
        'method',
        'url',
        'ip_address',
        'user_agent',
        'payload',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'payload' => 'array',
    ];

    /**
     * Get the user that owns the audit log.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }
}
