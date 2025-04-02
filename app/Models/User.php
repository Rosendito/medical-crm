<?php

namespace App\Models;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use App\Models\Users\UserAddress;
use App\Models\Users\UserAttribute;
use App\Models\Users\UserContact;
use App\Models\Users\UserDocument;
use App\Models\Users\UserSocialProfile;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements ShouldRotateEncryptedAttributes
{
    use HasEncryptedAttributeRotation, HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email' => 'encrypted',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the contacts for the user.
     *
     * @return HasMany<UserContact>
     */
    public function userContacts(): HasMany
    {
        return $this->hasMany(UserContact::class);
    }

    /**
     * Get all of the documents for the user.
     *
     * @return HasMany<UserDocument>
     */
    public function userDocuments(): HasMany
    {
        return $this->hasMany(UserDocument::class);
    }

    /**
     * Get all of the addresses for the user.
     *
     * @return HasMany<UserAddress>
     */
    public function userAddresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    /**
     * Get all of the attributes for the user.
     *
     * @return HasMany<UserAttribute>
     */
    public function userAttributes(): HasMany
    {
        return $this->hasMany(UserAttribute::class);
    }

    /**
     * Get all of the social profiles for the user.
     *
     * @return HasMany<UserSocialProfile>
     */
    public function userSocialProfiles(): HasMany
    {
        return $this->hasMany(UserSocialProfile::class);
    }
}
