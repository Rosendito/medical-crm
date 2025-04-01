<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;

class SocialPlatform extends Model
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
