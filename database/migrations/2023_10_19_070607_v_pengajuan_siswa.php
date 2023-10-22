<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            'CREATE OR REPLACE VIEW v_pengajuan_siswa AS 
                SELECT id_pengajuan, nis_siswa, nama, tingkat, nama_jurusan, kelompok, tanggal_pengajuan, status FROM pengajuan_siswa INNER JOIN siswa ON pengajuan_siswa.nis_siswa = siswa.nis 
                INNER JOIN pengajuan ON pengajuan_siswa.id_pengajuan = pengajuan.id 
                INNER JOIN kelas ON kelas.id = siswa.id_kelas 
                INNER JOIN jurusan ON jurusan.id = kelas.id_jurusan;
            '
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
