<?php

namespace App\Providers;

use App\Enums\Encryption\EncryptedColumnSize;
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
        Blueprint::macro('encryptedString', function (string $column, EncryptedColumnSize $size): ColumnDefinition {
            /** @var Blueprint $this */
            return $this->string($column, $size->encryptedStringLimit());
        });
    }
}
