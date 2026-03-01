<?php

namespace Company\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalItem extends Model
{
    protected $fillable = [
        'proposal_id', 'service_id', 'description',
        'quantity', 'unit_price', 'total',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
