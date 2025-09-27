<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nim')->unique();
            $table->string('faculty'); // Fakultas
            $table->string('department'); // Jurusan
            $table->integer('year_in'); // Angkatan
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->text('reason'); // Alasan bergabung
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};