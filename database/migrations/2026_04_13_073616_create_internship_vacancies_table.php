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
        Schema::create('internship_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Contoh: Frontend Developer
            $table->text('description')->nullable();
            $table->json('materi')->nullable(); // Menambahkan kolom materi
            $table->integer('quota')->default(0); // Menambahkan kolom kuota
            $table->string('icon')->default('fa-briefcase'); // Menambahkan kolom icon
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_vacancies');
    }
};