<?php

namespace App\Models\Users;

use App\Models\Attributes\AttributeDefinitionOption;
use App\Models\Base;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAttributeSelection extends Base
{
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
