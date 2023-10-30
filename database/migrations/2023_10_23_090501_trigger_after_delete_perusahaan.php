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
        "CREATE OR REPLACE TRIGGER tr_after_delete_perusahaan
            AFTER DELETE ON perusahaan FOR EACH ROW
            BEGIN
                DECLARE Activity TEXT;

                SET @Link = IFNULL(OLD.link_website, 'NULL');

                SELECT concat_perusahaan(
                    OLD.id,
                    OLD.id_jenis_perusahaan,
                    OLD.nama_perusahaan,
                    OLD.email, 
                    OLD.alamat,
                    @Link
                ) INTO Activity;

                CALL store_log_procedure('DELETE', Activity);
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
