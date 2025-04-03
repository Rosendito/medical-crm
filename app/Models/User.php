<?php

namespace App\Models;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use App\Enums\Filament\PanelIdentifier;
use App\Models\Users\UserAddress;
use App\Models\Users\UserAttribute;
use App\Models\Users\UserContact;
use App\Models\Users\UserDocument;
use App\Models\Users\UserSocialProfile;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements FilamentUser, ShouldRotateEncryptedAttributes
{
    use HasEncryptedAttributeRotation, HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
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
        'email_hash',
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
            'first_name' => 'encrypted',
            'last_name' => 'encrypted',
            'email' => 'encrypted',
            'email_hash' => 'hashed',
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (self $user) {
            $user->email_hash = Hash::make($user->email);
        });
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

    /**
     * Determine if the user can access the given panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === PanelIdentifier::CRM->value;
    }
}
