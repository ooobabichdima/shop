<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->json('specs')->nullable(); // JSON для характеристик
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false); // хит
            $table->boolean('is_new')->default(false); // новинка
            $table->integer('views')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
