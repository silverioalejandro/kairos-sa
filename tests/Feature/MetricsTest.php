<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Lead;
use App\Models\JobClick;
use App\Models\Operator;
use App\Models\Publisher;
use App\Models\PublisherCampaign;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MetricsTest extends TestCase
{
    public function testPublisherJobClick()
    {
        $this->seed('DataTestSeeder');
        factory(Lead::class, 50)->create();
        factory(JobClick::class, 50)->create();

        $response = $this->json('POST', '/api/admin/metrics/job-click', [], $this->dataHeader(2));
        $response->assertStatus(200);
    }

    public function testAdminJobClick()
    {
        $this->seed('DataTestSeeder');
        factory(Lead::class, 50)->create();
        factory(JobClick::class, 50)->create();
        $response = $this->json('POST', '/api/admin/metrics/job-click', [], $this->dataHeader(1));
        $response->assertStatus(200);
    }

    public function testPublisherAverageCpc()
    {
        $this->seed('DataTestSeeder');
        factory(Lead::class, 50)->create();
        factory(JobClick::class, 50)->create();
        $response = $this->json('POST', '/api/admin/metrics/average-cpc', [], $this->dataHeader(2));
        $response->assertStatus(200);
    }

    public function testPublisherCampaign()
    {
        $this->seed('DataTestSeeder');
        factory(Lead::class, 50)->create();
        factory(JobClick::class, 50)->create();
        factory(PublisherCampaign::class, 50)->create();

        $response = $this->json('POST', '/api/admin/metrics/publisher-campaign-details', [], $this->dataHeader(2));
        $response->assertStatus(200);
    }

    public function testTotalClickLastWeek()
    {
        $this->seed('DataTestSeeder');
        factory(Lead::class, 50)->create();
        factory(JobClick::class, 50)->create();
        factory(PublisherCampaign::class, 50)->create();

        $response = $this->json('POST', '/api/admin/metrics/tc-last-week', [], $this->dataHeader(2));

        dd($response->content());

        $response->assertStatus(200);
    }

    public function testPublisherExport()
    {
        $this->seed('DataTestSeeder');
        factory(Lead::class, 50)->create();
        factory(JobClick::class, 50)->create();
        factory(PublisherCampaign::class, 50)->create();

        $response = $this->json('POST', '/api/admin/metrics/export', [], $this->dataHeader(2));

        dd($response->content());

    }

    public function testAdminExport()
    {
        dd("passesee Admin");
    }
}
