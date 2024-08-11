<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMe()
    {

        $this->seed('DataTestSeeder');
        $response = $this->json('POST', '/api/me', [], $this->dataHeader(4));
        $response->assertStatus(200);
    }
}
