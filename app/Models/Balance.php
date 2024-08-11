<?php

namespace App\Models;

use App\Models\Operator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    protected $table = 'balances';
    protected $fillable = [
        'paid_id',
        'type_payment',
        'amount',
        'payment_date',
        'obs',
        'operator_id',
        'budget_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }
}
