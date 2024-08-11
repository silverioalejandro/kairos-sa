<?php

namespace App\Helpers;

use App\Models\Operator;
use App\Models\Publisher;

class PublisherHelper
{
    public static function getIdAuth(int $operatorId)
	{
		return Publisher::where('operator_id', $operatorId)->value('id');
	}

	public static function getNameAuth(int $operatorId)
	{
		return Publisher::where('id', $operatorId)->value('company');
	}

	public static function getTokenAuth(int $operatorId)
	{
		$data =  Publisher::with(['operator'])->where('id', $operatorId)->first();
		return $data->operator->token;
	}
}
