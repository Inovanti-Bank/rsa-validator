# RSA Validator

[![Latest Stable Version](https://poser.pugx.org/inovanti-bank/rsa-validator/v)](//packagist.org/packages/inovanti-bank/rsa-validator)
[![Total Downloads](https://poser.pugx.org/inovanti-bank/rsa-validator/downloads)](//packagist.org/packages/inovanti-bank/rsa-validator)
[![License](https://poser.pugx.org/inovanti-bank/rsa-validator/license)](//packagist.org/packages/inovanti-bank/rsa-validator)

A Laravel ^11 package for validating and decrypting data using RSA public and private keys. This package is designed to simplify secure communication with APIs using client-specific keys.

---

## **Features**

- Decrypts and validates Base64-encoded data using public RSA keys.
- Supports configuration of key storage in the database.
- Automatically loads migrations and configuration for Laravel projects.
- Fully compatible with Laravel ^11 and PHP ^8.0+.

---

## **Installation**

To install the package via Composer, run:

```bash
composer require inovanti-bank/rsa-validator
```

## Configuration

- After installing the package, the configuration and migrations are automatically loaded.
- If you need to customize the configuration file, you can publish it manually using:

```bash
php artisan vendor:publish --provider="InovantiBank\RSAValidator\Providers\RSAValidatorServiceProvider" --tag="config"
```

- This will publish the config/rsa-validator.php file. The default configuration is as follows:

```php
return [
    'table_name' => 'rsa_validator', // Name of the table storing public keys
];
```

# How to Use

## Storing Public Keys

Ensure you have a table (rsa_validator by default) to store the public keys. Use the following schema to insert a public key:

```php
DB::table('rsa_validator')->insert([
    'client_id' => 'client-unique-id',
    'public_key' => '-----BEGIN PUBLIC KEY-----...-----END PUBLIC KEY-----',
]);
```

## Decrypting Data

To decrypt and validate incoming data:

```php
use InovantiBank\RSAValidator\Facades\RSAValidator;

try {
    $decryptedData = RSAValidator::decryptData('client-id', $encryptedBase64Data);
    echo $decryptedData;
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
```

## Exception Handling

The following exceptions may be thrown:

- PublicKeyNotFoundException: Public key for the specified client is not found.
- DecryptionFailedException: The decryption process faile

## Contributing

If you want to contribute to this package:

- Fork the repository.
- Create a new branch.
- Submit a pull request.

## License

This package is open-source software licensed under the [MIT license](https://github.com/Inovanti-Bank/rsa-validator/tree/production?tab=MIT-1-ov-file).
