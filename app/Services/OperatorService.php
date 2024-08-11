<?php

namespace App\Services;

use App\Models\Operator;
use Illuminate\Support\Str;


class OperatorService
{
    private $paginationService;
    private $model;

    public function __construct(PaginationService $paginationService, Operator $model)
    {
        $this->model = $model;
        $this->paginationService = $paginationService;
    }

    public function getAll(array $input)
    {
        return $this->paginationService
            ->paginate($this->model->with(['rol:id,name']), $input, 15);
    }

    public function create(array $input): array
    {
        $input['password'] = bcrypt($input['password']);
        $input['api_token'] = Str::uuid();
        $this->model->create($input);

        return ['processed' => true];
    }

    public function udpate(array $input): array
    {
        $operator = $this->model->find($input['id']);
        $input['password'] = $operator->password;
        $operator->update($input);
        return ['processed' => true];
    }

    public function resetPassword(array $input): array
    {
        $operator = $this->model->where('email', $input['email']);
        $operator->update([
            'password' => bcrypt('secret')
        ]);
        return ['processed' => true];
    }
}