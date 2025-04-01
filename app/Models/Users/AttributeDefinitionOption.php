<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class AttributeDefinitionOption extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'value',
        'label',
        'order'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [];
}
