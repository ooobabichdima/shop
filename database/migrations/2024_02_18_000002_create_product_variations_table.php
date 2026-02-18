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
        // Add color and variation fields to products table
        Schema::table('products', function (Blueprint $table) {
            $table->string('color')->nullable()->after('youtube_url');
            $table->foreignId('parent_variation_id')->nullable()->after('color')->constrained('products')->onDelete('cascade');
        });

        // Create pivot table for product variations (many-to-many)
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variation_id')->constrained('products')->onDelete('cascade');
            $table->string('variation_type')->default('color'); // color, size, etc.
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['product_id', 'variation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['parent_variation_id']);
            $table->dropColumn(['color', 'parent_variation_id']);
        });
    }
};
