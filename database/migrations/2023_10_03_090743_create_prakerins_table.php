<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prakerin', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('id_pengajuan', 15);
            $table->string('nis_siswa', 12)->nullable(false);
            $table->string('nip_nik_pembimbing_sekolah', 20)->nullable(false);
            $table->string('nip_nik_pembimbing_industri', 20)->nullable(false);
            $table->enum('status', ['berlangsung', 'selesai'])->default('berlangsung')->nullable(false);
            $table->date('tanggal_mulai')->nullable(false);
            $table->date('tanggal_selesai')->nullable(false);

            $table->foreign('id_pengajuan')->references('id')->on('pengajuan')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nis_siswa')->references('nis')->on('siswa')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nip_nik_pembimbing_sekolah')->references('nip_nik')->on('pembimbing')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nip_nik_pembimbing_industri')->references('nip_nik')->on('pembimbing')
                ->cascadeOnDelete()->cascadeOnUpdate();
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
