<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Template;
use App\Models\TemplateAdm;
use App\Models\PublisherCampaign;

class HireableTest extends TestCase
{
    public function testSyndicationEmailCreateButton()
    {
        $this->seed('DataTestSeeder');
        $template = TemplateAdm::find(2);

        $input = [
            'name' => "prueba test",
            'pixels' => null,
            'is_ongage' => true,
            'publisher_id' => 3,
            'is_active' => 1,
            'keywords' => 'Customer Service, Data Entry, Manager, Server',
            'template_type_id' => $template->template_type_id,
            'type_id' => $template->template_type_id,
            'campaign' => 'YT-21',
            'template' => $this->repeatButton()
        ];
        Template::create($input);

        $response = $this->json('GET', '/api/syndication/email/create', $input, $this->dataHeader(4));

        $response->assertStatus(200);
        $this->assertDatabaseHas("publisher_campaigns", [
            "campaign_id" => $input['campaign'],
            "publisher_id" => $input['publisher_id'],
            "api_call" => 1,
            "error" => 0
        ]);
    }

    public function testSyndicationEmailCreateList()
    {
        $this->seed('DataTestSeeder');
        $template = TemplateAdm::find(2);

        $input = [
            'name' => "prueba test",
            'pixels' => null,
            'is_ongage' => true,
            'publisher_id' => 3,
            'is_active' => 1,
            'keywords' => 'Customer Service, Data Entry, Manager, Server',
            'template_type_id' => $template->template_type_id,
            'type_id' => $template->template_type_id,
            'campaign' => 'YT-21',
            'template' => $this->repeatList()
        ];
        Template::create($input);

        $response = $this->json('GET', '/api/syndication/email/create', $input, $this->dataHeader(4));
        $response->assertStatus(200);
    }

    public function testSyndicationEmailCreateListButton()
    {
        $this->seed('DataTestSeeder');
        $template = TemplateAdm::find(2);

        $input = [
            'name' => "prueba test",
            'pixels' => null,
            'is_ongage' => true,
            'publisher_id' => 3,
            'is_active' => 1,
            'keywords' => 'Customer Service, Data Entry, Manager, Server',
            'template_type_id' => $template->template_type_id,
            'type_id' => $template->template_type_id,
            'campaign' => 'YT-21',
            'template' => $this->listAndButton()
        ];
        Template::create($input);

        $response = $this->json('GET', '/api/syndication/email/create', $input, $this->dataHeader(4));
        $response->assertStatus(200);
    }

