<?php

namespace Inovanti\RSAValidator\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Inovanti\RSAValidator\Services\UserPublicKeyRepository;

class RSAValidatorService
{
    protected $logger;
    protected $repository;

    public function __construct(UserPublicKeyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function decryptWithPublicKey(string $publicKey, string $base64Data): string
    {
        $decodedData = base64_decode($base64Data);

        $result = '';
        if (!openssl_public_decrypt($decodedData, $result, $publicKey)) {
            Log::error('Decryption failed: Invalid public key or data');
            throw new Exception('Decryption failed: Invalid public key or data');
        }

        return $result;
    }
}

