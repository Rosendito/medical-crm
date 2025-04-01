<?php

namespace App\Models\Users;

use App\Models\Base;

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
}
