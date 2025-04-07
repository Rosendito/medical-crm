<?php

use App\Enums\Models\Attributes\AttributeDefinitionType;
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
        Schema::create('attribute_definitions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->hasTenant();
            $table->string('key')->unique();
            $table->string('label');
            $table->string('type')->default(AttributeDefinitionType::SELECT);
            $table->string('regex_pattern')->nullable();
            $table->boolean('is_required')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->boolean('should_encrypt')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_definitions');
    }
};
