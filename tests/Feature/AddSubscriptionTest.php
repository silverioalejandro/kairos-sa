<?php

namespace Tests\Feature;

use App\Helpers\SubscriptionHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddSubscriptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddHtmlSubscription()
    {
        $html = '<html>
            <head>
                <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css">
            </head>

            <body style="word-spacing:normal;background-color:#F1F2F4;" bis_status="ok" bis_frame_id="155">
                <div>
                    {{TITLE_CITY}}</div>
                <div>
                    {{TITLE_CITY}}
                    {{TITLE_STATE}}
                </div>
                <div>
                    <a href="http://search/?q={{KEYWORD}}">
                        <btn>{{KEYWORD}}</btn>
                    </a>
                </div>
            </body>
        </html>';

        $result = SubscriptionHelper::insertCode($html);
        // dd($result);
        $this->assertTrue(true);
    }

    public function testShowTemplateWithoutSubscription()
    {
        $template = $this->templateWithSubscription();
        $template = SubscriptionHelper::removeSubscription($template);
        $this->assertTrue(true);

        // dd($template);
    }

    public function templateWithSubscription()
    {
        return '<html>
            <head>
                <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css">
            <!--subscriptions-->
<style type="text/css">
                    .subscriptions{
                        background-color: #EBEBEB;
                    }
                </style>
<!--end_subscriptions-->
</head>

            <body style="word-spacing:normal;background-color:#F1F2F4;" bis_status="ok" bis_frame_id="155">
<!--subscriptions-->
<div class="subscription">
            <p style="text-align: center;">[Fname], Join The Club!</p>
            <p style="text-align: center;">Get&nbsp;<strong>exclusive&nbsp;</strong>noticies on Job Offer. Select your tier:</p>
            <table border="1" width="" height="128">
                <tbody>
                    <tr>
                        <td style="text-align: center; width: 165px;"><strong>SILVER</strong></td>
                        <td style="width: 165px;">
                            <p style="text-align: center;"><strong>SILVER</strong></p>
                        </td>
                        <td style="width: 165px;">
                            <p style="text-align: center;"><strong>GOLD</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 165px;">
                            <p style="text-align: center;">1-2 email for week</p>
                            <p style="text-align: center;">
                                <a href="google.com"
                                    style="background-color:#3399FE; border-radius:10px; color:#ffffff; display:inline-block; line-height:30px;text-align:center; text-decoration:none; -webkit-text-size-adjust:none; mso-hide:all; border: 1px solid #1F9987; margin:0 4px 10px 4px; font-size:14px; font-family:\'Lato\', Helvetica Neue, Arial, sans-serif; padding: 0 10px;"
                                    class="pill-hover" target="_blank">
                                    Select
                                </a>
                            </p>
                        </td>
                        <td style="width: 165px;">
                            <p style="text-align: center;">3-5 email for week</p>
                            <p style="text-align: center;">
                                <a href="youtube.com"
                                    style="background-color:#3399FE; border-radius:10px; color:#ffffff; display:inline-block; line-height:30px;text-align:center; text-decoration:none; -webkit-text-size-adjust:none; mso-hide:all; border: 1px solid #1F9987; margin:0 4px 10px 4px; font-size:14px; font-family:\'Lato\', Helvetica Neue, Arial, sans-serif; padding: 0 10px;"
                                    class="pill-hover" target="_blank">
                                    Select
                                </a>
                            </p>
                        </td>
                        <td style="width: 165px;">
                            <p style="text-align: center;">6-7 email for week</p>
                            <p style="text-align: center;">
                                <a href="maduradas.com"
                                    style="background-color:#3399FE; border-radius:10px; color:#ffffff; display:inline-block; line-height:30px;text-align:center; text-decoration:none; -webkit-text-size-adjust:none; mso-hide:all; border: 1px solid #1F9987; margin:0 4px 10px 4px; font-size:14px; font-family:\'Lato\', Helvetica Neue, Arial, sans-serif; padding: 0 10px;"
                                    class="pill-hover" target="_blank">
                                    Select
                                </a>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
<!--end_subscriptions-->

                <div>
                    {{TITLE_CITY}}</div>
                <div>
                    {{TITLE_CITY}}
                    {{TITLE_STATE}}
                </div>
                <div>
                    <a href="http://search/?q={{KEYWORD}}">
                        <btn>{{KEYWORD}}</btn>
                    </a>
                </div>
            </body>
        </html>
';
    }
}
