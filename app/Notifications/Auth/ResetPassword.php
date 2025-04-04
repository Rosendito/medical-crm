<?php

namespace App\Notifications\Auth;

use Filament\Notifications\Auth\ResetPassword as FilamentResetPassword;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;

class ResetPassword extends FilamentResetPassword implements ShouldBeEncrypted {}
