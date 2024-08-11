<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Domain;
use App\Models\Operator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OperatorTest extends TestCase
{
    public function testCreateOperatorAdminRejectedRequired()
    {
        $input = [];
        $response = $this->json('POST', '/api/admin/operators/admin/create', $input, $this->dataHeader(1));
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["name","email"]
            ]);
    }

    public function testCreateOperatorAdminOk()
    {
        $input = [
            'name' => 'test',
            'email' => 'test@test.com'
        ];

        $response = $this->json('POST', '/api/admin/operators/admin/create', $input, $this->dataHeader(1));

        $response->assertStatus(201);

    }

    public function testCreateOperatorAdminRejectedEmailExist()
    {
        $input = [
            'name' => 'test',
            'email' => 'dwbartet@gmail.com'
        ];

        $response = $this->json('POST', '/api/admin/operators/admin/create', $input, $this->dataHeader(1));
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["email"]
            ]);
    }

    public function testResetPassword()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $response = $this->json('POST', '/api/admin/operators/publisher/2/reset-password', [], $this->dataHeader(1));

        $response->assertStatus(200);
    }

    public function testResetMyPasswordRejedRequired()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $response = $this->json('POST', '/api/admin/operators/reset-my-password', [], $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["id","currentPassword","newPassword"]
            ]);
    }

    public function testResetMyPasswordNotMatch()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'id' => 3,
            'currentPassword' => 'secret12345699',
            'newPassword' => 'secretv2'
        ];

        $response = $this->json('POST', '/api/admin/operators/reset-my-password', $input, $this->dataHeader(1));
        $response->assertStatus(404);
    }
}
