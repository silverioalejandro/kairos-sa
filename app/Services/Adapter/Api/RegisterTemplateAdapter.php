<?php

namespace App\Services\Adapter\Api;

use Ixudra\Curl\Facades\Curl;

class RegisterTemplateAdapter
{
    private $url;
    private $token;

    public function __construct(){
        $this->url = config('services.api_syndication_parser_go.url');
        $this->token = config('services.api_syndication_parser_go.token');
    }

    public function registerTemplate(array $input): array
    {
        $url = $this->url . "parser/save_template";
        $input["template_id"] = $input["id"];

        $response = Curl::to($url)
            ->withContentType("application/x-www-form-urlencoded")
            ->withData($input)
            ->withTimeout(20)
            ->post();

        return json_decode($response, true);
    }

    public function activeTemplate(array $input): array
    {
        $url = $this->url . "parser/active_template";

        $response = Curl::to($url)
            ->withContentType("application/x-www-form-urlencoded")
            ->withData($input)
            ->withTimeout(20)
            ->post();

        return json_decode($response, true);
    }

    public function validConnectionMongo() :array
    {
        $url = $this->url . "test";

        $response = Curl::to($url)
            ->withContentType("application/x-www-form-urlencoded")
            ->withTimeout(20)
            ->get();

        if (collect($response) == "[false]"){
            return [
                'status_code' => 500,
                'message' => 'Error connecting to MongoDB server',
            ];
        }

        return json_decode($response, true);
    }
}