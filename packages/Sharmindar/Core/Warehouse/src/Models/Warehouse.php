<?php

namespace Sharmindar\Core\Warehouse\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\Activity\Models\ActivityProxy;
use Sharmindar\Core\Activity\Traits\LogsActivity;
use Sharmindar\Core\Attribute\Traits\CustomAttribute;
use Sharmindar\Core\Tag\Models\TagProxy;
use Sharmindar\Core\Warehouse\Contracts\Warehouse as WarehouseContract;

class Warehouse extends Model implements WarehouseContract
{
    use CustomAttribute, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'contact_name',
        'contact_emails',
        'contact_numbers',
        'contact_address',
    ];

    /**
     * The attributes that are castable.
     *
     * @var array
     */
    protected $casts = [
        'contact_emails'  => 'array',
        'contact_numbers' => 'array',
        'contact_address' => 'array',
    ];

    /**
     * Get the locations for the warehouse.
     */
    public function locations()
    {
        return $this->hasMany(LocationProxy::modelClass());
    }

    /**
     * The tags that belong to the lead.
     */
    public function tags()
    {
        return $this->belongsToMany(TagProxy::modelClass(), 'warehouse_tags');
    }

    /**
     * Get the activities.
     */
    public function activities()
    {
        return $this->belongsToMany(ActivityProxy::modelClass(), 'warehouse_activities');
    }
}
