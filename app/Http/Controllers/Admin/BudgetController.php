<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\BudgetService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    protected $service;

    public function __construct(BudgetService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $data = $this->service->getAll($input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    public function show(int $id)
    {
        try {
            $data = $this->service->show($id);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $input['operator_id'] = Auth::id();

            $data = $this->service->create($input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    public function update(Request $request)
    {
        try {
            $input = $request->all();
            $input['operator_id'] = Auth::id();

            $data = $this->service->update($input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }
}
