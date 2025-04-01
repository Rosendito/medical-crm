<?php

namespace App\Enums\Models\Users;

enum UserContactType: string
{
    case EMAIL = 'email';
    case PHONE = 'phone';
}
