<?php

namespace App\Services\Adapter\Api;

use Ixudra\Curl\Facades\Curl;

class HireableAdapter
{
    private $url;

    public function __construct(){
        $this->url = config('services.hireable.url');
    }

    public function all(): array
    {
        $response = Curl::to($this->url)
            ->asJsonRequest()
            ->returnResponseObject()
            ->withTimeout(60)
            ->get();

        if($response->content){
            $data = json_decode($response->content,true);
            return collect($data['hits'])->map(function ($item) {
                return [
                    'title' => $item['title'],
                    'city' => $item['city'],
                    'state' => $item['state'],
                    'url' => $item['url'],
                    'company' => $item['company'],
                    'logo' => $item['logo']
                ];
            })->values()->all();
        }

        return [];
    }
}