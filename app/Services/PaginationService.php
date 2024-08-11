<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class PaginationService
{
    const DATE_COLUMNS = [
        'payment_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'created'
    ];

    public function paginate($dataObject, $requestData, $rowsPerPage)
    {
        $filtered = $this->filter($dataObject, $requestData);
        return $filtered->paginate($rowsPerPage);
    }

    public function filter($dataObject, $requestData)
    {
        $filterables = $dataObject->getModel()->filterRelations;

        if(isset($requestData['sortBy'])){
            $sortDesc = $requestData['sortDesc'];
            foreach ($requestData['sortBy'] as $index => $sortBy) {
                $dataObject = $dataObject->orderBy($sortBy, $sortDesc[$index] ? 'DESC' : 'ASC');
            }
        }

        if(!isset($requestData['filterBy'])){
            return $dataObject;
        }

        $filterValues = $requestData['filterValues'];
        foreach ($requestData['filterBy'] as $index => $filterBy) {
            $filterValuesVar = $filterValues[$index];
            if(!is_null($filterables) && array_key_exists($filterBy, $filterables)){
                $dataObject = $dataObject->whereHas($filterables[$filterBy], function($query) use ($filterValuesVar, $filterBy){
                    return $query->where($filterBy, $filterValuesVar);
                });
                continue;
            }
            if(in_array($filterBy, SELF::DATE_COLUMNS) && is_array($filterValuesVar) && count($filterValuesVar) > 1){
                $dataObject = $dataObject->whereBetween(DB::raw("DATE($filterBy)"), $filterValuesVar);
                continue;
            }

            if(in_array($filterBy, SELF::DATE_COLUMNS)){
                $dataObject = $dataObject->whereDate($filterBy, $filterValuesVar);
                continue;
            }

            if(is_array($filterValuesVar)){
                $dataObject = $dataObject->whereIn($filterBy, $filterValuesVar);
                continue;
            }

            if ($this->isLike($filterValuesVar)){
                $dataObject = $dataObject->where($filterBy, 'like' ,$filterValuesVar);
                continue;
            }

            $dataObject = $dataObject->where($filterBy, $filterValuesVar);
        }

        return $dataObject;
    }

    public function isLike(string $str){
        return strlen($str) > 4 && substr($str, 0, 1) == '%' && substr($str, -1) == '%';
    }
}