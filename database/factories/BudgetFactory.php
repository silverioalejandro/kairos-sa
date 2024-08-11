<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Budget;
use App\Models\Operator;
use App\Models\BudgetDetails;
use App\Models\BudgetVehicles;
use App\Models\Paid;
use App\Models\Product;
use App\Models\Vehicle;
use Faker\Generator as Faker;
use App\Models\Views\VPaymentTypes;

$factory->define(Budget::class, function (Faker $faker) {
    $ivaAmount = $faker->unique()->numberBetween(1, 21);
    $retentionAmount = $faker->unique()->numberBetween(1, 10);
    $discountAmount = $faker->unique()->numberBetween(1, 10);
    $totalAmount = $ivaAmount + $retentionAmount + $discountAmount;
    return [
        'event_id' => 1,
        'nro_vehicles' => 1,
        'total_vehicles' => 250000,
        'nro_products' => 8,
        'total_products' => 450000,
        'iva_percentage' => $ivaAmount,
        'iva_amount' => $ivaAmount,
        'retention_percentage' => $retentionAmount,
        'retention_amount' => $retentionAmount,
        'discount_percentage' => $discountAmount,
        'discount_amount' => $discountAmount,
        'total_amount' => $totalAmount,
        'status_budget_code' => 701,
        'payment_type_code' => VPaymentTypes::all()->random(1)->first()->id,
        'operator_id' => Operator::all()->random(1)->first()->id,
    ];
});

$factory->afterCreating(Budget::class, function ($data) {

    $product = Product::all()->random(1)->first();
    factory(BudgetDetails::class)->create([
        "budget_id" => $data->id,
        "product_id" => $product->id,
        "price" => $product->price
    ]);

    $product = Product::all()->random(1)->first();
    factory(BudgetDetails::class)->create([
        "budget_id" => $data->id,
        "product_id" => $product->id,
        "price" => $product->price
    ]);

    $product = Product::all()->random(1)->first();
    factory(BudgetDetails::class)->create([
        "budget_id" => $data->id,
        "product_id" => $product->id,
        "price" => $product->price
    ]);

    $vehicle = Vehicle::all()->random(1)->first();
    factory(BudgetVehicles::class)->create([
        "budget_id" => $data->id,
        "vehicle_id" => $vehicle->id,
        "price" => $vehicle->price
    ]);

    factory(Paid::class,2)->create([
        "budget_id" => $data->id,
        "obs" => "Abono"
    ]);
});
