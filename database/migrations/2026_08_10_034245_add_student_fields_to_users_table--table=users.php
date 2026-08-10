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
        Schema::table('users', function (Blueprint $table) {
            $table->string('kode_murid')->unique()->after('id');
            $table->string('kelas')->nullable()->after('email');
            $table->unsignedInteger('poin')->default(0)->after('kelas');
            $table->string('role')->default('murid')->after('poin');
        });      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['kode_murid', 'kelas', 'poin', 'role']);
        });
    }
};
