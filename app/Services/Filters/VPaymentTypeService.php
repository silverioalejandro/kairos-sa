<?php

namespace App\Services\Filters;

use App\Models\Views\VPaymentTypes;

class VPaymentTypeService
{
    protected $model;

    public function __construct(VPaymentTypes $model)
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