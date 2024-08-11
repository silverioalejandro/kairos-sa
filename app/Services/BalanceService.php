<?php

namespace App\Services;

use App\Models\Balance;

class BalanceService
{
    private $paginationService;
    private $model;

    public function __construct(
        PaginationService $paginationService,
        Balance $model
    ) {
        $this->model = $model;
        $this->paginationService = $paginationService;
    }

    public function getAll(array $input): array
    {
        $data = $this->model->with(['operator:id,email']);
        $dataTotal = $this->paginationService->filter($data, $input);
        $total = $dataTotal->sum('amount');

        $response = $dataTotal->paginate(15);

        $response = $response->toArray();
        $response['extras'] = [
            'total' => $total
        ];

        return $response;
    }

    public function create(array $input): object
    {
        $input['amount'] = $this->typePaymen($input);
        $data = $this->model->create($input);

        return $data;
    }

    public function typePaymen(array $input): int
    {
        return ($input['type_payment'] == 0) ? (-1 * $input['amount']) : $input['amount'];
    }

    public function udpate(array $input): bool
    {
        $input['amount'] = $this->typePaymen($input);
        $data = $this->model->find($input['id'])
                ->update($input);

        return $data;
    }
}