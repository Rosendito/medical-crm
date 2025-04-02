<?php

namespace Tests\Stubs\EncryptedRotatableModels\Some\Deep;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use Illuminate\Database\Eloquent\Model;

class ModelWithSensibleData extends Model implements ShouldRotateEncryptedAttributes
{
    use HasEncryptedAttributeRotation;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sensible_field_3' => 'encrypted',
            'sensible_field_4' => 'encrypted',
        ];
    }
}
