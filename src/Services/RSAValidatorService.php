<?php

namespace InovantiBank\RSAValidator\Services;

use Illuminate\Support\Facades\DB;
use Exception;

class RSAValidatorService
{
    public function decryptData($clientId, $encryptedData)
    {
        $publicKey = $this->getPublicKey($clientId);

        if (!$publicKey) {
            throw new Exception("Public key not found for client ID: $clientId");
        }

        $decodedData = base64_decode($encryptedData);
        if (!openssl_public_decrypt($decodedData, $decryptedData, $publicKey)) {
            throw new Exception("Failed to decrypt data with the provided public key.");
        }

        return $decryptedData;
    }

    private function getPublicKey($clientId)
    {
        if (config('rsa-validator.storage') === 'database') {
            $client = DB::table('rsa_validator')->where('client_id', $clientId)->first();
            return $client ? $client->public_key : null;
        } else {
            $path = config('rsa-validator.key_directory') . "/$clientId.pub";
            return file_exists($path) ? file_get_contents($path) : null;
        }
    }
}