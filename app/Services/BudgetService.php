<?php

namespace App\Services;

use App\Models\Budget;
use Illuminate\Support\Facades\DB;

class BudgetService
{
    private $paginationService;
    private $model;

    public function __construct(
        PaginationService $paginationService,
        Budget $model
    ) {
        $this->model = $model;
        $this->paginationService = $paginationService;
    }

    public function getAll(array $input)
    {
        $data = $this->model->withTotalAmountPaid()
            ->with(['event', 'event.customer:id,name,identification_number','operator:id,email', 'statusBudget:id,name', 'paymentType:id,name', 'budgetDetails', 'budgetDetails.product']);

        return $this->paginationService
            ->paginate($data, $input, 15);
    }

    public function show(int $id)
    {
        $data = $this->model
        ->with(['event', 'event.customer', 'event.statusEvent', 'operator:id,email', 'statusBudget:id,name', 'paymentType:id,name', 'budgetDetails', 'budgetDetails.product', 'budgetVehicles', 'budgetVehicles.vehicle', 'budgetVehicles.vehicle.freight'])
        ->find($id);

        return $data;
    }

    public function create(array $input): array
    {
        $input['budget']['event_id'] = $input['event_id'];
        $input['budget']['operator_id'] = $input['operator_id'];

        $products = $this->prepareDataProducts($input['products']);
        $vehicles = $this->prepareDataVehicles($input['vehicles']);

        try {
            DB::beginTransaction();
            $budget = Budget::create($input['budget']);

            $budget->budgetDetails()->createMany($products);
            $budget->budgetVehicles()->createMany($vehicles);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return [];
    }

    public function update(array $input): array
    {
        $id = $input['id'];
        $input['budget']['event_id'] = $input['event_id'];
        $input['budget']['operator_id'] = $input['operator_id'];

        $budget = Budget::find($id);
        $budget->update($input['budget']);

        $budget->budgetDetails()->delete();
        $budget->budgetVehicles()->delete();

        $products = $this->prepareDataProducts($input['products']);
        $vehicles = $this->prepareDataVehicles($input['vehicles']);

        $budget->budgetDetails()->createMany($products);
        $budget->budgetVehicles()->createMany($vehicles);

        return [];
    }

    private function prepareDataVehicles(array $vehicles): array
    {
        return collect($vehicles)->map(function ($vehicle) {
            return [
                'vehicle_id' => $vehicle['vehicle_id'],
                'price' => $vehicle['price']
            ];
        })->values()->all();
    }

    private function prepareDataProducts(array $products): array
    {
        return collect($products)->map(function ($product) {
            return [
                'product_id' => $product['product_id'],
                'price' => $product['product_price'],
                'quantity' => $product['product_quantity'],
            ];
        })->values()->all();
    }
}