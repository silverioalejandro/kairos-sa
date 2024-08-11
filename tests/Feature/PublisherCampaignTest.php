<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublisherCampaignTest extends TestCase
{
    public function testPublisherCampaignTokenInvalid()
    {
        $input = [ 'token' => 'wer234234' ];

        $response = $this->json('POST', '/api/syndication/register/publisher-campaign', $input);
        $response->assertStatus(403)
            ->assertJsonStructure([
                'error'
            ]);
    }

    public function testPublisherCampaignRequired()
    {
        $input = [
            'token' => config('services.api_syndication_parser_go.token_app')
        ];

        $response = $this->json('POST', '/api/syndication/register/publisher-campaign', $input);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => ['campaign_id', 'publisher_id', 'api_call', 'error']
            ]);
    }

    public function testPublisherCampaignOk()
    {
        $this->seed('DataTestSeeder');

        $input = [
            'token' => config('services.api_syndication_parser_go.token_app'),
            'campaign_id' => 'AAA-1123',
            'publisher_id' => '2',
            'api_call' => 20,
            'error' => 10
        ];

        $response = $this->json('POST', '/api/syndication/register/publisher-campaign', $input);

        unset($input['token']);
        $response->assertStatus(200);
        $this->assertDatabaseHas("publisher_campaigns", $input);


        $input = [
            'token' => config('services.api_syndication_parser_go.token_app'),
            'campaign_id' => 'AAA-1123',
            'publisher_id' => '2',
            'api_call' => 80,
            'error' => 30
        ];

        $response = $this->json('POST', '/api/syndication/register/publisher-campaign', $input);

        unset($input['token']);
        $response->assertStatus(200);
        $this->assertDatabaseHas("publisher_campaigns", $input);
    }
}
