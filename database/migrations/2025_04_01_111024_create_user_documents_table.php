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
        Schema::create('user_documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->hasTenant();
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('document_type_id')->constrained('document_types');
            $table->encryptedString('number', EncryptedColumnSize::MEDIUM);
            $table->encryptedString('issued_by', EncryptedColumnSize::MEDIUM)->nullable();
            $table->boolean('is_verified')->default(false);
            $table->date('issued_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_documents');
    }
};
