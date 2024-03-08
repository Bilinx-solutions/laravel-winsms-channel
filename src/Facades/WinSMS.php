<?php

namespace Shipper\WinSMS\Facades;

use Illuminate\Support\Facades\Facade;

class WinSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'winsms';
    }
}
