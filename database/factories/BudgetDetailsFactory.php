<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Budget;
use App\Models\BudgetDetails;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(BudgetDetails::class, function (Faker $faker) {
    return [
        'budget_id' => Budget::all()->random(1)->first()->id,
        'product_id' => Product::all()->random(1)->first()->id,
        'price' => 2,
        'quantity' => 1
    ];
});