<?php
namespace App\Helpers;

use Carbon\Carbon;

class OptimisoftHelper
{
	public static function convertDate($date)
	{
		return Carbon::createFromFormat('d-m-Y', $date)->format('Y/m/d');
	}
}