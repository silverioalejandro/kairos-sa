<?php

namespace Tests;

use App\Models\Operator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function dataHeader(int $operatorId)
    {
        $operator = Operator::find($operatorId);
        $this->actingAs($operator);
        return [
            'Accept' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
            'Authorization' => "Bearer {$operator->api_token}"
        ];
    }
}
