<?php

namespace Tests\Stubs\EncryptedRotatableModels;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model implements ShouldRotateEncryptedAttributes
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
            'sensible_field_1' => 'encrypted',
            'sensible_field_2' => 'encrypted',
        ];
    }
}
