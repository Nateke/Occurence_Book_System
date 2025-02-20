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
        Schema::table('offended', function (Blueprint $table) {
            $table
                ->foreign('county_id')
                ->references('id')
                ->on('counties')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreign('country_id')
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
        Schema::table('offended', function (Blueprint $table) {
            $table->dropForeign(['county_id']);
            $table->dropForeign(['country_id']);
            $table->dropForeign(['subcounty_id']);
            $table->dropForeign(['ward_id']);
        });
    }
};
