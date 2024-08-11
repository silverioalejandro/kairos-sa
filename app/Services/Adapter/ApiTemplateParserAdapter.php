<?php

namespace App\Services\Adapter;

use Exception;
use App\Models\Rol;
use App\Models\Operator;
use App\Models\Publisher;
use App\Jobs\EmailTestJob;
use Ixudra\Curl\Facades\Curl;
use App\Helpers\PublisherHelper;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;

class ApiTemplateParserAdapter
{
    protected $url;

    public function __construct(){
        $this->url = config('services.api_syndication_parser_go.url');
    }

    public function parser(array $input): array
    {
        $publisherId = Auth::user()->publisher_id;
        $token = PublisherHelper::getTokenAuth($publisherId);

        $template = Template::find($input['templateId']);

        $url = $this->url . 'syndication/email/create?';
        $url .= 'template_id=' . $input["templateId"];
        $url .= '&email=' . $input["email"];
        $url .= '&campaign=test';
        $url .= '&keyword=cashier'; //. config('services.hireable.default_keyword');
        $url .= '&location=miami, FL'; //. config('services.hireable.default_location');
        $url .= '&days_back=' . config('services.hireable.default_days_back');
        $url .= '&first_name=test';
        $url .= '&last_name=test';
        $url .= '&jobs_list=' . config('services.hireable.default_jobs_list');
        $url .= '&hid=' . '1234';
        $url .= '&sid=' . '1234';
        $url .= '&list_id=' . '143634';
        $url .= '&token=' . $token;
        $url .= '&jpp=' . $template->jpp;
        $url .= '&from=email';

        if ($template->company){
            $url .= '&qtype=' . $template->company;
        }

        if ($template->to_job){
            $url .= '&linkto=true';
        }

        $url = str_replace(' ', '%20', $url);

        // logger('url');
        // logger($url);

        $response = Curl::to($url)
            ->asJsonRequest()
            ->withTimeout(60)
            ->get();

        if (strlen($response) == 0 ){
            return [
                "status" => 200,
                "error" => true,
                "msg" => "Not found data hireable"
            ];
        }

        $input['html'] = $response;
        $input['subject'] = "";

        if ($this->validateJSON($response)){
            $data = json_decode($response, true);
            $input['html'] = base64_decode($data["html"]);
            $input['subject'] = $data["subject"];
        }

        dispatch(new EmailTestJob($input));

        return [
            "status" => 200,
            "error" => false,
            "msg" => "sent"
        ];
    }

    function validateJSON(string $json): bool
    {
        try {
            $test = json_decode($json, null, JSON_THROW_ON_ERROR);
            if (is_object($test)) return true;
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}