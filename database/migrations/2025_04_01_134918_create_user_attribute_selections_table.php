<?php

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
        Schema::create('user_attribute_selections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_attribute_id')->constrained('user_attributes');
            $table->foreignUuid('attribute_option_id')->constrained('attribute_options');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_attribute_selections');
    }
};
