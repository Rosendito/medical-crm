<?php

use App\Enums\Encryption\EncryptedColumnSize;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->encryptedString('first_name', EncryptedColumnSize::MEDIUM);
            $table->encryptedString('last_name', EncryptedColumnSize::MEDIUM);
            $table->encryptedString('email', EncryptedColumnSize::SMALL);

            // Stores a hashed version of the email (also encrypted) to allow fast and
            // secure lookups without exposing the original email
            $table->string('email_hash')->unique();

            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