    public function html()
    {
        return '<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>

        <body style="word-spacing:normal;background-color:#F1F2F4;" bis_status="ok" bis_frame_id="155">

            <div
                style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
                Find your next Sales job today
            </div>


            <div style="background-color:#F1F2F4;">

                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                    style="background:#ffffff;background-color:#ffffff;width:100%;">
                    <tbody>
                        <tr>
                            <td>


                                <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#ffffff" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->


                                <div style="margin:0px auto;max-width:600px;">

                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td style="direction:ltr;font-size:0px;padding:0;text-align:center;">
                                                    <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->

                                                    <div class="mj-column-per-100 mj-outlook-group-fix"
                                                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">

                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                                            width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="vertical-align:top;padding:5px 0;">

                                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                                            role="presentation" style="" width="100%">
                                                                            <tbody>

                                                                                <tr>
                                                                                    <td align="center"
                                                                                        style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                                                        <table border="0" cellpadding="0"
                                                                                            cellspacing="0" role="presentation"
                                                                                            style="border-collapse:collapse;border-spacing:0px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td style="width:140px;">

                                                                                                        <a href="https://boldcareers.com/"
                                                                                                            target="_blank">

                                                                                                            <img alt="FYC Logo"
                                                                                                                height="auto"
                                                                                                                src="https://str.findyourcareer.com/fyc_logo_white_outline.png"
                                                                                                                style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;"
                                                                                                                width="140">

                                                                                                        </a>

                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>

                                                                                    </td>
                                                                                </tr>

                                                                            </tbody>
                                                                        </table>

                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>

                                                    <!--[if mso | IE]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>


                                <!--[if mso | IE]></td></tr></table><![endif]-->


                            </td>
                        </tr>
                    </tbody>
                </table>


                <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
                <div style="margin:0px auto;max-width:600px;">

                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                                    <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:420px;" ><![endif]-->

                                    <div class="mj-column-per-70 mj-outlook-group-fix"
                                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">

                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                            style="vertical-align:top;" width="100%">
                                            <tbody>

                                                <tr>
                                                    <td align="center"
                                                        style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                        <div
                                                            style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:center;color:#4C5C68;">
                                                            <h3>Looking for a new job?</h3>
                                                            Find your career curates the best opportunities for you.

                                                            <br> <br>
                                                            Here are the latest openings for <b>{{QUERY}}</b> jobs posted this
                                                            week
                                                            in
                                                            <b>{{TITLE_CITY}},&nbsp;{{TITLE_STATE}}</b>.
                                                        </div>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" vertical-align="middle"
                                                        style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                                            style="border-collapse:separate;line-height:100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" bgcolor="#3B8B63" role="presentation"
                                                                        style="border:none;border-radius:5px;cursor:auto;mso-padding-alt:10px 25px;background:#3B8B63;"
                                                                        valign="middle">
                                                                        <a href="https://redirect.boldcareers.com/forwarding?e={{email}}&amp;h=&amp;k={{keyword1}}&amp;l={{city}},{{state}}&amp;z={{zip}}&amp;pc={{partnercode}}&amp;fn={{firstname}}&amp;ln={{lastname}}&amp;campaignId={{ocx_mailing_id}}&amp;c={{city}}&amp;s={{state}}&amp;z={{zip}}&amp;emcUrlId=view_more"
                                                                            class="btn-hover"
                                                                            style="display:inline-block;background:#3B8B63;color:#ffffff;font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:bold;line-height:18px;margin:0;text-decoration:none;text-transform:uppercase;padding:10px 25px;mso-padding-alt:0px;border-radius:5px;"
                                                                            target="_blank">
                                                                            {{MORE_JOBS}}
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>

                                    <!--[if mso | IE]></td></tr></table><![endif]-->
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>


                <!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->


                <div style="margin:0px auto;max-width:600px;">

                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                                    <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->

                                    <div class="mj-column-per-100 mj-outlook-group-fix"
                                        style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">

                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color:#ffffff;vertical-align:top;padding:0;">

                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation"
                                                            style="" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="font-size:0px;padding:10px 25px;word-break:break-word; border: 8px solid #F1F2F4;">

                                                                        <div
                                                                            style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left;color:#4C5C68;">
                                                                            <a class="green-link" href="{{URL}}"
                                                                                style="font-weight: 700; color: #3B8B63; font-size: 18px; text-decoration: underline;">
                                                                                {{TITLE}}
                                                                            </a>
                                                                            <br><br>
                                                                            <span style="font-size: 12px">
                                                                                <a href="{{URL}}"
                                                                                    style="text-decoration: none; color: #4C5C68;"
                                                                                    css-class="link-hover">
                                                                                    <img src="{{LOGOCOMPANY}}" width="14"
                                                                                        height="auto" alt="・"
                                                                                        style="padding-right: 5px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{COMPANY}}
                                                                                    <img src="https://str.findyourcareer.com/fyc-icon-location.png"
                                                                                        width="14" height="auto" alt="・"
                                                                                        style="margin-left: 10px; padding-right: 2px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{CITY}}, {{STATE}}
                                                                                </a>
                                                                            </span>

                                                                        </div>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="font-size:0px;padding:10px 25px;word-break:break-word; border: 8px solid #F1F2F4;">

                                                                        <div
                                                                            style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left;color:#4C5C68;">
                                                                            <a class="green-link" href="{{URL}}"
                                                                                style="font-weight: 700; color: #3B8B63; font-size: 18px; text-decoration: underline;">
                                                                                {{TITLE}}
                                                                            </a>
                                                                            <br><br>
                                                                            <span style="font-size: 12px">
                                                                                <a href="{{URL}}"
                                                                                    style="text-decoration: none; color: #4C5C68;"
                                                                                    css-class="link-hover">
                                                                                    <img src="{{LOGOCOMPANY}}" width="14"
                                                                                        height="auto" alt="・"
                                                                                        style="padding-right: 5px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{COMPANY}}


                                                                                    <img src="https://str.findyourcareer.com/fyc-icon-location.png"
                                                                                        width="14" height="auto" alt="・"
                                                                                        style="margin-left: 10px; padding-right: 2px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{CITY}}, {{STATE}}
                                                                                </a>
                                                                            </span>

                                                                        </div>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="font-size:0px;padding:10px 25px;word-break:break-word; border: 8px solid #F1F2F4;">

                                                                        <div
                                                                            style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left;color:#4C5C68;">
                                                                            <a class="green-link" href="{{URL}}"
                                                                                style="font-weight: 700; color: #3B8B63; font-size: 18px; text-decoration: underline;">
                                                                                {{TITLE}}
                                                                            </a>
                                                                            <br><br>
                                                                            <span style="font-size: 12px">
                                                                                <a href="{{URL}}"
                                                                                    style="text-decoration: none; color: #4C5C68;"
                                                                                    css-class="link-hover">
                                                                                    <img src="{{LOGOCOMPANY}}" width="14"
                                                                                        height="auto" alt="・"
                                                                                        style="padding-right: 5px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{COMPANY}}


                                                                                    <img src="https://str.findyourcareer.com/fyc-icon-location.png"
                                                                                        width="14" height="auto" alt="・"
                                                                                        style="margin-left: 10px; padding-right: 2px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{CITY}}, {{STATE}}
                                                                                </a>
                                                                            </span>

                                                                        </div>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="font-size:0px;padding:10px 25px;word-break:break-word; border: 8px solid #F1F2F4;">

                                                                        <div
                                                                            style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left;color:#4C5C68;">
                                                                            <a class="green-link" href="{{URL}}"
                                                                                style="font-weight: 700; color: #3B8B63; font-size: 18px; text-decoration: underline;">
                                                                                {{TITLE}}
                                                                            </a>
                                                                            <br><br>
                                                                            <span style="font-size: 12px">
                                                                                <a href="{{URL}}"
                                                                                    style="text-decoration: none; color: #4C5C68;"
                                                                                    css-class="link-hover">
                                                                                    <img src="{{LOGOCOMPANY}}" width="14"
                                                                                        height="auto" alt="・"
                                                                                        style="padding-right: 5px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{COMPANY}}


                                                                                    <img src="https://str.findyourcareer.com/fyc-icon-location.png"
                                                                                        width="14" height="auto" alt="・"
                                                                                        style="margin-left: 10px; padding-right: 2px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{CITY}}, {{STATE}}
                                                                                </a>
                                                                            </span>

                                                                        </div>

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td align="left"
                                                                        style="font-size:0px;padding:10px 25px;word-break:break-word; border: 8px solid #F1F2F4;">

                                                                        <div
                                                                            style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left;color:#4C5C68;">
                                                                            <a class="green-link" href="{{URL}}"
                                                                                style="font-weight: 700; color: #3B8B63; font-size: 18px; text-decoration: underline;">
                                                                                {{TITLE}}
                                                                            </a>
                                                                            <br><br>
                                                                            <span style="font-size: 12px">
                                                                                <a href="{{URL}}"
                                                                                    style="text-decoration: none; color: #4C5C68;"
                                                                                    css-class="link-hover">
                                                                                    <img src="{{LOGOCOMPANY}}" width="14"
                                                                                        height="auto" alt="・"
                                                                                        style="padding-right: 5px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{COMPANY}}


                                                                                    <img src="https://str.findyourcareer.com/fyc-icon-location.png"
                                                                                        width="14" height="auto" alt="・"
                                                                                        style="margin-left: 10px; padding-right: 2px; vertical-align: middle; padding-bottom: 5px;">
                                                                                    {{CITY}}, {{STATE}}
                                                                                </a>
                                                                            </span>

                                                                        </div>

                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>




                                                        <!--[if mso | IE]></td></tr></table><![endif]-->


                                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                                            role="presentation"
                                                            style="background:#444444;background-color:#444444;width:100%;">
                                                            <tbody>
                                                                <tr>
                                                                    <td>


                                                                        <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#444444" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->


                                                                        <div style="margin:0 auto;max-width:600px;">

                                                                            <table align="center" border="0" cellpadding="0"
                                                                                cellspacing="0" role="presentation"
                                                                                style="width:100%;">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                                                                                            <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->

                                                                                            <div class="mj-column-per-100 mj-outlook-group-fix"
                                                                                                style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">

                                                                                                <table border="0"
                                                                                                    cellpadding="0"
                                                                                                    cellspacing="0"
                                                                                                    role="presentation"
                                                                                                    style="vertical-align:top;"
                                                                                                    width="100%">
                                                                                                    <tbody>

                                                                                                        <tr>
                                                                                                            <td align="center"
                                                                                                                style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                                                                                <div
                                                                                                                    style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:center;color:#ffffff;">
                                                                                                                    3296
                                                                                                                    Westerville
                                                                                                                    Rd, Unit
                                                                                                                    #127
                                                                                                                    Columbus, OH
                                                                                                                    43224
                                                                                                                    <br>
                                                                                                                    <a
                                                                                                                        href="https://manage.boldcareers.com/?e=$email$&amp;h=$email_secure_hash$&amp;pc={{partnercode}}&amp;campaignId={{ocx_mailing_id}}&amp;emcUrlId=unsubscribe">
                                                                                                                        Unsubscribe
                                                                                                                    </a>
                                                                                                                </div>

                                                                                                            </td>
                                                                                                        </tr>

                                                                                                    </tbody>
                                                                                                </table>

                                                                                            </div>

                                                                                            <!--[if mso | IE]></td></tr></table><![endif]-->
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

                                                                        </div>


                                                                        <!--[if mso | IE]></td></tr></table><![endif]-->


                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>





                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </body>

        </html>';
    }


