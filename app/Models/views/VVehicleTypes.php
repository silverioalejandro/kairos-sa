<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VVehicleTypes extends Model
{
    protected $table = 'v_vehicle_types';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
