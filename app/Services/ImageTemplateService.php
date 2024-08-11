<?php

namespace App\Services;

use Illuminate\Http\File;

use App\Models\ImageTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageTemplateService
{
    private $imageTemplate;
    private $paginationService;

    public function __construct(ImageTemplate $imageTemplate, PaginationService $paginationService)
    {
        $this->imageTemplate = $imageTemplate;
        $this->paginationService = $paginationService;
    }

    public function getAll(array $input)
    {
        return $this->paginationService
            ->paginate($this->imageTemplate->with(['domain:id,domain', 'operator:id,email']), $input, 15);
    }

    public function create(array $input)
    {
        $file = $input['files'];
        $folder = "images/" . str_replace(".", "", $input['domain']);
        $path = Storage::putFileAs($folder, $file, $input['name']);

        $this->imageTemplate->create([
            "domain_id"  => $input['domain_id'],
            "operator_id" => Auth::id(),
            "name" => $input['name'],
            "path" => $path,
        ]);

        return $this->imageTemplate;
    }

    public function update(array $input)
    {
        $file = $input['files'];
        $folder = "images/" . str_replace(".", "", $input['domain']);
        $path = Storage::putFileAs($folder, $file, $input['name']);

        $imageTemplate = $this->imageTemplate->find($input['id']);

        $imageTemplate->domain_id = $input['domain_id'];
        $imageTemplate->name = $input['name'];
        $imageTemplate->path = $path;
        $imageTemplate->save();

        return $imageTemplate;
    }
}