<?php

use App\Models\Team;
use App\Models\Tenant;

if (! function_exists('tenant_columns')) {
    /**
     * Add tenant and team columns to factory.
     */
    function tenant_columns(array $columns = [])
    {
        return array_merge([
            'tenant_id' => Tenant::factory(),
            'team_id' => Team::factory(),
        ], $columns);
    }
}
