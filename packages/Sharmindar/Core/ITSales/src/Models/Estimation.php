<?php

namespace Sharmindar\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\User\Models\User;

class Estimation extends Model
{
    protected $fillable = [
        'proposal_id', 'estimated_by', 'total_hours',
        'buffer_percentage', 'total_with_buffer',
        'total_cost', 'assumptions', 'risks', 'status',
    ];

    protected $casts = [
        'total_hours' => 'decimal:2',
        'buffer_percentage' => 'decimal:2',
        'total_with_buffer' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function estimator()
    {
        return $this->belongsTo(User::class , 'estimated_by');
    }

    public function items()
    {
        return $this->hasMany(EstimationItem::class);
    }

    public function approvals()
    {
        return $this->morphMany(Approval::class , 'approvable');
    }

    /**
     * Recalculate totals from items.
     */
    public function recalculate(): void
    {
        $this->total_hours = $this->items()->sum('hours');
        $this->total_with_buffer = $this->total_hours * (1 + $this->buffer_percentage / 100);
        $this->total_cost = $this->items()->sum('cost') * (1 + $this->buffer_percentage / 100);
        $this->save();
    }
}
