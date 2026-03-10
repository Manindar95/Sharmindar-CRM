<?php

namespace Sharmindar\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Sharmindar\Core\User\Models\User;

class Approval extends Model
{
    protected $fillable = [
        'approvable_type', 'approvable_id',
        'stage', 'stage_name', 'approver_id',
        'status', 'comments', 'decided_at',
    ];

    protected $casts = [
        'decided_at' => 'datetime',
        'stage' => 'integer',
    ];

    /**
     * Polymorphic: the item being approved (Proposal, Estimation, etc.)
     */
    public function approvable(): MorphTo
    {
        return $this->morphTo();
    }

    public function approver()
    {
        return $this->belongsTo(User::class , 'approver_id');
    }

    // ─── Helpers ──────────────────────────────────

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function markApproved(?string $comments = null): void
    {
        $this->update([
            'status' => 'approved',
            'comments' => $comments,
            'decided_at' => now(),
        ]);
    }

    public function markRejected(?string $comments = null): void
    {
        $this->update([
            'status' => 'rejected',
            'comments' => $comments,
            'decided_at' => now(),
        ]);
    }
}
