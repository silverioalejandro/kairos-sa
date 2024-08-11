<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VStatusProducts extends Model
{
    protected $table = 'v_status_products';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
