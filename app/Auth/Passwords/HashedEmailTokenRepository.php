<?php

namespace App\Auth\Passwords;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class HashedEmailTokenRepository extends DatabaseTokenRepository
{
    protected function getPayload($email, $token)
    {
        return [
            'email' => secure_deterministic_hash($email),
            'token' => $this->hasher->make($token),
            'created_at' => now(),
        ];
    }

    protected function deleteExisting(CanResetPasswordContract $user)
    {
        return $this->getTable()
            ->where('email', secure_deterministic_hash($user->getEmailForPasswordReset()))
            ->delete();
    }

    public function exists(CanResetPasswordContract $user, $token)
    {
        $record = (array) $this->getTable()
            ->where('email', secure_deterministic_hash($user->getEmailForPasswordReset()))
            ->first();

        return $record &&
            ! $this->tokenExpired($record['created_at']) &&
              $this->hasher->check($token, $record['token']);
    }

    public function recentlyCreatedToken(CanResetPasswordContract $user)
    {
        $record = (array) $this->getTable()
            ->where('email', secure_deterministic_hash($user->getEmailForPasswordReset()))
            ->first();

        return $record && $this->tokenRecentlyCreated($record['created_at']);
    }
}
