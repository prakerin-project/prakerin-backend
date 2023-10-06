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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('nip_walas', 20)->nullable(false);
            $table->string('nip_kaprog', 20)->nullable(false);
            $table->date('tanggal_pengajuan')->nullable(false);
            $table->string('nama_industri', 100)->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('kontak_industri', 20)->nullable(false);
            $table->enum('persetujuan_walas', ['disetujui', 'ditolak'])->nullable();
            $table->enum('persetujuan_kaprog', ['disetujui', 'ditolak'])->nullable();
            $table->enum('persetujuan_tu', ['disetujui', 'ditolak'])->nullable();
            $table->string('surat_resmi', 30)->nullable();
            $table->enum('status', ['belum_disetujui', 'disetujui', 'diajukan', 'diterima', 'ditolak'])->default('belum_disetujui')->nullable();
            $table->timestamps();

            $table->foreign('nip_walas')->references('nip')->on('walas')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nip_kaprog')->references('nip')->on('kaprog')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
