<?php

namespace Sharmindar\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Lead\Models\Lead;
use Webkul\Quote\Models\Quote;
use Webkul\User\Models\User;

class Proposal extends Model
{
    protected $fillable = [
        'proposal_number', 'lead_id', 'quote_id', 'title',
        'executive_summary', 'scope_of_work', 'deliverables',
        'timeline_weeks', 'total_amount', 'valid_until',
        'status', 'version', 'parent_id',
        'prepared_by', 'approved_by', 'terms_and_conditions',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'total_amount' => 'decimal:2',
        'valid_until' => 'date',
        'timeline_weeks' => 'integer',
        'version' => 'integer',
    ];

    /**
     * Boot: auto-generate proposal number on creating.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($proposal) {
            if (empty($proposal->proposal_number)) {
                $year = now()->format('Y');
                $lastId = static::whereYear('created_at', $year)->max('id') ?? 0;
                $proposal->proposal_number = sprintf('PROP-%s-%03d', $year, $lastId + 1);
            }
        });
    }

    // ─── Relationships ────────────────────────────

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function items()
    {
        return $this->hasMany(ProposalItem::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function estimations()
    {
        return $this->hasMany(Estimation::class);
    }

    public function approvals()
    {
        return $this->morphMany(Approval::class , 'approvable');
    }

    public function preparedBy()
    {
        return $this->belongsTo(User::class , 'prepared_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class , 'approved_by');
    }

    public function parentVersion()
    {
        return $this->belongsTo(static::class , 'parent_id');
    }

    public function revisions()
    {
        return $this->hasMany(static::class , 'parent_id');
    }

    public function handover()
    {
        return $this->hasOne(ProjectHandover::class);
    }

    // ─── Helpers ──────────────────────────────────

    public function isExpired(): bool
    {
        return $this->valid_until && $this->valid_until->isPast();
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }
}
