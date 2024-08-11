<?php

namespace App\Services\Adapter;

use Ixudra\Curl\Facades\Curl;

class HireableAdapter
{
    protected $url;

    public function __construct(){
        $this->url = config('services.hireable.url_base');
    }

    public function all(array $input): array
    {
        $parameter['keyword'] = isset($input['keyword']) ? $input['keyword'] : config('services.hireable.default_keyword');
        $parameter['location']  = isset($input['location']) ? $input['location'] : config('services.hireable.default_location');
        $parameter['siteid']  = config('services.hireable.site_id');
        $parameter['jpp']  = isset($input['jobs_list']) ? $input['jobs_list'] : config('services.hireable.default_jobs_list');
        $parameter['sp']  = 1;
        $parameter['sf'] = 1;
        $parameter['email']  = isset($input['email']) ? $input['email'] : '';
        $parameter['first_name']  = isset($input['first_name']) ? $input['first_name'] : '';
        $parameter['last_name']  = isset($input['last_name']) ? $input['last_name'] : '';
        $parameter['emd5']  = '';
        $parameter['token']  = config('services.hireable.token_hr');
        $parameter['r'] =25;
        $parameter['ch'] ='v1';
        $parameter['source'] ='search';
        $parameter['daysBack'] = isset($input['days_back']) ? $input['days_back'] : config('services.hireable.default_days_back');
        $parameter['salary'] ='true';
        $parameter['sid']  = isset($input['sid']) ? $input['sid'] : 0; //required
        $parameter['hid']  = isset($input['hid']) ? $input['hid'] : 0; //required
        $parameter['list_id']  = isset($input['list_id']) ? $input['list_id'] : 0; //required
        $parameter['campaign']  = isset($input['campaign']) ? $input['campaign'] : 0;

        $query = "/?q=" .$parameter['keyword'] .
                "&l=".$parameter['location'] .
                "&siteid=" .$parameter['siteid'] .
                "&jpp=" .$parameter['jpp'] .
                "&sp=" .$parameter['sp'] .
                "&sf=" .$parameter['sf'];
        $query = $query .
                "&email=" .$parameter['email'] .
                "&emd5=" .$parameter['emd5'] .
                "&tk=" .$parameter['token'] .
                "&r=" .$parameter['r'] .
                "&ch=" .$parameter['ch'] .
                "&source=" .$parameter['source'];
        $query = $query .
                "&daysBack=" .$parameter['daysBack'] .
                "&salary=" .$parameter['salary'];

        $this->url = str_replace(' ', '%20', $this->url . $query);

        $response = Curl::to($this->url)
            ->asJsonRequest()
            ->returnResponseObject()
            ->withOption('SSL_VERIFYHOST', false)
            ->withTimeout(60)
            ->get();

        if($response->content){
            $data = json_decode($response->content,true);

            $hireable = collect($data['hits'])->map(function ($item) {
                return [
                    'title' => $item['title'],
                    'city' => $item['city'],
                    'state' => $item['state'],
                    'url' => $item['url'],
                    'company' => $item['company'],
                    'logo' => $item['logo'],
                    'summary' => $item['summary'],
                    'creationDate' => $item['creationDate']
                ];
            })->values()->all();



            $defaultCity = explode(",", config('services.hireable.default_location'))[0];
            $defaultState = explode(",", config('services.hireable.default_location'))[1];

            $valueCity = isset($data['location']) && isset($data['location']['city']) ? $data['location']['city']: $defaultCity;
            $valueState = isset($data['location']) && isset($data['location']['state']) ? $data['location']['state']: $defaultState;

            return [
                'hireable' => $hireable,
                'query' => $parameter['keyword'],
                'title_city' => $valueCity,
                'title_state' => $valueState,
                'more_jobs' => $valueCity,
                'parameters' => $parameter
            ];
        }

        return [];
    }


}