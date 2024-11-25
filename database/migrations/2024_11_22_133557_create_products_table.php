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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete(); // Relasi ke tabel categories
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete(); // Relasi ke tabel brands
            $table->string('name'); // Nama produk
            $table->string('slug')->unique(); // Slug produk unik
            $table->json('images')->nullable(); // Nama file gambar produk, bisa null
            $table->text('description')->nullable(); // Deskripsi produk, bisa null
            $table->decimal('price', 10, 2); // Harga produk
            $table->boolean('is_active')->default(true); // Status produk
            $table->boolean('is_featured')->default(false); // Produk unggulan
            $table->boolean('in_stock')->default(true); // Produk tersedia
            $table->boolean('on_sale')->default(false); // Produk sedang diskon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
