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
        // Duplicate migration — intentionally left empty to avoid duplicate table creation during tests.
        return;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
        return;
    }
};
