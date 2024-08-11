<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\OperatorService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OperatorRequest;
use App\Http\Requests\OperatorResetPasswordRequest;

class OperatorController extends Controller
{
    protected $service;

    public function __construct(OperatorService $service)
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

    public function store(OperatorRequest $request)
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

    public function update(OperatorRequest $request)
    {
        try {
            $input = $request->all();
            $data = $this->service->udpate($input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    public function resetPassword(OperatorResetPasswordRequest $request)
    {
        try {
            $input = $request->all();
            $data = $this->service->resetPassword($input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    // public function storeAdmin(OperatorAdminCreateRequest $request){
    //     try {
    //         $data = $this->service->createAdmin($request->all());
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
    //     }

    //     return response()->json(['data' => $data], 201);
    // }

    // public function changeActive(int $operator_id)
    // {
    //     try {
    //         $data = $this->service->changeActive($operator_id);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
    //     }
    //     return response()->json(['data' => $data]);
    // }

    // public function dueDate(PublisherDueDateRequest $request)
    // {
    //     try {
    //         $data = $this->service->dueDate($request->all());
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
    //     }
    //     return response()->json(['data' => $data]);
    // }

    // public function resetPassword($operatorId)
    // {
    //     try {
    //         $data = $this->service->resetPassword($operatorId);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
    //     }
    //     return response()->json(['data' => $data]);
    // }

    // public function resetMyPassword(ResetMyPasswordRequest $request)
    // {
    //     try {
    //         $data = $this->service->resetMyPassword($request->all());
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 404);
    //     }
    //     return response()->json(['data' => $data]);
    // }

    // public function udpate(OperatorPublisherUpdateRequest $request)
    // {
    //     try {
    //         $input = $request->all();
    //         $data = $this->service->update($input);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
    //     }
    //     return response()->json(['data' => $data]);
    // }
}
