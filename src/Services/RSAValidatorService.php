<?php

namespace InovantiBank\RSAValidator\Services;

use Illuminate\Support\Facades\DB;
use InovantiBank\RSAValidator\Exceptions\PublicKeyNotFoundException;
use InovantiBank\RSAValidator\Exceptions\DecryptionFailedException;
use InvalidArgumentException;

class RSAValidatorService
{
    protected $tableName;

    public function __construct()
    {
        $this->tableName = config('rsa-validator.table_name');

        if (empty($this->tableName) || !is_string($this->tableName)) {
            throw new InvalidArgumentException('The "table_name" configuration in rsa-validator.php must be a non-empty string.');
        }

        if (!DB::getSchemaBuilder()->hasTable($this->tableName)) {
            throw new InvalidArgumentException("The table '{$this->tableName}' does not exist in the database. Please run migrations.");
        }
    }

    public function decryptData($clientId, $encryptedData)
    {
        $publicKey = $this->getPublicKey($clientId);

        if (!$publicKey) {
            throw new PublicKeyNotFoundException($clientId);
        }

        $decodedData = base64_decode($encryptedData);

        if (!$decodedData || !openssl_public_decrypt($decodedData, $decryptedData, $publicKey)) {
            throw new DecryptionFailedException();
        }

        return $decryptedData;
    }

    private function getPublicKey($clientId)
    {
        $client = DB::table($this->tableName)->where('client_id', $clientId)->first();
        return $client ? $client->public_key : null;
    }
}
