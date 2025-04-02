<?php

namespace Tests\Stubs\EncryptedRotatableModels\Some\Deep;

use App\Contracts\Encryption\ShouldRotateEncryptedFields;
use Illuminate\Database\Eloquent\Model;

class ModelWithSensibleData extends Model implements ShouldRotateEncryptedFields
{
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
