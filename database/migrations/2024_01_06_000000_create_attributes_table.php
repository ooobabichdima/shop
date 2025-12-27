<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // platform, fps, type, etc.
            $table->string('name'); // "Платформа", "Скорость", etc.
            $table->enum('type', ['string', 'number', 'boolean'])->default('string');
            $table->boolean('is_filterable')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained()->onDelete('cascade');
            $table->string('value_string')->nullable();
            $table->decimal('value_number', 10, 2)->nullable();
            $table->boolean('value_bool')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'attribute_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
        Schema::dropIfExists('attributes');
    }
};
