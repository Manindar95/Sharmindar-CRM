<?php

namespace Company\Core\ITSales\Models;

use Illuminate\Database\Eloquent\Model;

class EstimationItem extends Model
{
    protected $fillable = [
        'estimation_id', 'requirement_id', 'task_description',
        'phase', 'role', 'hours', 'rate', 'cost',
    ];

    protected $casts = [
        'hours' => 'decimal:2',
        'rate' => 'decimal:2',
        'cost' => 'decimal:2',
    ];

    public function estimation()
    {
        return $this->belongsTo(Estimation::class);
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }
}
