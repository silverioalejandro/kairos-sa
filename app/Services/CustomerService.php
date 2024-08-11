<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    private $paginationService;
    private $model;

    public function __construct(
        PaginationService $paginationService,
        Customer $customer
    ) {
        $this->model = $customer;
        $this->paginationService = $paginationService;
    }

    public function getAll(array $input)
    {
        return $this->paginationService
            ->paginate($this->model->with(['operator:id,email', 'statusCustomer:id,name']), $input, 15);
    }

    public function create(array $input): array
    {
        $this->model->create($input);
        return [ 'processed' => true ];
    }

    public function udpate(array $input): array
    {
        $this->model->find($input['id'])
                ->update($input);
        return ['processed' => true];
    }
}