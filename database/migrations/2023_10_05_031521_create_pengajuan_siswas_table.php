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
        Schema::create('pengajuan_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengajuan', 15)->nullable(false);
            $table->string('nis_siswa', 12)->nullable(false);

            $table->foreign('id_pengajuan')->references('id')->on('pengajuan')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('nis_siswa')->references('nis')->on('siswa')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_siswa');
    }
};
