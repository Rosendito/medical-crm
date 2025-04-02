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
        Schema::create('attribute_definition_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('attribute_definition_id')->constrained('attribute_definitions');
            $table->string('value')->nullable();
            $table->encryptedString('encrypted_value', EncryptedColumnSize::LARGE)->nullable();
            $table->string('label');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_definition_options');
    }
};
