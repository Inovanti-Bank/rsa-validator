<?php

return [
    'public_key_storage' => env('RSA_PUBLIC_KEY_STORAGE', 'database'), // 'database' ou 'file'
    'public_key_path' => env('RSA_PUBLIC_KEY_PATH', storage_path('rsa/public_keys')), // Caminho para as chaves, se "file"

    // Configurações para armazenamento em banco de dados
    'database' => [
        'table' => env('RSA_PUBLIC_KEY_TABLE', 'users'), // Nome da tabela
        'column' => env('RSA_PUBLIC_KEY_COLUMN', 'public_key'), // Nome da coluna
    ],
];


