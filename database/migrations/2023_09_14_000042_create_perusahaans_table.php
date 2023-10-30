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
            $table->unsignedBigInteger('id_jenis_perusahaan');
            $table->string('nama_perusahaan', 100)->unique()->nullable(false);
            $table->string('email', 60)->unique()->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('link_website', 50)->nullable(true);
            /* ----------------------------------- FK ----------------------------------- */
            $table->foreign('id_jenis_perusahaan')->references('id')->on('jenis_perusahaan')
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
