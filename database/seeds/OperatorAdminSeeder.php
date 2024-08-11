<?php

use App\Models\Operator;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OperatorAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [ 'name' => 'Admin', 'email' => 'test@gmail.com', 'cellphone' => '11332', 'password' => bcrypt('123456'), 'api_token' => Str::uuid()],
        ];

        foreach ($admin as $item) {
            Operator::create([
                'name' => $item['name'],
                'email' => $item['email'],
                'cellphone' => $item['cellphone'],
                'password' => $item['password'],
                'api_token' => $item['api_token']
            ]);
        }
    }
}
