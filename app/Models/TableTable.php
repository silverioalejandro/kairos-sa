<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableTable extends Model
{
    protected $table = 'table_tables';
    protected $fillable = [
        'des_table',
        'cod_table',
        'rel_table',
        'sede_id',
        'order',
        'active'
    ];

}
