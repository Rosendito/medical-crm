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
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->hasTenant();
            $table->foreignUuid('user_id')->constrained('users');
            $table->string('type');
            $table->encryptedString('value', EncryptedColumnSize::MEDIUM);
            $table->encryptedString('label', EncryptedColumnSize::MEDIUM)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contacts');
    }
};
