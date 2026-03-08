<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Add image column if it doesn't exist
            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')->nullable()->after('description');
            }

            // Add featured home columns
            $table->boolean('show_on_home')->default(false);
            $table->integer('home_sort_order')->default(0);
            $table->string('home_title')->nullable();
            $table->text('home_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['show_on_home', 'home_sort_order', 'home_title', 'home_description']);
            // Don't drop image column as it might be used by other migrations
        });
    }
};
