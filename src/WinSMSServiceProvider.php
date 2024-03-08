<?php

namespace Shipper\WinSMS;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;

class WinSMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish the configuration file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/winsms.php' => config_path('winsms.php'),
            ], 'config');
        }

        // Register the service
        $this->app->singleton(WinSMSService::class, function ($app) {
            return new WinSMSService(config('winsms.api_key'));
        });

        // Extend the notification channel
        $this->app->when(WinSMSChannel::class)
            ->needs(WinSMSService::class)
            ->give(WinSMSService::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/winsms.php',
            'winsms'
        );
    }
}
