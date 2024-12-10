<?php

namespace InovantiBank\RSAValidator\Providers;

use Illuminate\Support\ServiceProvider;
use InovantiBank\RSAValidator\Services\RSAValidatorService;

class RSAValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('rsavalidator', function () {
            return new RSAValidatorService();
        });

        $this->mergeConfigFrom(__DIR__.'/../../config/rsa-validator.php', 'rsa-validator');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/rsa-validator.php' => config_path('rsa-validator.php'),
            __DIR__.'/../../migrations/' => database_path('migrations')
        ], 'config');
    }
}

