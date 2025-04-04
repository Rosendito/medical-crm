<?php

namespace App\Models\Identities;

use App\Models\CommonModel;

class DocumentType extends CommonModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'country_code',
        'name',
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
