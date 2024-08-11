<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Domain;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DomainsTest extends TestCase
{

    public function testDomainsAllOk()
    {
        factory(Domain::class, 2)->create();

        $response = $this->json('POST', '/api/admin/domains', [], $this->dataHeader(1));
        $response->assertStatus(200);

    }

    public function testCreateDomainRejectedRequired()
    {
        $input = [];

        $response = $this->json('POST', '/api/admin/domains/create', $input, $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["name", "domain"]
            ]);
    }

    public function testCreateDomainRejectedNameOrDomainExist()
    {
        factory(Domain::class)->create(['name' => 'test', 'domain' => 'test.com']);

        $input = [
            'name' => 'test',
            'domain' => 'test.com'
        ];

        $response = $this->json('POST', '/api/admin/domains/create', $input, $this->dataHeader(1));
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["name", "domain"]
            ]);
    }

    public function testCreateDomainOk()
    {
        $input = [
            'name' => 'test',
            'domain' => 'test.com',
            'description' => 'test test test'
        ];

        $response = $this->json('POST', '/api/admin/domains/create', $input, $this->dataHeader(1));
        $response->assertStatus(201);
    }

    public function testDomainActiveOk()
    {
        factory(Domain::class)->create(["is_active" => true]);

        $response = $this->json('POST', '/api/admin/domains/1/change-active', [], $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("domains", [
            "id" => 1,
            "is_active" => false
        ]);
    }

    public function testUpdateDomainRejedNameOrDamainExist()
    {
        factory(Domain::class, 1)->create(["name" => "test", "domain" => "test.com"]);
        factory(Domain::class, 1)->create();

        $input = [
            'id' => 2,
            'name' => 'test',
            'domain' => 'test.com',
        ];

        $response = $this->json('POST', '/api/admin/domains/update', $input, $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["name", "domain"]
            ]);
    }

    public function testUpdateDomainOk()
    {
        factory(Domain::class, 1)->create(["name" => "test", "domain" => "test.com"]);

        $input = [
            'id' => 1,
            'name' => 'test2',
            'domain' => 'test2.com',
            'description' => 'test2 test2 test2'
        ];

        $response = $this->json('POST', '/api/admin/domains/update', $input, $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("domains", $input);
    }
}
