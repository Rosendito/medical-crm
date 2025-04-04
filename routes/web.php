<?php

use App\Models\User;
use Filament\Notifications\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $user = User::first();

    $notification = app(ResetPassword::class, ['token' => 'x']);

    $user->notify($notification);
});
