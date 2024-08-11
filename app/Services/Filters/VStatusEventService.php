<?php

namespace App\Services\Filters;

use App\Models\Views\VStatusEvents;

class VStatusEventService
{
    protected $model;

    public function __construct(VStatusEvents $model)
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