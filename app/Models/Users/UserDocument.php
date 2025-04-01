<?php

namespace App\Models\Users;

use App\Models\Base;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Base
{
    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'is_verified' => 'boolean',
        'issued_at' => 'date',
        'expires_at' => 'date',
    ];
}
