<?php

namespace App\Services\Filters;

use App\Models\Views\VStatusProducts;

class VStatusProductService
{
    protected $model;

    public function __construct(VStatusProducts $model)
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