<?php

namespace App\Services\Adapter\Api;

use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Log;

class PixelAdapter
{
    public function sendPixelToPublisher($params, $cpcPay): String
    {
        try {
            // $url = "https://feed.topdirectjobs.com/v1/controller.php?
            //         email=" . $params['email'] .
            //         "&list_id=" .$params['list_id'] .
            //         "&sourceip=" . $params['ip'] .
            //         "&keyword=" . $params['keyword'] .
            //         "&city=" . $params['city'] .
            //         "&state=" . $params['state'] .
            //         "&zip=" . $params['zip'];

            $event = 'Click_Em_Other';
            if($params['typeClick'] == 'list'){
                if($params['from'] == 'site'){
                    $event = 'Click_Site_JobListing';
                }else{
                    $event = 'Click_Em_JobListing';
                }
            }

            $url = "https://www.wallatrax.com/rd/ipx.php?
                    hid=" . $params['hid'] .
                    "&sid=" . $params['sid'] .
                    "&ate=" . $cpcPay .
                    "&atp=" . $cpcPay .
                    "&event" . $event;

            Curl::to($url)
                ->asJsonRequest()
                ->returnResponseObject()
                ->withTimeout(60)
                ->get();
        } catch (\Throwable $th) {
            throw $th;
        }

        Log::channel('pixel_send')->error('send pixel url: '.$url);
        return 'Success';
    }
}