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
        CREATE OR REPLACE TRIGGER t_after_insert_jurusan 
        AFTER INSERT ON jurusan FOR EACH ROW
        CALL logger(NEW.id,NEW.nama_jurusan,NEW.akronim,'INSERT');
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
