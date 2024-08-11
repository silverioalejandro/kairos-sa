<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Domain;
use App\Models\Operator;
use App\Models\Template;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemplatesTest extends TestCase
{
    public function testTemplaListAllOk()
    {
        factory(Domain::class, 2)->create();
        factory(Operator::class)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);
        factory(Operator::class)->create(['email' => 'test1@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        factory(Template::class, 2)->create(['publisher_id' => 2]);
        factory(Template::class, 3)->create(['publisher_id' => 1]);

        Template::create([
            'publisher_id' => 1,
            'name' => 'test 1',
            'pixels' => 'www www',
            'template' => '<p>test</p>',
            'template_type_id' => 1,
            'type_id' => 2
        ]);

        $response = $this->json('POST', '/api/admin/templates', [], $this->dataHeader(3));
        $response->assertStatus(200);
    }

    public function testTemplateCreateRejedRequired(){
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $response = $this->json('POST', '/api/admin/templates/create', [], $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["template", "name"]
            ]);
    }

    public function testTemplateCreateOk(){
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'name' => 'template 1',
            'pixels' => 'www - www -',
            'is_ongage' => false,
            'template' => '<p>pelota</p>',
            'keywords' => 'uno, dos, tres, cuatro',
            'template_type_id' => 1,
            'type_id' => 2
        ];

        $response = $this->json('POST', '/api/admin/templates/create', $input, $this->dataHeader(2));

        $response->assertStatus(201);
        $this->assertDatabaseHas("templates", $input);
    }

    public function testTemplateUpdateRejedRequered(){
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $response = $this->json('POST', '/api/admin/templates/update', [], $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["id", "template", "name"]
            ]);
    }

    public function testTemplateUpdateOk(){
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        Template::create([
            'publisher_id' => 1,
            'name' => 'test 1',
            'pixels' => 'aaa - aaa',
            'is_ongage' => false,
            'template' => '<p>test</p>',
            'template_type_id' => 1,
            'type_id' => 2
        ]);

        $input = [
            'id' => 1,
            'publisher_id' => 1,
            'name' => 'template 1',
            'is_ongage' => true,
            'pixels' => 'bbb - bbb',
            'template' => '<p>pelota</p>'
        ];

        $response = $this->json('POST', '/api/admin/templates/update', $input, $this->dataHeader(1));
        $response->assertStatus(201);
        $this->assertDatabaseHas("templates", $input);
    }

    public function testTemplateShow(){
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        Template::create([
            'publisher_id' => 1,
            'name' => 'test 1',
            'pixels' => 'aaa - aaa',
            'is_ongage' => false,
            'template' => '<p>test</p>',
            'template_type_id' => 1,
            'type_id' => 2
        ]);


        $response = $this->json('POST', '/api/admin/templates/1', [], $this->dataHeader(2));

        $response->assertStatus(200);
    }

    public function testTemplateActiveOk()
    {
        factory(Domain::class)->create(["is_active" => true]);

        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        Template::create([
            'publisher_id' => 1,
            'name' => 'test 1',
            'pixels' => 'aaa - aaa',
            'is_ongage' => false,
            'is_active' => true,
            'template' => '<p>test</p>',
            'template_type_id' => 1,
            'type_id' => 2
        ]);

        Template::create([
            'publisher_id' => 1,
            'name' => 'test 2',
            'pixels' => 'bbb - bbb',
            'is_ongage' => false,
            'is_active' => false,
            'template' => '<p>test</p>',
            'template_type_id' => 1,
            'type_id' => 2
        ]);

        $response = $this->json('POST', '/api/admin/templates/1/2/change-active', [], $this->dataHeader(2));

        $response->assertStatus(200);

        dd($response->content());


        $this->assertDatabaseHas("templates", [
            "id" => 1,
            "is_active" => false
        ]);

        $this->assertDatabaseHas("templates", [
            "id" => 2,
            "is_active" => true
        ]);
    }

    public function testTemplateTest()
    {
        factory(Domain::class)->create(["is_active" => true]);

        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        Template::create([
            'publisher_id' => 1,
            'name' => 'test 1',
            'pixels' => 'aaa - aaa',
            'is_ongage' => false,
            'is_active' => true,
            'template' => '<p>{{TITLE_STATE}}</p>',
            'template_type_id' => 3,
            'type_id' => 2
        ]);

        $input = [
            "email_from" => "test@tes.com",
            "email_to" => "test@test.com",
            "name" => "Test",
            "subject" => "Test"
        ];

        $response = $this->json('POST', '/api/admin/templates/1/test', $input, $this->dataHeader(2));
        $response->assertStatus(200);
    }

    public function testTemplateSendToNodeOk()
    {
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'name' => 'template 1',
            'pixels' => 'www - www -',
            'is_ongage' => false,
            'template' => '<p>pelota</p>',
            'keywords' => 'uno, dos, tres, cuatro',
            'template_type_id' => 1,
            'type_id' => 2
        ];

        $response = $this->json('POST', '/api/admin/templates/create', $input, $this->dataHeader(2));
        dd($response->content());
        $response->assertStatus(201);
        $this->assertDatabaseHas("templates", $input);
    }
}
