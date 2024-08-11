<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('customer_id');
            $table->string('address')->nullable();
            $table->date('event_start')->nullable();
            $table->date('event_end')->nullable();
            $table->date('event_date')->nullable();
            $table->string('code');
            $table->unsignedInteger('status_event_code')->default(601);
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
        Schema::dropIfExists('events');
    }
}
