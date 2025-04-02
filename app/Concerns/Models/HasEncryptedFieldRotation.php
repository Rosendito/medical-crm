<?php

namespace App\Concerns\Models;

use App\Actions\Encryption\RotateModelEncryptedFields;
use Illuminate\Database\Eloquent\Model;

trait HasEncryptedFieldRotation
{
    public function rotateEncryptedFields(): void
    {
        RotateModelEncryptedFields::make()->handle($this);
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
