<?php

namespace App\Models\Users;

use App\Models\Attributes\AttributeDefinitionOption;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAttributeSelection extends Model
{
    use HasFactory, HasUuids;

    /**
     * Get the user attribute.
     *
     * @return BelongsTo<UserAttribute>
     */
    public function userAttribute(): BelongsTo
    {
        return $this->belongsTo(UserAttribute::class);
    }

    /**
     * Get the attribute option.
     *
     * @return BelongsTo<AttributeDefinitionOption>
     */
    public function attributeDefinitionOption(): BelongsTo
    {
        return $this->belongsTo(AttributeDefinitionOption::class);
    }
}
