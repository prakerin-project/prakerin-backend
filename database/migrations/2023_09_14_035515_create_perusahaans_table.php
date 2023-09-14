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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bidang_keahlian')->index();
            $table->string('nama_perusahaan', 100)->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('email', 60)->nullable(false);

            $table->foreign('id_bidang_keahlian')->on('bidang_keahlian')->references('id');
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
