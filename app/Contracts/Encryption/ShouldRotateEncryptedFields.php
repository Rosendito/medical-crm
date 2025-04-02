<?php

namespace App\Contracts\Encryption;

interface ShouldRotateEncryptedFields
{
    public function rotateEncryptedFields(): void;

    public function getEncryptedAttributes(): array;
}
