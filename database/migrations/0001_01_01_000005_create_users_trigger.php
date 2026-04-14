<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        /**
         * you need (at least one of) the SYSTEM_USER privilege(s) for this operation
         */

        $sql = "drop trigger if exists users_before_insert";
        DB::statement($sql);

        $sql = "drop trigger if exists users_before_update";
        DB::statement($sql);

        $sql = <<<TRI
CREATE TRIGGER users_before_insert BEFORE INSERT ON `users`
FOR EACH ROW
BEGIN

    SET NEW.zodiac_sign = zodiac(NEW.birth_date);

END
TRI;

        DB::statement($sql);

        $sql = <<<TRG
CREATE TRIGGER users_before_update BEFORE UPDATE ON `users`
FOR EACH ROW
BEGIN

    SET NEW.zodiac_sign = zodiac(NEW.birth_date);

END
TRG;

        DB::statement($sql);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        /**
         * you need (at least one of) the SYSTEM_USER privilege(s) for this operation
         */
        $sql = "drop trigger if exists users_before_insert";
        DB::statement($sql);

        $sql = "drop trigger if exists users_before_update";
        DB::statement($sql);
    }
};
