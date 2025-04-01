<?php

namespace App\Models\Users;

use App\Models\Base;

class UserAddress extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'country_code',
        'type',
        'label',
        'street_line_1',
        'street_line_2',
        'city',
        'state',
        'postal_code',
        'is_primary',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];
}
