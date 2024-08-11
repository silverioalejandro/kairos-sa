<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use App\Models\Customer;
use App\Models\Operator;
use App\Models\Views\VStatusEvents;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'customer_id' => Customer::all()->random(1)->first()->id,
        'address' => $faker->streetAddress,
        'event_start' => '2024-05-01',
        'event_end' => '2024-05-03',
        'event_date' => '2024-05-02 14:30:00',
        'code' => $faker->numerify('########'),
        'status_event_code' => VStatusEvents::all()->random(1)->first()->id,
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});
