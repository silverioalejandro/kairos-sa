<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Domain;
use App\Models\Operator;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HtmlTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHtmlCreateRejedRequired()
    {
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $response = $this->json('POST', '/api/admin/operators/publisher/create-html', [], $this->dataHeader(1));
        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["publisher_id", "html"]
            ]);
    }

    public function testHtmlCreateOk()
    {
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'publisher_id' => 3,
            'html' => '<p>test</p>'
        ];

        $response = $this->json('POST', '/api/admin/operators/publisher/create-html', $input, $this->dataHeader(1));

        $response->assertStatus(201);
        $this->assertDatabaseHas("publisher_htmls", $input);

        $input = [
            'publisher_id' => 3,
            'html' => '<p>test-v2</p>'
        ];

        $response = $this->json('POST', '/api/admin/operators/publisher/create-html', $input, $this->dataHeader(1));

        $response->assertStatus(201);
        $this->assertDatabaseHas("publisher_htmls", $input);
    }

    public function testHtmlShow(){
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'publisher_id' => 3,
            'html' => '<p>test</p>'
        ];

        $response = $this->json('POST', '/api/admin/operators/publisher/create-html', $input, $this->dataHeader(1));
        $response = $this->json('POST', '/api/admin/operators/publisher/3/show-html', [], $this->dataHeader(1));

        $response->assertStatus(200);
    }
}
