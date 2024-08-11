<?php

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'name' => 'Admin' ],
            [ 'name' => 'Operador' ]
        ];

        foreach ($roles as $rol) {
            Rol::create([
                'name' => $rol['name']
            ]);
        }
    }
}
