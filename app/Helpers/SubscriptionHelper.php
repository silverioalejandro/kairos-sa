<?php

namespace App\Helpers;

use App\Models\CodeHtmlCss;

class SubscriptionHelper
{
    public static function insertCode(string $template): string
    {
        $codeSubscription = CodeHtmlCss::where('name', 'subscriptions')->first();

        // Html
        $pattern = '/<body(.*?)>/s';
        preg_match($pattern, $template, $match);
        $titleBody = $match[0];
        $contentHtml = $titleBody . "\n"
            . "<!--subscriptions-->\n"
            . self::codeHtml($codeSubscription->html) . "\n"
            . "<!--end_subscriptions-->\n";

        $template = preg_replace(("/" . $match[0] . "/"), $contentHtml, $template, 1);

        // Css
        $pattern = '/<\/head>/s';
        preg_match($pattern, $template, $match);
        $endTitleHead = $match[0];
        $ContentCss = "<!--subscriptions-->\n"
            . $codeSubscription->css . "\n"
            . "<!--end_subscriptions-->\n"
            . $endTitleHead;

        $template = preg_replace(("/<\/head>/"), $ContentCss, $template, 1);

        return $template;
    }

    public static function codeHtml(string $codeHtml): string
    {
        $divSubscription = $codeHtml;
        $divSubscription = preg_replace("/{{URL_BRONZE}}/", config('subscription.url_bronze'), $divSubscription, 1);
        $divSubscription = preg_replace("/{{URL_SILVER}}/", config('subscription.url_silver'), $divSubscription, 1);
        $divSubscription = preg_replace("/{{URL_GOLD}}/", config('subscription.url_gold'), $divSubscription, 1);

        return $divSubscription;
    }

    public static function removeSubscription(string $template): string
    {
        foreach (range(1, 2) as $nro) {
            $pattern = '/<!--subscriptions-->(.*?)!--end_subscriptions-->/s';
            preg_match($pattern, $template, $match);
            if (count($match) > 0){
                $template = str_replace($match[0], '', $template);
            }
        }
        return $template;
    }
}