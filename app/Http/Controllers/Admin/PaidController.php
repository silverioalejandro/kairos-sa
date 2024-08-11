<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\PaidService;
use App\Http\Requests\PaidRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PaidController extends Controller
{
    protected $service;

    public function __construct(PaidService $service)
    {
        $this->service = $service;
    }

    public function paids(int $budgetId, Request $request)
    {
        try {
            $input = $request->all();
            $data = $this->service->getAll($budgetId, $input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    public function store(PaidRequest $request)
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

    public function update(PaidRequest $request)
    {
        try {
            $input = $request->all();
            $data = $this->service->udpate($input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }
}
