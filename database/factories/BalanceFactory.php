<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Balance;
use App\Models\Operator;
use Faker\Generator as Faker;

$factory->define(Balance::class, function (Faker $faker) {
    $amount = [-4000, -8000, -6000, -10000];
    return [
        'type_payment' => false,
        'amount' => $amount[array_rand($amount)],
        'payment_date' => $faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
        'obs' => $faker->text(),
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});
