<?php

namespace App\Models\Users;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use App\Models\CommonModel;

class UserAddress extends CommonModel implements ShouldRotateEncryptedAttributes
{
    use HasEncryptedAttributeRotation;

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
