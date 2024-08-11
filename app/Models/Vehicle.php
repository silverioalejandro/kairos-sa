<?php

namespace App\Models;

use App\Models\Views\VStatusVehicles;
use App\Models\Views\VVehicleTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $fillable = [
        'freight_id',
        'vehicle_type_id',
        'patent',
        'obs',
        'price',
        'status_vehicle_code',
        'operator_id',
    ];

    public $filterRelations = [
        'name' => 'freight',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function statusVehicle(): BelongsTo
    {
        return $this->belongsTo(VStatusVehicles::class, 'status_vehicle_code');
    }

    public function freight(): BelongsTo
    {
        return $this->belongsTo(Freight::class, 'freight_id');
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VVehicleTypes::class, 'vehicle_type_id');
    }
}
