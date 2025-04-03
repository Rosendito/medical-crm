<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseAuth;

class Login extends BaseAuth
{
    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'email_hash' => secure_deterministic_hash($data['email']),
            'password' => $data['password'],
        ];
    }
}
