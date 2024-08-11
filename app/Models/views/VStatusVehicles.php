<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VStatusVehicles extends Model
{
    protected $table = 'v_status_vehicles';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
