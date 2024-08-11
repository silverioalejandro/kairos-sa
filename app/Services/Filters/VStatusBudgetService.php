<?php

namespace App\Services\Filters;

use App\Models\Views\VStatusBudgets;
use App\Models\Views\VStatusCars;

class VStatusBudgetService
{
    protected $model;

    public function __construct(VStatusBudgets $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model
            ->where('active', true)
            ->get(['id', 'name']);
    }
}