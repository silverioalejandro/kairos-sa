<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('freight_id');
            $table->unsignedInteger('vehicle_type_id');
            $table->string('patent');
            $table->string('obs');
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('status_vehicle_code')->default(601);
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
        Schema::dropIfExists('vehicles');
    }
}
