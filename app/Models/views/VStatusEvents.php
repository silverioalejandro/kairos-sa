<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VStatusEvents extends Model
{
    protected $table = 'v_status_events';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
