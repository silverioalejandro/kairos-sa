<?php

namespace App\Models;

use App\Models\BudgetDetails;
use App\Models\Views\VPaymentTypes;
use App\Models\Views\VStatusBudgets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    protected $table = 'budgets';
    protected $fillable = [
        'event_id',
        'nro_vehicles',
        'total_vehicles',
        'nro_products',
        'total_products',
        'iva_percentage',
        'iva_amount',
        'retention_percentage',
        'retention_amount',
        'discount_percentage',
        'discount_amount',
        'total_amount',
        'status_budget_code',
        'payment_type_code',
        'operator_id',
    ];

    public $filterRelations = [
        'identification_number' => 'event.customer',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class, 'operator_id');
    }

    public function statusBudget(): BelongsTo
    {
        return $this->belongsTo(VStatusBudgets::class, 'status_budget_code');
    }

    public function paymentType(): BelongsTo
    {
        return $this->belongsTo(VPaymentTypes::class, 'payment_type_code');
    }

    public function budgetDetails(): HasMany
    {
        return $this->hasMany(BudgetDetails::class, 'budget_id');
    }

    public function budgetVehicles(): HasMany
    {
        return $this->hasMany(BudgetVehicles::class, 'budget_id');
    }

    public function scopeWithTotalAmountPaid($query)
    {
        $subSelect = Paid::selectRaw('SUM(amount) as total')
        ->whereColumn('paids.budget_id', 'budgets.id')
        ->groupBy('budgets.id');

        $query->addSelect([
            'total_amount_paid' => $subSelect
        ]);
    }
}
