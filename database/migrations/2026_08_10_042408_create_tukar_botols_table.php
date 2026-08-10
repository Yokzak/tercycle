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
    Schema::create('transaksi_tukar_botol', function (Blueprint $table) {
        $table->id();

        $table->foreignId('tukar_botol_id')
            ->constrained('tukar_botols')
            ->cascadeOnDelete();

        $table->foreignId('jenis_sampah_id')
            ->constrained('jenis_sampahs')
            ->restrictOnDelete();

        $table->unsignedInteger('jumlah');
        $table->unsignedInteger('poin_per_item');
        $table->unsignedInteger('subtotal_poin');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tukar_botols');
    }
};
