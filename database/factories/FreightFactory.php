<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Freight;
use App\Models\Operator;
use Faker\Generator as Faker;
use App\Models\Views\VStatusFreights;

$factory->define(Freight::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name,
        'email' => $faker->unique()->safeEmail,
        'cellphone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'contact' => $this->faker->name,
        'status_freight_code' => VStatusFreights::all()->random(1)->first()->id,
        'info' => null,
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});
