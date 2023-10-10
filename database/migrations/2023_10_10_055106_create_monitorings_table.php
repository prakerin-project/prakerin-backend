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
        Schema::create('monitoring', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->string('id', 30)->primary();
            $table->string('nip_pembimbing', 20)->nullable(false);
            $table->string('id_prakerin', 15)->nullable(false);
            $table->date('tanggal')->nullable(false);
            $table->text('catatan')->nullable(false);
            $table->string('bukti', 50)->nullable(false);
            $table->timestamps();

            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('nip_pembimbing')->references('nip_nik')->on('pembimbing')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_prakerin')->references('id')->on('prakerin')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring');
    }
};
