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
        $table->unsignedInteger('id_product')->autoIncrement(); // Primary key
        $table->unsignedInteger('id_category')->nullable(); // Foreign key ke categories
        $table->foreign('id_category')
            ->references('id_category') // Relasi ke id_category di tabel categories
            ->on('categories')
            ->cascadeOnDelete(); // Hapus produk jika kategori dihapus
        $table->string('code', 8)->unique(); // Maksimal 8 karakter, harus unik
        $table->string('name', 30); // Maksimal 30 karakter
        $table->string('brand', 30); // Maksimal 30 karakter
        $table->string('stock', 5); // Maksimal 5 karakter
        $table->string('price_buy', 15); // Maksimal 15 karakter
        $table->string('price_sell', 15); // Maksimal 15 karakter
        $table->string('unit', 20); // Maksimal 10 karakter
        $table->timestamps(); // created_at dan updated_at
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
