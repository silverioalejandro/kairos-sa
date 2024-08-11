<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TemplateType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FiltersTest extends TestCase
{
    public function testTemplateTypeFilterOk()
    {
        factory(TemplateType::class, 2)->create();
        $response = $this->json('GET', 'api/admin/filters/template-adm', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }
}
