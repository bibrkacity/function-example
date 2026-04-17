<?php

use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function ($table) {
            $table->date('birth_date')->nullable()->after('password');
            $table->string('zodiac_sign', 20)
                ->nullable()
                ->index()
                ->after('birth_date');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('zodiac_sign');
        });

    }
};
