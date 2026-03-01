<?php

namespace Company\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'category', 'billing_type',
        'hourly_rate', 'fixed_price',
        'technology_stack', 'description', 'is_active',
    ];

    protected $casts = [
        'technology_stack' => 'array',
        'hourly_rate' => 'decimal:2',
        'fixed_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function proposalItems()
    {
        return $this->hasMany(ProposalItem::class);
    }

    public function estimationItems()
    {
        return $this->hasManyThrough(EstimationItem::class , ProposalItem::class);
    }
}
