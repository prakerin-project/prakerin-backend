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
        Schema::create('pembimbing', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->string('nip_nik', 20)->primary();
            $table->unsignedBigInteger('id_jurusan')->nullable(false);
            $table->string('id_user', 36)->nullable(false);
            $table->string('nama', 100)->nullable(false);
            $table->string('no_telp', 22)->nullable(false); // (+62) 8XX-XXXX-XXXX
            $table->string('email', 255)->unique()->nullable(false);
            $table->enum('lingkup', ['sekolah', 'industri'])->nullable(false);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(false);
            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('id_user')->references('id')->on('user')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_jurusan')->references('id')->on('jurusan')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing');
    }
};
