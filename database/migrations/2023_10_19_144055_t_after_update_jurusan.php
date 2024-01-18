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
        DB::unprepared(
        "CREATE OR REPLACE TRIGGER t_after_update_jurusan 
        AFTER UPDATE ON jurusan FOR EACH ROW
        BEGIN
            DECLARE Activity TEXT;

            SELECT CONCAT(
                'id_jurusan: ',NEW.id,
                ', new.nama_jurusan: ',NEW.nama_jurusan,
                ', old.nama_jurusan: ',OLD.nama_jurusan,
                ', new.akronim: ',NEW.akronim,
                ', old.akronim: ',OLD.akronim) INTO Activity;

            CALL store_log_procedure('UPDATE', Activity);
        END;
        "
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS `t_after_update_jurusan`;");
    }
};
