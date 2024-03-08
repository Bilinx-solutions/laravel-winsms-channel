<?php

namespace Shipper\WinSMS;

class WinSMSService
{
    protected $apiKey;
    protected $defaultSenderId;

    public function __construct($apiKey, $defaultSenderId = null)
    {
        $this->apiKey = $apiKey;
        $this->defaultSenderId = $defaultSenderId ?: config('winsms.sender_id');
    }

    public function sendSMS($to, $from = null, $message)
    {
        $from = $from ?: $this->defaultSenderId; // Use provided sender or default
        $sms = urlencode($message);
        $url = "https://www.winsmspro.com/sms/sms/api?action=send-sms&api_key={$this->apiKey}&to={$to}&from={$from}&sms={$sms}";

        // Consider using a HTTP client like Guzzle for better error handling and flexibility
        $response = file_get_contents($url);

        // Process the response
        return $response;
    }
}
