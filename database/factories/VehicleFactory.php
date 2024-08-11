<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Freight;
use App\Models\Vehicle;
use App\Models\Operator;
use Faker\Generator as Faker;
use App\Models\Views\VVehicleTypes;
use App\Models\Views\VStatusVehicles;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'freight_id' => Freight::all()->random(1)->first()->id,
        'vehicle_type_id' => VVehicleTypes::all()->random(1)->first()->id,
        'patent' => strtoupper($faker->lexify('???')) . $faker->unique()->numberBetween(901, 999),
        'obs' => $faker->sentence(5),
        'price' => rand(150000, 350000),
        'status_vehicle_code' => VStatusVehicles::all()->random(1)->first()->id,
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});
