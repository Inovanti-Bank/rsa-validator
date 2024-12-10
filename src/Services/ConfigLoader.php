<?php

namespace Inovanti\RSAValidator\Services;

class ConfigLoader
{
    protected array $config;

    public function __construct(array $userConfig = [])
    {
        // Carregar configurações padrão
        $defaultConfig = [
            'public_key_storage' => getenv('RSA_PUBLIC_KEY_STORAGE') ?: 'database',
            'public_key_path' => getenv('RSA_PUBLIC_KEY_PATH') ?: __DIR__ . '/../../storage/rsa/public_keys',
            'database' => [
                'table' => getenv('RSA_PUBLIC_KEY_TABLE') ?: 'users',
                'column' => getenv('RSA_PUBLIC_KEY_COLUMN') ?: 'public_key',
            ],
        ];

        // Mesclar configurações padrão com as fornecidas pelo usuário
        $this->config = array_replace_recursive($defaultConfig, $userConfig);
    }

    public function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }
}
