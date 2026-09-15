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
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('vacancy_id')->constrained('internship_vacancies')->onDelete('cascade');
        
        // Biodata Pelamar
        $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->text('address');
        $table->date('birth_date');
        $table->enum('gender', ['Laki-laki', 'Perempuan']);
        $table->string('institution'); // Kampus/Sekolah
        $table->string('major'); // Properti/Jurusan
        
        // File Dokumen (Menyimpan Path)
        $table->string('profile_photo');
        $table->string('portfolio')->nullable();
        $table->string('cv');
        $table->string('recommendation_letter')->nullable();
        
        // Info Tambahan
        $table->string('source'); // Dari mana mengetahui Imersa
        $table->text('motivation'); // Mengapa ingin magang
        
        // Status Finite State Automaton
        // Default: Applied
        $table->string('status')->default('Applied');
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
