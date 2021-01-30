<?php

namespace Iyngaran\Advertiser;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Iyngaran\Advertiser\Advertiser
 */
class AdvertiserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-classified-advertiser';
    }
}
