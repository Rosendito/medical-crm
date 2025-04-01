<?php

namespace App\Models\Users;

use App\Models\Base;
use App\Models\Socials\SocialPlatform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSocialProfile extends Base
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'handle',
        'url',
        'is_primary',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the social platform.
     *
     * @return BelongsTo<SocialPlatform>
     */
    public function socialPlatform(): BelongsTo
    {
        return $this->belongsTo(SocialPlatform::class);
    }
}
