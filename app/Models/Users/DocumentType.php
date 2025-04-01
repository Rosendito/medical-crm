<?php

namespace App\Models\Users;

use App\Models\Base;

class DocumentType extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'country_code',
        'regex_pattern',
        'requires_expiration',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'requires_expiration' => 'boolean',
    ];
}
