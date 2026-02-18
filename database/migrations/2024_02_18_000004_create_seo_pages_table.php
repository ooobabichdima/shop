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
        // Add SEO fields to categories
        Schema::table('categories', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
        });

        // Create SEO pages table for custom pages
        Schema::create('seo_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique(); // home, about, contacts, etc.
            $table->string('page_name'); // Human readable name
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert default pages
        DB::table('seo_pages')->insert([
            [
                'page_key' => 'home',
                'page_name' => 'Головна сторінка',
                'meta_title' => 'Strikeball Shop — Інтернет-магазин страйкбольного обладнання',
                'meta_description' => 'Купити страйкбольне обладнання в Україні: приводи AEG, магазини, кулі, захист, тактичне спорядження. Великий вибір, вигідні ціни, доставка по Україні.',
                'meta_keywords' => 'страйкбол, airsoft, привод AEG, магазини страйкбол, кулі airsoft, захист, тактичне спорядження',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_key' => 'catalog',
                'page_name' => 'Каталог товарів',
                'meta_title' => 'Каталог - Strikeball Shop',
                'meta_description' => 'Повний каталог страйкбольного обладнання: приводи, обладнання, аксесуари',
                'meta_keywords' => 'каталог страйкбол, товари airsoft',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_pages');

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'meta_description', 'meta_keywords']);
        });
    }
};
