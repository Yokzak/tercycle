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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_lengkap', 61);
            $table->string('nis', 8)->unique();
            $table->string('no_telepon', 13);
            $table->string('kode_siswa', 12)->unique();
            $table->string('kelas', 3);
            $table->foreignId('jurusan_id', 4)->constrained('jurusan')->cascadeOnDelete();
            $table->unsignedInteger('saldo_poin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
