<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Operator;
use Faker\Generator as Faker;
use App\Models\views\VCategory;
use App\Models\Views\VStatusProducts;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'description' => $faker->text(),
        'sku' => $faker->numerify('########'),
        'category_code' => VCategory::all()->random(1)->first()->id,
        'price' => rand(500, 20000),
        'cover_price' => rand(500, 20000),
        'quantity' => rand(1, 2000),
        'quantity_factory' => rand(1, 2000),
        'status_product_code' => VStatusProducts::all()->random(1)->first()->id,
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});
