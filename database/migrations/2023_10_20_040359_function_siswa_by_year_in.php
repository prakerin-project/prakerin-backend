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
        CREATE OR REPLACE FUNCTION siswa_masuk(myear YEAR)
        RETURNS BIGINT UNSIGNED
        BEGIN
            DECLARE all_siswa BIGINT UNSIGNED;
            SELECT COUNT(*) FROM ukom2023_dharma_fattahul_winzi.siswa WHERE tahun_masuk = myear INTO all_siswa;
            
            RETURN all_siswa;
        END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP FUNCTION IF EXISTS `siswa_masuk`;");
    }
};
