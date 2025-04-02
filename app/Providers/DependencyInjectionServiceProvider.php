<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

class DependencyInjectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Finder::class, fn () => new Finder);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
