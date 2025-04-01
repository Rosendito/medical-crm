<?php

namespace App\Models\Users;

use App\Models\Social\SocialPlatform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSocialProfile extends Model
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
