<?php

namespace App\Observers;

use App\Models\Balance;
use App\Models\Paid;

class PaidObserver
{
    /**
     * Handle the paid "created" event.
     *
     * @param  \App\Paid  $paid
     * @return void
     */
    public function created(Paid $paid)
    {
        $balance = [
            'paid_id' => $paid['id'],
            'type_payment' => true,
            'amount' => $paid['amount'],
            'obs' => "Presupuesto id: " . $paid['budget_id'],
            'payment_date' => $paid['payment_date'],
            'operator_id' => $paid['operator_id'],
            'budget_id' => $paid['budget_id'],
        ];

        Balance::create($balance);
    }

    /**
     * Handle the paid "updated" event.
     *
     * @param  \App\Paid  $paid
     * @return void
     */
    public function updated(Paid $paid)
    {
        $balance = [
            'paid_id' => $paid['id'],
            'type_payment' => true,
            'amount' => $paid['amount'],
            'obs' => "Presupuesto id: " . $paid['budget_id'],
            'payment_date' => $paid['payment_date'],
            'operator_id' => $paid['operator_id'],
            'budget_id' => $paid['budget_id'],
        ];

        $model = Balance::where('paid_id', $paid['id']);
        $model->update($balance);
    }

    /**
     * Handle the paid "deleted" event.
     *
     * @param  \App\Paid  $paid
     * @return void
     */
    public function deleted(Paid $paid)
    {
        //
    }

    /**
     * Handle the paid "restored" event.
     *
     * @param  \App\Paid  $paid
     * @return void
     */
    public function restored(Paid $paid)
    {
        //
    }

    /**
     * Handle the paid "force deleted" event.
     *
     * @param  \App\Paid  $paid
     * @return void
     */
    public function forceDeleted(Paid $paid)
    {
        //
    }
}
