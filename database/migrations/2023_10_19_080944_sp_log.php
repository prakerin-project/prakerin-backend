<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "CREATE OR REPLACE PROCEDURE store_log_procedure
            (
                Action ENUM('INSERT', 'UPDATE', 'DELETE'),
                Activity TEXT
            )
            MODIFIES SQL DATA
            BEGIN
                DECLARE User TEXT;
                DECLARE IP VARCHAR(30);

                SELECT USER() INTO User;
                SELECT SUBSTRING_INDEX(host,':',1) AS 'ip' FROM information_schema.processlist WHERE ID=connection_id() INTO IP;

                INSERT INTO logs (action, activity, user, ip_address)
                VALUES (Action, Activity, User, IP);
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
