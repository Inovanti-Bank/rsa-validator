<?php

return [
    'storage' => env('RSA_STORAGE', 'database'), // Options: 'database', 'directory'
    'key_directory' => env('RSA_KEY_DIRECTORY', storage_path('rsa-keys')),
];
