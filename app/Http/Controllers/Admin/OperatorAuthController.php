<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest;
use App\Services\OperatorAuthService;
use App\Exceptions\PublisherDueDateException;

class OperatorAuthController
{
    protected $operatorAuthService;
    public function __construct(OperatorAuthService $operatorAuthService)
    {
        $this->operatorAuthService = $operatorAuthService;
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->operatorAuthService->login($request->all());
        } catch (PublisherDueDateException $e){
            return response()->json(['error' => $e->getMessage()], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
        return response()->json($data, 200);
    }
}
