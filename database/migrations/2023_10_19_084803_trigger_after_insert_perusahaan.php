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
            "CREATE OR REPLACE TRIGGER tr_after_insert_perusahaan
            AFTER INSERT ON perusahaan FOR EACH ROW
            BEGIN
                DECLARE Activity TEXT;

                SET @Link = IFNULL(NEW.link_website, 'NULL');

                SELECT concat_perusahaan(
                    NEW.id,
                    NEW.id_jenis_perusahaan,
                    NEW.nama_perusahaan,
                    NEW.email, 
                    NEW.alamat,
                    @Link
                ) INTO Activity;

                CALL store_log_procedure('INSERT', Activity);
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
