<?php

namespace Inovanti\RSAValidator\Services;

use Exception;
use PDO;

class UserPublicKeyRepository
{
    protected ConfigLoader $config;
    protected PDO $pdo;

    public function __construct(array $userConfig = [])
    {
        $this->config = new ConfigLoader($userConfig);

        // Inicializar conexão de banco de dados via DatabaseConnection
        $dbConnection = new DatabaseConnection($userConfig['database'] ?? []);
        $this->pdo = $dbConnection->getConnection();
    }

    public function getPublicKey(int $userId): string
    {
        $storageMethod = $this->config->get('public_key_storage');

        if ($storageMethod === 'database') {
            return $this->getPublicKeyFromDatabase($userId);
        } elseif ($storageMethod === 'file') {
            return $this->getPublicKeyFromFile($userId);
        }

        throw new Exception('Invalid public key storage method configured.');
    }

    protected function getPublicKeyFromDatabase(int $userId): string
    {
        $table = $this->config->get('database.table');
        $column = $this->config->get('database.column');

        $query = sprintf(
            'SELECT %s FROM %s WHERE id = :id LIMIT 1',
            $column,
            $table
        );

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $userId]);

        $result = $stmt->fetch();

        if (!$result || !isset($result[$column])) {
            throw new Exception("Public key not found in database (Table: $table, Column: $column) for user ID: $userId");
        }

        return $result[$column];
    }

    protected function getPublicKeyFromFile(int $userId): string
    {
        $filePath = $this->config->get('public_key_path') . "/user_{$userId}.key";

        if (!file_exists($filePath)) {
            throw new Exception("Public key file not found for user ID: $userId");
        }

        return file_get_contents($filePath);
    }
}
