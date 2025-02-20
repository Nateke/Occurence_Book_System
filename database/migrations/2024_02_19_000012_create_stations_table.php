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
        Schema::create('stations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('station_name');
            $table->string('station_number');
            $table->string('location')->nullable();
            $table->string('sublocation')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('county_id');
            $table->unsignedBigInteger('subcounty_id');
            $table->unsignedBigInteger('ward_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
