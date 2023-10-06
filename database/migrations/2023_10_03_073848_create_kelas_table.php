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
        Schema::create('kelas', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->id();
            $table->unsignedBigInteger('id_jurusan')->nullable(false);
            $table->char('kelompok', 1)->nullable();
            $table->enum('tingkat', ['10', '11', '12'])->nullable(false);
            $table->unsignedSmallInteger('angkatan')->nullable(false);

            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('id_jurusan')->references('id')->on('jurusan')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
