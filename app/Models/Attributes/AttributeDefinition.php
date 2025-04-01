<?php

namespace App\Models\Attributes;

use App\Enums\Models\Attributes\AttributeDefinitionType;
use App\Models\Base;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttributeDefinition extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'label',
        'type',
        'is_required',
        'is_visible',
        'regex_pattern',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => AttributeDefinitionType::class,
        'is_required' => 'boolean',
        'is_visible' => 'boolean',
    ];

    /**
     * Get all of the options for the attribute definition.
     *
     * @return HasMany<AttributeDefinitionOption>
     */
    public function attributeDefinitionOptions(): HasMany
    {
        return $this->hasMany(AttributeDefinitionOption::class);
    }
}
