<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Inovanti\RSAValidator\Services\UserPublicKeyRepository;

$config = [
    'public_key_storage' => 'database',
    'database' => [
        'table' => getenv('RSA_PUBLIC_KEY_TABLE'),
        'column' => getenv('RSA_PUBLIC_KEY_COLUMN'),
        'driver' => getenv('DB_CONNECTION'),
        'host' => getenv('DB_HOST'),
        'port' => getenv('DB_PORT'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
    ],
];

dd($config);

$repository = new UserPublicKeyRepository($config);

try {
    $publicKey = $repository->getPublicKey(1); // Substituir por um ID válido no banco
    echo "Chave pública: \n$publicKey";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
