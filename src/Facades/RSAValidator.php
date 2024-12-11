<?php

namespace InovantiBank\RSAValidator\Facades;

use Illuminate\Support\Facades\Facade;

class RSAValidator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rsavalidator';
    }
}
