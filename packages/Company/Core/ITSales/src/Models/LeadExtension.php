<?php

namespace Company\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Lead\Models\Lead;

class LeadExtension extends Model
{
    protected $primaryKey = 'lead_id';

    public $incrementing = false;

    protected $fillable = [
        'lead_id',
        'lifecycle_status_id',
        'service_type',
        'project_type',
        'budget_range',
        'expected_start_date',
        'timeline_expectation',
        'technology_preference',
        'lead_source_detail',
        'requirement_summary',
        'decision_maker_name',
        'decision_maker_role',
        'priority_score',
        'score_breakdown',
        'temperature',
    ];

    protected $casts = [
        'technology_preference' => 'array',
        'score_breakdown' => 'array',
        'expected_start_date' => 'date',
        'priority_score' => 'integer',
    ];

    /**
     * The lead this extension belongs to.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * The current lifecycle status.
     */
    public function lifecycleStatus()
    {
        return $this->belongsTo(LeadLifecycleStatus::class , 'lifecycle_status_id');
    }

    /**
     * All status transitions for this lead.
     */
    public function transitions()
    {
        return $this->hasMany(LeadStatusTransition::class , 'lead_id', 'lead_id');
    }

    /**
     * Get the temperature emoji.
     */
    public function getTemperatureEmojiAttribute(): string
    {
        return match ($this->temperature) {
                'hot' => '🔥',
                'warm' => '🟡',
                'cold' => '🔵',
                default => '⚪',
            };
    }

    /**
     * Get a human-readable score label.
     */
    public function getScoreLabelAttribute(): string
    {
        return "{$this->temperature_emoji} {$this->priority_score}/100 ({$this->temperature})";
    }
}
