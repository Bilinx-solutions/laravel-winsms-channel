<?php

namespace Shipper\WinSMS;

class WinSMSService
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendSMS($to, $from, $message)
    {
        $sms = urlencode($message);
        $url = "https://www.winsmspro.com/sms/sms/api?action=send-sms&api_key={$this->apiKey}&to={$to}&from={$from}&sms={$sms}";

        // Send the request to WinSMS API
        // You might want to use a HTTP client like Guzzle instead of file_get_contents for better error handling and flexibility
        $response = file_get_contents($url);

        // Process the response
        return $response;
    }
}
