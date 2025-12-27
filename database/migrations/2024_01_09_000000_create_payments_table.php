<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('provider'); // monobank, etc.
            $table->enum('status', ['pending', 'processing', 'success', 'failed', 'refunded'])->default('pending');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('UAH');
            $table->string('invoice_id')->nullable(); // ID инвойса от провайдера
            $table->json('payload')->nullable(); // доп данные от провайдера
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
