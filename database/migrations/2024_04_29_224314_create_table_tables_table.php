<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_tables', function (Blueprint $table) {
            $table->id();
            $table->string('des_table');
            $table->integer('cod_table')->index();
            $table->integer('rel_table')->index();
            $table->integer('sede_id');
            $table->integer('order');
            $table->boolean('active');

            $table->index(['cod_table', 'rel_table'], 'idx_table_tables_pk1');
            $table->index(['des_table', 'cod_table', 'rel_table'], 'idx_table_tables_pk2');

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
        Schema::dropIfExists('table_tables');
    }
}
