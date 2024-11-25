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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete(); // Relasi ke tabel orders
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete(); // Relasi ke tabel products
            $table->integer('quantity')->default(1); // Jumlah produk
            $table->decimal('unit_amount', 10, 2)->nullable(); // Harga produk
            $table->decimal('total_amount', 10, 2)->nullable(); // Sub total harga produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
