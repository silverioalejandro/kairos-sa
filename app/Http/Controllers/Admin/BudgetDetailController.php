<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BudgetDetailService;

class BudgetDetailController extends Controller
{
    protected $service;

    public function __construct(BudgetDetailService $service)
    {
        $this->service = $service;
    }

    public function show(int $budgetId)
    {
        try {
            $data = $this->service->getAll($budgetId);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }

        return response()->json(['data' => $data]);
    }
}
