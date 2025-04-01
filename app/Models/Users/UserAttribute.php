<?php

namespace App\Models\Users;

use App\Models\Base;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
