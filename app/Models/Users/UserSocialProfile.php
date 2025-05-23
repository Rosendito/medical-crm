<?php

namespace App\Models\Users;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use App\Models\CommonModel;
use App\Models\Socials\SocialPlatform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSocialProfile extends CommonModel implements ShouldRotateEncryptedAttributes
{
    use HasEncryptedAttributeRotation;

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
        'handle' => 'encrypted',
        'url' => 'encrypted',
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
