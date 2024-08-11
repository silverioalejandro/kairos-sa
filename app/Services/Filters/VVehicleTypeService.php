<?php

namespace App\Services\Filters;

use App\Models\Views\VVehicleTypes;

class VVehicleTypeService
{
    protected $model;

    public function __construct(VVehicleTypes $model)
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