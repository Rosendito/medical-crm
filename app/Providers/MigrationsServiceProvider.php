<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Support\ServiceProvider;

class MigrationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerBlueprintMacros();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected function registerBlueprintMacros(): void
    {
        Blueprint::macro('encryptedString', function (string $column, string $size = 'small'): ColumnDefinition {
            /** @var \Illuminate\Database\Schema\Blueprint $this */
            $length = encryptable_column_length($size);

            return $this->string($column, $length);
        });
    }
}
