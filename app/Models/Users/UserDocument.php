<?php

namespace App\Models\Users;

use App\Models\Base;
use App\Models\Identity\DocumentType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
