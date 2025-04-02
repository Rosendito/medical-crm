<?php

namespace App\Models\Users;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use App\Models\Attributes\AttributeDefinition;
use App\Models\Base;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAttribute extends Base implements ShouldRotateEncryptedAttributes
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'encrypted_value' => 'encrypted',
    ];

    /**
     * Get the attribute definition.
     *
     * @return BelongsTo<AttributeDefinition>
     */
    public function attributeDefinition(): BelongsTo
    {
        return $this->belongsTo(AttributeDefinition::class);
    }

    /**
     * Get all of the selections for the user attribute.
     *
     * @return HasMany<UserAttributeSelection>
     */
    public function userAttributeSelections(): HasMany
    {
        return $this->hasMany(UserAttributeSelection::class);
    }
}
