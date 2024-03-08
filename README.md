# Laravel WinSMS notification channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shipper/laravel-winsms-channel.svg?style=flat-square)](https://packagist.org/packages/shipper/laravel-winsms-channel)
[![Total Downloads](https://img.shields.io/packagist/dt/shipper/laravel-winsms-channel.svg?style=flat-square)](https://packagist.org/packages/shipper/laravel-winsms-channel)
![GitHub Actions](https://github.com/shipper/laravel-winsms-channel/actions/workflows/main.yml/badge.svg)

A Laravel Notification Channel to send sms notification to your users in Tunisia using WinSMS.
More details here [https://www.winsms.tn](https://www.winsms.tn).

## Installation

You can install the package via composer:

```bash
composer require shipper/laravel-winsms-channel
```

You can publish configuration file using:

```bash
php  artisan vendor:publish --provider="Shipper\WinSMS\WinSMSServiceProvider"
```

## Usage

First, you need to create have an active winsms account. Go
to [https://www.winsms.tn/](https://www.winsms.tn/) and create one. Once you
have access to your account, you'll need to get your `API KEY`. These credentials will be used to communicate with Win SMS API.
Go to [https://winsmspro.com/sms/user/sms-api/info](https://winsmspro.com/sms/user/sms-api/info)

Finally, add a new service in your `config/service.php` file.

```php

// file: config/winsms.php

return [
    'api_key' => env('WINSMS_API_KEY', ''),
];
```

### Configure your notification

In your notification class, add the WinSMS Channel in the via method and create
a `toWinSMS` method.

```php
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Shipper\WinSMS\WinSMSChannel;
use Shipper\WinSMS\WinSMSMessage;

class ConfirmationNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WinSMSChannel::class];
    }

    // ...others method here


     /**
     * Send sms using WinSMS API
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toWinSMS($notifiable):WinSMSMessage
    {
        return (new WinSMSMessage())
            ->to($notifiable->phone_number)
            ->from('MyApp')
            ->content('Your account has been created successfully');
    }
}
```

### Available Message methods

- `to` (the receiver phone number)
- `from` (the sender phone number)
- `content` (the actual text message)

### Using Facade

You can also use the facade to send sms notification.

```php
use Shipper\WinSMS\Facades\WinSMS;

WinSMS::sendSMS('216XXXXXXXX', 'MyApp', 'Your account has been created successfully');
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
