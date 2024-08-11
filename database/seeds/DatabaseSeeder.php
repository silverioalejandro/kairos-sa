<?php

use App\Models\TemplateAdm;
use App\Models\TemplateType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OperatorAdminSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(TableTableSeeder::class);

        // Eliminar cuando se pase a producción
        $this->call(DataTestSeeder::class);
    }
}
