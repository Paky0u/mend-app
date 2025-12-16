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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            // 1. Tambahkan User ID (Agar dompet jadi milik pribadi)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 

            $table->string('name');

            // 2. Tambahkan Saldo Awal (Agar hitungan real)
            // Kita pakai decimal biar presisi, default 0
            $table->decimal('initial_balance', 15, 0)->default(0); 

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
