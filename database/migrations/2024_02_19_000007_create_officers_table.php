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
        Schema::create('officers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('station_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('officer_name');
            $table->string('badge_number');
            $table->string('rank');
            $table->enum('gender',['male', 'female', 'other'])->default('male');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('officers');
    }
};
