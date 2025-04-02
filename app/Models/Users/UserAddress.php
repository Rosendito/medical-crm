<?php

namespace App\Models\Users;

use App\Concerns\Models\HasEncryptedFieldRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedFields;
use App\Models\Base;

class UserAddress extends Base implements ShouldRotateEncryptedFields
{
    use HasEncryptedFieldRotation;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'country_code',
        'type',
        'label',
        'street_line_1',
        'street_line_2',
        'city',
        'state',
        'postal_code',
        'is_primary',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'label' => 'encrypted',
        'street_line_1' => 'encrypted',
        'street_line_2' => 'encrypted',
        'is_primary' => 'boolean',
    ];
}
