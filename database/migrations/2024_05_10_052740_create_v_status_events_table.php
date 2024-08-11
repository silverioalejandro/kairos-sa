<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateVStatusEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS v_status_events;");
        DB::statement(
            "
            CREATE VIEW v_status_events
            AS
            SELECT
                t.cod_table as id,
                t.des_table as name,
                t.order,
                t.active
            FROM table_tables t
            WHERE t.rel_table = 19;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_status_events');
    }
}
