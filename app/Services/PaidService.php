<?php

namespace App\Services;

use App\Models\Paid;

class PaidService
{
    private $paginationService;
    private $model;

    public function __construct(
        PaginationService $paginationService,
        Paid $model
    ) {
        $this->model = $model;
        $this->paginationService = $paginationService;
    }

    public function getAll(int $budgetId, array $input)
    {
        $data = $this->model->where('budget_id', $budgetId)
            ->with(['operator:id,email', 'paymentTypeCode:id,name']);

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
        $this->model->create($input);
        return ['processed' => true];
    }

    public function udpate(array $input): array
    {
        $this->model->find($input['id'])
        ->update($input);
        return ['processed' => true];
    }
}