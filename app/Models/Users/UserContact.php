<?php

namespace App\Models\Users;

use App\Enums\Models\Users\UserContactType;
use App\Models\Base;

class UserContact extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'type',
        'value',
        'label',
        'is_primary',
        'verified_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => UserContactType::class,
            'is_primary' => 'boolean',
            'verified_at' => 'datetime',
        ];
    }
}
