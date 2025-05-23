<?php

namespace App\Models\Socials;

use App\Models\CommonModel;

class SocialPlatform extends CommonModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'base_url',
        'regexp_pattern',
    ];
}
