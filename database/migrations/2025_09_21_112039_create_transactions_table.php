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
            
            // TAMBAHKAN BARIS INI
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('transaction_category_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('description');
            $table->date('transaction_date');
            $table->enum('type', ['income', 'expense']);
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