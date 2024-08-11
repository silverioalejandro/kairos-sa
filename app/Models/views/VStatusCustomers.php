<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VStatusCustomers extends Model
{
    protected $table = 'v_status_customers';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
