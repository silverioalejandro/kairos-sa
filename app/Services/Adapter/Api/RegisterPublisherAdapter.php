<?php

namespace App\Services\Adapter\Api;

use Ixudra\Curl\Facades\Curl;

class RegisterPublisherAdapter
{
    private $url;
    private $token;

    public function __construct(){
        $this->url = config('services.api_syndication_parser_go.url');
        $this->token = config('services.api_syndication_parser_go.token');
    }

    public function registerPublisher(array $input): array
    {
        $url = $this->url . "parser/save_publisher/" . $input['publisher_id'] . "/" . $input['token'] . "/";

        $response = Curl::to($url)
            ->withContentType("application/x-www-form-urlencoded")
            ->withTimeout(20)
            ->post();

        return json_decode($response, true);
    }
}