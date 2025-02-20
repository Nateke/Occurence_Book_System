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
        Schema::table('statements', function (Blueprint $table) {
            $table
                ->foreign('recorded_by')
                ->references('id')
                ->on('officers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statements', function (Blueprint $table) {
            $table->dropForeign(['recorded_by']);
            $table->dropForeign(['booking_id']);
        });
    }
};
