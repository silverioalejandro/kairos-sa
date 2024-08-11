<?php

use App\Models\Budget;
use App\Models\Event;
use App\Models\Freight;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DataTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Customer::class, 28)->create();

        factory(Product::class)->create([
            'name' => 'Mesa nro 100',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Mesa nro 200',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Mesa nro 300',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Mesa nro 400',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Silla nro 100',
            'category_code' => 302
        ]);

        factory(Product::class)->create([
            'name' => 'Silla nro 200',
            'category_code' => 302
        ]);

        factory(Product::class)->create([
            'name' => 'Silla nro 300',
            'category_code' => 302
        ]);

        factory(Product::class)->create([
            'name' => 'Silla nro 400',
            'category_code' => 302
        ]);

        factory(Product::class)->create([
            'name' => 'Mesones nro 100',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Mesones nro 200',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Mesones nro 300',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Mesones nro 400',
            'category_code' => 301
        ]);

        factory(Product::class)->create([
            'name' => 'Sencilla de color Blanco',
            'category_code' => 303
        ]);

        factory(Product::class)->create([
            'name' => 'Sencilla de color amarillo',
            'category_code' => 303
        ]);

        factory(Product::class)->create([
            'name' => 'Con manta de color azul',
            'category_code' => 303
        ]);

        factory(Product::class)->create([
            'name' => 'Con manta de color rojo',
            'category_code' => 303
        ]);

        factory(Freight::class, 22)->create();
        factory(Vehicle::class, 22)->create();
        factory(Event::class, 22)->create();
        factory(Budget::class, 3)->create();
    }
}
