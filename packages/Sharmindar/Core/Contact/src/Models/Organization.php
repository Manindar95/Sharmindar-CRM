<?php

namespace Sharmindar\Core\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\Attribute\Traits\CustomAttribute;
use Sharmindar\Core\Contact\Contracts\Organization as OrganizationContract;
use Sharmindar\Core\User\Models\UserProxy;

class Organization extends Model implements OrganizationContract
{
    use CustomAttribute;

    protected $casts = [
        'address' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'user_id',
    ];

    /**
     * Get persons.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persons()
    {
        return $this->hasMany(PersonProxy::modelClass());
    }

    /**
     * Get the user that owns the lead.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }
}
