<?php

namespace App\Models;

use App\Models\Views\VStatusCustomers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'cellphone',
        'address',
        'province',
        'neighborhood',
        'identification_number',
        'status_customer_code',
        'operator_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function statusCustomer(): BelongsTo
    {
        return $this->belongsTo(VStatusCustomers::class, 'status_customer_code');
    }
}
