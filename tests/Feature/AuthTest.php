<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Domain;
use App\Models\Operator;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{

    public function testOperatorLoginOk()
	{
        factory(Domain::class, 1)->create();
		$user = factory(Operator::class, 1)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('secret'),
            'is_active' => 1,
            'role_id' => Operator::PUBLISHER
        ])->first();

		$response = $this->post('/api/admin/operators/login', ['email' => $user->email, 'password' => 'secret']);
		$response->assertStatus(200);
	}

    public function testOperatorLoginRejedInactive()
	{
        factory(Domain::class, 1)->create();
		$user = factory(Operator::class, 1)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('secret'),
            'is_active' => 0,
            'role_id' => Operator::PUBLISHER
        ])->first();

		$response = $this->post('/api/admin/operators/login', ['email' => $user->email, 'password' => 'secret']);
		$response->assertStatus(401);
	}
}
