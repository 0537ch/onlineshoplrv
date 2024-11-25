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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete(); // Relasi ke tabel users
            $table->string('first_name'); // Nama penerima
            $table->string('last_name'); // Nama penerima
            $table->string('phone'); // Nomor telepon penerima
            $table->string('email'); // Alamat email penerima
            $table->string('street_address'); // Alamat lengkap penerima
            $table->string('city'); // Kota penerima
            $table->string('province'); // Provinsi penerima
            $table->string('post_code'); // Kode pos penerima
            $table->string('country'); // Negara penerima
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
