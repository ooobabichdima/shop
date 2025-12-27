<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('related_id')->constrained('products')->onDelete('cascade');
            $table->enum('type', ['recommended', 'tuning_kit']); // рекомендуемые или тюнинг
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['product_id', 'related_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_relations');
    }
};
