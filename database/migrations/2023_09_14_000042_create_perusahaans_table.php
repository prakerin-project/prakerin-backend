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
        Schema::create('perusahaan', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->id();
            $table->unsignedBigInteger('id_bidang_keahlian');
            $table->string('nama_perusahaan', 100)->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('email', 60)->nullable(false);
            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('id_bidang_keahlian')->references('id')->on('bidang_keahlian')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};