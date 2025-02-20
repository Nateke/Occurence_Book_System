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
        Schema::create('witness', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_scan')->nullable();
            $table->boolean('underage_flag');
            $table->string('phone_number')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('other_name')->nullable();
            $table->enum('gender',['male', 'female', 'other'])->default('male');
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('county_id');
            $table->unsignedBigInteger('subcounty_id');
            $table->unsignedBigInteger('ward_id');
            $table->unsignedBigInteger('added_by');
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('occupation')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('witness');
    }
};
