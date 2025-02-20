<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('user_code')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->unique();
            $table->string('address')->nullable();
            $table->enum('gender',['male', 'female', 'other'])->default('male');
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('nationality')->nullable();
            $table->unsignedBigInteger('county_id')->nullable();
            $table->unsignedBigInteger('subcounty_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->enum('status', ['active','suspended'])->default('suspended');
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
