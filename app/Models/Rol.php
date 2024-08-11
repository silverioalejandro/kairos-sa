<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    const ADMIN = 1;
    const OPERATOR = 2;

    protected $table = 'rols';
    protected $fillable = ['name'];
}
