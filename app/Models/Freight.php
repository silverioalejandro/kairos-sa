<?php

namespace App\Models;

use App\Models\Views\VStatusFreights;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Freight extends Model
{
    protected $table = 'freights';
    protected $fillable = [
        'name',
        'email',
        'cellphone',
        'address',
        'contact',
        'status_freight_code',
        'info',
        'operator_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function statusFreight(): BelongsTo
    {
        return $this->belongsTo(VStatusFreights::class, 'status_freight_code');
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'freight_id');
    }
}
