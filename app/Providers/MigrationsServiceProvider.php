<?php

namespace App\Providers;

use App\Enums\Encryption\EncryptedColumnSize;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Database\Schema\ForeignKeyDefinition;
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

        Blueprint::macro('hasTenant',
            /**
             * @return array<ForeignKeyDefinition>
             */
            function (): array {
                /** @var Blueprint $this */
                $tenantForeign = $this->foreignUuid('tenant_id')->constrained('tenants');
                $teamForeign = $this->foreignUuid('team_id')->nullable()->constrained('teams');

                return [$tenantForeign, $teamForeign];
            });

        Blueprint::macro('dropTenant', function (): void {
            /** @var Blueprint $this */
            $this->dropForeign(['tenant_id', 'team_id']);
            $this->dropColumn(['tenant_id', 'team_id']);
        });

        Blueprint::macro('hasCreator', function (): ForeignKeyDefinition {
            /** @var Blueprint $this */
            return $this->foreignUuid('creator_id')->nullable()->constrained('users');
        });

        Blueprint::macro('dropCreator', function (): void {
            /** @var Blueprint $this */
            $this->dropForeign('creator_id');
            $this->dropColumn('creator_id');
        });
    }
}
