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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->nullable(); //
            $table->foreignId('product_id')->constrained()->cascadeOnDelete(); //
            $table->string('date');
            $table->string('total_item');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('amount_paid', 10, 2); 
            $table->enum('status', ['completed', 'pending', 'canceled'])->default('pending'); // Status transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashiers');
    }
};
