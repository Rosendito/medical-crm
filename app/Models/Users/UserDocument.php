<?php

namespace App\Models\Users;

use App\Concerns\Models\HasEncryptedAttributeRotation;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use App\Models\Base;
use App\Models\Identities\DocumentType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDocument extends Base implements ShouldRotateEncryptedAttributes
{
    use HasEncryptedAttributeRotation;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'number',
        'issued_by',
        'is_verified',
        'issued_at',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'number' => 'encrypted',
        'issued_by' => 'encrypted',
        'is_verified' => 'boolean',
        'issued_at' => 'date',
        'expires_at' => 'date',
    ];

    /**
     * Get the document type.
     *
     * @return BelongsTo<DocumentType>
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }
}
