<?php

namespace App\Models;

use App\Models\Views\VStatusEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'customer_id',
        'address',
        'event_start',
        'event_end',
        'event_date',
        'code',
        'status_event_code',
        'operator_id',
    ];

    public $filterRelations = [
        'identification_number' => 'customer',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function statusEvent(): BelongsTo
    {
        return $this->belongsTo(VStatusEvents::class, 'status_event_code');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
