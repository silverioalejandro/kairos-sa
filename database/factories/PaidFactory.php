<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Paid;
use App\Models\Operator;
use Faker\Generator as Faker;

$factory->define(Paid::class, function (Faker $faker) {
    $amount = [4000, 8000, 6000, 10000];
    return [
        // 'budget_id' => Budget::all()->random(1)->first()->id,
        'payment_type_code' => 801,
        'amount' => $amount[array_rand($amount)],
        'payment_date' => $faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
        'obs' => $faker->text(),
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});
