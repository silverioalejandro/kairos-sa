<?php

namespace App\Models;

use App\Models\Operator;
use App\Models\Views\VPaymentTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paid extends Model
{
    protected $table = 'paids';
    protected $fillable = [
        'budget_id',
        'payment_type_code',
        'amount',
        'payment_date',
        'obs',
        'operator_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function paymentTypeCode(): BelongsTo
    {
        return $this->belongsTo(VPaymentTypes::class, 'payment_type_code');
    }
}
