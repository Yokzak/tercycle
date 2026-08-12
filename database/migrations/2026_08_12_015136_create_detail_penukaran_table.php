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
        Schema::create('detail_penukaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penukaran_id')->constrained('penukaran_botol')->cascadeOnDelete();
            $table->foreignId('kategori_botol_id')->constrained('kategori_botol')->restrictOnDelete();
            $table->unsignedInteger('jumlah_botol');
            $table->unsignedInteger('poin_satuan');
            $table->unsignedInteger('subtotal_poin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penukaran');
    }
};
