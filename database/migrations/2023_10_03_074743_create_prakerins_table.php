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
        Schema::create('prakerin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa')->nullable(false);
            $table->unsignedBigInteger('id_pembimbing_sekolah')->nullable(false);
            $table->unsignedBigInteger('id_pembimbing_industri')->nullable(false);
            $table->unsignedBigInteger('id_jurnal')->nullable(false);
            $table->enum('status', ['berlangsung', 'selesai'])->default('berlangsung')->nullable(false);
            $table->date('tanggal_mulai')->nullable(false);
            $table->date('tanggal_selesai')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prakerin');
    }
};
