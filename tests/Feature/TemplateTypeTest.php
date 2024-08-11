<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Operator;
use App\Models\TemplateType;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemplateTypeTest extends TestCase
{
    public function testTemplateTypeListOk()
    {
        factory(TemplateType::class, 4)->create();
        $response = $this->json('POST', '/api/admin/template-type', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }

    public function testTemplateTypeCreateRejedRequired()
    {
        $response = $this->json('POST', '/api/admin/template-type/create', [], $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["name", "dictionary", "type_id"]
            ]);
    }

    public function testTemplateTypeCreateOk()
    {
        $input = factory(TemplateType::class)->make()->toArray();
        $input['image'] = UploadedFile::fake()->image('avatar.jpg');
        $input['operator_id'] = 1;
        $response = $this->json('POST', '/api/admin/template-type/create', $input, $this->dataHeader(1));

        $response->assertStatus(201);
    }

    public function testTemplateTypeUpdateRejedRequired()
    {
        $response = $this->json('POST', '/api/admin/template-type/update', [], $this->dataHeader(1));
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["id","name", "dictionary", "type_id"]
            ]);
    }

    public function testTemplateTypeUpdateOk()
    {
        factory(TemplateType::class)->create()->toArray();
        $input = [
            "id" => 1,
            "name" => "hd",
            // 'image' => UploadedFile::fake()->image('avatar.jpg'),
            "description" => "hd",
            "dictionary" => '[{"hd":"hd"}]',
            "type_id" => 2
        ];

        $response = $this->json('POST', '/api/admin/template-type/update', $input, $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("template_types", $input);
    }

    public function testTemplateTypeUpdateStatusOk()
    {
        $data = factory(TemplateType::class)->create([
            'is_active' => true
        ])->toArray();

        $response = $this->json('POST', '/api/admin/template-type/2/updateStatus', [], $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("template_types", ['id' => 2, 'is_active' => false]);
    }

    public function testTemplateTypeShow(){
        factory(TemplateType::class, 2)->create();
        $response = $this->json('POST', '/api/admin/template-type/1', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }
}
