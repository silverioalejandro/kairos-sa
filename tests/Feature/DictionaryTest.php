<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DictionaryTest extends TestCase
{
    public function testDomainsAllOk()
    {
        $response = $this->json('POST', '/api/admin/dictionary', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }
}
