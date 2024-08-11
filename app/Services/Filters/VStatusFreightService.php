<?php

namespace App\Services\Filters;

use App\Models\Views\VStatusFreights;

class VStatusFreightService
{
    protected $model;

    public function __construct(VStatusFreights $model)
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