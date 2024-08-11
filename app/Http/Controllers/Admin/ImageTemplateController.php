<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageTemplateService;
use App\Http\Requests\ImageTemplateCreateRequest;
use App\Http\Requests\ImageTemplateUpdateRequest;

class ImageTemplateController extends Controller
{
    protected $service;

    public function __construct(ImageTemplateService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->service->getAll($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    // public function store(ImageTemplateCreateRequest $request)
    public function store(Request $request)
    {


        $input = $request->all();
        logger('input');
        logger($input);

        // logger('file');
        // logger($request->file);

        try {
            $data = $this->service->create($input);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }
        return response()->json(['data' => $data]);
    }

    // public function update(ImageTemplateUpdateRequest $request)
    public function update(Request $request)
    {
        $input = $request->all();
        try {
            $data = $this->service->update($input);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage() . ' - ' . $e->getFile() . ' | ' . $e->getLine()], 404);
        }

        return response()->json(['data' => $data]);
    }
}
