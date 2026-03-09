<?php

namespace Sharmindar\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Lead\Models\Lead;
use Webkul\User\Models\User;

class Requirement extends Model
{
    protected $fillable = [
        'lead_id', 'proposal_id', 'title', 'description',
        'category', 'priority', 'complexity',
        'status', 'estimated_hours', 'notes', 'created_by',
    ];

    protected $casts = [
        'estimated_hours' => 'decimal:2',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class , 'created_by');
    }

    public function estimationItems()
    {
        return $this->hasMany(EstimationItem::class);
    }
}
