<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique(); // ORDER-20250101-0001
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Customer info
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email')->nullable();

            // Amounts
            $table->decimal('subtotal', 10, 2); // сумма товаров
            $table->decimal('discount', 10, 2)->default(0); // скидка
            $table->decimal('shipping_cost', 10, 2)->default(0); // доставка
            $table->decimal('total', 10, 2); // итого

            // Shipping
            $table->string('shipping_provider')->nullable(); // np, courier, pickup
            $table->string('shipping_city')->nullable(); // город НП
            $table->string('shipping_ref')->nullable(); // ref отделения НП
            $table->text('shipping_address')->nullable(); // адрес доставки/отделения

            // Other
            $table->string('promo_code')->nullable();
            $table->text('comment')->nullable();
            $table->enum('status', [
                'new',
                'confirmed',
                'paid',
                'shipped',
                'delivered',
                'canceled'
            ])->default('new');

            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name_snapshot'); // название товара на момент заказа
            $table->string('sku_snapshot')->nullable();
            $table->decimal('price_snapshot', 10, 2); // цена на момент заказа
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
