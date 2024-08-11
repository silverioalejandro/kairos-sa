<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\BalanceService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BalanceRequest;

class BalanceController extends Controller
{
    protected $service;

    public function __construct(BalanceService $service)
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

    public function store(BalanceRequest $request)
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

    public function update(BalanceRequest $request)
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
