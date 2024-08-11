<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Operator;
use App\Models\Views\VStatusCustomers;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    $identification_number = $faker->unique()->numberBetween(95897200, 98899900);
    return [
        'name' => $this->faker->name,
        'email' => $faker->unique()->safeEmail,
        'cellphone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'province' => $faker->streetAddress,
        'neighborhood' => $faker->streetAddress,
        'identification_number' => $identification_number,
        'status_customer_code' => VStatusCustomers::all()->random(1)->first()->id,
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});