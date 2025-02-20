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
        Schema::create('flats_bails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('amount');
            $table->string('conditions')->nullable();
            $table->dateTimeTz('release_date');
            $table->string('surety_details');
            $table->unsignedBigInteger('booking_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flats_bails');
    }
};
