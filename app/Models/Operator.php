<?php

namespace App\Models;

use App\Models\Publisher;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Operator extends Authenticatable
{
    protected $table = 'operators';
    protected $fillable = [
        'name',
        'email',
        'cellphone',
        'password',
        'api_token',
        'token',
        'is_active',
        'role_id',
        'created_by',
    ];

    protected $hidden = [
        'password'
    ];

    public function rol(){
        return $this->belongsTo(Rol::class, 'role_id', 'id' );
    }

    public function randString(int $length ): string
    {
        $chars = "*+-:;_-!@()abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }
}
