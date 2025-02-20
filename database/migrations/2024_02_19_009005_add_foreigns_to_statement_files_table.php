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
        Schema::table('statement_files', function (Blueprint $table) {
            $table
                ->foreign('statement_id')
                ->references('id')
                ->on('statements')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statement_files', function (Blueprint $table) {
            $table->dropForeign(['statement_id']);
        });
    }
};
