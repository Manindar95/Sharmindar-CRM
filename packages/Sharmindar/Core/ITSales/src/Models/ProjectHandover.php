<?php

namespace Sharmindar\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\Admin\Models\Project;
use Sharmindar\Core\Lead\Models\Lead;
use Sharmindar\Core\User\Models\User;

class ProjectHandover extends Model
{
    protected $fillable = [
        'lead_id', 'proposal_id', 'project_id',
        'handover_status', 'handover_notes',
        'handed_over_by', 'received_by', 'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function handedOverBy()
    {
        return $this->belongsTo(User::class , 'handed_over_by');
    }

    public function receivedBy()
    {
        return $this->belongsTo(User::class , 'received_by');
    }

    /**
     * Mark the handover as completed.
     */
    public function markCompleted(): void
    {
        $this->update([
            'handover_status' => 'completed',
            'completed_at' => now(),
        ]);
    }
}
