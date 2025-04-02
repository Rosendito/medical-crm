<?php

namespace App\Contracts\Encryption;

interface ShouldRotateEncryptedAttributes
{
    public function rotateEncryptedAttributes(): void;

    public function getEncryptedAttributes(): array;
}
