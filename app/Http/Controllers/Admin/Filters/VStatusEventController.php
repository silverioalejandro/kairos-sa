<?php

namespace App\Http\Controllers\Admin\Filters;

use App\Http\Controllers\Controller;
use App\Services\Filters\VStatusEventService;

class VStatusEventController extends Controller
{
    protected $service;

    public function __construct(VStatusEventService $service)
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
