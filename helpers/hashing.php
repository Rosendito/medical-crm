<?php

if (! function_exists('secure_deterministic_hash')) {
    function secure_deterministic_hash(string $value): string
    {
        return '$deterministic'.hash_hmac('sha256', $value, config('app.key'));
    }
}

if (! function_exists('is_secure_deterministic_hash')) {
    function is_secure_deterministic_hash(string $value): bool
    {
        return str($value)->startsWith('$deterministic');
    }
}
