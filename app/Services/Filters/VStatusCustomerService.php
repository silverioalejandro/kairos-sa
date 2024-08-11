<?php

namespace App\Services\Filters;

use App\Models\views\VStatusCustomers;

class VStatusCustomerService
{
    protected $model;

    public function __construct(VStatusCustomers $model)
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