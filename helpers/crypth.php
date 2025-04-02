<?php

if (! function_exists('encryptable_column_length')) {
    /**
     * Retrieve a configured string length for encrypted fields.
     *
     * @param  string  $size  The size category: 'small', 'medium', 'large', etc.
     */
    function encryptable_column_length(string $size = 'small', bool $encrypted = true): int
    {
        $key = $encrypted ? 'encrypted_string_length' : 'real_string_length';

        return config("database.encryptables.{$size}.{$key}", $encrypted ? 512 : 128);
    }
}
