<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VStatusFreights extends Model
{
    protected $table = 'v_status_freights';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
