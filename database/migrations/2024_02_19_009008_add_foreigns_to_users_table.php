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
        Schema::table('users', function (Blueprint $table) {
//            $table
//                ->foreign('officer_id')
//                ->references('id')
//                ->on('officers')
//                ->onUpdate('CASCADE')
//                ->onDelete('CASCADE');

            $table
                ->foreign('county_id')
                ->references('id')
                ->on('counties')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreign('nationality')
                ->references('id')
                ->on('countries')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('subcounty_id')
                ->references('id')
                ->on('subcounties')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('ward_id')
                ->references('id')
                ->on('wards')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->dropForeign(['officer_id']);
            $table->dropForeign(['nationality']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['subcounty_id']);
            $table->dropForeign(['ward_id']);
        });
    }
};
