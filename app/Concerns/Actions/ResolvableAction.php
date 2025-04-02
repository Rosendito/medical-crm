<?php

namespace App\Concerns\Actions;

use Illuminate\Support\Fluent;

trait ResolvableAction
{
    public static function make(): static
    {
        return app(static::class);
    }

    /**
     * @return static
     */
    public static function makeIf(bool $condition): mixed
    {
        return $condition ? static::make() : new Fluent;
    }

    /**
     * @return static
     */
    public static function makeUnless(bool $condition): mixed
    {
        return static::makeIf(! $condition);
    }
}
