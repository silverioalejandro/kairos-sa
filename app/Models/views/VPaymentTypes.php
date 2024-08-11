<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VPaymentTypes extends Model
{
    protected $table = 'v_payment_types';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
