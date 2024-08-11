<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

class VStatusBudgets extends Model
{
    protected $table = 'v_status_budgets';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
