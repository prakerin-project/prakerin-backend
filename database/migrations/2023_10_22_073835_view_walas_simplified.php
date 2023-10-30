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
        DB::unprepared("
        CREATE OR REPLACE VIEW `walas_simplified` AS
        SELECT
            walas.nip, 
            walas.nama, 
            walas.no_telp, 
            walas.jenis_kelamin, 
            kelas.kelompok, 
            kelas.tingkat, 
            kelas.angkatan, 
            jurusan.akronim,
            CONCAT(kelas.angkatan,' - ',kelas.tingkat,' ',jurusan.akronim,' ',kelas.kelompok) AS kelas_shorten
        FROM 
            walas
            LEFT JOIN
            kelas
            ON 
                walas.id_kelas = kelas.id
            LEFT JOIN
            jurusan
            ON 
                kelas.id_jurusan = jurusan.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `walas_simplified`;");
    }
};
