<?php

namespace App\Traits;

use App\Models\Operator;
use App\Helpers\PublisherHelper;
use Illuminate\Database\Eloquent\Model;

trait FilterOperatorTrait
{
    public function filterOperator(array $input, $model): array
    {
        // dd($input['authId']);
        $operator = Operator::find($input['authId']);
        // dd($operator);

        // $model = $this->model::with();

        // dd($model);
        // dd($operator->role_id);
        if($operator->role_id == Operator::PUBLISHER){
            // dd("si paso");
            logger("si entro 1");
            logger("publisher id ::");

            logger(PublisherHelper::getIdAuth($input['authId']));

            $model->where('publisher_id', PublisherHelper::getIdAuth($input['authId']));
        }

        logger("Filtrado === 2");
        logger($model->get()->count());

        logger("paso 3");

        // dd("No entro");
        unset($input['authId']);

        return ['input' => $input, 'model' => $model];
    }
}
