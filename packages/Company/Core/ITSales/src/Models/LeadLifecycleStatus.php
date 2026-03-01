<?php

namespace Company\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;

class LeadLifecycleStatus extends Model
{
    protected $fillable = [
        'name', 'code', 'color', 'sort_order',
        'is_active', 'is_terminal', 'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_terminal' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get all active statuses in order.
     */
    public static function activeOrdered()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get the default status for new leads.
     */
    public static function defaultStatus(): ?self
    {
        return static::where('code', 'new_lead')->first();
    }

    /**
     * Leads currently in this status.
     */
    public function leadExtensions()
    {
        return $this->hasMany(LeadExtension::class , 'lifecycle_status_id');
    }

    /**
     * Transitions that moved leads INTO this status.
     */
    public function incomingTransitions()
    {
        return $this->hasMany(LeadStatusTransition::class , 'to_status_id');
    }
}
