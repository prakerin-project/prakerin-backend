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
        Schema::create('siswa', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->string('nis', 12)->primary();
            $table->unsignedBigInteger('id_kelas')->nullable(false);
            $table->string('id_user', 36)->nullable(false);
            $table->string('nama', 100)->nullable(false);
            $table->string('email', 255)->unique()->nullable(false);
            $table->year('tahun_ajaran')->nullable(false);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(false);
            $table->string('tempat_lahir', 30)->nullable(false);
            $table->date('tanggal_lahir')->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('no_telp', 22)->nullable(false); // (+62) 8XX-XXXX-XXXX
            $table->string('no_telp_wali', 22)->nullable(false); // (+62) 8XX-XXXX-XXXX
            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('id_kelas')->references('id')->on('kelas')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_user')->references('id')->on('user')
                ->cascadeOnDelete()->cascadeOnUpdate();
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