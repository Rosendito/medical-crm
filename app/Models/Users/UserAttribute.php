<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'value'
    ];
}
