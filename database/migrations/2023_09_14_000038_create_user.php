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
        Schema::create('user', function (Blueprint $table) {
            /* ------------------------------- ATTRIBUTES ------------------------------- */
            $table->uuid('id')->primary();
            $table->string('username', 20)->nullable(false)->unique();
            $table->string('password', 255)->nullable(false);
            $table->enum('role', ['siswa', 'walas', 'kaprog', 'pembimbing', 'hubin', 'tu'])->nullable(false);
            $table->string('foto_profil', 31)->nullable();
            $table->string('token', 100)->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
