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
        Schema::create('offenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('offence_name');
            $table->text('description');
            $table->double('fine_amount')->nullable();
            $table->string('imprisonment_duration')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offenses');
    }
};
