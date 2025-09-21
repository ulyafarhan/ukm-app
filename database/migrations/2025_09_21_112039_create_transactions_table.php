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
            $table->foreignId('transaction_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->comment('Dicatat oleh');
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['income', 'outcome']);
            $table->date('transaction_date');
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
