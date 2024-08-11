<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TemplateAdm;
use App\Models\TemplateType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemplateAdmTest extends TestCase
{
    public function testTemplateAdmListOk()
    {
        factory(TemplateType::class, 2)->create();
        factory(TemplateAdm::class, 4)->create();

        $response = $this->json('POST', '/api/admin/template-adm', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }

    public function testTemplateAdmCreateRejedRequired()
    {
        $response = $this->json('POST', '/api/admin/template-adm/create', [], $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["name", "template_type_id", "template"]
            ]);
    }

    public function testTemplateAdmCreateOk()
    {
        factory(TemplateType::class, 1)->create();
        $input = factory(TemplateAdm::class)->make(['operator_id' => 1])->toArray();

        $response = $this->json('POST', '/api/admin/template-adm/create', $input, $this->dataHeader(1));
        $response->assertStatus(201);
        $this->assertDatabaseHas("template_adms", $input);
    }

    public function testTemplateAdmUpdateRejedRequired()
    {
        $response = $this->json('POST', '/api/admin/template-adm/update', [], $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["id", "name", "template_type_id", "template"]
            ]);
    }

    public function testTemplateAdminUpdateOk()
    {
        factory(TemplateType::class, 1)->create();
        factory(TemplateAdm::class)->create()->toArray();
        $input = [
            "id" => 1,
            "name" => "hd",
            "description" => "hd",
            "template_type_id" => 1,
            "operator_id" => 1,
            "template" => "Test2"
        ];

        $response = $this->json('POST', '/api/admin/template-adm/update', $input,
        $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("template_adms", $input);
    }

    public function testTemplateAdmUpdateStatusOk()
    {
        factory(TemplateType::class, 1)->create();
        factory(TemplateAdm::class)->create([
            'is_active' => true
        ])->toArray();

        $response = $this->json('POST', '/api/admin/template-adm/2/updateStatus', [], $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("template_adms", ['id' => 2, 'is_active' => false]);
    }
}
