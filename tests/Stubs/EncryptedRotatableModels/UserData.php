<?php

namespace Tests\Stubs\EncryptedRotatableModels;

use App\Contracts\Encryption\ShouldRotateEncryptedFields;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model implements ShouldRotateEncryptedFields
{
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
