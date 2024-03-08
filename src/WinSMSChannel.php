<?php

namespace Shipper\WinSMS;

use Illuminate\Notifications\Notification;

class WinSMSChannel
{
    protected $winSMSService;

    public function __construct(WinSMSService $winSMSService)
    {
        $this->winSMSService = $winSMSService;
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWinSMS($notifiable);

        if (!$message instanceof WinSMSMessage) {
            return;
        }

        $to = $message->to;
        $from = $message->from ?? null; // Use default from WinSMSService if not set
        $text = $message->message;

        $this->winSMSService->sendSMS($to, $from, $text);
    }
}
