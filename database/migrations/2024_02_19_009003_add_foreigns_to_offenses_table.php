<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('offenses', function (Blueprint $table) {
//            $table
//                ->foreign('offenseCase_id')
//                ->references('id')
//                ->on('offense_cases')
//                ->onUpdate('CASCADE')
//                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offenses', function (Blueprint $table) {
//            $table->dropForeign(['offenseCase_id']);
        });
    }
};
