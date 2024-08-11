<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Domain;
use App\Models\Operator;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublisherTest extends TestCase
{
    public function testOperatorLoginRejedDueDate()
	{
		factory(Domain::class, 1)->create();
		$user = factory(Operator::class, 1)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('secret'),
            'is_active' => 1,
            'role_id' => Operator::PUBLISHER
        ])->first();

        Publisher::where('operator_id', $user->id)
            ->update([
                'due_date' => '2022-04-01'
            ]);

		$response = $this->post('/api/admin/operators/login', ['email' => $user->email, 'password' => 'secret']);
		$response->assertStatus(401);
	}

    public function testCreateOperatorPublisherRejectedRequired()
    {
        $input = [];
        $response = $this->json('POST', '/api/admin/operators/publisher/create', $input, $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["name","email","company","domain_id","pay"]
            ]);
    }

    public function testUpdateOperatorPublisherAllRejectedRequired()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [];
        $response = $this->json('POST', '/api/admin/operators/publisher/update', $input, $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["operator_id","name","email","company","domain_id","pay"]
            ]);
    }

    public function testUpdateOperatorPublisherEmailExistRejected()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'id' => 2,
            'name' => 'test',
            'email' => 'test@test.com',
            'company' => 'test company',
            'domain_id' => 1,
            'pay' => '5'
        ];

        $response = $this->json('POST', '/api/admin/operators/publisher/update', $input, $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["email"]
            ]);
    }

    public function testUpdateOperatorPublisherOk()
    {
        factory(Domain::class, 2)->create();
        factory(Operator::class, 1)->create(['email' => 'test@test.com', 'is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'operator_id' => 2,
            'name' => 'test2',
            'email' => 'test2@test.com',
            'company' => 'test2 company',
            'domain_id' => 2,
            'pay' => '6'
        ];

        $response = $this->json('POST', '/api/admin/operators/publisher/update', $input, $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("publishers", [
            "operator_id" => $input['operator_id'],
            "company" => $input['company'],
            "domain_id" => $input['domain_id'],
            "pay" => $input['pay']
        ]);
    }

    public function testCreateOperatorPublisherOk()
    {
        factory(Domain::class)->create();

        $input = [
            'name' => 'test',
            'email' => 'test@test.com',
            'company' => 'test company',
            'domain_id' => 1,
            'pay' => '7.70'
        ];

        $response = $this->json('POST', '/api/admin/operators/publisher/create', $input, $this->dataHeader(1));

        $response->assertStatus(201);
        $this->assertDatabaseHas("publishers", [
            "id" => 1,
            "operator_id" => 2,
            "company" => "test company",
            "domain_id" => 1,
            "pay" => "7.70"
        ]);
    }

    public function testOperatorPublisherActiveOk()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [];

        $response = $this->json('POST', '/api/admin/operators/publisher/2/change-active', $input, $this->dataHeader(1));
        $response->assertStatus(200);
        $this->assertDatabaseHas("operators", [
            "id" => 2,
            "is_active" => false
        ]);
    }

    public function testPublisherDueDateRejectedRequired()
    {
        $input = [];

        $response = $this->json('POST', '/api/admin/operators/publisher/due-date', $input, $this->dataHeader(1));

        $response->assertStatus(422)
            ->assertJsonStructure([
                'errors' => ["publisher_id"]
            ]);
    }

    public function testOperatorPublisherDueDateOk()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $input = [
            'publisher_id' => 1,
            'due_date' => '2022-06-01'
        ];

        $response = $this->json('POST', '/api/admin/operators/publisher/due-date', $input, $this->dataHeader(1));

        $response->assertStatus(200);
        $this->assertDatabaseHas("publishers", [
            "id" => 1,
            "operator_id" => 2,
            "due_date" => $input['due_date']
        ]);
    }

    public function testPublisherAllOk()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 2)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $response = $this->json('POST', '/api/admin/operators/publisher', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }

    public function testPublisherShowOk()
    {
        factory(Domain::class)->create();
        factory(Operator::class, 1)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);
        $response = $this->json('POST', '/api/admin/operators/publisher/3/show', [], $this->dataHeader(1));

        $response->assertStatus(200);
    }

    public function testPublisherList(){
        factory(Domain::class, 2)->create();
        factory(Operator::class, 2)->create(['is_active' => 1, 'role_id' => Operator::PUBLISHER]);

        $response = $this->json('GET', '/api/admin/filters/publishers', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }
}
