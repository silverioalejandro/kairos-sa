<?php

namespace App\Services;

use App\Models\BudgetVehicles;
use App\Services\PaginationService;

class BudgetVehicleService
{
    private $paginationService;
    private $model;

    public function __construct(
        PaginationService $paginationService,
        BudgetVehicles $model
    ) {
        $this->model = $model;
        $this->paginationService = $paginationService;
    }

    public function getAll(int $budgetId)
    {
        $data = $this->model->with(['vehicle', 'vehicle.freight', 'vehicle.statusVehicle', 'vehicle.vehicleType'])
                ->where('budget_id', $budgetId);

        return $this->paginationService
                ->paginate($data, [], 15);
    }
}