<?php

namespace InovantiBank\RSAValidator\Exceptions;

use Exception;

class DecryptionFailedException extends Exception
{
    public function __construct()
    {
        parent::__construct("Failed to decrypt data with the provided public key.");
    }
}
