<?php

namespace InovantiBank\RSAValidator\Exceptions;

use Exception;

class PublicKeyNotFoundException extends Exception
{
    public function __construct($clientId)
    {
        parent::__construct("Public key not found for client ID: $clientId");
    }
}
