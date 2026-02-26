<?php

namespace Webkul\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webkul\Contact\Models\Person;
use Webkul\User\Models\User;

class Proposal extends Model
{
    protected $fillable = [
        'proposal_id',
        'project_id',
        'person_id',
        'user_id',
        'proposal_date',
        'value',
        'status',
        'ceo_approved_at',
        'manager_approved_at',
        'shared_with_client_at',
        'client_signed_at',
    ];

    protected $casts = [
        'proposal_date'         => 'date',
        'ceo_approved_at'       => 'date',
        'manager_approved_at'   => 'date',
        'shared_with_client_at' => 'date',
        'client_signed_at'      => 'date',
        'value'                 => 'decimal:4',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
