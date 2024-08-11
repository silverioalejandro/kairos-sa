<?php

namespace App\Services\Adapter\Api;

use Ixudra\Curl\Facades\Curl;

class UpdatePublisherCampaignClickAdapter
{
    private $url;
    private $token;

    public function __construct(){
        $this->url = config('services.api_syndication_parser_go.url');
        $this->token = config('services.api_syndication_parser_go.token');
    }

    public function updateClick(): array
    {
        $url = $this->url."parser/publisher_campaign_click";

        $response = Curl::to($url)
            ->withTimeout(20)
            ->post();
        if(empty($response)) {
            return [];
        }
        return json_decode($response, true);
    }
}