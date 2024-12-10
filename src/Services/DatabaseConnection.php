<?php

namespace Inovanti\RSAValidator\Services;

use PDO;
use Exception;

class DatabaseConnection
{
    protected array $config;
    protected ?PDO $pdo = null;

    public function __construct(array $userConfig = [])
    {
        // Configurações padrão
        $defaultConfig = [
            'driver' => getenv('DB_CONNECTION') ?: '',
            'host' => getenv('DB_HOST') ?: '',
            'port' => getenv('DB_PORT') ?: '',
            'database' => getenv('DB_DATABASE') ?: '',
            'username' => getenv('DB_USERNAME') ?: '',
            'password' => getenv('DB_PASSWORD') ?: '',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        ];
        
        // Mesclar com configurações personalizadas
        $this->config = array_replace_recursive($defaultConfig, $userConfig);

        dd($this->config);
    }

    public function getConnection(): PDO
    {
        if ($this->pdo === null) {
            $dsn = sprintf(
                '%s:host=%s;port=%s;dbname=%s',
                $this->config['driver'],
                $this->config['host'],
                $this->config['port'],
                $this->config['database']
            );

            try {
                $this->pdo = new PDO(
                    $dsn,
                    $this->config['username'],
                    $this->config['password'],
                    $this->config['options']
                );
            } catch (Exception $e) {
                throw new Exception("Failed to connect to the database: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}
