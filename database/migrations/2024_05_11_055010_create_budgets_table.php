<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('nro_vehicles');
            $table->decimal('total_vehicles', 12, 2)->default(0);
            $table->unsignedInteger('nro_products');
            $table->decimal('total_products', 12, 2)->default(0);
            $table->decimal('iva_percentage', 12, 2)->default(0);
            $table->decimal('iva_amount', 12, 2)->default(0);
            $table->decimal('retention_percentage', 12, 2)->default(0);
            $table->decimal('retention_amount', 12, 2)->default(0);
            $table->decimal('discount_percentage', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->unsignedInteger('status_budget_code')->default(701);
            $table->unsignedInteger('payment_type_code');
            $table->unsignedInteger('operator_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
