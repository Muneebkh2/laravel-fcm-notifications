<?php

namespace Muneebkh2\LaravelFcmNotifications\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelFCM extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Muneebkh2\LaravelFcmNotifications\FCMService';
    }
}
