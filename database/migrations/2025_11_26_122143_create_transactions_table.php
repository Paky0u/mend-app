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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Agar data tidak tertukar antar user
            $table->string('name'); // Keterangan (misal: Beli Nasi)
            $table->enum('type', ['income', 'expense']); // Pemasukan / Pengeluaran
            $table->decimal('amount', 15, 2); // Jumlah Uang
            $table->date('date'); // Tanggal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
