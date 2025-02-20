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
        Schema::create('statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('statement_text');
            $table->unsignedBigInteger('recorded_by');
            $table->dateTimeTz('recording_date');
            $table->unsignedBigInteger('booking_id');
            $table->string('evidence_collected')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statements');
    }
};
