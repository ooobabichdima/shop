<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(false)->after('image');
            $table->integer('home_sort_order')->default(0)->after('show_on_home');
            $table->string('home_title')->nullable()->after('home_sort_order');
            $table->text('home_description')->nullable()->after('home_title');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['show_on_home', 'home_sort_order', 'home_title', 'home_description']);
        });
    }
};
