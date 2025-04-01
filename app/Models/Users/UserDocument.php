<?php

namespace App\Models\Users;

use App\Models\Base;
use App\Models\Identities\DocumentType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDocument extends Base
{
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
