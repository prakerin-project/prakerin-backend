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
        Schema::create('kaprog', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->string('nip', 20)->primary();
            $table->unsignedBigInteger('id_jurusan')->nullable(false);
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->string('nama', 100)->nullable(false);
            $table->string('no_telp', 22)->nullable(false); // (+62) 8XX-XXXX-XXXX
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(false);
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
        Schema::dropIfExists('kaprog');
    }
};
