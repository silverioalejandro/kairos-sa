<?php

namespace App\Services;

use App\Services\PaginationService;
use Maatwebsite\Excel\Excel;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    protected $model;
    private $relations;
    private $paginationService;

    public function __construct(Model $model, array $relations = [])
    {
        $this->model = $model;
        $this->relations = $relations;
        $this->paginationService = new PaginationService;
    }

    public function all($input)
    {
        $query = $this->model;

        if (!empty($this->relations)) {
            $query = $query->with($this->relations);
        }

        return $this->paginationService
            ->paginate($query, $input, 15);
    }

    public function show(int $id){
        $query = $this->model;

        if (!empty($this->relations)) {
            $query = $query->with($this->relations);
        }

        return $query->find($id)->first();
    }

    public function export($input, $className)
    {
        return (new $className($input))->download(
            '.csv',
            Excel::CSV,
            [
                'Content-Type' => 'text/csv'
            ]
        );
    }

    public function create(array $input){
        return $this->model->create($input);
    }
}
