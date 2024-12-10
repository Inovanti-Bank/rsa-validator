<?php

namespace Inovanti\RSAValidator\Tests;

use Inovanti\RSAValidator\Services\RSAValidatorService;
use PHPUnit\Framework\TestCase;

class RSAValidatorServiceTest extends TestCase
{
    public function testDecryptWithPublicKey()
    {
        $service = new RSAValidatorService(new MockRepository());
        $publicKey = "-----BEGIN PUBLIC KEY-----...-----END PUBLIC KEY-----";
        $encryptedData = base64_encode('sample-encrypted-data');

        $this->assertEquals(
            'sample-data',
            $service->decryptWithPublicKey($publicKey, $encryptedData)
        );
    }
}

