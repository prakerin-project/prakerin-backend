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
            $table->id();
            $table->unsignedBigInteger('id_jurnal')->nullable(false);
            $table->string('aktivitas', 255)->nullable(false);
            $table->date('tanggal')->useCurrent()->nullable(false);
            $table->enum('konfirmasi', ['valid', 'not_valid'])->default('not_valid')->nullable(false);

            $table->foreign('id_jurnal')->references('id')->on('jurnal')
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
