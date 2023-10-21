<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE OR REPLACE PROCEDURE logger(id TEXT,nama TEXT,akronim TEXT,type ENUM("INSERT","UPDATE","DELETE"))
        MODIFIES SQL DATA
        READS SQL DATA
        BEGIN
        DECLARE activity TEXT;
            SELECT CONCAT("id: ",id,", nama_jurusan: ",nama,", akronim: ",akronim) INTO activity;
        INSERT INTO `logs` VALUES(NULL,type,activity, CURRENT_USER(),CURRENT_TIMESTAMP());
        END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP PROCEDURE IF EXISTS `logger`;");
    }
};
