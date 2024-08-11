<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS v_vehicle_types;");
        DB::statement(
            "
            CREATE VIEW v_vehicle_types
            AS
            SELECT
                t.cod_table as id,
                t.des_table as name,
                t.order,
                t.active
            FROM table_tables t
            WHERE t.rel_table = 900;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_vehicle_types');
    }
}
