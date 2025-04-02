<?php

namespace App\Models\Attributes;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use App\Models\Base;

class AttributeDefinitionOption extends Base implements ShouldRotateEncryptedAttributes
{
    use HasEncryptedAttributeRotation;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'value',
        'encrypted_value',
        'label',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'encrypted_value' => 'encrypted',
    ];
}
