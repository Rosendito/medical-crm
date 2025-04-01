<?php

namespace App\Models\Users;

use App\Models\Attributes\AttributeDefinition;
use App\Models\Base;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAttribute extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'value',
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
