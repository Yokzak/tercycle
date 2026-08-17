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
        Schema::create('pencairan_poin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->restrictOnDelete();
            $table->unsignedInteger('jumlah_poin');
            $table->unsignedBigInteger('jumlah_uang');
            $table->enum('metode', ['cash','e-wallet']);
            $table->enum('provider', ['dana','gopay','shopeepay','ovo'])->nullable();
            $table->string('nama_penerima');
            $table->string('nomor_tujuan')->nullable();
            $table->enum('status', ['menunggu', 'diproses','disetujui','ditolak','selesai'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->dateTime('tanggal_pengajuan');
            $table->dateTime('tanggal_pencairan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencairan_poin');
    }
};
