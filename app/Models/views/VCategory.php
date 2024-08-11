<?php

namespace App\Models\views;

use Illuminate\Database\Eloquent\Model;

class VCategory extends Model
{
    protected $table = 'v_categories';
    protected $fillable = [
        'id',
        'name',
        'order',
        'active',
    ];
}
