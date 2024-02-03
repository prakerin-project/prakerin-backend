<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            'CREATE OR REPLACE VIEW angkatan_view AS 
                SELECT k.angkatan, s.tahun_masuk, COUNT(DISTINCT s.id_kelas) 
                AS jumlah_kelas, COUNT(s.nis) AS jumlah_siswa
                FROM kelas k
                JOIN siswa s ON k.id = s.id_kelas
                GROUP BY k.angkatan, s.tahun_masuk;
            ',
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
