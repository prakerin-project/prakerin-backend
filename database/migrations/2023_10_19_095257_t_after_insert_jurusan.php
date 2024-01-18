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
        "CREATE OR REPLACE TRIGGER t_after_insert_jurusan 
        AFTER INSERT ON jurusan FOR EACH ROW
        BEGIN
            DECLARE Activity TEXT;

            SELECT CONCAT(
                'id_jurusan: ',NEW.id,
                ', nama_jurusan: ',NEW.nama_jurusan,
                ', akronim: ',NEW.akronim) INTO Activity;
                
            CALL store_log_procedure('INSERT', Activity);
        END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS `t_after_insert_jurusan`;");
    }
};
