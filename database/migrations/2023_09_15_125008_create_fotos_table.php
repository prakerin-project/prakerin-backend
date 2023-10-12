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
        Schema::create('foto', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->id();
            $table->unsignedBigInteger('id_perusahaan')->nullable(false);
            $table->string('path', 20)->nullable(false);
            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('id_perusahaan')->references('id')->on('perusahaan')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto');
    }
};
