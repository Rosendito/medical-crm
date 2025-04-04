<?php

namespace App\Providers;

use App\Auth\Passwords\CustomPasswordBrokerManager;
use Illuminate\Contracts\Auth\PasswordBrokerFactory;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->registerCustomPasswordBroker();
    }

    protected function registerCustomPasswordBroker(): void
    {
        $this->app->singleton(PasswordBrokerFactory::class, function ($app) {
            return new CustomPasswordBrokerManager($app);
        });

        $this->app->alias(PasswordBrokerFactory::class, 'auth.password');
    }
}
