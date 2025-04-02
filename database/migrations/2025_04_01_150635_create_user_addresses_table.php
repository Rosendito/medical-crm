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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users');
            $table->string('country_code', 2);
            $table->string('type')->nullable();
            $table->encryptedString('label', EncryptedColumnSize::MEDIUM)->nullable();
            $table->encryptedString('street_line_1', EncryptedColumnSize::LARGE);
            $table->encryptedString('street_line_2', EncryptedColumnSize::LARGE)->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
