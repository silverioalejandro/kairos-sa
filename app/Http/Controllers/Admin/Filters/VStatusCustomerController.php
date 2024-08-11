<?php

namespace App\Http\Controllers\Admin\Filters;

use App\Http\Controllers\Controller;
use App\Services\Filters\VStatusCustomerService;

class VStatusCustomerController extends Controller
{
    protected $service;

    public function __construct(VStatusCustomerService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {
            $data = $this->service->getAll();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }
}
