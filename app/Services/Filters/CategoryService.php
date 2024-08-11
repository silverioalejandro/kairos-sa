<?php

namespace App\Services\Filters;

use App\Models\views\VCategory;

class CategoryService
{
    protected $model;

    public function __construct(VCategory $model)
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