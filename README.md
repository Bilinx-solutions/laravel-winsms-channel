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
    public function toOrange($notifiable):array
    {
        return [
            'to' => $notifiable->phone_number,
            'from' => 'MyApp',
            'text' => 'Your account has been created successfully'
        ];
    }
}
```

### Available Message methods

- `to` (the receiver phone number)
- `from` (the sender phone number)
- `text` (the actual text message)

### Configuration file

```php
<?php

return [
    /****
     * The country code that must be prepend to all phone number.
     * If the phone number already start with the `+`(plus) symbol,
     * the country code will not be applied.
     */
    'country_code' => null,

    /**
     * You may wish for all SMS sent by your application to be sent from
     * the same phone number. Here, you may specify a name and a phone number that is
     * used globally for all SMS that are sent by your application.
     */
    'from' => [
        'phone_number' => null,
        'name' => env('APP_NAME')
    ]
];
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email abouba181@gmail.com instead of using the issue tracker.

## Credits

- [Aboubacar OUATTARA](https://github.com/oza75)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
