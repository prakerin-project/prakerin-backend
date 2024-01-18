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
        "CREATE OR REPLACE TRIGGER t_after_delete_jurusan 
        AFTER DELETE ON jurusan FOR EACH ROW
        BEGIN
            DECLARE Activity TEXT;

            SELECT CONCAT(
                'id_jurusan: ',OLD.id,
                ', old.nama_jurusan: ',OLD.nama_jurusan,
                ', old.akronim: ',OLD.akronim) INTO Activity;

            CALL store_log_procedure('DELETE', Activity);
        END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS `t_after_delete_jurusan`;");
    }
};