    public function htmlButtom()
    {
        return '<div>
            <a href="{{KEYWORD_SALES}}"><btn>SALES</btn></a><a href="{{KEYWORD_OTRO}}"><btn>OTRO</btn></a>
            <a href="{{KEYWORD_DEVELOPER}}"><btn>DEVELOPER</btn></a>
            <a href="{{KEYWORD_ADMIN}}"><btn>ADMIN</btn></a>
        </div>';
    }

    public function repeatButton(){
        return '<html>
            <head>
                <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css">
            </head>

            <body style="word-spacing:normal;background-color:#F1F2F4;" bis_status="ok" bis_frame_id="155">
                <div>
                    {{QUERY}}
                </div>
                {{QUERY}}{{QUERY}}
                {{QUERY}}{{QUERY}}{{QUERY}}
                <div>
                    {{TITLE_STATE}}
                </div>
                <div>
                    {{TITLE_STATE}}
                </div>
                <!--repeat_button-->
                <div><a href="{{KEYWORD}}"><btn>{{KEYWORD}}</btn></a></div>
                <!--end_repeat_button-->
                {{QUERY}}
            </body>
        </html>';
    }

    public function listAndButton(){
    return '<html>
        <head>
            <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css">
        </head>

        <body style="word-spacing:normal;background-color:#F1F2F4;" bis_status="ok" bis_frame_id="155">
            <div>
                {{TITLE}}
                {{TITLE_CITY}}</div>
            <div>
                {{TITLE_CITY}}
                {{TITLE_STATE}}
            </div>
            <!--{{repeat_button}}-->
            <div>
                <a href="http://search/?q={{KEYWORD}}">
                    <btn>{{LINK}}</btn>
                </a>
            </div>
            <!--{{end_repeat_button}}-->

            <!--{{repeat_list}}-->
            <div>
                <a href="http://search/?q={{KEYWORD}}">
                    {{CITY}}
                    {{LOGOCOMPANY}}
                    {{COMPANY}}
                    <btn>{{KEYWORD}}</btn>
                </a>
            </div>
            <!--{{end_repeat_list}}-->
        </body>

        </html>';
    }

    public function repeatList(){
        return '<html>

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
                <!--{{repeat_list}}-->
                    <div>
                        {{STATE}}
                        {{CITY}}
                        <a href="{{LINK}}">
                            <btn>{{LINK}}</btn>
                        </a>
                    </div>
                <!--{{end_repeat_list}}-->
            </body>
            </html>';
    }

    public function button(){
        return '
            <html>
                <head>
                    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css">
                </head>

                <body style="word-spacing:normal;background-color:#F1F2F4;" bis_status="ok" bis_frame_id="155">
                        <div>
                            {{QUERY}}
                        </div>
                        <div>
                            {{TITLE_CITY}}</div>
                        <div>
                            {{TITLE_CITY}}
                            {{TITLE_STATE}}
                        </div>
                        <!--{{repeat_button}}-->
                        <div>
                            <a href="http://search/?q={{KEYWORD}}">
                                <btn>{{KEYWORD}}</btn>
                            </a>
                        </div>
                        <!--{{end_repeat_button}}-->
                </body>
        </html>
        ';
    }

}
