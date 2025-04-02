<?php

namespace App\Concerns\Models;

use App\Actions\Encryption\RotateModelEncryptedAttributes;
use Illuminate\Database\Eloquent\Model;

trait HasEncryptedAttributeRotation
{
    public function rotateEncryptedAttributes(): void
    {
        RotateModelEncryptedAttributes::make()->handle($this);
    }

    public function getEncryptedAttributes(): array
    {
        /** @var Model $this */
        return collect($this->getCasts())
            ->filter(
                fn (string $cast) => $cast === 'encrypted'
            )
            ->keys()
            ->toArray();
    }
}
