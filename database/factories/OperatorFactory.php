<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Operator;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Operator::class, function (Faker $faker) {
    $token = Str::random(60);
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'cellphone' => $faker->phoneNumber,
        'password' => bcrypt('secret'),
        'api_token' => $token,
        'token' => $token,
        'is_active' => true,
        'created_by' => 1,
        'role_id' => 1
    ];
});
