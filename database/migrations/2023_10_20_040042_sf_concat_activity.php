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
        DB::unprepared(
            "CREATE OR REPLACE FUNCTION concat_perusahaan(
                id_perusahaan BIGINT UNSIGNED,
                id_jenis_perusahaan BIGINT UNSIGNED,
                nama_perusahaan VARCHAR(100),
                email VARCHAR(60),
                alamat TEXT,
                link_website VARCHAR(50)) RETURNS TEXT
            BEGIN
                    DECLARE JenisPerusahaan VARCHAR(100);
                    
                    SELECT nama INTO JenisPerusahaan FROM jenis_perusahaan WHERE id=id_jenis_perusahaan LIMIT 1;
                    
                    RETURN CONCAT(
                        'id_perusahaan: ', id_perusahaan,
                        ', jenis_perusahaan: ', JenisPerusahaan,
                        ', nama_perusahaan: ', nama_perusahaan,
                        ', email: ', email,
                        ', alamat: ', alamat,
                        ', link_website: ', link_website
                    );
            END;"
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
