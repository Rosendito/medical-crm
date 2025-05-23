<?php

namespace App\Models\Attributes;

use App\Enums\Models\Attributes\AttributeDefinitionType;
use App\Models\CommonModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttributeDefinition extends CommonModel
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
        'regex_pattern',
        'is_required',
        'is_visible',
        'should_encrypt',
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
        'should_encrypt' => 'boolean',
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
