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
        "CREATE OR REPLACE TRIGGER tr_after_update_perusahaan
            AFTER UPDATE ON perusahaan FOR EACH ROW
            BEGIN
                DECLARE OldActivity TEXT;
                DECLARE NewActivity TEXT;

                SET @OldLink = IFNULL(OLD.link_website, 'NULL');
                SET @NewLink = IFNULL(NEW.link_website, 'NULL');

                SELECT concat_perusahaan(
                    OLD.id,
                    OLD.id_jenis_perusahaan,
                    OLD.nama_perusahaan,
                    OLD.email, 
                    OLD.alamat,
                    @OldLink
                ) INTO OldActivity;
                
                SELECT concat_perusahaan(
                    NEW.id,
                    NEW.id_jenis_perusahaan,
                    NEW.nama_perusahaan,
                    NEW.email, 
                    NEW.alamat,
                    @NewLink
                ) INTO NewActivity;

                CALL store_log_procedure('UPDATE', CONCAT('From : {', OldActivity, '} To : {', NewActivity, '}'));
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
