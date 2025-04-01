<?php

namespace App\Models\Users;

use App\Enums\Models\Users\AttributeDefinitionType;
use Illuminate\Database\Eloquent\Model;

class AttributeDefinition extends Model
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
}
