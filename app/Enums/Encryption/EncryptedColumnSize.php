<?php

namespace App\Enums\Encryption;

enum EncryptedColumnSize: string
{
    case SMALL = 'small';
    case MEDIUM = 'medium';
    case LARGE = 'large';

    public function plainStringLimit(): int
    {
        return config("database.encryptables.{$this->value}.plain_string_length");
    }

    public function encryptedStringLimit(): int
    {
        return config("database.encryptables.{$this->value}.encrypted_string_length");
    }
}
