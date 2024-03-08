<?php

namespace Shipper\WinSMS;

use Illuminate\Notifications\Notification;

class WinSMSChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWinSMS($notifiable);

        $apiKey = config('winsms.api_key');
        $to = $notifiable->routeNotificationFor('winsms');
        $from = $message['from'];
        $sms = urlencode($message['text']);

        $url = "https://www.winsmspro.com/sms/sms/api?action=send-sms&api_key={$apiKey}&to={$to}&from={$from}&sms={$sms}";

        // Use file_get_contents or a HTTP client to send the request
        $response = file_get_contents($url);

        // Handle response
    }
}
