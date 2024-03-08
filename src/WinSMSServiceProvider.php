<?php

namespace Shipper\WinSMS;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;

class WinSMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/winsms.php' => config_path('winsms.php'),
        ]);

        Notification::extend('winsms', function ($app) {
            return new WinSMSChannel();
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/winsms.php',
            'winsms'
        );
    }
}
