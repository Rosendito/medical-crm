<?php

namespace Tests\Feature\Filament\Auth;

use App\Filament\Auth\Login;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_can_login_with_valid_credentials(): void
    {
        $email = 'test@example.com';
        $password = 'password';

        $user = $this->createTestUser($email, $password);

        $this->attemptLogin($email, $password)
            ->assertHasNoFormErrors();

        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_invalid_password(): void
    {
        $email = 'test@example.com';
        $correctPassword = 'password';
        $invalidPassword = 'wrong-password';

        $this->createTestUser($email, $correctPassword);

        $this->attemptLogin($email, $invalidPassword)
            ->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    public function test_user_cannot_login_with_invalid_email(): void
    {
        $validEmail = 'test@example.com';
        $invalidEmail = 'wrong@example.com';
        $password = 'password';

        $this->createTestUser($validEmail, $password);

        $this->attemptLogin($invalidEmail, $password)
            ->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    protected function createTestUser(
        string $email = 'test@example.com',
        string $password = 'password'
    ): User {
        return User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    protected function attemptLogin(string $email, string $password)
    {
        return Livewire::test(Login::class)
            ->fillForm([
                'email' => $email,
                'password' => $password,
            ])
            ->call('authenticate');
    }
}
