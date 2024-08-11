<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    private $paginationService;
    private $model;

    public function __construct(
        PaginationService $paginationService,
        Product $model
    ) {
        $this->model = $model;
        $this->paginationService = $paginationService;
    }

    public function getAll(array $input)
    {
        return $this->paginationService
            ->paginate($this->model->with(['category:id,name','operator:id,email', 'statusProduct:id,name']), $input, 15);
    }

    public function create(array $input): array
    {
        $this->model->create($input);
        return ['processed' => true];
    }

    public function udpate(array $input): array
    {
        $this->model->find($input['id'])
        ->update($input);
        return ['processed' => true];
    }
}