<?php

namespace Company\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Lead\Models\Lead;
use Webkul\User\Models\User;

class LeadStatusTransition extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'lead_id', 'from_status_id', 'to_status_id',
        'transitioned_by', 'notes', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function fromStatus()
    {
        return $this->belongsTo(LeadLifecycleStatus::class , 'from_status_id');
    }

    public function toStatus()
    {
        return $this->belongsTo(LeadLifecycleStatus::class , 'to_status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'transitioned_by');
    }
}
