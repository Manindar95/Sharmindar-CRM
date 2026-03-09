<?php

namespace Sharmindar\Core\User\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Models\UserProxy;

class UserMeta extends Model
{
    protected $table = 'user_meta';

    protected $fillable = [
        'user_id',
        'key',
        'value',
    ];

    /**
     * Get the user that owns the meta.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }
}
