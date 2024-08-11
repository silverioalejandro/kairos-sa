<?php

namespace App\Services;

use App\Models\Budget;
use App\Models\BudgetDetails;

class BudgetDetailService
{
    private $paginationService;
    private $model;

    public function __construct(
        PaginationService $paginationService,
        BudgetDetails $model
    ) {
        $this->model = $model;
        $this->paginationService = $paginationService;
    }

    public function getAll(int $budgetId)
    {
        $data = $this->model->with(['product'])
                ->where('budget_id', $budgetId);

        return $this->paginationService
                ->paginate($data, [], 15);
    }
}