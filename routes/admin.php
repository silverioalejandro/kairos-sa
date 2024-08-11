<?php

use App\Models\Balance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaidController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\BalanceController;
use App\Http\Controllers\Admin\FreightController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OperatorController;
use App\Http\Controllers\Admin\BudgetDetailController;
use App\Http\Controllers\Admin\OperatorAuthController;
use App\Http\Controllers\Admin\BudgetVehicleController;
use App\Http\Controllers\Admin\Filters\VCategoryController;
use App\Http\Controllers\Admin\Filters\VPaymentTypeController;
use App\Http\Controllers\Admin\Filters\VStatusEventController;
use App\Http\Controllers\Admin\Filters\VVehicleTypeController;
use App\Http\Controllers\Admin\Filters\VStatusBudgetController;
use App\Http\Controllers\Admin\Filters\VStatusFreightController;
use App\Http\Controllers\Admin\Filters\VStatusProductController;
use App\Http\Controllers\Admin\Filters\VStatusVehicleController;
use App\Http\Controllers\Admin\Filters\VStatusCustomerController;

Route::group(['prefix' => 'operators'], function () {
    Route::post('login', [OperatorAuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:operators'], function () {

    Route::group(['prefix' => 'filters', 'namespace' => 'Filters'], function () {

        Route::get('categories', [VCategoryController::class, 'index']);
        Route::get('payment-types', [VPaymentTypeController::class, 'index']);
        Route::get('vehicle-types', [VVehicleTypeController::class, 'index']);

        Route::group(['prefix' => 'status', 'namespace' => 'Filters'], function () {
            Route::get('customer', [VStatusCustomerController::class, 'index']);
            Route::get('product', [VStatusProductController::class, 'index']);
            Route::get('freight', [VStatusFreightController::class, 'index']);
            Route::get('vehicle', [VStatusVehicleController::class, 'index']);
            Route::get('event', [VStatusEventController::class, 'index']);
            Route::get('budget', [VStatusBudgetController::class, 'index']);
        });
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::post('/', [CustomerController::class, 'index']);
        Route::post('create', [CustomerController::class, 'store']);
        Route::post('update', [CustomerController::class, 'update']);
    });

    Route::group(['prefix' => 'product'], function () {
        Route::post('/', [ProductController::class, 'index']);
        Route::post('create', [ProductController::class, 'store']);
        Route::post('update', [ProductController::class, 'update']);
    });

    Route::group(['prefix' => 'freight'], function () {
        Route::post('/', [FreightController::class, 'index']);
        Route::post('create', [FreightController::class, 'store']);
        Route::post('update', [FreightController::class, 'update']);
    });

    Route::group(['prefix' => 'vehicle'], function () {
        Route::post('/', [VehicleController::class, 'index']);
        Route::post('create', [VehicleController::class, 'store']);
        Route::post('update', [VehicleController::class, 'update']);
    });

    Route::group(['prefix' => 'event'], function () {
        Route::post('/', [EventController::class, 'index']);
        Route::post('create', [EventController::class, 'store']);
        Route::post('update', [EventController::class, 'update']);
    });

    Route::group(['prefix' => 'budget'], function () {
        Route::post('/', [BudgetController::class, 'index']);
        Route::get('{id}', [BudgetController::class, 'show']);
        Route::post('detail/{id}', [BudgetDetailController::class, 'show']);
        Route::post('vehicle/{id}', [BudgetVehicleController::class, 'show']);
        Route::post('create', [BudgetController::class, 'store']);
        Route::post('update', [BudgetController::class, 'update']);
        Route::post('paids/{id}', [PaidController::class, 'paids']);
        Route::post('paid/update', [PaidController::class, 'update']);
        Route::post('paid/create', [PaidController::class, 'store']);
    });

    Route::group(['prefix' => 'operator'], function () {
        Route::post('/', [OperatorController::class, 'index']);
        Route::post('reset-password', [OperatorController::class, 'resetPassword']);
        Route::post('create', [OperatorController::class, 'store']);
        Route::post('update', [OperatorController::class, 'update']);
    });

    Route::group(['prefix' => 'balances'], function () {
        Route::post('/', [BalanceController::class, 'index']);
        Route::post('create', [BalanceController::class, 'store']);
        Route::post('update', [BalanceController::class, 'update']);
    });
});
