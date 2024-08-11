<?php

use App\Models\TableTable;
use Illuminate\Database\Seeder;

class TableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ["id" => 1, "des_table" => "table", "cod_table" => 1, "rel_table" => 0, "sede_id" => 1, "order" => 1, "active" => 1],
            ["id" => 2, "des_table" => "table_filter", "cod_table" => 2, "rel_table" => 0, "sede_id" => 1, "order" => 2, "active" => 1],

            ["id" => 3, "des_table" => "Status customers", "cod_table" => 100, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 4, "des_table" => "Activo", "cod_table" => 101, "rel_table" => 3, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 5, "des_table" => "Inactivo", "cod_table" => 102, "rel_table" => 3, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 6, "des_table" => "Status product", "cod_table" => 200, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 7, "des_table" => "Activo", "cod_table" => 201, "rel_table" => 6, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 8, "des_table" => "Inactivo", "cod_table" => 202, "rel_table" => 6, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 9, "des_table" => "Categories", "cod_table" => 300, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 10, "des_table" => "Mesas", "cod_table" => 301, "rel_table" => 9, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 11, "des_table" => "Sillas", "cod_table" => 302, "rel_table" => 9, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 12, "des_table" => "Fundas para sillas", "cod_table" => 303, "rel_table" => 9, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 13, "des_table" => "Status freights (Flete)", "cod_table" => 400, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 14, "des_table" => "Activo", "cod_table" => 401, "rel_table" => 13, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 15, "des_table" => "Inactivo", "cod_table" => 402, "rel_table" => 13, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 16, "des_table" => "Status vehicle", "cod_table" => 500, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 17, "des_table" => "Activo", "cod_table" => 501, "rel_table" => 16, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 18, "des_table" => "Inactivo", "cod_table" => 502, "rel_table" => 16, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 19, "des_table" => "Status events", "cod_table" => 600, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 20, "des_table" => "Por aprobación", "cod_table" => 601, "rel_table" => 19, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 21, "des_table" => "Aprobada", "cod_table" => 602, "rel_table" => 19, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 22, "des_table" => "Status budgets (Presupuesto)", "cod_table" => 700, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 23, "des_table" => "Por aprobación", "cod_table" => 701, "rel_table" => 22, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 24, "des_table" => "Aprobada", "cod_table" => 702, "rel_table" => 22, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 25, "des_table" => "Payment types", "cod_table" => 800, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 26, "des_table" => "Efectivo", "cod_table" => 801, "rel_table" => 25, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 27, "des_table" => "Tarjeta crédito", "cod_table" => 802, "rel_table" => 25, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 28, "des_table" => "Transferencia", "cod_table" => 803, "rel_table" => 25, "sede_id" => 1, "order" => 0, "active" => 1],

            ["id" => 29, "des_table" => "Vehicle types", "cod_table" => 900, "rel_table" => 1, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 30, "des_table" => "Camión 350", "cod_table" => 901, "rel_table" => 900, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 31, "des_table" => "Camiones rectos", "cod_table" => 902, "rel_table" => 900, "sede_id" => 1, "order" => 0, "active" => 1],
            ["id" => 32, "des_table" => "Camión semirremolque", "cod_table" => 903, "rel_table" => 900, "sede_id" => 1, "order" => 0, "active" => 1],
        ];

        foreach ($items as $item) {
            $condition = [
                'cod_table' => $item['cod_table']
            ];
            $row = [
                'id' => $item['id'],
                'des_table' => $item['des_table'],
                'cod_table' => $item['cod_table'],
                'rel_table' => $item['rel_table'],
                'sede_id' => $item['sede_id'],
                'order' => $item['order'],
                'active' => $item['active']
            ];
            $row = TableTable::firstOrCreate($condition, $row);
        }
    }
}
