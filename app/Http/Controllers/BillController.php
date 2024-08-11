<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Budget;
use Barryvdh\DomPDF\Facade\Pdf;

class BillController extends Controller
{
    public function bill(int $id)
    {
        $budget = Budget::with(['event', 'event.customer', 'event.statusEvent', 'operator:id,email', 'statusBudget:id,name', 'paymentType:id,name', 'budgetDetails', 'budgetDetails.product', 'budgetVehicles', 'budgetVehicles.vehicle', 'budgetVehicles.vehicle.freight'])
            ->find($id)->toArray();

        $data['budget'] = $budget;

        Carbon::setLocale('es'); // Establece el idioma español
        $data['created'] = Carbon::now();

        $html = view('bill.bill', $data)->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->stream();
    }
}
