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

        $sql = "drop function if exists `zodiac`";
        DB::statement($sql);

        $sql = <<<FNC
CREATE FUNCTION zodiac(d date) RETURNS varchar(40) deterministic NO SQL
begin
  DECLARE mn int;
  DECLARE dy int;
  DECLARE date_code int;
  DECLARE sign varchar(40);

    IF d IS NULL THEN
        return null;
    END IF;

    SET mn = Month(d);
    SET dy = Day(d);
    SET date_code = mn*100+dy;

    CASE
        WHEN date_code >= 1222 OR date_code <= 119  THEN set sign = 'Goat';
        WHEN date_code >= 120 AND date_code <= 218 THEN set sign = 'Water-Bearer';
        WHEN date_code >= 219 AND date_code <= 320  THEN set sign = 'Fish';
        WHEN date_code >= 321 AND date_code <= 419 THEN set sign = 'Ram';
        WHEN date_code >= 420 AND date_code <= 520  THEN set sign = 'Bull';
        WHEN date_code >= 521 AND date_code <= 620 THEN set sign = 'Twins';
        WHEN date_code >= 621 AND date_code <= 722  THEN set sign = 'Crab';
        WHEN date_code >= 723 AND date_code <= 822 THEN set sign = 'Lion';
        WHEN date_code >= 823 AND date_code <= 922  THEN set sign = 'Virgin';
        WHEN date_code >= 923 AND date_code <= 1021 THEN set sign = 'Scales';
        WHEN date_code >= 1022 AND date_code <= 1121  THEN set sign = 'Scorpion';
        WHEN date_code >= 1122 AND date_code <= 1221 THEN set sign = 'Archer';
        ELSE set sign = 'error';
    END CASE;

    return sign;

end
FNC;

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
        $sql = "drop function if exists `zodiac`";
        DB::statement($sql);

    }
};
