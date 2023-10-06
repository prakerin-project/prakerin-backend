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
        Schema::create('aktivitas_jurnal', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->id();
            $table->string('id_prakerin', 15)->nullable(false);
            $table->string('pengonfirmasi', 20)->nullable();
            $table->string('aktivitas', 255)->nullable(false);
            $table->date('tanggal')->useCurrent()->nullable(false);
            $table->enum('konfirmasi', ['valid', 'not_valid'])->default('not_valid')->nullable(false);
            $table->string('foto', 25)->nullable(false);
            $table->time('jam_masuk')->nullable(false);
            $table->time('jam_pulang')->nullable(false);

            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('id_prakerin')->references('id')->on('prakerin')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('pengonfirmasi')->references('nip_nik')->on('pembimbing')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas_jurnal');
    }
};
