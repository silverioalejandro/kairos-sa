<?php

namespace App\Services\Filters;

use App\Models\Views\VStatusVehicles;

class VStatusVehicleService
{
    protected $model;

    public function __construct(VStatusVehicles $model)
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