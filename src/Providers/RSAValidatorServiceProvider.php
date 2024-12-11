<?php

namespace InovantiBank\RSAValidator\Providers;

use Illuminate\Support\ServiceProvider;

class RSAValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('rsavalidator', function () {
            return new \InovantiBank\RSAValidator\Services\RSAValidatorService();
        });

        $this->mergeConfigFrom(__DIR__.'/../../config/rsa-validator.php', 'rsa-validator');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/rsa-validator.php' => config_path('rsa-validator.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../../migrations');
    }
}
