<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TemplateAdm;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PixelsTest extends TestCase
{
    public function testJobClickFromEmailOk()
    {
        $this->seed('DataTestSeeder');
        TemplateAdm::find(2);

        $input = [
            'email' => 'test@test.com',
            'publisher' => 3,
            'list_id' => 33,
            'from' => 'email',
            'template' => 1,
            'typeClick' => 'list',
            'keyword' => 'Manager',
            'zip' => 'CDC',
            'campaign'  => 'aa-rt-123',
            'hr_job_id'  => '',
            'hr_provider' => '',
            'cpc' => '10',
            'siteId' => '',
            'job_link' => 'ruta-link',
            'city' => 'New, York',
            'state' => 'FL',
            'ip' => '123.456.789.000'
        ];

        $response = $this->json('POST', '/api/syndication/pixel/jobclick', $input, $this->dataHeader(4));

        $response->assertStatus(200);

        $this->assertDatabaseHas("leads", [
            "email" => $input['email'],
            "click" => 3
        ]);

        $this->assertDatabaseHas("job_clicks", [
            "lead_id" => 1,
            "publisher_id" => $input['publisher'],
            "campaign_id" => $input['campaign'],
            "template_id" => $input['template'],
            "job_link" => $input['job_link'],
            "cpc_charged" => $input['cpc'],
            "cpc_pay" => 1.0,
            "from" => $input['from'],
            "ip" => $input['ip']
        ]);
    }

    public function testJobclickFromSiteOK()
    {
        $this->seed('DataTestSeeder');
        TemplateAdm::find(2);

        $input = [
            'email' => 'test@test.com',
            'publisher' => 3,
            'list_id' => 33,
            'from' => 'site',
            'template' => 1,
            'typeClick' => 'list',
            'keyword' => 'Manager',
            'zip' => 'CDC',
            'campaign'  => 'aa-rt-123',
            'hr_job_id'  => '',
            'hr_provider' => '',
            'cpc' => '10',
            'siteId' => '',
            'job_link' => 'ruta-link',
            'city' => 'New, York',
            'state' => 'FL',
            'ip' => '123.456.789.000'
        ];

        $response = $this->json('POST', '/api/syndication/pixel/jobclick', $input, $this->dataHeader(4));
        $response->assertStatus(200);

        $this->assertDatabaseHas("leads", [
            "email" => $input['email'],
            "click" => 2
        ]);

        $this->assertDatabaseHas("job_clicks", [
            "lead_id" => 1,
            "publisher_id" => $input['publisher'],
            "campaign_id" => $input['campaign'],
            "template_id" => $input['template'],
            "job_link" => $input['job_link'],
            "cpc_charged" => $input['cpc'],
            "cpc_pay" => 1.0,
            "from" => $input['from'],
            "ip" => $input['ip']
        ]);
    }

    public function testJobclickFromSiteNewEmailOK()
    {
        $this->seed('DataTestSeeder');
        TemplateAdm::find(2);

        $input = [
            'email' => 'test1@test.com',
            'publisher' => 3,
            'list_id' => 33,
            'from' => 'site',
            'template' => 1,
            'typeClick' => 'list',
            'keyword' => 'Manager',
            'zip' => 'CDC',
            'campaign'  => 'aa-rt-123',
            'hr_job_id'  => '',
            'hr_provider' => '',
            'cpc' => '10',
            'siteId' => '',
            'job_link' => 'ruta-link',
            'city' => 'New, York',
            'state' => 'FL',
            'ip' => '123.456.789.000'
        ];

        $response = $this->json('POST', '/api/syndication/pixel/jobclick', $input, $this->dataHeader(4));
        $response->assertStatus(200);

        $this->assertDatabaseHas("leads", [
            "email" => $input['email'],
            "click" => 0
        ]);

        $this->assertDatabaseHas("job_clicks", [
            "lead_id" => 2,
            "publisher_id" => $input['publisher'],
            "campaign_id" => $input['campaign'],
            "template_id" => $input['template'],
            "job_link" => $input['job_link'],
            "cpc_charged" => $input['cpc'],
            "cpc_pay" => 1.0,
            "from" => $input['from'],
            "ip" => $input['ip']
        ]);
    }
}
