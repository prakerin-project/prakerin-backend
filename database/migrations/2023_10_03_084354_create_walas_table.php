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
        Schema::create('walas', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->string('nip', 20)->primary();
            $table->unsignedBigInteger('id_kelas')->nullable(false);
            $table->string('id_user', 36)->nullable(false);
            $table->string('nama', 100)->nullable(false);
            $table->string('no_telp', 22)->nullable(false); // (+62) 8XX-XXXX-XXXX
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(false);
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
        Schema::dropIfExists('walas');
    }
};
