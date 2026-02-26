<?php

namespace Webkul\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\User\Models\User;

class Payment extends Model
{
    protected $fillable = [
        'invoice_id',
        'project_id',
        'invoice_date',
        'invoice_amount',
        'due_date',
        'payment_status',
        'payment_received_date',
        'followup_owner_id',
    ];

    protected $casts = [
        'invoice_date'          => 'date',
        'due_date'              => 'date',
        'payment_received_date' => 'date',
        'invoice_amount'        => 'decimal:4',
    ];

    /**
     * Get the project associated with the payment.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the followup owner associated with the payment.
     */
    public function followup_owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'followup_owner_id');
    }
}
