<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->string('sku')->index();
            $table->unsignedInteger('category_code');
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('cover_price', 12, 2);
            $table->integer('quantity');
            $table->integer('quantity_factory');
            $table->unsignedInteger('status_product_code')->default(201);
            $table->json('info')->nullable();
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
        Schema::dropIfExists('products');
    }
}
