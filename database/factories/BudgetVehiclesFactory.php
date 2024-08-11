<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Budget;
use Faker\Generator as Faker;
use App\Models\BudgetVehicles;
use App\Models\Vehicle;

$factory->define(BudgetVehicles::class, function (Faker $faker) {
    return [
        'budget_id' => Budget::all()->random(1)->first()->id,
        'vehicle_id' => Vehicle::all()->random(1)->first()->id,
        'price' => 2
    ];
});
