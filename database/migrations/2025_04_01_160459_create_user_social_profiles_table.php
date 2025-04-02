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
        Schema::create('user_social_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('social_platform_id')->constrained('social_platforms');
            $table->encryptedString('handle', EncryptedColumnSize::SMALL)->nullable();
            $table->encryptedString('url', EncryptedColumnSize::MEDIUM);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_social_profiles');
    }
};
